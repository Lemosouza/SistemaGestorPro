@extends('layouts.admin')
@section('title', 'Detalhes do Documento')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Detalhes do Documento</div>
        <div class="page-sub">Informações de arquivo, validade e status documental.</div>
    </div>
    <a href="{{ route('documents.index') }}" class="btn-secondary-sm"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

<div class="content-card p-4">
    <div class="detail-grid">
        <div class="detail-item"><div class="detail-label">Fornecedor</div><div class="detail-value">{{ optional($document->supplier->user)->name ?? '—' }}</div></div>
        <div class="detail-item"><div class="detail-label">Tipo</div><div class="detail-value">{{ $document->document_type }}</div></div>
        <div class="detail-item"><div class="detail-label">Arquivo</div><div class="detail-value">{{ $document->original_name ?? '—' }}</div></div>
        <div class="detail-item"><div class="detail-label">Upload</div><div class="detail-value">{{ optional($document->upload_date)->format('d/m/Y H:i') ?? optional($document->created_at)->format('d/m/Y H:i') }}</div></div>
        <div class="detail-item"><div class="detail-label">Validade</div><div class="detail-value">{{ optional($document->expiration_date)->format('d/m/Y') ?? 'Sem validade' }}</div></div>
        <div class="detail-item"><div class="detail-label">Status</div><div class="detail-value"><span class="badge-status {{ $document->status_badge_class }}">{{ $document->status_label }}</span></div></div>
    </div>

    <div class="mt-4 d-flex gap-2">
        @if($document->file_path)
            <a href="{{ asset('storage/'.$document->file_path) }}" target="_blank" class="btn-primary-sm"><i class="bi bi-download"></i> Abrir arquivo</a>
        @endif
        <a href="{{ route('documents.index') }}" class="btn-secondary-sm">Voltar</a>
    </div>
</div>

@endsection
