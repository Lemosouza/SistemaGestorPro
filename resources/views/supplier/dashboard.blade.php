@extends('layouts.admin')
@section('title', 'Dashboard — Fornecedor')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Dashboard do Fornecedor</div>
        <div class="page-sub">Área do usuário comum fornecedor para envio e acompanhamento de documentos.</div>
    </div>
    <a href="{{ route('documents.create') }}" class="btn-primary-sm"><i class="bi bi-cloud-upload"></i> Enviar documento</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(59,130,246,.15);color:#3b82f6"><i class="bi bi-file-earmark-text"></i></div><div class="value">{{ $totalDocuments ?? 0 }}</div><div class="label">Documentos enviados</div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(52,211,153,.15);color:#34d399"><i class="bi bi-check-circle"></i></div><div class="value">{{ $validDocuments ?? 0 }}</div><div class="label">Válidos</div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(250,204,21,.15);color:#facc15"><i class="bi bi-clock-history"></i></div><div class="value">{{ $expiringDocuments ?? 0 }}</div><div class="label">Próximos do vencimento</div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(248,113,113,.15);color:#f87171"><i class="bi bi-x-octagon"></i></div><div class="value">{{ $expiredDocuments ?? 0 }}</div><div class="label">Vencidos</div></div></div>
</div>

<div class="table-card">
    <div class="table-header">
        <h6><i class="bi bi-file-earmark-text-fill me-2" style="color:#3b82f6"></i>Meus Documentos</h6>
        <a href="{{ route('documents.index') }}" class="btn-secondary-sm">Ver lista completa</a>
    </div>
    <div class="table-responsive">
        <table class="custom-table">
            <thead><tr><th>Tipo</th><th>Arquivo</th><th>Validade</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse($documents ?? [] as $document)
                <tr>
                    <td>{{ $document->document_type }}</td>
                    <td>{{ $document->original_name ?? '—' }}</td>
                    <td>{{ optional($document->expiration_date)->format('d/m/Y') ?? 'Sem validade' }}</td>
                    <td><span class="badge-status {{ $document->status_badge_class }}">{{ $document->status_label }}</span></td>
                    <td><a href="{{ route('documents.show', $document) }}" class="btn-icon"><i class="bi bi-eye"></i></a></td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center muted py-4">Nenhum documento enviado ainda.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
