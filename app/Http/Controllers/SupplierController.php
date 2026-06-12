<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SystemLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::with(['user', 'documents']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('document', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
            });
        }

        $suppliers = $query->latest()->paginate(10)->withQueryString();
        return view('suppliers.index', compact('suppliers'));
    }

    public function show(Supplier $supplier)
    {
        $supplier->load(['user', 'documents', 'analyses.company']);
        return view('suppliers.show', compact('supplier'));
    }

    public function create()
    {
        $supplier = new Supplier(['status' => 'pending']);
        $user = new User(['role' => 'supplier']);
        return view('suppliers.form', compact('supplier', 'user'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateSupplier($request);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => 'supplier',
            'password' => Hash::make($validated['password'] ?? 'Fornecedor@123'),
        ]);

        $supplier = Supplier::create([
            'user_id' => $user->id,
            'document' => $this->onlyDigits($validated['document']),
            'category' => $validated['category'],
            'contact_name' => $validated['contact_name'] ?? $validated['name'],
            'contact_email' => $validated['contact_email'] ?? $validated['email'],
            'contact_phone' => $validated['contact_phone'] ?? ($validated['phone'] ?? null),
            'address' => $validated['address'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status'],
        ]);

        SystemLog::record('supplier.created', "Fornecedor {$user->name} criado.");

        return redirect()->route('suppliers.show', $supplier)->with('success', 'Fornecedor cadastrado com sucesso.');
    }

    public function edit(Supplier $supplier)
    {
        $supplier->load('user');
        $user = $supplier->user;
        return view('suppliers.form', compact('supplier', 'user'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $supplier->load('user');
        $validated = $this->validateSupplier($request, $supplier);

        $supplier->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        if (!empty($validated['password'])) {
            $supplier->user->update(['password' => Hash::make($validated['password'])]);
        }

        $supplier->update([
            'document' => $this->onlyDigits($validated['document']),
            'category' => $validated['category'],
            'contact_name' => $validated['contact_name'] ?? $validated['name'],
            'contact_email' => $validated['contact_email'] ?? $validated['email'],
            'contact_phone' => $validated['contact_phone'] ?? ($validated['phone'] ?? null),
            'address' => $validated['address'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status'],
        ]);

        SystemLog::record('supplier.updated', "Fornecedor {$supplier->user->name} atualizado.");

        return redirect()->route('suppliers.show', $supplier)->with('success', 'Fornecedor atualizado com sucesso.');
    }

    public function destroy(Supplier $supplier)
    {
        $name = optional($supplier->user)->name ?? 'Fornecedor';
        $supplier->delete();
        SystemLog::record('supplier.deleted', "Fornecedor {$name} excluído.");
        return redirect()->route('suppliers.index')->with('success', 'Fornecedor excluído com sucesso.');
    }

    private function validateSupplier(Request $request, ?Supplier $supplier = null): array
    {
        $userId = optional($supplier?->user)->id;
        $document = $this->onlyDigits($request->input('document'));

        $request->merge(['document' => $document]);

        if (!$this->isValidCpfOrCnpj($document)) {
            $request->validate([
                'document' => ['required', function ($attribute, $value, $fail) {
                    $fail('Informe um CPF com 11 dígitos ou CNPJ com 14 dígitos válido.');
                }]
            ]);
        }

        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'phone' => 'nullable|string|max:20',
            'password' => [$supplier ? 'nullable' : 'nullable', 'confirmed', 'min:8'],
            'document' => ['required', 'string', Rule::unique('suppliers', 'document')->ignore($supplier?->id)],
            'category' => 'required|string|max:100',
            'contact_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive,pending',
        ]);
    }

    private function onlyDigits(?string $value): string
    {
        return preg_replace('/\D/', '', (string) $value);
    }

    private function isValidCpfOrCnpj(string $value): bool
    {
        $digits = $this->onlyDigits($value);
        if (strlen($digits) === 11) {
            return $this->isValidCpf($digits);
        }
        if (strlen($digits) === 14) {
            return $this->isValidCnpj($digits);
        }
        return false;
    }

    private function isValidCpf(string $cpf): bool
    {
        if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            $sum = 0;
            for ($i = 0; $i < $t; $i++) {
                $sum += $cpf[$i] * (($t + 1) - $i);
            }
            $digit = ((10 * $sum) % 11) % 10;
            if ((int) $cpf[$t] !== $digit) {
                return false;
            }
        }
        return true;
    }

    private function isValidCnpj(string $cnpj): bool
    {
        if (strlen($cnpj) !== 14 || preg_match('/^(\d)\1{13}$/', $cnpj)) {
            return false;
        }
        $weights1 = [5,4,3,2,9,8,7,6,5,4,3,2];
        $weights2 = [6,5,4,3,2,9,8,7,6,5,4,3,2];
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += $cnpj[$i] * $weights1[$i];
        }
        $digit1 = $sum % 11 < 2 ? 0 : 11 - ($sum % 11);
        $sum = 0;
        for ($i = 0; $i < 13; $i++) {
            $sum += $cnpj[$i] * $weights2[$i];
        }
        $digit2 = $sum % 11 < 2 ? 0 : 11 - ($sum % 11);
        return (int) $cnpj[12] === $digit1 && (int) $cnpj[13] === $digit2;
    }
}
