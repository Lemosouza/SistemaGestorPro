@extends('layouts.admin')
@section('title', $user->exists ? 'Editar usuário' : 'Criar usuário')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">{{ $user->exists ? 'Editar usuário' : 'Criar usuário' }}</div>
        <div class="page-sub">Definição de permissões para administrador, empresa ou fornecedor.</div>
    </div>
    <a href="{{ route('admin.users.index') }}" class="btn-secondary-sm">
        <i class="bi bi-arrow-left"></i> Cancelar
    </a>
</div>

<form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}" class="content-card p-4">
    @csrf
    @if($user->exists)
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nome</label>
            <input name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Telefone</label>
            <input name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Perfil / Permissão</label>
            <select name="role" class="form-select" required>
                <option value="admin" @selected(old('role', $user->role) === 'admin')>Administrador</option>
                <option value="company" @selected(old('role', $user->role) === 'company')>Empresa</option>
                <option value="supplier" @selected(old('role', $user->role) === 'supplier')>Fornecedor</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Senha {{ $user->exists ? '(opcional)' : '' }}</label>
            <input type="password" name="password" class="form-control" {{ $user->exists ? '' : 'required' }}>
        </div>

        <div class="col-md-6">
            <label class="form-label">Confirmar senha</label>
            <input type="password" name="password_confirmation" class="form-control" {{ $user->exists ? '' : 'required' }}>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('admin.users.index') }}" class="btn-secondary-sm">Cancelar</a>
        <button class="btn-primary-sm"><i class="bi bi-save"></i> Salvar</button>
    </div>
</form>

@endsection
