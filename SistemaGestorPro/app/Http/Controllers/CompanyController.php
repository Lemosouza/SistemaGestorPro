<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\SystemLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::with('user');

        if ($search = $request->input('search')) {
            $query->where('company_name', 'like', "%{$search}%")
                ->orWhere('document', 'like', "%{$search}%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
        }

        $companies = $query->latest()->paginate(10)->withQueryString();
        return view('companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        $company->load('user', 'analyses.supplier.user');
        return view('companies.show', compact('company'));
    }

    public function create()
    {
        $company = new Company();
        $user = new User(['role' => 'company']);
        return view('companies.form', compact('company', 'user'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateCompany($request);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => 'company',
            'password' => Hash::make($validated['password'] ?? 'Empresa@123'),
        ]);

        $company = Company::create([
            'user_id' => $user->id,
            'company_name' => $validated['company_name'],
            'document' => preg_replace('/\D/', '', $validated['document']),
        ]);

        SystemLog::record('company.created', "Empresa {$company->company_name} criada.");

        return redirect()->route('companies.show', $company)->with('success', 'Empresa criada com sucesso.');
    }

    public function edit(Company $company)
    {
        $company->load('user');
        $user = $company->user;
        return view('companies.form', compact('company', 'user'));
    }

    public function update(Request $request, Company $company)
    {
        $company->load('user');
        $validated = $this->validateCompany($request, $company);

        $company->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        if (!empty($validated['password'])) {
            $company->user->update(['password' => Hash::make($validated['password'])]);
        }

        $company->update([
            'company_name' => $validated['company_name'],
            'document' => preg_replace('/\D/', '', $validated['document']),
        ]);

        SystemLog::record('company.updated', "Empresa {$company->company_name} atualizada.");

        return redirect()->route('companies.show', $company)->with('success', 'Empresa atualizada com sucesso.');
    }

    public function destroy(Company $company)
    {
        $name = $company->company_name;
        $company->delete();
        SystemLog::record('company.deleted', "Empresa {$name} excluída.");
        return redirect()->route('companies.index')->with('success', 'Empresa removida com sucesso.');
    }

    private function validateCompany(Request $request, ?Company $company = null): array
    {
        $userId = optional($company?->user)->id;

        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'phone' => 'nullable|string|max:20',
            'password' => [$company ? 'nullable' : 'nullable', 'confirmed', 'min:8'],
            'company_name' => 'required|string|max:255',
            'document' => ['required', 'string', Rule::unique('companies', 'document')->ignore($company?->id)],
        ]);
    }
}
