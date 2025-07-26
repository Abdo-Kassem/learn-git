<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Category;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::with('subcategories')->get();
        return response()->json([
            'data' => $categories->toArray(),
            'status' => 200,
        ]);
    }

}
