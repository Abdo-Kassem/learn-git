<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function addRating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating_number' => 'required|numeric|digits_between:1,5',
            'seller_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray(),
                'status' => 400
            ]);
        }  

        Rating::create([
            'user_id' => auth()->guard('api')->id(),
            'rating_number' => $request->rating_number,
            'feedback' => $request->feedback,
            'seller_id' => $request->seller_id
        ]);

        return response()->json([
            'success' => 'Rating Sent Successfully',
            'status' => 200
        ]);
    }
}
