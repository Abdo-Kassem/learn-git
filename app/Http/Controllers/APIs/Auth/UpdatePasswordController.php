<?php

namespace App\Http\Controllers\APIs\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailOtpVerification;
use App\Models\User;
use App\Notifications\WhatsappNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordController extends Controller
{
    public function forgetPassword(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(), 'status' => 422
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if(! $user) {
            return response()->json([
                'status' => 422,
                'error' => 'Email Not Found Please Enter Valide Email'
            ]);
        }

        $user->otp =  mt_rand(1111,9999);
        $user->save();

        Mail::to($request->email)->send(new EmailOtpVerification($user));
        //Notification::send($user, new WhatsappNotification());

        return response()->json([
            'status' => 200,
            'success' => 'Reset OTP Send Successfully',
        ]);
        
    }

    public function otpVerification(Request $request) 
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'code' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray(),
                'status' => 422
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if(! $user) {
            return response()->json([
                'error' => 'Email not found',
                'status' => 404
            ]);
        } 

        if($user->otp == $request->code) {
            return response()->json([
                'status' => 200,
                'success' => 'Code Is Correct'
            ]);
        }

        return response()->json([
            'status' => 422,
            'error' => 'Code Not Correct'
        ]);

    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(), 
                'status' => 422
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if(! $user) {
            return response()->json([
                'error' => 'Email not found',
                'status' => 404
            ]);
        } 

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status' => 200,
            'success' => 'Your password changed successfully .'
        ]);

    }

}
