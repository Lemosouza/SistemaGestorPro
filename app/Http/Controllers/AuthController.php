<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use App\Models\Company;
use App\Models\Document;
use App\Models\Supplier;
use App\Models\SystemLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            SystemLog::record('login', 'Usuário entrou no sistema.');
            return $this->redirectByRole(Auth::user()->role);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'E-mail ou senha incorretos.']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,company,supplier',
            'password' => 'required|confirmed|min:8',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'role.required' => 'Selecione um perfil de acesso.',
            'role.in' => 'Perfil inválido.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'As senhas não coincidem.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($user->role === 'supplier') {
            Supplier::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'document' => preg_replace('/\D/', '', (string) $request->input('document', '00000000000')),
                    'category' => $request->input('category', 'Geral'),
                    'contact_name' => $user->name,
                    'contact_email' => $user->email,
                    'contact_phone' => $user->phone,
                    'status' => 'pending',
                ]
            );
        }

        if ($user->role === 'company') {
            Company::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'company_name' => $user->name,
                    'document' => preg_replace('/\D/', '', (string) $request->input('document', '00000000000000')),
                ]
            );
        }

        Auth::login($user);
        SystemLog::record('register', "Usuário {$user->email} criado pelo cadastro público.");

        return $this->redirectByRole($user->role);
    }

    public function logout(Request $request)
    {
        SystemLog::record('logout', 'Usuário saiu do sistema.');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function adminDashboard()
    {
        $today = Carbon::today();
        $limit = Carbon::today()->addDays(30);

        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalSuppliers' => Supplier::count(),
            'totalDocuments' => Document::count(),
            'totalAnalyses' => Analysis::count(),
            'expiredDocuments' => Document::whereDate('expiration_date', '<', $today)->count(),
            'expiringDocuments' => Document::whereBetween('expiration_date', [$today, $limit])->count(),
            'pendingSuppliers' => Supplier::where('status', 'pending')->count(),
            'recentSuppliers' => Supplier::with('user')->latest()->limit(6)->get(),
            'alerts' => Document::with('supplier.user')
                ->whereNotNull('expiration_date')
                ->whereDate('expiration_date', '<=', $limit)
                ->orderBy('expiration_date')
                ->limit(8)
                ->get(),
        ]);
    }

    public function companyDashboard()
    {
        $today = Carbon::today();
        $limit = Carbon::today()->addDays(30);

        return view('company.dashboard', [
            'totalSuppliers' => Supplier::count(),
            'totalDocuments' => Document::count(),
            'totalAnalyses' => Analysis::count(),
            'approvedAnalyses' => Analysis::where('status', 'approved')->count(),
            'alerts' => Document::with('supplier.user')
                ->whereNotNull('expiration_date')
                ->whereDate('expiration_date', '<=', $limit)
                ->orderBy('expiration_date')
                ->limit(8)
                ->get(),
        ]);
    }

    public function supplierDashboard()
    {
        $supplier = Auth::user()->supplier;
        $documents = $supplier ? $supplier->documents()->latest()->get() : collect();

        return view('supplier.dashboard', [
            'supplier' => $supplier,
            'documents' => $documents,
            'totalDocuments' => $documents->count(),
            'validDocuments' => $documents->where('calculated_status', 'valid')->count(),
            'expiringDocuments' => $documents->where('calculated_status', 'expiring')->count(),
            'expiredDocuments' => $documents->where('calculated_status', 'expired')->count(),
        ]);
    }

    private function redirectByRole(string $role)
    {
        return match($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'company' => redirect()->route('company.dashboard'),
            'supplier' => redirect()->route('supplier.dashboard'),
            default => redirect()->route('login'),
        };
    }
}
