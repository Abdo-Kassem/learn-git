<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('Admin.pages.sliders.index' , compact('sliders'));
    }

    public function create()
    {
        return view('Admin.pages.sliders.create');
    }

   
    public function store(Request $request)
    {     
        $request->validate([
            'title_ar' => 'nullable',
            'title_fr' => 'nullable',
            'slider_image' => 'required|image|mimes:png,jpg,jpeg,gif,webp',
        ]);

        $data = $request->except(['_method', '_token']);

        if( $request->slider_image ) {
            Image::make($request->slider_image)->save('uploads/sliders/' . $request->slider_image->hashName());
            $data['slider_image'] = 'uploads/sliders/' . $request->slider_image->hashName();
        }

        Slider::create($data);

        session()->flash('success', trans('backend.created_successfully'));
        return redirect()->route('sliders.index');
    }

    public function show(Slider $slider)
    {
        return view('Admin.pages.sliders.show' , compact('slider'));
    }
    
    public function edit(Slider $slider)
    {
        return view('Admin.pages.sliders.edit' , compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title_ar' => 'nullable',
            'title_en' => 'nullable',
            'slider_image' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp',
        ]);

        $data = $request->except(['_method', '_token']);

        if( $request->slider_image ){
            if( $slider->slider_image != 'uploads/sliders/default.jpg' ){
                unlink($slider->slider_image);
            }

            Image::make($request->slider_image)->save('uploads/sliders/' . $request->slider_image->hashName());
            $data['slider_image'] = 'uploads/sliders/' . $request->slider_image->hashName();
        }

        $slider->update($data);

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->route('sliders.index');
    }

    
    public function destroy(Slider $slider)
    {
        if( $slider->slider_image != 'uploads/sliders/default.jpg' ){
            unlink($slider->slider_image);
        }

        $slider->delete();

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect()->back();
    }

}
