<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();

        return view('Admin.pages.admins.index' , compact('admins'));
    }


    public function create()
    {
        return view('Admin.pages.admins.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:admins',
            'phone' => 'required|min:10|max:15',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg,gif'
        ]);

        $admin = new Admin;

        if( $request->avatar ){
            Image::make($request->avatar)->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/admins/' . $request->avatar->hashName());
            $admin->avatar = 'uploads/admins/' . $request->avatar->hashName();
        }

        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->description = $request->description;
        $admin->last_login_date = '-----';
        $admin->last_logout_date = '-----';
        $admin->password = bcrypt($request->password);
        $admin->created_by = adminurl()->id;
        $admin->save();

        session()->flash('success', trans('backend.created_successfully'));
        return redirect()->route('admin.admins.index');
    }

    
    public function show(Admin $admin)
    {
        return view('Admin.pages.admins.show' , compact('admin'));
    }

    
    public function edit(Admin $admin)
    {
        return view('Admin.pages.admins.edit' , compact('admin'));
    }

    
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'phone' => 'required|min:10|max:15',
            'password' => 'nullable',
            'password_confirmation' => 'nullable|same:password',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg,gif'
        ]);

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
        $admin->address = $request->address;
        $admin->description = $request->description;
        $admin->updated_by = adminurl()->id;
        if( !empty($request->password) ){
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->route('admin.admins.index');
    }

    
    public function destroy(Admin $admin)
    {
        if( $admin->avatar != 'uploads/admins/default.png' ){
            unlink($admin->avatar);
        }
        $admin->delete();

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect()->back();
    }

    public function activation(Admin $admin)
    {
        if( $admin->status == 1 ){
            $admin->status = 0;
            $admin->save();
            session()->flash('success', trans('backend.record_disabled_successfully'));
            return redirect()->back();
        }else{
            $admin->status = 1;
            $admin->save();
            session()->flash('success', trans('backend.record_actived_successfully'));
            return redirect()->back();
        }
        
    }
}
