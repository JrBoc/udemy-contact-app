<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index', [
            'contacts' => Contact::with('company')->orderBy('first_name')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function show($id)
    {
        return view('contacts.show', [
            'contact' => Contact::find($id),
        ]);
    }
}
