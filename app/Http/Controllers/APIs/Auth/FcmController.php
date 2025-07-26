<?php

namespace App\Http\Controllers\APIs\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FcmController extends Controller
{
    public function updateFcmToken(Request $request)
    {
        $user = auth()->guard('api')->user();

        if (! $user) {
            return response()->json([
                'status' => 0,
                'error' => 'This user not found !'
            ]);
        }

        $user->fcm_device_token = $request->fcm;
        $user->save();

        return response()->json([
            'status' => 1,
            'success' => 'User fcm device token updated successfully .'
        ]);
    }
}
