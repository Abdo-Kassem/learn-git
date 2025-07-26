<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validator = Validator::make($request->except('_token'),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email:rfc',
            'phone_prefix' => 'required',
            'phone' => 'required|digits_between:5,13',
            'message' => 'required',
            'subject' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()
            ]);
        }

        $data = $request->except(['phone_prefix']);
        $data['phone'] = $request->phone_prefix + $data['phone'];
            
        Contact::create($data);

        return response()->json([
            'success' => 'Message Send Successfully',
            'status' => '200'
        ]);
    }
}
