<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Company;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index', [
            'contacts' => user()->contacts()->with('company')->latest('id')->paginate(10),
            'companies' => Company::userCompanies(),
        ]);
    }

    public function create()
    {
        return view('contacts.create', [
            'contact' => null,
            'companies' => Company::userCompanies('Select Company'),
        ]);
    }

    public function store(ContactRequest $request)
    {
        $request->user()
            ->contacts()
            ->create($request->only([
                'first_name',
                'last_name',
                'phone',
                'address',
                'email',
                'company_id',
            ]));

        return redirect()->route('contacts.index')->with('message', 'Contact has been added successfully.');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', [
            'contact' => $contact,
        ]);
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', [
            'contact' => $contact,
            'companies' => Company::userCompanies('Select Company'),
        ]);
    }

    public function update(Contact $contact, ContactRequest $request)
    {
        $contact
            ->fill($request->only([
                'first_name',
                'last_name',
                'phone',
                'address',
                'email',
                'company_id',
            ]))
            ->save();

        return redirect()->route('contacts.index')->with('message', 'Contact has been updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('message', 'Contact has been updated deleted.');
    }
}
