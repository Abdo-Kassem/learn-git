<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with(['user', 'product'])->get();
        return view('Admin.pages.complaints.index', compact('complaints'));
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return redirect()->back()->with('success', trans('backend.deleted_successfully'));
    }
}
