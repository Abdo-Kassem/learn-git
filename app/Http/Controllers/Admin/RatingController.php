<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::with(['user', 'seller'])->get(); 
        return view('Admin.pages.ratings.index', compact('ratings'));
    }

    public function show(Rating $rating)
    {
        return view('Admin.pages.ratings.show', compact('rating'));
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();
        return back()->with('success', trans('backend.deleted_successfully'));
    }
}
