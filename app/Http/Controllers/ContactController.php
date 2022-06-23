<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('company')
            ->where(function ($query) {
                if ($companyId = request('company_id')) {
                    $query->where('company_id', $companyId);
                }
            })
            ->orderBy('first_name')
            ->paginate(10);

        return view('contacts.index', [
            'contacts' => $contacts,
            'companies' => Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', ''),
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
