<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return view('Admin.pages.brands.index',compact('brands'));
    }

    
    public function create()
    {
        return view('Admin.pages.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_fr' => 'required',
            'logo' => 'required|image'
        ]);

        $data = $request->except(['_token','_method']);

        Image::make($request->logo)->save('uploads/brands/' . $request->logo->hashName());
        $data['logo'] = 'uploads/brands/' . $request->logo->hashName();

        Brand::create($data);

        successMessage(trans('backend.created_successfully'));

        return redirect()->route('admin.brands.index');

    }
    
    public function edit(Brand $brand)
    {
        return view('Admin.pages.brands.edit',compact('brand'));
    }

    
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name_ar' => 'required|unique:brands,name_ar,'.$brand->id,
            'name_fr' => 'required|unique:brands,name_en,'.$brand->id,
            'logo' => 'nullable|image'
        ]);

        $data = $request->except(['_token','_method']);

        if($request->logo) {
            if($brand->logo != 'uploads/brands/default.png')
                unlink($brand->logo);
            Image::make($request->logo)->save('uploads/brands/' . $request->logo->hashName());
            $data['logo'] = 'uploads/brands/' . $request->logo->hashName();
        }

        $brand->update($data);

        successMessage(trans('backend.updated_successfully'));

        return redirect()->route('admin.brands.index');
    }

    
    public function destroy(Brand $brand)
    {
        if($brand->logo != 'uploads/brands/default.png')
            unlink($brand->logo);
        
        $brand->delete();
        successMessage(trans('backend.deleted_successfully'));
        return redirect()->back();
    }

}
