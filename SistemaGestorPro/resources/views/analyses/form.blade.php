@extends('layouts.admin')
@section('title', $analysis->exists ? 'Editar avaliação' : 'Nova avaliação')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div><div class="page-title">{{ $analysis->exists ? 'Editar avaliação' : 'Nova avaliação' }}</div><div class="page-sub">Avaliação de fornecedores realizada pela empresa ou administração.</div></div>
    <a href="{{ route('analyses.index') }}" class="btn-secondary-sm"><i class="bi bi-arrow-left"></i> Cancelar</a>
</div>

<form method="POST" action="{{ $analysis->exists ? route('analyses.update', $analysis) : route('analyses.store') }}" class="content-card p-4">
    @csrf
    @if($analysis->exists) @method('PUT') @endif
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Empresa avaliadora</label><select name="company_id" class="form-select" required><option value="">Selecione</option>@foreach($companies as $company)<option value="{{ $company->id }}" @selected(old('company_id', $analysis->company_id) == $company->id)>{{ $company->company_name }}</option>@endforeach</select></div>
        <div class="col-md-6"><label class="form-label">Fornecedor avaliado</label><select name="supplier_id" class="form-select" required><option value="">Selecione</option>@foreach($suppliers as $supplier)<option value="{{ $supplier->id }}" @selected(old('supplier_id', $analysis->supplier_id) == $supplier->id)>{{ optional($supplier->user)->name }} — {{ $supplier->document }}</option>@endforeach</select></div>
        <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select" required><option value="under_review" @selected(old('status', $analysis->status) === 'under_review')>Em análise</option><option value="approved" @selected(old('status', $analysis->status) === 'approved')>Aprovado</option><option value="rejected" @selected(old('status', $analysis->status) === 'rejected')>Reprovado</option></select></div>
        <div class="col-md-4"><label class="form-label">Data da avaliação</label><input type="date" name="evaluation_date" class="form-control" value="{{ old('evaluation_date', optional($analysis->evaluation_date)->format('Y-m-d')) }}"></div>
        <div class="col-md-4"><label class="form-label">Validade da avaliação</label><input type="date" name="validity_date" class="form-control" value="{{ old('validity_date', optional($analysis->validity_date)->format('Y-m-d')) }}"></div>
        <div class="col-12"><label class="form-label">Descrição / Parecer</label><textarea name="description" class="form-control" rows="5">{{ old('description', $analysis->description) }}</textarea></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('analyses.index') }}" class="btn-secondary-sm">Cancelar</a><button class="btn-primary-sm"><i class="bi bi-save"></i> Salvar</button></div>
</form>

@endsection
