@extends('layouts.admin')
@section('title', 'Dashboard — Empresa')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Dashboard da Empresa Avaliadora</div>
        <div class="page-sub">Listagem e visualização de fornecedores, documentos e avaliações.</div>
    </div>
    <a href="{{ route('company.suppliers.index') }}" class="btn-primary-sm"><i class="bi bi-search"></i> Ver fornecedores</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(59,130,246,.15);color:#3b82f6"><i class="bi bi-people-fill"></i></div><div class="value">{{ $totalSuppliers ?? 0 }}</div><div class="label">Fornecedores</div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(52,211,153,.15);color:#34d399"><i class="bi bi-file-earmark-text-fill"></i></div><div class="value">{{ $totalDocuments ?? 0 }}</div><div class="label">Documentos</div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(250,204,21,.15);color:#facc15"><i class="bi bi-graph-up-arrow"></i></div><div class="value">{{ $totalAnalyses ?? 0 }}</div><div class="label">Avaliações</div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(6,182,212,.15);color:#06b6d4"><i class="bi bi-check2-circle"></i></div><div class="value">{{ $approvedAnalyses ?? 0 }}</div><div class="label">Aprovados</div></div></div>
</div>

<div class="table-card">
    <div class="table-header">
        <h6><i class="bi bi-bell-fill me-2" style="color:#facc15"></i>Alertas de documentos para avaliação</h6>
        <a href="{{ route('documents.index') }}" class="btn-secondary-sm">Ver documentos</a>
    </div>
    <div class="table-responsive">
        <table class="custom-table">
            <thead><tr><th>Fornecedor</th><th>Documento</th><th>Validade</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse($alerts ?? [] as $document)
                <tr>
                    <td>{{ optional($document->supplier->user)->name ?? '—' }}</td>
                    <td>{{ $document->document_type }}</td>
                    <td>{{ optional($document->expiration_date)->format('d/m/Y') ?? '—' }}</td>
                    <td><span class="badge-status {{ $document->status_badge_class }}">{{ $document->status_label }}</span></td>
                    <td><a href="{{ route('documents.show', $document) }}" class="btn-icon"><i class="bi bi-eye"></i></a></td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center muted py-4">Nenhum alerta no momento.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
