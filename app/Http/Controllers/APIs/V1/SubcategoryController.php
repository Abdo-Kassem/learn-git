<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Like;
use App\Models\Product;
use App\Models\Subcategory;
use App\Traits\SellerRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    use SellerRating;

    
    public function getProducts(Request $request)
    {
        $validator = Validator::make($request->only(['subcategory_id']), [
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => '0',
                'message' => trans('backend.category_not_found')
            ]);
        }

        $userId = $request->has('token') ? auth()->guard('api')->id() : null;

        $products = Product::with(['product_images', 'owner', 'city', 'area'])
            ->withCount('likes')
            ->withCount('views')
            ->where('subcategory_id', $request->subcategory_id)
            ->where('status', 1)
            ->leftJoin('subscriptions', function($join) {
                $join->on('products.id', '=', 'subscriptions.product_id')
                    ->where('subscriptions.is_expired', false);
            })
            //->select('products.*')
            ->selectRaw('IF(subscriptions.is_expired IS FALSE, 1, 0) as has_subscription')
            ->orderByDesc('has_subscription') // Products with active subscriptions first
            ->orderByDesc('products.id')            // Then by product ID in descending order
            ->paginate(20);                         // Paginate with 20 items per page

        // Add liked and sellerRating attributes
        $products->getCollection()->transform(function ($product) use ($userId) {
            $product->liked = $userId
                ? Like::where('product_id', $product->id)->where('user_id', $userId)->exists()
                : false;
            $product->sellerRating = $this->getSellerRating($product->user_id);
            return $product;
        });

        return response()->json([
            'status' => 200,
            'data' => $products
        ]);
        
    }

}
