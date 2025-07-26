<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Mail\EmailOtp;
use App\Mail\EmailOtpVerification;
use App\Notifications\WhatsappNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function destroyAccount(Request $request) 
    {
        $user = auth()->guard('api')->user();

        if ($user->avatar != 'uploads/users/default.png') {
            unlink($user->avatar);
        }

        $user->delete();

        return response()->json([
            'success' => 'account delete successfully',
            'status' => 200
        ]);

    }

    public function updateProfile(Request $request) 
    {
        $user = auth()->guard('api')->user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            //'phone_prefix' => 'required|max:10',
            'phone' => 'required|min:8|max:20|unique:users,phone,' . $user->id,
            'email' => 'required|string|email|max:100|unique:users,email,' . $user->id,
            'location' => 'nullable|array',
            'location.*' => 'required|numeric',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        }

        $data = $request->except(['token', 'password']);
        $oldEmail = $user->email; 

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        try {
        
            if($request->email != $user->email) {

                $data['otp'] = mt_rand(1111, 9999);
                $data['status'] = 0;
                $user->update($data);
                $user->refresh();
                Mail::to($request->email)->send(new EmailOtpVerification($user));
                //Notification::send($user, new WhatsappNotification);

            } else {
                $user->update($data);
                $user->refresh();
            }
            

            if (($request->email != $oldEmail) || $request->password) {
                auth()->guard('api')->logout();
            }

            return response()->json([
                'status' => 200,
                'user' => $user
            ]);

        } catch (Exception $ex) {

            return response()->json([
                'status' => 400,
                'error' => 'فشلة العمليه الرجاء المحاوله مره اخرى'
            ]);

        }

    }

    public function updateAvatar(Request $request) 
    {
        $validator = Validator::make($request->only('avatar'), [
            'avatar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        }

        $user = auth()->guard('api')->user();

        if ($user->avatar != 'uploads/users/default.png') {
            unlink($user->avatar);
        }

        $avatar = base64_decode($request->avatar);
        $path = 'uploads/users/' . $user->first_name . '_' . time() . '.png';
        file_put_contents($path, $avatar);

        $user->avatar = $path;
        $user->save();

        return response()->json([
            'message' => 'avatar uploded successfully',
            'status' => 200
        ]);

    }

    public function updatePreferedLanguage(Request $request)
    {
        $validator = Validator::make($request->only('prefered_langauge'), [
            'prefered_langauge' => 'required|in:ar,fr',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 400);
        }

        $user = auth()->guard('api')->user();

        $user->prefered_language = $request->prefered_langauge;
        $user->save();

        return response()->json([
            'message' => 'Done',
            'status' => 200
        ]);
    }

}
