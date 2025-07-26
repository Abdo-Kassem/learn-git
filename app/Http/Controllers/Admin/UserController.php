<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        
        foreach ($users as &$user) {
            if ($user->products()->exists()) {
                $user->add_badge = true;
            } else {
                $user->add_badge = false;
            }
        }

        return view('Admin.pages.users.index' , compact('users'));
    }

    public function create()
    {
        $cities = City::get();
        return view('Admin.pages.users.create', compact('cities'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|max:15',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg,gif'
        ]);

        $user = new User;

        if( $request->avatar ){
            Image::make($request->avatar)->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/users/' . $request->avatar->hashName());
            $user->avatar = 'uploads/users/' . $request->avatar->hashName();
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city_id = $request->city_id;
        $user->area_id = $request->area_id;
        $user->last_login_date = '-----';
        $user->last_logout_date = '-----';
        $user->password = bcrypt($request->password);
        $user->created_by = adminurl()->id;
        $user->status = 1;
        $user->save();

        session()->flash('success', trans('backend.created_successfully'));
        return redirect()->route('admin.users.index');
    }

    
    public function show(User $user)
    {
        return view('Admin.pages.users.show' , compact('user'));
    }

    
    public function edit(User $user)
    {
        $cities = City::get(['name_ar', 'name_fr', 'id']);
        $areas = Area::where('city_id', $user->city_id)->get(['name_ar', 'name_fr', 'id']);;
        return view('Admin.pages.users.edit' , compact('user', 'cities', 'areas'));
    }

    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|min:10|max:15',
            'location' => 'nullable|array',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
            'password_confirmation' => 'nullable|same:password',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg,gif'
        ]);

        if( $request->avatar ){
            if( $user->avatar != 'uploads/users/default.png' ){
                unlink($user->avatar);
            }
            Image::make($request->avatar)->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/users/' . $request->avatar->hashName());
            $user->avatar = 'uploads/users/' . $request->avatar->hashName();
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city_id = $request->city_id;
        $user->area_id = $request->area_id;
        $user->updated_by = adminurl()->id;
        if( !empty($request->password) ){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->route('admin.users.index');
    }

    
    public function destroy(User $user)
    {
        
        if( $user->avatar != 'uploads/users/default.png' ){
            unlink($user->avatar);
        }
        $user->delete();

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect()->back();
        
    }

    public function activation(User $user)
    {
        if( $user->status == 1 ){
            $user->status = 0;
            $user->save();
            session()->flash('success', trans('backend.record_disabled_successfully'));
            return redirect()->back();
        }else{
            $user->status = 1;
            $user->save();
            session()->flash('success', trans('backend.record_actived_successfully'));
            return redirect()->back();
        }
        
    }

    public function addBadge(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'badge' => 'required|numeric|in:1,2,3'
        ]);

        $user = User::find($request->userId);
        $user->badge = $request->badge;
        $user->save();

        return back()->with('success', trans('backend.updated_successfully'));
    }
}
