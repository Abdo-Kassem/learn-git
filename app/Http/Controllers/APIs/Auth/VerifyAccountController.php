<?php

namespace App\Http\Controllers\APIs\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailOtpVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class VerifyAccountController extends Controller
{
    public function accountVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'phone' => 'required|numeric',
            'email' => 'required|email',
            'code' => 'required|size:4',
        ]);

        if( $validator->fails() ){
            return response()->json([
                'status' => 422 ,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $user = User::where('email' , $request->email)->first();

        if( !$user ) {
            return response()->json([
                'status' => 422 ,
                'error' => 'Account Not Found !'
            ]);
        }

        if ($user->otp == $request->code) {

            $user->status = 1;
            $user->save();

            return response()->json([
                'status' => 200,
                'success' => 'Your account actived successfully you can login now !'
            ]);

        } else {

            return response()->json([
                'status' => 422,
                'error' => 'OTP code is incorrect !'
            ]);

        }
    }

    public function resendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email' , $request->email)->first();

        if(! $user) {
            return response()->json([
                'status' => 422 ,
                'error' => 'account not found !'
            ]);
        }


        Mail::to($request->email)->send(new EmailOtpVerification($user));
        //Notification::send($user, new WhatsappNotification());

        return response()->json([
            'status' => 200,
            'success' => 'Code sent successfully to whatsapp.'
        ]);

    }

}
