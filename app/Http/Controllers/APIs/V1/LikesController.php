<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikesController extends Controller
{
    public function addLike(Request $request)
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
        $like = Like::where('user_id', $userId)->where('product_id', $request->product_id)->first();

        if ($like) {
            $like->delete();
            $message = 'Like Deleted';
        } else {
            Like::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
            ]);
            $message = 'Like Created';
        }

        return response()->json([
            'status' => 200,
            'success' => $message
        ]);
    }
}
