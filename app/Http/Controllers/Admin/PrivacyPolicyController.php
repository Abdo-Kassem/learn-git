<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use App\Models\UsingCondition;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view('Admin.pages.privacy-policy', compact('privacyPolicy'));
    }

    public function update(Request $request, PrivacyPolicy $privacyPolicy) 
    {
        $request->validate([
            'description_ar' => 'required',
            'description_fr' => 'required'
        ]);

        $data = $request->except(['_token', '_method']);

        $privacyPolicy->update($data);

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->back();

    }
}
