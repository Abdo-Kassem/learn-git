<?php

namespace App\Http\Controllers\APIs\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailOtpVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function checkEmailBeforeRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100|unique:users',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422 ,
                'errros' => $validator->errors()->toArray()
            ]);
        }

        return response()->json(['status' => 200, 'success' => 'Ok !']);

    }

    public function checkPhoneBeforeRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits_between:7,15|unique:users,phone',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->errors()->toArray()
            ]);
        }

        return response()->json(['status' => 200, 'success' => 'Ok !']);
        
    }


    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'email' => 'required|email|max:100|unique:users',
            'phone_prefix' => 'required|max:10',
            'phone' => 'required|numeric|digits_between:7,15|unique:users,phone',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->toArray(),
                'status' => 422
            ]);
        }

        $otp = rand(1111,9999);
        
        $user = $this->create($request->except(['password_confirmation', 'phone_prefix']), $otp, $request->phone_prefix);
        $jwt = auth()->guard('api')->login($user);

        //Mail::to($request->email)->send(new EmailOtpVerification($user));

        return response()->json([
            'status' => 200,
            'user' => $user->refresh()->load(['city', 'area']),
            'jwt' => $jwt
        ]);

    }

    private function create(array $data, $opt, $phonePrefix) 
    {
        $data['phone'] = $phonePrefix . $data['phone'];
        $data['password'] = bcrypt($data['password']);
        $data['otp'] = $opt;
        $data['status'] = true;

        return User::create($data);
    }

}
