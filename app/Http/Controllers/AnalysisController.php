<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use App\Models\Company;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
     public function index()
    {
        $analyses = Analysis::with('company', 'supplier')->get();
        return view('analyses.index', compact('analyses'));
    }

    public function show(Analysis $analysis)
    {
        $analysis->load('company', 'supplier');
        return view('analyses.show', compact('analysis'));
    }

    public function create()
    {
        $companies = Company::all();
        $suppliers = Supplier::all();
        return view('analyses.create', compact('companies', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id'      => 'required|exists:companies,id',
            'supplier_id'     => 'required|exists:suppliers,id',
            'status'          => 'required|string',
            'description'     => 'nullable|string',
            'evaluation_date' => 'nullable|date',
            'validity_date'   => 'nullable|date',
        ]);

        Analysis::create($request->all());
        return redirect()->route('analyses.index')->with('success', 'Análise criada com sucesso.');
    }

    public function edit(Analysis $analysis)
    {
        $companies = Company::all();
        $suppliers = Supplier::all();
        return view('analyses.edit', compact('analysis', 'companies', 'suppliers'));
    }

    public function update(Request $request, Analysis $analysis)
    {
        $request->validate([
            'status'          => 'required|string',
            'description'     => 'nullable|string',
            'evaluation_date' => 'nullable|date',
            'validity_date'   => 'nullable|date',
        ]);

        $analysis->update($request->all());
        return redirect()->route('analyses.index')->with('success', 'Análise atualizada com sucesso.');
    }

    public function destroy(Analysis $analysis)
    {
        $analysis->delete();
        return redirect()->route('analyses.index')->with('success', 'Análise removida com sucesso.');
    }
}
