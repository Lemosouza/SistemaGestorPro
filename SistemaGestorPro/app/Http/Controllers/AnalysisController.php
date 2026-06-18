<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use App\Models\Company;
use App\Models\Supplier;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        $query = Analysis::with('company', 'supplier.user');

        if (Auth::user()->role === 'company') {
            $companyId = optional(Auth::user()->company)->id;
            if ($companyId) {
                $query->where('company_id', $companyId);
            }
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('status', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('supplier.user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $analyses = $query->latest()->paginate(10)->withQueryString();
        return view('analyses.index', compact('analyses'));
    }

    public function show(Analysis $analysis)
    {
        $analysis->load('company.user', 'supplier.user');
        return view('analyses.show', compact('analysis'));
    }

    public function create()
    {
        $analysis = new Analysis(['evaluation_date' => now(), 'status' => 'under_review']);
        $companies = Company::with('user')->get();
        $suppliers = Supplier::with('user')->get();
        return view('analyses.form', compact('analysis', 'companies', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:approved,rejected,under_review',
            'description' => 'nullable|string',
            'evaluation_date' => 'nullable|date',
            'validity_date' => 'nullable|date',
        ]);

        $analysis = Analysis::create($validated);
        SystemLog::record('analysis.created', 'Avaliação de fornecedor criada.');

        return redirect()->route('analyses.show', $analysis)->with('success', 'Análise criada com sucesso.');
    }

    public function edit(Analysis $analysis)
    {
        $companies = Company::with('user')->get();
        $suppliers = Supplier::with('user')->get();
        return view('analyses.form', compact('analysis', 'companies', 'suppliers'));
    }

    public function update(Request $request, Analysis $analysis)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:approved,rejected,under_review',
            'description' => 'nullable|string',
            'evaluation_date' => 'nullable|date',
            'validity_date' => 'nullable|date',
        ]);

        $analysis->update($validated);
        SystemLog::record('analysis.updated', 'Avaliação de fornecedor atualizada.');

        return redirect()->route('analyses.show', $analysis)->with('success', 'Análise atualizada com sucesso.');
    }

    public function destroy(Analysis $analysis)
    {
        $analysis->delete();
        SystemLog::record('analysis.deleted', 'Avaliação de fornecedor removida.');
        return redirect()->route('analyses.index')->with('success', 'Análise removida com sucesso.');
    }
}
