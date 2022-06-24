<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('contacts.index', [
            'contacts' => $user->contacts()->with('company')->latestFirst()->paginate(10),
            'companies' => $user->companies()->orderBy('name')->pluck('name', 'id')->prepend('All Companies', ''),
        ]);
    }

    public function create()
    {
        return view('contacts.create', [
            'companies' => auth()->user()->companies()->orderBy('name')->pluck('name', 'id')->prepend('Select Companies', ''),
            'contact' => new Contact(),
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
            'companies' => Company::orderBy('name')->pluck('name', 'id')->prepend('Select Companies', ''),
        ]);
    }

    public function update(Contact $contact, Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
            'address' => ['required', 'string'],
            'company_id' => ['required', 'exists:companies,id'],
        ]);

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

        return back()->with('message', 'Contact has been updated deleted.');
    }
}
