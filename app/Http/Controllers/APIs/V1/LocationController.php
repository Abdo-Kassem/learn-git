<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function cities()
    {
        $cities = City::get();

        return response()->json([
            'status' => 200,
            'data' => $cities
        ]);
    }

    public function areas()
    {
        $areas = Area::get();

        return response()->json([
            'status' => 200,
            'data' => $areas
        ]);
    }

    public function areasByCityId(City $city)
    {
        $areas = $city->areas;

        return response()->json([
            'status' => 200,
            'data' => $areas
        ]);
    }
}
