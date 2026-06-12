<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\SystemLogController;

// Landing page
Route::get('/', fn() => view('landing'))->name('landing');

// Autenticação pública
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Documentos: fornecedor envia; admin/empresa acompanham e visualizam.
    Route::resource('documents', DocumentController::class)->only(['index', 'create', 'store', 'show', 'destroy']);

    // Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::resource('suppliers', SupplierController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('analyses',  AnalysisController::class);

        Route::prefix('admin/users')->name('admin.users.')->group(function () {
            Route::get('/',            [AdminUserController::class, 'index'])->name('index');
            Route::get('/create',      [AdminUserController::class, 'create'])->name('create');
            Route::post('/',           [AdminUserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/{user}',      [AdminUserController::class, 'update'])->name('update');
            Route::delete('/{user}',   [AdminUserController::class, 'destroy'])->name('destroy');
        });

        Route::get('/admin/logs', [SystemLogController::class, 'index'])->name('admin.logs.index');
    });

    // Empresa avaliadora
    Route::middleware(['role:company'])->group(function () {
        Route::get('/company/dashboard', [AuthController::class, 'companyDashboard'])->name('company.dashboard');
        Route::get('/company/analyses',  [AnalysisController::class, 'index'])->name('company.analyses');
        Route::get('/company/analyses/{analysis}', [AnalysisController::class, 'show'])->name('company.analyses.show');
        Route::get('/company/suppliers', [SupplierController::class, 'index'])->name('company.suppliers.index');
        Route::get('/company/suppliers/{supplier}', [SupplierController::class, 'show'])->name('company.suppliers.show');
    });

    // Fornecedor comum
    Route::middleware(['role:supplier'])->group(function () {
        Route::get('/supplier/dashboard', [AuthController::class, 'supplierDashboard'])->name('supplier.dashboard');
    });
});
