@extends('layouts.admin')
@section('title', $company->exists ? 'Editar empresa' : 'Cadastrar empresa')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4"><div><div class="page-title">{{ $company->exists ? 'Editar empresa' : 'Cadastrar empresa' }}</div><div class="page-sub">Cadastro de empresa avaliadora.</div></div><a href="{{ route('companies.index') }}" class="btn-secondary-sm"><i class="bi bi-arrow-left"></i> Cancelar</a></div>

<form method="POST" action="{{ $company->exists ? route('companies.update', $company) : route('companies.store') }}" class="content-card p-4">
    @csrf
    @if($company->exists) @method('PUT') @endif
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Nome do usuário</label><input name="name" class="form-control" value="{{ old('name', $user->name) }}" required></div>
        <div class="col-md-6"><label class="form-label">E-mail</label><input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required></div>
        <div class="col-md-6"><label class="form-label">Telefone</label><input name="phone" class="form-control" value="{{ old('phone', $user->phone) }}"></div>
        <div class="col-md-6"><label class="form-label">Nome da empresa</label><input name="company_name" class="form-control" value="{{ old('company_name', $company->company_name) }}" required></div>
        <div class="col-md-6"><label class="form-label">CNPJ/Documento</label><input name="document" class="form-control" value="{{ old('document', $company->document) }}" required></div>
        <div class="col-md-3"><label class="form-label">Senha {{ $company->exists ? '(opcional)' : '' }}</label><input type="password" name="password" class="form-control"></div>
        <div class="col-md-3"><label class="form-label">Confirmar senha</label><input type="password" name="password_confirmation" class="form-control"></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('companies.index') }}" class="btn-secondary-sm">Cancelar</a><button class="btn-primary-sm"><i class="bi bi-save"></i> Salvar</button></div>
</form>

@endsection
