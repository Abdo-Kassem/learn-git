<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Jobs\NotifyBeforDeleteProduct;
use App\Models\Like;
use App\Models\Product;
use App\Models\SearchHistory;
use App\Traits\SellerRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    use SellerRating;


    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'min_price' => 'nullable|numeric',
            'max_price' => 'nullable|numeric' . (isset($request->min_price) ? '|gte:min_price' : ''),
            'subcategory_id' => 'nullable|numeric|exists:subcategories,id',
            'city_id' => 'nullable|numeric|exists:cities,id',
            'area_id' => 'nullable|numeric|exists:areas,id',
            'state' => 'nullable|numeric|in:1,2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $price = [
            $request->min_price ?? Product::min('price'),
            $request->max_price ?? Product::max('price')
        ];

        $query = Product::with(['product_images', 'owner', 'brand', 'city', 'area'])
            ->withCount('likes')
            ->withCount('views')
            ->whereBetween('price', $price)
            ->where('status', 1);
        
        if (isset($request->subcategory_id)) {
            $query->where('subcategory_id', $request->subcategory_id);
        }
        
        if (isset($request->state)) {
            $query->where('type', $request->state);
        }

        if (isset($request->city_id)) {
            $query->where('city_id', $request->city_id);
        }

        if (isset($request->area_id)) {
            $query->where('area_id', $request->area_id);
        }

        if (isset($request->querySearch)) {
            $querySearch = $request->query_search;

            $query->where(function($query) use ($querySearch) {
                $query->where('name_ar', 'like', '%' . $querySearch . '%')
                    ->orWhere('name_fr', 'like', '%' . $querySearch . '%');
            });
        }

        $query->leftJoin('subscriptions', function($join) {
            $join->on('products.id', '=', 'subscriptions.product_id')
                ->where('subscriptions.is_expired', false);
        })
        ->selectRaw('IF(subscriptions.is_expired IS FALSE, 1, 0) as has_subscription')
        ->orderByDesc('has_subscription')       //Products with active subscriptions first
        ->orderByDesc('products.id');            // Then by product ID in descending order

        $userId = $request->has('token') ? auth()->guard('api')->id() : null;

        if ($userId) {
            $products = $query->whereDoesntHave('complaints', function($query) use ($userId) {
                return $query->where('user_id', $userId);
            })->paginate(20);
        } else {
            $products = $query->paginate(20);
        }

        $products->getCollection()->transform(function ($product) use ($userId) {
            $product->liked = $userId
                ? Like::where('product_id', $product->id)->where('user_id', $userId)->exists()
                : false;
            $product->sellerRating = $this->getSellerRating($product->user_id);
            return $product;
        });

        if ($userId) {
            $this->storeSearchInHistroy($request);
        }
        
        return response()->json([
            'status' => 200,
            'data' => $products
        ]);
    }

    private function storeSearchInHistroy(Request $request)
    {
        $data = $request->except('token');

        if (count($data) > 0 && $request->has('token')) {
            $data['user_id'] = auth()->guard('api')->id();
            SearchHistory::create($data);
        }
    }

}
