<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewProductFirebasNotification;
use App\Mail\NewProductAdded;
use App\Models\Like;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductView;
use App\Models\User;
use App\Notifications\FirebasSMSNotification;
use App\Traits\SellerRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use SellerRating;

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subcategory_id' => 'required|exists:subcategories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
            'delivery_type' => 'required|numeric|in:1,2',
            'name' => 'required',
            'price' => 'required',
            'type' => 'required|numeric|digits_between:1,2',
            'description' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $user = auth()->guard('api')->user();

        $data = $request->except(['token', '_method', 'multiple_images']);
        $data['image'] = $this->saveImage($request->image, $request->name_fr);
        $data['SKU'] = $this->generateSKU();
        $data['user_id'] = $user->id;

        $product = Product::create($data);
 
        if( $request->multiple_images ) {
            $images = [];

            foreach($request->multiple_images as $index => $img){
                $images[$index]['product_id'] = $product->id;
                $images[$index]['image'] = $this->saveImage($img, Str::random(6));
            }

            ProductImage::insert($images);
        }

        Mail::to($user->email)->send(new NewProductAdded($product, $user));
        
        SendNewProductFirebasNotification::dispatch($product);

        return response()->json([
            'status' => 200,
            'success' => 'Product Added Successfully',
            'product_id' => $product->id 
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
            'delivery_type' => 'required|numeric|in:1,2',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'type' => 'required|numeric|digits_between:1,2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $product = Product::find($request->product_id);
        $data = $request->except(['_token', '_method']);
        
        if ($request->image) {
            if( $product->image != 'uploads/products/default.png' ){
                unlink($product->image);
            }
            $data['image'] = $this->saveImage($request->image, $request->name_fr);
        }

        if ( $product->update($data) ) {
            if( $request->multiple_images ) {
                $data = [];

                foreach($request->multiple_images as $index => $img){
                    $data[$index]['product_id'] = $product->id;
                    $data[$index]['image'] = $this->saveImage($img, Str::random(6));
                }

                ProductImage::insert($data);
            }
        }

        return response()->json([
            'status' => 200,
            'success' => 'Product Updated Successfully'
        ]);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->only(['product_id']), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $product = Product::find($request->product_id);

        if( $product->image != 'uploads/products/default.png' ){
            unlink($product->image);
        }
        
        $product->delete();

        return response()->json([
            'status' => 200,
            'success' => 'Product Deleted Successfully'
        ]);
    }

    public function deleteSingleImage(Request $request)
    {
        $validator = Validator::make($request->only(['image_id']), [
            'image_id' => 'required|exists:product_images,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $product_image = ProductImage::find($request->image_id);
        unlink($product_image->image);
        $product_image->delete();
        
        return response()->json([
            'status' => 200,
            'success' => 'Image Deleted Successfully'
        ]);
    }

    public function markAsSold(Request $request)
    {
        $validator = Validator::make($request->only(['product_id']), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }

        Product::where('id', $request->product_id)->update(['status' => 0]);

        return response()->json([
            'status' => 200,
            'success' => 'Product Mark As Sold Successfully'
        ]);
    }

    public function addView(Request $request)
    {
        $validator = Validator::make($request->only(['product_id']), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $userId = auth()->guard('api')->id();
        $userHasView = ProductView::where('user_id', $userId)->where('product_id', $request->product_id)->exists();

        if (! $userHasView) {
            ProductView::create(['user_id' => $userId, 'product_id' => $request->product_id]);
        }

        return response()->json([
            'status' => 200,
            'success' => 'One View Added Successfully'
        ]);
    }

    public function getAllProducts(Request $request)
    {
        $products = Product::with(['product_images', 'owner', 'brand', 'city', 'area'])
                        ->withCount('likes')
                        ->withCount('views')
                        ->where('type',$request->type)
                        ->where('status', 1);
                        
        if ($request->has('token')) {
            $userId = auth()->guard('api')->id();

            $products = $products->whereDoesntHave('complaints', function($query) use ($userId) {
                                return $query->where('user_id', $userId);
                            })->paginate(20);

            foreach ($products as &$product) {
                $product->liked = Like::where('product_id', $product->id)
                    ->where('user_id', $userId)
                    ->exists();
            }
        } else {
            $products = $products->paginate(20);
        }

        foreach ($products as &$product) {
            $product->sellerRating = $this->getSellerRating($product->user_id);
        }

        return response()->json([
            'status' => 200,
            'data' => $products,
        ]);
    }

    public function getFeaturedProducts(Request $request)
    {
        $userId = $request->has('token') ? auth()->guard('api')->id() : null;

        $products = Product::with(['product_images', 'owner', 'city', 'area'])
            ->withCount('likes')
            ->withCount('views')
            ->where('status', 1)
            ->leftJoin('subscriptions', function($join) {
                $join->on('products.id', '=', 'subscriptions.product_id')
                    ->where('subscriptions.is_expired', false);
            })
            //->select('products.*')
            ->selectRaw('IF(subscriptions.is_expired IS FALSE, 1, 0) as has_subscription')
            ->orderByDesc('has_subscription') // Products with active subscriptions first
            ->orderByDesc('views_count');            // Then by product ID in descending order        
                        
        if ($userId) {
            $products = $products->whereDoesntHave('complaints', function($query) use ($userId) {
                return $query->where('user_id', $userId);
            })->paginate(10);
        } else {
            $products = $products->paginate(10);
        }

        $products->getCollection()->transform(function ($product) use ($userId) {
            $product->liked = $userId
                ? Like::where('product_id', $product->id)->where('user_id', $userId)->exists()
                : false;
            $product->sellerRating = $this->getSellerRating($product->user_id);
            return $product;
        });

        return response()->json([
            'status' => 200,
            'data' => $products,
        ]);
    }

    public function getProduct(Request $request)
    {
        $validator = Validator::make($request->only('product_id'), [
            'product_id' => 'required|exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray());
        }

        $product = Product::with(['product_images', 'owner', 'brand', 'city', 'area'])
            ->withCount('likes')
            ->withCount('views')
            ->find($request->product_id);
        
        if ($request->has('token')) {
            $userId = auth()->guard('api')->id();

            $product->liked = Like::where('product_id', $product->id)
                ->where('user_id', $userId)
                ->exists();
        }

        $product->sellerRating = $this->getSellerRating($product->user_id);

        $this->sendFirebaseSMSNotification($product);
            
        return response()->json($product, 200);
    }

    private function saveImage($image, $name)
    {
        $path = 'uploads/products/' . $name . '_' . time() . '.png'; 
        $imageContent = base64_decode($image);
        file_put_contents($path, $imageContent);
        return $path;
    }

    private function generateSKU()
    {
        $sku = '';

        do {
            $sku = mt_rand(11111111,99999999);

            if(! Product::where('sku',$sku)->exists()) {
                break;
            }      
        } while(true);

        return $sku;
    }

    private function sendFirebaseSMSNotification(Product $product)
    {
        $seller = User::select(['id', 'fcm_device_token', 'prefered_language', 'first_name'])
            ->find($product->user_id);

        if ($seller->prefered_language == 'ar') {
            $title = "المنتج: " . $product->name_ar . ' تم عرضه';
            $message = "مرحبا استاذ " . $seller->first_name . " يسعدنا ان نخبرك ان تم عرض المنتج: " . $product->name_ar;
        } else {
            $title = "Produit affiché: " . $product->name_fr;
            $message = "Bonjour professeur " . $seller->first_name . " Nous avons le plaisir de vous informer que le produit a été affiché:" . $product->name_fr;
        }

        $seller->notify(new FirebasSMSNotification($title, $message));
    }

}
