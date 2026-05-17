<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('user')->get();
        return view('companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        $company->load('user', 'analyses');
        return view('companies.show', compact('company'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'      => 'required|exists:users,id',
            'company_name' => 'required|string',
            'document'     => 'required|string',
        ]);

        Company::create($request->all());
        return redirect()->route('companies.index')->with('success', 'Empresa criada com sucesso.');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name' => 'required|string',
            'document'     => 'required|string',
        ]);

        $company->update($request->all());
        return redirect()->route('companies.index')->with('success', 'Empresa atualizada com sucesso.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Empresa removida com sucesso.');
    }
}
