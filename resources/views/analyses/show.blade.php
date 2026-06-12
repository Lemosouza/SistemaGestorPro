@extends('layouts.admin')
@section('title', 'Detalhes da Avaliação')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div><div class="page-title">Detalhes da Avaliação</div><div class="page-sub">Tela de visualização da empresa avaliadora.</div></div>
    <div class="d-flex gap-2">@if(Auth::user()->role === 'admin')<a href="{{ route('analyses.edit', $analysis) }}" class="btn-primary-sm"><i class="bi bi-pencil"></i> Editar</a>@endif<a href="{{ route(Auth::user()->role === 'company' ? 'company.analyses' : 'analyses.index') }}" class="btn-secondary-sm"><i class="bi bi-arrow-left"></i> Voltar</a></div>
</div>

<div class="content-card p-4">
    <div class="detail-grid">
        <div class="detail-item"><div class="detail-label">Fornecedor</div><div class="detail-value">{{ optional($analysis->supplier->user)->name ?? '—' }}</div></div>
        <div class="detail-item"><div class="detail-label">Empresa avaliadora</div><div class="detail-value">{{ optional($analysis->company)->company_name ?? '—' }}</div></div>
        <div class="detail-item"><div class="detail-label">Status</div><div class="detail-value">@include('partials.analysis-status', ['status' => $analysis->status])</div></div>
        <div class="detail-item"><div class="detail-label">Data da avaliação</div><div class="detail-value">{{ optional($analysis->evaluation_date)->format('d/m/Y') ?? '—' }}</div></div>
        <div class="detail-item"><div class="detail-label">Validade</div><div class="detail-value">{{ optional($analysis->validity_date)->format('d/m/Y') ?? '—' }}</div></div>
        <div class="detail-item"><div class="detail-label">Documento do fornecedor</div><div class="detail-value">{{ optional($analysis->supplier)->document ?? '—' }}</div></div>
    </div>
    <div class="mt-4"><div class="detail-label">Parecer</div><div class="muted">{{ $analysis->description ?: 'Nenhuma descrição informada.' }}</div></div>
</div>

@endsection
