<?php

namespace App\Http\Controllers\APIs\V1;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->only(['category_id']), [
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()
            ]);
        }

        $packages = Package::where('category_id', $request->category_id)
            ->paginate(20);

        return response()->json([
            'status' => 200,
            'data' => $packages
        ]);
    }
}
