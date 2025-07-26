<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    
    public function index()
    {
        $faqs = FAQ::all();
        return view('Admin.pages.faqs.index',compact('faqs'));
    }

    
    public function create()
    {
        return view('Admin.pages.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_ar' => 'required',
            'question_en' => 'required',
            'answer_ar' => 'required',
            'answer_en' => 'required'
        ]);

        $faq = new FAQ;

        $faq->question_ar = $request->question_ar;
        $faq->question_en = $request->question_en;
        $faq->answer_ar = $request->answer_ar;
        $faq->answer_en = $request->answer_en;

        $faq->save();

        successMessage(trans('backend.created_successfully'));
        return redirect()->route('admin.pages.faqs.index');
    }

    
    public function show(FAQ $faq)
    {
        return view('Admin.pages.faqs.show',compact('faq'));
    }

    
    public function edit(FAQ $faq)
    {
        return view('Admin.pages.faqs.edit',compact('faq'));
    }

    
    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'question_ar' => 'required',
            'question_en' => 'required',
            'answer_ar' => 'required',
            'answer_en' => 'required'
        ]);

        $faq->question_ar = $request->question_ar;
        $faq->question_en = $request->question_en;
        $faq->answer_ar = $request->answer_ar;
        $faq->answer_en = $request->answer_en;

        $faq->save();

        successMessage(trans('backend.updated_successfully'));
        return redirect()->route('admin.pages.faqs.index');
    }

    
    public function destroy(FAQ $faq)
    {
        $faq->delete();

        successMessage(trans('backend.deleted_successfully'));
        return redirect()->route('admin.pages.faqs.index');
    }
}
