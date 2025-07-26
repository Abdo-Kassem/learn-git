<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplaintsController extends Controller
{
    public function sendComplaint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray(),
                'status' => 400
            ]);
        }  

        Complaint::create([
            'user_id' => auth()->guard('api')->id(),
            'product_id' => $request->product_id
        ]);

        return response()->json([
            'success' => 'Complaint Sent Successfully',
            'status' => 200
        ]);
    }
}
