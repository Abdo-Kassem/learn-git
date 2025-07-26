<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AccountController extends Controller
{
    public function index()
    {
        return view('Frontend.delete-my-account');
    }

    public function check_account(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $checkAccount = User::where('email' , $request->email)->first();

        if( !$checkAccount ) {
            session()->flash('error', trans('backend.not_found_account'));
            return redirect()->back();
        }

        if ($checkAccount->email === $request->email && Hash::check($request->password,$checkAccount->password)) {
            
            session()->put('my_account' , $checkAccount);

            return view('Frontend.final-delete-my-account');

        } else {
            session()->flash('error', trans('backend.email_or_password_incorrect'));
            return redirect()->back();
        }
    }

    public function delete_account(Request $request)
    {
        $account = User::find(session()->get('my_account')->id);
        $account->delete();

        session()->forget('my_account');

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect('/');
    }

    
}
