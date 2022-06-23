<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

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
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('contacts.index', [
            'contacts' => $contacts,
            'companies' => Company::orderBy('name')->pluck('name', 'id')->prepend('All Companies', ''),
        ]);
    }

    public function create()
    {
        return view('contacts.create', [
            'companies' => Company::orderBy('name')->pluck('name', 'id')->prepend('Select Companies', ''),
        ]);
    }

    public function show($id)
    {
        return view('contacts.show', [
            'contact' => Contact::find($id),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
            'address' => ['required', 'string'],
            'company_id' => ['required', 'exists:companies,id'],
        ]);

        Contact::create($request->only([
            'first_name',
            'last_name',
            'phone',
            'address',
            'email',
            'company_id',
        ]));

        return redirect()->route('contacts.index')->with('message', 'Contact has been added successfully.');
    }
}
