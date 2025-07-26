<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Admin;   

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = adminurl();

        return view('Admin.profile' , compact('admin'));
    }

    public function update(Request $request)
    {   
        $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:admins,email,'.$request->admin_id,
            'phone' => 'required|min:10|max:15',
            'password' => 'nullable',
            'password_confirmation' => 'nullable|same:password',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg,gif'
        ]);


        $admin = Admin::find($request->admin_id);
        if( $request->avatar ){
            if( $admin->avatar != 'uploads/admins/default.png' ){
                unlink($admin->avatar);
            }
            Image::make($request->avatar)->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/admins/' . $request->avatar->hashName());
            $admin->avatar = 'uploads/admins/' . $request->avatar->hashName();
        }
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->updated_by = $request->admin_id;
        if( !empty($request->password) ){
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        session()->flash('success', trans('backend.profile_updated_successfully'));
        return redirect()->back();
    }
}
