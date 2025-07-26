<?php

namespace App\Http\Controllers\APIs\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request){

    	$validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(), 'status' => 422]
            );
        }

        $jwt = auth()->guard('api')->attempt($validator->validated());

        if (! $jwt) {
            return response()->json([
                'status' => 422,
                'error' => 'email or password incorrect !'
            ]);
        }

        $user = User::where('email' , $request->email)->first();

        if( $user->status == 0 ){
            return response()->json([
                'status' => 409,
                'error' => 'Active your account first verification code sent to your email !'
            ]);
        }

        return response()->json([
            'status' => 200,
            'user' => $user,
            'token' => $jwt
        ]);

    }
}
