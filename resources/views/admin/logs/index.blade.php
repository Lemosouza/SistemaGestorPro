@extends('layouts.admin')
@section('title', 'Histórico de Alterações')
@section('content')

@php
    // Tradução visual apenas para o front-end.
    $actionLabels = [
        'register' => 'Cadastro',
        'login' => 'Entrada',
        'logout' => 'Saída',
        'create' => 'Criação',
        'update' => 'Atualização',
        'delete' => 'Exclusão',
        'upload' => 'Envio de documento',
        'download' => 'Download',
        'approve' => 'Aprovação',
        'reject' => 'Reprovação',
        'company.created' => 'Empresa criada',
        'company.updated' => 'Empresa atualizada',
        'company.deleted' => 'Empresa excluída',
        'supplier.created' => 'Fornecedor criado',
        'supplier.updated' => 'Fornecedor atualizado',
        'supplier.deleted' => 'Fornecedor excluído',
        'document.uploaded' => 'Documento enviado',
        'document.deleted' => 'Documento excluído',
        'analysis.created' => 'Avaliação criada',
        'analysis.updated' => 'Avaliação atualizada',
        'analysis.deleted' => 'Avaliação excluída',
        'user.created' => 'Usuário criado',
        'user.updated' => 'Usuário atualizado',
        'user.deleted' => 'Usuário excluído',
    ];
@endphp

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Histórico de Alterações</div>
        <div class="page-sub">Logs do sistema para auditoria administrativa.</div>
    </div>
</div>

<div class="table-card">
    <div class="table-header">
        <form method="GET" class="d-flex gap-2 flex-grow-1">
            <input name="search" class="form-control" placeholder="Buscar por ação, descrição ou usuário" value="{{ request('search') }}">
            <button class="btn-primary-sm"><i class="bi bi-search"></i> Buscar</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Usuário</th>
                    <th>Ação</th>
                    <th>Descrição</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    @php
                        $actionKey = strtolower(trim($log->action ?? ''));
                    @endphp
                    <tr>
                        <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ optional($log->user)->name ?? 'Sistema' }}</td>
                        <td>
                            <span class="badge-status badge-pending">
                                {{ $actionLabels[$actionKey] ?? $log->action }}
                            </span>
                        </td>
                        <td>{{ $log->description ?: '—' }}</td>
                        <td>{{ $log->ip_address ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center muted py-4">Nenhum log registrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3">{{ $logs->links() }}</div>
</div>

@endsection
