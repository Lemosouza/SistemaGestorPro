<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AnalysisController;

// Rotas públicas
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas — autenticado
Route::middleware(['auth'])->group(function () {

    // Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::resource('suppliers', SupplierController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('analyses', AnalysisController::class);
    });

    // Company
    Route::middleware(['role:company'])->group(function () {
        Route::get('/company/dashboard', [AuthController::class, 'companyDashboard'])->name('company.dashboard');
        Route::get('/company/analyses', [AnalysisController::class, 'index'])->name('company.analyses');
        Route::get('/company/analyses/{analysis}', [AnalysisController::class, 'show'])->name('company.analyses.show');
    });

    // Supplier
    Route::middleware(['role:supplier'])->group(function () {
        Route::get('/supplier/dashboard', [AuthController::class, 'supplierDashboard'])->name('supplier.dashboard');
        Route::resource('documents', DocumentController::class)->only(['index', 'create', 'store', 'show']);
    });

});