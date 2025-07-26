<?php

namespace App\Traits;

use App\Models\Rating;

trait SellerRating
{
    private $returnedRating = [];

    public function getSellerRating($sellerId) 
    {
        if (! array_key_exists($sellerId, $this->returnedRating)) {
            $ratingAvreage = Rating::where('user_id', $sellerId)->average('rating_number');
            $this->returnedRating[$sellerId] = number_format($ratingAvreage, 1);
        }

        return $this->returnedRating[$sellerId];
    }
}