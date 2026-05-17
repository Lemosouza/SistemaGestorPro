<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('supplier_id', Auth::user()->supplier->id)->get();
        return view('documents.index', compact('documents'));
    }

    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required|string',
            'upload_date'   => 'nullable|date',
            'status'        => 'required|string',
        ]);

        Document::create([
            'supplier_id'   => Auth::user()->supplier->id,
            'document_type' => $request->document_type,
            'upload_date'   => $request->upload_date,
            'status'        => $request->status,
        ]);

        return redirect()->route('documents.index')->with('success', 'Documento enviado com sucesso.');
    }
}
