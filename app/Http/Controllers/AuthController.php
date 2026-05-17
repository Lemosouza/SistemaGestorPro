<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ── Login ────────────────────────────────────────────────

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return $this->redirectByRole(Auth::user()->role);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'E-mail ou senha incorretos.']);
    }

    // ── Registro ─────────────────────────────────────────────

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|in:admin,company,supplier',
            'password' => 'required|confirmed|min:8',
        ], [
            'name.required'      => 'O nome é obrigatório.',
            'email.required'     => 'O e-mail é obrigatório.',
            'email.email'        => 'Informe um e-mail válido.',
            'email.unique'       => 'Este e-mail já está cadastrado.',
            'role.required'      => 'Selecione um perfil de acesso.',
            'role.in'            => 'Perfil inválido.',
            'password.required'  => 'A senha é obrigatória.',
            'password.confirmed' => 'As senhas não coincidem.',
            'password.min'       => 'A senha deve ter no mínimo 8 caracteres.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return $this->redirectByRole($user->role);
    }

    // ── Logout ───────────────────────────────────────────────

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // ── Dashboards ───────────────────────────────────────────

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function companyDashboard()
    {
        return view('company.dashboard');
    }

    public function supplierDashboard()
    {
        return view('supplier.dashboard');
    }

    // ── Helper ───────────────────────────────────────────────

    private function redirectByRole(string $role)
    {
        return match($role) {
            'admin'    => redirect()->route('admin.dashboard'),
            'company'  => redirect()->route('company.dashboard'),
            'supplier' => redirect()->route('supplier.dashboard'),
            default    => redirect()->route('login'),
        };
    }
}