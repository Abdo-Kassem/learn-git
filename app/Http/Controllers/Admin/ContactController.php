<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('Admin.pages.contacts.index' , compact('contacts'));
    }

   
    public function show(Contact $contact)
    {
        return view('Admin.pages.contacts.show' , compact('contact'));
    }

 
    public function destroy(Contact $contact)
    {
        $contact->delete();
        session()->flash('success',trans('backend.deleted_successfully'));
        return redirect()->back();
    }
}
