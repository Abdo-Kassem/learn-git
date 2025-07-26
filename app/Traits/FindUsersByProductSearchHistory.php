<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\User;

trait FindUsersByProductSearchHistory
{
    public function getUsersByProductSearchHistory(Product $product) 
    {
        $users = User::where('users.id', '!=', $product->user_id)
            ->whereHas('searchHistroy', function($query)  use ($product) {
                return $query->where(function($query) use ($product) {
                        return $query->where('min_price', '<=', $product->price)
                            ->orWhereNull('min_price');
                    })->where(function($query) use ($product) {
                        return $query->where('max_price', '>=', $product->price)
                            ->orWhereNull('max_price');
                    })->where(function($query) use ($product) {
                        return $query->where('subcategory_id', $product->subcategory_id)
                            ->orWhereNull('subcategory_id');
                    })->where(function($query) use ($product) {
                        return $query->where('city_id', $product->city_id)
                            ->orWhereNull('city_id');
                    })->where(function($query) use ($product) {
                        return $query->where('area_id', $product->area_id)
                            ->orWhereNull('area_id');
                    })->where(function($query) use ($product) {
                        return $query->where('state', $product->type)
                            ->orWhereNull('state');
                    });
            })->select(['fcm_device_token', 'prefered_language', 'id'])->get();
        
        return $users;
    }
}