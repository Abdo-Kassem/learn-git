<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::get();
        return view('Admin.pages.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('Admin.pages.cities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|unique:cities,name_ar',
            'name_fr' => 'required|unique:cities,name_fr',
        ]);

        $data = $request->except(['_method', '_token']);

        City::create($data);

        return redirect()->route('cities.index')->with('success', trans('backend.created_successfully'));
    }

    public function edit(City $city)
    {
        return view('Admin.pages.cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name_ar' => 'required|unique:cities,name_ar,' . $city->id,
            'name_fr' => 'required|unique:cities,name_fr,' . $city->id,
        ]);

        $data = $request->except(['_method', '_token']);

        $city->update($data);

        return redirect()->route('cities.index')->with('success', trans('backend.updated_successfully'));
    }

    public function destroy(City $city)
    {
        $city->delete();
        return back()->with('success', trans('backend.deleted_successfully'));
    }
}
