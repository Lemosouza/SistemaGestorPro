@extends('layouts.admin')
@section('title', 'Dashboard — Admin')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Dashboard Administrativo</div>
        <div class="page-sub">Cards de gestão, alertas documentais e visão geral dos fornecedores.</div>
    </div>
    <a href="{{ route('suppliers.create') }}" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Novo fornecedor</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(59,130,246,.15);color:#3b82f6"><i class="bi bi-person-lines-fill"></i></div><div class="value">{{ $totalUsers ?? 0 }}</div><div class="label">Usuários</div><div class="change muted">Gestão de permissões</div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(52,211,153,.15);color:#34d399"><i class="bi bi-people-fill"></i></div><div class="value">{{ $totalSuppliers ?? 0 }}</div><div class="label">Fornecedores</div><div class="change muted">Base cadastrada</div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(250,204,21,.15);color:#facc15"><i class="bi bi-exclamation-triangle-fill"></i></div><div class="value">{{ $expiringDocuments ?? 0 }}</div><div class="label">Próximos do vencimento</div><div class="change" style="color:#facc15">Até 30 dias</div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="icon" style="background:rgba(248,113,113,.15);color:#f87171"><i class="bi bi-x-octagon-fill"></i></div><div class="value">{{ $expiredDocuments ?? 0 }}</div><div class="label">Documentos vencidos</div><div class="change" style="color:#f87171">Exigem ação</div></div></div>
</div>

<div class="row g-4">
    <div class="col-xl-7">
        <div class="table-card">
            <div class="table-header">
                <h6><i class="bi bi-bell-fill me-2" style="color:#facc15"></i>Lista de alertas</h6>
                <a href="{{ route('documents.index') }}" class="btn-secondary-sm">Ver documentos</a>
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead><tr><th>Documento</th><th>Fornecedor</th><th>Validade</th><th>Status</th></tr></thead>
                    <tbody>
                    @forelse($alerts ?? [] as $document)
                        <tr>
                            <td>{{ $document->document_type }}</td>
                            <td>{{ optional($document->supplier->user)->name ?? '—' }}</td>
                            <td>{{ optional($document->expiration_date)->format('d/m/Y') ?? '—' }}</td>
                            <td><span class="badge-status {{ $document->status_badge_class }}">{{ $document->status_label }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center muted py-4">Nenhum alerta documental no momento.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="table-card">
            <div class="table-header">
                <h6><i class="bi bi-people-fill me-2" style="color:#3b82f6"></i>Fornecedores recentes</h6>
                <a href="{{ route('suppliers.index') }}" class="btn-secondary-sm">Ver todos</a>
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead><tr><th>Nome</th><th>Categoria</th><th>Status</th></tr></thead>
                    <tbody>
                    @forelse($recentSuppliers ?? [] as $supplier)
                        <tr>
                            <td><a href="{{ route('suppliers.show', $supplier) }}" class="text-decoration-none">{{ optional($supplier->user)->name ?? '—' }}</a></td>
                            <td>{{ $supplier->category ?? '—' }}</td>
                            <td>@include('partials.supplier-status', ['status' => $supplier->status])</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center muted py-4">Nenhum fornecedor cadastrado.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
