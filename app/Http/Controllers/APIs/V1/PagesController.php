<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AppSetting;
use App\Models\PrivacyPolicy;
use App\Models\Slider;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function sliders()
    {
        $sliders = Slider::get();

        return response()->json([
            'status' => 200,
            'data' => $sliders
        ]);
    }

    public function privacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::first();

        return response()->json([
            'status' => 200,
            'data' => $privacyPolicy
        ]);
    }

    public function about()
    {
        $about = About::first();

        return response()->json([
            'status' => 200,
            'data' => $about
        ]);
    }

    public function appSetting()
    {
        $appSetting = AppSetting::first();

        return response()->json([
            'status' => 200,
            'data' => $appSetting
        ]);
    }
}
