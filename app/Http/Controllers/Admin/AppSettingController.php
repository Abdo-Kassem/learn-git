<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function index()
    {
        $setting = AppSetting::first();
        return view('Admin.pages.app-setting', compact('setting'));
    }

    public function update(Request $request, AppSetting $appSetting)
    {
        $request->validate([
            'phone' => 'required|min:7|max:15',
            'whatsapp_number' => 'required|min:7|max:15',
            'address' => 'nullable|max:240',
            'email' => 'required|max:100',
            'facebook' => 'nullable|url|max:240',
            'instagram' => 'nullable|url|max:240',
        ]);

        $appSetting->update($request->except(['_method', '_token']));

        return back()->with('success', trans('backend.updated_successfully'));
    }
}
