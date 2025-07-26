<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category:name_ar,name_fr,id')->get();
        return view('Admin.pages.subcategories.index',compact('subcategories'));
    }

    
    public function create()
    {
        $categories = Category::get(['id', 'name_ar', 'name_fr']);
        return view('Admin.pages.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_fr' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image',
            'color' => 'required|max:15'
        ]);

        $data = $request->except(['_token', '_method']);

        Image::make($request->image)->save('uploads/subcategories/' . $request->image->hashName());
        $data['image'] = 'uploads/subcategories/' . $request->image->hashName();

        Subcategory::create($data);

        successMessage(trans('backend.created_successfully'));

        return redirect()->route('subcategories.index');

    }

    
    public function show(Subcategory $subcategory)
    {
        return view('Admin.pages.subcategories.show',compact('subcategory'));
    }

    
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::get(['id', 'name_ar', 'name_fr']);
        return view('Admin.pages.subcategories.edit',compact('categories', 'subcategory'));
    }

    
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name_ar' => 'required|unique:categories,name_ar,'.$subcategory->id,
            'name_fr' => 'required|unique:categories,name_fr,'.$subcategory->id,
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
            'color' => 'required|max:15'
        ]);

        $data = $request->except(['_token', '_method']);

        if($request->image) {
            if($subcategory->image != 'uploads/subcategories/default.png' && file_exists($subcategory->image))
                unlink($subcategory->image);

            Image::make($request->image)->save('uploads/subcategories/' . $request->image->hashName());
            $data['image'] = 'uploads/subcategories/' . $request->image->hashName();
        }

        $subcategory->update($data);

        successMessage(trans('backend.updated_successfully'));

        return redirect()->route('subcategories.index');
    }

    
    public function destroy(Subcategory $subcategory)
    {
        $imagePath = $subcategory->image;
        
        $subcategory->delete();

        if($imagePath != 'uploads/subcategories/default.png' && file_exists($imagePath))
            unlink($imagePath);

        successMessage(trans('backend.deleted_successfully'));
        return redirect()->back();
    }

}
