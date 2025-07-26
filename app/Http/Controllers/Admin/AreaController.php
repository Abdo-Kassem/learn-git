<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('city')->get();
        return view('Admin.pages.areas.index', compact('areas'));
    }

    public function create()
    {
        $cities = City::get(['name_ar', 'name_fr', 'id']);
        return view('Admin.pages.areas.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|min:3',
            'name_fr' => 'required|min:3',
            'city_id' => 'required|exists:cities,id'
        ]);

        $data = $request->except(['_method', '_token']);

        Area::create($data);

        return redirect()->route('areas.index')->with('success', trans('backend.created_successfully'));
    }

    public function edit(Area $area)
    {
        $cities = City::get(['name_ar', 'name_fr', 'id']);
        return view('Admin.pages.areas.edit', compact('area', 'cities'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'name_ar' => 'required|min:3',
            'name_fr' => 'required|min:3',
        ]);

        $data = $request->except(['_method', '_token']);

        $area->update($data);

        return redirect()->route('areas.index')->with('success', trans('backend.updated_successfully'));
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return back()->with('success', trans('backend.deleted_successfully'));
    }
}
