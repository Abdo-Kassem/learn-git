<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Admin.pages.categories.index',compact('categories'));
    }

    
    public function create()
    {
        return view('Admin.pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_fr' => 'required',
            'image' => 'required|image',
            'color' => 'required|max:15'
        ]);

        $data = $request->except(['_token','_method']);

        Image::make($request->image)->save('uploads/categories/' . $request->image->hashName());
        $data['image'] = 'uploads/categories/' . $request->image->hashName();

        Category::create($data);

        successMessage(trans('backend.created_successfully'));

        return redirect()->route('admin.categories.index');

    }

    
    public function show(Category $category)
    {
        return view('Admin.pages.categories.show',compact('category'));
    }

    
    public function edit(Category $category)
    {
        return view('Admin.pages.categories.edit',compact('category'));
    }

    
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_ar' => 'required|unique:categories,name_ar,'.$category->id,
            'name_fr' => 'required|unique:categories,name_fr,'.$category->id,
            'image' => 'nullable|image',
            'color' => 'required|max:15'
        ]);

        $data = $request->except(['_token','_method']);

        if($request->image) {
            if($category->image != 'uploads/categories/default.png'  && file_exists($category->image))
                unlink($category->image);

            Image::make($request->image)->save('uploads/categories/' . $request->image->hashName());
            $data['image'] = 'uploads/categories/' . $request->image->hashName();
        }

        $category->update($data);

        successMessage(trans('backend.updated_successfully'));

        return redirect()->route('admin.categories.index');
    }

    
    public function destroy(Category $category)
    {
        $imagePath = $category->image;
        
        $category->delete();

        if($imagePath != 'uploads/categories/default.png' && file_exists($imagePath)) {
            unlink($imagePath);
        }

        successMessage(trans('backend.deleted_successfully'));
        return redirect()->back();
    }

}
