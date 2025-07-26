<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\PrivacyPolicy;
use App\Models\UsingCondition;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('Admin.pages.about', compact('about'));
    }

    public function update(Request $request, About $about) 
    {
        $request->validate([
            'description_ar' => 'required',
            'description_fr' => 'required'
        ]);

        $data = $request->except(['_token', '_method']);

        $about->update($data);

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->back();

    }
}
