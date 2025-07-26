<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Product;
use App\Models\Rating;
use App\Traits\SellerRating;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use SellerRating;

    
    public function getAllProductsForUser(Request $request)
    {
        $userId = $request->seller_id;
      
        $products = Product::with(['product_images', 'brand', 'city', 'area'])
                        ->withCount('likes')
                        ->withCount('views')
                        ->where('user_id',$userId)
                        ->leftJoin('subscriptions', function($join) {
                            $join->on('products.id', '=', 'subscriptions.product_id');
                        })
                        ->selectRaw('IF(subscriptions.is_expired IS false,1,0) AS has_subscription')
                        ->paginate(20);

        foreach ($products as &$product) {
            $product->liked = Like::where('product_id', $product->id)
                ->where('user_id', $userId)
                ->exists();
                
            $product->sellerRating = $this->getSellerRating($product->user_id);
        }

        return response()->json([
            'status' => 200,
            'data' => $products,
        ]);
    }

    public function getAllLikedProductsForUser(Request $request)
    {
        $userId = auth()->guard('api')->id();
      
        $products = Product::with(['product_images', 'brand', 'city', 'area', 'owner'])
                        ->whereHas('likes', function($query) use ($userId) {
                            return $query->where('user_id', $userId);
                        })
                        ->withCount('likes')
                        ->withCount('views')
                        ->paginate(20);

        foreach ($products as &$product) {
            $product->sellerRating = $this->getSellerRating($product->user_id);
        }

        return response()->json([
            'status' => 200,
            'data' => $products,
        ]);
    }


    public function getRating()
    {
        $sellerId = auth()->guard('api')->id();

        $rates = Rating::where('user_id', $sellerId)->get();

        return response()->json([
            'status' => 200,
            'data' => $rates,
            'sellerRating' => $this->getSellerRating($sellerId)
        ]);
    }

}
