<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('category:id,name_ar,name_fr')->get();
        return view('Admin.pages.packages.index', compact('packages'));
    }

    public function create()
    {
        $categories = Category::get(['id', 'name_ar', 'name_fr']);
        return view('Admin.pages.packages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_fr' => 'required',
            'days_number' => 'required|numeric|min:1',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'required|numeric|min:99',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif'
        ]);

        $data = $request->except(['_token', '_method']);

        if ($request->image) {
            $imagePath = 'uploads/packages/' . $request->file('image')->hashName();
            Image::make($request->file('image'))->save($imagePath);
            $data['image'] = $imagePath;
        }

        Package::create($data);

        return redirect()->route('packages.index')->with('success', trans('backend.created_successfully'));
    }

    public function show(Package $package)
    {
        return view('Admin.pages.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        $categories = Category::get(['id', 'name_ar', 'name_fr']);
        return view('Admin.pages.packages.edit', compact('package', 'categories'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_fr' => 'required',
            'days_number' => 'required|numeric|min:1',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'required|numeric|min:99',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif'
        ]);

        $data = $request->except(['_token', '_method']);

        if ($request->image) {
            if (file_exists($package->image)) {
                unlink($package->image);
            }

            $imagePath = 'uploads/packages/' . $request->file('image')->hashName();
            Image::make($request->file('image'))->save($imagePath);
            $data['image'] = $imagePath;
        }

        $package->update($data);

        return redirect()->route('packages.index')->with('success', trans('backend.updated_successfully'));
    }

    public function destroy(Package $package)
    {
        if (file_exists($package->image)) {
            unlink($package->image);
        }

        $package->delete();

        return back()->with('success', trans('backend.deleted_successfully'));
    }
}
