<?php

namespace App\Http\Controllers\APIs\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogoutController extends Controller
{
    public function Logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray(),
                'status' => 422
            ]);
        }

        auth()->guard('api')->logout(true);

        return response()->json([
            'success' => 'Logout Successfully',
            'status' => 200
        ]);

    }
}
