<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        return view('companies.index', [
            'companies' => user()->companies()->latest('id')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('companies.create', [
            'company' => null,
        ]);
    }

    public function store(CompanyRequest $request)
    {
        $request->user()
            ->companies()
            ->create($request->only([
                'name',
                'address',
                'email',
                'website',
            ]));

        return redirect()->route('companies.index')->with('message', 'Company has been created successfully.');
    }

    public function show(Company $company)
    {
        return view('companies.show', [
            'company' => $company,
        ]);
    }

    public function edit(Company $company)
    {
        return view('companies.edit', [
            'company' => $company,
        ]);
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $company
            ->fill($request->only([
                'name',
                'address',
                'email',
                'website',
            ]))
            ->save();

        return redirect()->route('companies.index')->with('message', 'Company has been updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('message', 'Company has been deleted successfully.');
    }
}
