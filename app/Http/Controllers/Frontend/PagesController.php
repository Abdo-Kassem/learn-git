<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AppSetting;
use App\Models\PrivacyPolicy;

class PagesController extends Controller
{
    public function contactPage()
    {
        $contacts = AppSetting::first();
        return view('Frontend.contact-us', compact('contacts'));
    }

    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view('Frontend.privacy-policy', compact('privacyPolicy'));
    }

    public function about()
    {
        $about = About::first();
        return view('Frontend.about', compact('about'));
    }
}
