<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewProductFirebasNotification;
use App\Mail\NewProductAdded;
use App\Models\Area;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','DESC')->get();

        return view('Admin.pages.products.index' , compact('products'));
    }

    public function create()
    {
        $subcategories = Subcategory::all();
        $brands = Brand::select(['name_ar', 'name_fr', 'id'])->get();
        $users = User::get(['first_name', 'last_name', 'id']);
        $cities = City::get(['name_ar', 'name_fr', 'id']);
        $areas = Area::get(['name_ar', 'name_fr', 'id']);;


        return view('Admin.pages.products.create' , compact(
            'subcategories',
            'brands',
            'users',
            'cities',
            'areas'
        ));
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'user_id' => 'required|exists:users,id',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
            'delivery_type' => 'required|numeric|in:1,2',
            'name' => 'required',
            'price' => 'required',
            'type' => 'required|numeric|digits_between:1,2',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif',
        ]);

        $user = User::find($request->user_id);

        $data = $request->except(['_token', '_method']);
        Image::make($request->image)->save('uploads/products/' . $request->image->hashName());
        $data['image'] = 'uploads/products/' . $request->image->hashName();
        $data['SKU'] = $this->generateSKU();

        $product = Product::create($data);

        // Foreach through Multiple images 
        if( $request->multiple_images ){
            foreach($request->multiple_images as $img){

                // Insert Image into server .
                Image::make($img)->save('uploads/products/multi_images/' . $img->hashName());

                // Insert image into database .
                $productImage = new ProductImage;
                $productImage->product_id = $product->id;
                $productImage->image = 'uploads/products/multi_images/'. $img->hashName();
                $productImage->save();
            }
        }

        Mail::to($user->email)->send(new NewProductAdded($product, $user));
        SendNewProductFirebasNotification::dispatch($product);

        successMessage(trans('backend.created_successfully'));
        return redirect()->route('admin.products.index');
    }

    
    public function show(Product $product)
    {
        return view('Admin.pages.products.show' , compact('product'));
    }

    
    public function edit(Product $product)
    {
        $subcategories = Subcategory::all();
        $brands = Brand::select(['name_ar', 'name_fr', 'id'])->get();
        $users = User::get(['first_name', 'last_name', 'id']);
        $cities = City::get(['name_ar', 'name_fr', 'id']);
        $areas = Area::where('city_id', $product->city_id)->get(['name_ar', 'name_fr', 'id']);


        return view('Admin.pages.products.edit' , compact(
            'product',
            'subcategories',
            'brands',
            'users',
            'cities',
            'areas'
        ));
    }

    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'user_id' => 'required|exists:users,id',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
            'delivery_type' => 'required|numeric|in:1,2',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'type' => 'required|numeric|digits_between:1,2',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
        ]);

        $data = $request->except(['_token', '_method']);
        
        if ( $request->image ) {
            if( $product->image != 'uploads/products/default.png' && file_exists($product->image) ){
                unlink($product->image);
            }
            Image::make($request->image)->save('uploads/products/' . $request->image->hashName());
            $data['image'] = 'uploads/products/' . $request->image->hashName();
        }

        if (  $product->update($data) ) {

            // Foreach through Multiple images 
            if( $request->multiple_images ){
                foreach($request->multiple_images as $img){

                    // Insert Image into server .
                    Image::make($img)->save('uploads/products/multi_images/' . $img->hashName());

                    // Insert image into database .
                    $productImage = new ProductImage;
                    $productImage->product_id = $product->id;
                    $productImage->image = 'uploads/products/multi_images/'. $img->hashName();
                    $productImage->save();
                }
            }
        }

        successMessage(trans('backend.updated_successfully'));
        return redirect()->route('admin.products.index');
    }

    
    public function destroy(Product $product)
    {
        if( $product->image != 'uploads/products/default.png' && file_exists($product->image) ){
            unlink($product->image);
        }
        
        $product->delete();

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect()->back();
    }

    public function activation(Product $product)
    {
        if( $product->status == 1 ){
            $product->status = 0;
            $product->save();
            session()->flash('success', trans('backend.record_disabled_successfully'));
            return redirect()->back();
        }else{
            $product->status = 1;
            $product->save();
            session()->flash('success', trans('backend.record_actived_successfully'));
            return redirect()->back();
        }
        
    }

    private function generateSKU()
    {
        $sku = '';
        do {
            $sku = mt_rand(11111111,99999999);

            if(!Product::where('sku',$sku)->exists()) 
                break;
        }while(true);

        return $sku;
    }

    public function deleteSingleImage(Request $request)
    {
        $product_image = ProductImage::find($request->image_id);
        unlink($product_image->image);
        $product_image->delete();
        return $product_image;
    }

    public function editSingleImage(Request $request)
    {
        $product_image = ProductImage::find($request->image_id);

        return asset($product_image->image);
    }

    public function updateSingleImage(Request $request)
    {

        $product_single_image = ProductImage::find($request->imageId);

        if( $request->image ){
            
            unlink($product_single_image->image);
            $product_single_image->delete();

            Image::make($request->image)->save('uploads/products/multi_images/' . $request->image->hashName());
            $product_single_image->image = 'uploads/products/multi_images/' . $request->image->hashName();
            $product_single_image->save();
        }

        
    }

    public function storeSingleImage(Request $request)
    {
        if( $request->image ){
            $product_single_image = new ProductImage;

            // Insert Image into server .
            Image::make($request->image)->save('uploads/products/multi_images/' . $request->image->hashName());
            $product_single_image->image = 'uploads/products/multi_images/' . $request->image->hashName();
            
            // insert image into database .
            $product_single_image->product_id = $request->product_id;
            $product_single_image->image = 'uploads/products/multi_images/' . $request->image->hashName();
            $product_single_image->save();
        }
    }

    public function areasByCityId(Request $request)
    {
        $city = City::find($request->cityId);

        if ($city) {
            $areas = $city->areas;
        } else {
            $areas = [];
        }
       
        return response()->json([
            'status' => 200,
            'data' => $areas
        ]);
    }
}
