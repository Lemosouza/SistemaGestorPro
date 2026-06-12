<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Supplier;
use App\Models\SystemLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Document::with('supplier.user');

        if ($user->role === 'supplier') {
            $query->where('supplier_id', optional($user->supplier)->id);
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('document_type', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('supplier.user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $documents = $query->latest()->paginate(10)->withQueryString();
        return view('documents.index', compact('documents'));
    }

    public function show(Document $document)
    {
        $this->authorizeDocument($document);
        $document->load('supplier.user');
        return view('documents.show', compact('document'));
    }

    public function create()
    {
        $suppliers = Auth::user()->role === 'admin' ? Supplier::with('user')->get() : collect();
        return view('documents.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'document_type' => 'required|string|max:255',
            'expiration_date' => 'nullable|date',
            'file' => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx',
        ];

        if ($user->role === 'admin') {
            $rules['supplier_id'] = 'required|exists:suppliers,id';
        }

        $validated = $request->validate($rules);

        $supplierId = $user->role === 'admin'
            ? $validated['supplier_id']
            : optional($user->supplier)->id;

        if (!$supplierId) {
            return back()->with('error', 'Não existe cadastro de fornecedor vinculado a este usuário.')->withInput();
        }

        $path = $request->file('file')->store('documents', 'public');
        $status = $this->calculateStatus($validated['expiration_date'] ?? null);

        $document = Document::create([
            'supplier_id' => $supplierId,
            'document_type' => $validated['document_type'],
            'file_path' => $path,
            'original_name' => $request->file('file')->getClientOriginalName(),
            'upload_date' => now(),
            'expiration_date' => $validated['expiration_date'] ?? null,
            'status' => $status,
        ]);

        SystemLog::record('document.created', "Documento {$document->document_type} enviado.");

        return redirect()->route('documents.index')->with('success', 'Documento enviado com sucesso.');
    }

    public function destroy(Document $document)
    {
        $this->authorizeDocument($document);

        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $name = $document->document_type;
        $document->delete();
        SystemLog::record('document.deleted', "Documento {$name} excluído.");

        return redirect()->route('documents.index')->with('success', 'Documento excluído com sucesso.');
    }

    private function authorizeDocument(Document $document): void
    {
        $user = Auth::user();
        if ($user->role === 'supplier' && optional($user->supplier)->id !== $document->supplier_id) {
            abort(403, 'Você não tem permissão para acessar este documento.');
        }
    }

    private function calculateStatus(?string $expirationDate): string
    {
        if (!$expirationDate) {
            return 'valid';
        }

        $today = Carbon::today();
        $expiration = Carbon::parse($expirationDate)->startOfDay();

        if ($expiration->lt($today)) {
            return 'expired';
        }

        if ($expiration->diffInDays($today) <= 30) {
            return 'expiring';
        }

        return 'valid';
    }
}
