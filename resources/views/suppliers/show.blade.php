@extends('layouts.admin')
@section('title', 'Detalhes do Fornecedor')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Detalhes do Fornecedor</div>
        <div class="page-sub">Dados completos, documentos, avaliações e status geral.</div>
    </div>
    <div class="d-flex gap-2">
        @if(Auth::user()->role === 'admin')<a href="{{ route('suppliers.edit', $supplier) }}" class="btn-primary-sm"><i class="bi bi-pencil"></i> Editar</a>@endif
        <a href="{{ Auth::user()->role === 'company' ? route('company.suppliers.index') : route('suppliers.index') }}" class="btn-secondary-sm"><i class="bi bi-arrow-left"></i> Voltar</a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="content-card p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0">{{ optional($supplier->user)->name ?? '—' }}</h5>
                <span class="badge-status {{ $supplier->general_status === 'regular' ? 'badge-active' : 'badge-inactive' }}">{{ ucfirst($supplier->general_status) }}</span>
            </div>
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-label">CPF/CNPJ</div><div class="detail-value">{{ $supplier->document }}</div></div>
                <div class="detail-item"><div class="detail-label">Categoria</div><div class="detail-value">{{ $supplier->category ?? '—' }}</div></div>
                <div class="detail-item"><div class="detail-label">E-mail</div><div class="detail-value">{{ optional($supplier->user)->email ?? '—' }}</div></div>
                <div class="detail-item"><div class="detail-label">Telefone</div><div class="detail-value">{{ optional($supplier->user)->phone ?? '—' }}</div></div>
                <div class="detail-item"><div class="detail-label">Responsável</div><div class="detail-value">{{ $supplier->contact_name ?? '—' }}</div></div>
                <div class="detail-item"><div class="detail-label">Status cadastral</div><div class="detail-value">@include('partials.supplier-status', ['status' => $supplier->status])</div></div>
            </div>
            @if($supplier->notes)<div class="mt-3 muted">{{ $supplier->notes }}</div>@endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="stat-card h-100"><div class="icon" style="background:rgba(59,130,246,.15);color:#3b82f6"><i class="bi bi-clipboard-data"></i></div><div class="value">{{ $supplier->documents->count() }}</div><div class="label">Documentos vinculados</div><div class="change muted">{{ $supplier->analyses->count() }} avaliações registradas</div></div>
    </div>
</div>

<div class="table-card mb-4">
    <div class="table-header"><h6>Documentos do fornecedor</h6></div>
    <div class="table-responsive"><table class="custom-table"><thead><tr><th>Tipo</th><th>Arquivo</th><th>Validade</th><th>Status</th><th></th></tr></thead><tbody>
    @forelse($supplier->documents as $document)
        <tr><td>{{ $document->document_type }}</td><td>{{ $document->original_name ?? '—' }}</td><td>{{ optional($document->expiration_date)->format('d/m/Y') ?? '—' }}</td><td><span class="badge-status {{ $document->status_badge_class }}">{{ $document->status_label }}</span></td><td><a href="{{ route('documents.show', $document) }}" class="btn-icon"><i class="bi bi-eye"></i></a></td></tr>
    @empty
        <tr><td colspan="5" class="text-center muted py-4">Nenhum documento enviado.</td></tr>
    @endforelse
    </tbody></table></div>
</div>

<div class="table-card">
    <div class="table-header"><h6>Avaliações do fornecedor</h6>@if(Auth::user()->role === 'admin')<a href="{{ route('analyses.create') }}" class="btn-primary-sm">Nova avaliação</a>@endif</div>
    <div class="table-responsive"><table class="custom-table"><thead><tr><th>Empresa</th><th>Status</th><th>Avaliação</th><th>Validade</th><th></th></tr></thead><tbody>
    @forelse($supplier->analyses as $analysis)
        <tr><td>{{ optional($analysis->company)->company_name ?? '—' }}</td><td>@include('partials.analysis-status', ['status' => $analysis->status])</td><td>{{ optional($analysis->evaluation_date)->format('d/m/Y') ?? '—' }}</td><td>{{ optional($analysis->validity_date)->format('d/m/Y') ?? '—' }}</td><td><a href="{{ (Auth::user()->role === 'company' ? route('company.analyses.show', $analysis) : route('analyses.show', $analysis)) }}" class="btn-icon"><i class="bi bi-eye"></i></a></td></tr>
    @empty
        <tr><td colspan="5" class="text-center muted py-4">Nenhuma avaliação registrada.</td></tr>
    @endforelse
    </tbody></table></div>
</div>

@endsection
