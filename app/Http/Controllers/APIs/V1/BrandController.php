<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Like;
use App\Models\Product;
use App\Traits\SellerRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    use SellerRating;

    
    public function index() 
    {
        $brands = Brand::get();
        return response()->json([
            'data' => $brands,
            'status' => 200
        ]);
    }

    public function getProductsByBrand(Request $request)
    {
        $validator = Validator::make($request->only('brand_id'), [
            'brand_id' => 'required|exists:brands,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray());
        }

        $products = Product::where('brand_id', $request->brand_id)
                        ->with(['product_images', 'city', 'area'])
                        ->where('status', 1)
                        ->get();

        if ($request->has('token')) {
            $userId = auth()->guard('api')->id();

            foreach ($products as &$product) {
                $product->liked = Like::where('product_id', $product->id)
                        ->where('user_id', $userId)
                        ->exists();
            }
        }

        foreach ($products as &$product) {
            $product->sellerRating = $this->getSellerRating($product->user_id);
        }
                        
        return response()->json($products, 200);
    }
}
