@extends('layouts.admin')
@section('title', 'Documentos')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Documentos</div>
        <div class="page-sub">Lista de documentos do fornecedor, upload de arquivos, validade e status.</div>
    </div>
    @if(Auth::user()->role !== 'company')
        <a href="{{ route('documents.create') }}" class="btn-primary-sm"><i class="bi bi-cloud-upload"></i> Novo upload</a>
    @endif
</div>

<div class="table-card">
    <div class="table-header">
        <form method="GET" class="d-flex gap-2 flex-grow-1">
            <input type="text" name="search" class="form-control" placeholder="Buscar por fornecedor, tipo ou status" value="{{ request('search') }}">
            <button class="btn-primary-sm"><i class="bi bi-search"></i> Buscar</button>
            @if(request('search'))<a href="{{ route('documents.index') }}" class="btn-secondary-sm">Limpar</a>@endif
        </form>
    </div>
    <div class="table-responsive">
        <table class="custom-table">
            <thead><tr><th>Fornecedor</th><th>Tipo</th><th>Arquivo</th><th>Validade</th><th>Status</th><th>Ações</th></tr></thead>
            <tbody>
            @forelse($documents as $document)
                <tr>
                    <td>{{ optional($document->supplier->user)->name ?? '—' }}</td>
                    <td>{{ $document->document_type }}</td>
                    <td>{{ $document->original_name ?? '—' }}</td>
                    <td>{{ optional($document->expiration_date)->format('d/m/Y') ?? 'Sem validade' }}</td>
                    <td><span class="badge-status {{ $document->status_badge_class }}">{{ $document->status_label }}</span></td>
                    <td>
                        <a href="{{ route('documents.show', $document) }}" class="btn-icon"><i class="bi bi-eye"></i></a>
                        @if(Auth::user()->role !== 'company')
                        <form action="{{ route('documents.destroy', $document) }}" method="POST" style="display:inline" onsubmit="return confirm('Excluir este documento?')">
                            @csrf @method('DELETE')
                            <button class="btn-icon danger"><i class="bi bi-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center muted py-4">Nenhum documento encontrado.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $documents->links() }}</div>
</div>

@endsection
