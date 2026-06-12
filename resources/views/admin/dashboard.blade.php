@extends('layouts.admin')
@section('title', 'Dashboard — SistemaGestorPro')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Dashboard</div>
        <div class="page-sub">Bem-vindo de volta, {{ Auth::user()->name }}!</div>
    </div>
</div>

<!-- STAT CARDS -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(59,130,246,.15);color:#3b82f6"><i class="bi bi-people-fill"></i></div>
            <div class="value">{{ $totalSuppliers ?? 0 }}</div>
            <div class="label">Fornecedores</div>
            <div class="change" style="color:#34d399"><i class="bi bi-arrow-up-short"></i> Total cadastrado</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(6,182,212,.15);color:#06b6d4"><i class="bi bi-building-fill"></i></div>
            <div class="value">{{ $totalCompanies ?? 0 }}</div>
            <div class="label">Empresas</div>
            <div class="change" style="color:#34d399"><i class="bi bi-arrow-up-short"></i> Total cadastrado</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(52,211,153,.15);color:#34d399"><i class="bi bi-file-earmark-text-fill"></i></div>
            <div class="value">{{ $totalDocuments ?? 0 }}</div>
            <div class="label">Documentos</div>
            <div class="change" style="color:#34d399"><i class="bi bi-arrow-up-short"></i> Total cadastrado</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(250,204,21,.15);color:#facc15"><i class="bi bi-graph-up-arrow"></i></div>
            <div class="value">{{ $totalAnalyses ?? 0 }}</div>
            <div class="label">Análises</div>
            <div class="change" style="color:#34d399"><i class="bi bi-arrow-up-short"></i> Total cadastrado</div>
        </div>
    </div>
</div>

<!-- RECENT SUPPLIERS TABLE -->
<div class="table-card">
    <div class="table-header">
        <h6><i class="bi bi-people-fill me-2" style="color:#3b82f6"></i>Fornecedores Recentes</h6>
        <a href="{{ route('suppliers.index') }}" class="btn-primary-sm">
            <i class="bi bi-arrow-right"></i> Ver todos
        </a>
    </div>
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Documento</th>
                    <th>Status</th>
                    <th>Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentSuppliers ?? [] as $supplier)
                <tr>
                    <td style="color:var(--muted)">{{ $supplier->id }}</td>
                    <td>{{ $supplier->document ?? '—' }}</td>
                    <td>
                        @if($supplier->status === 'active')
                            <span class="badge-status badge-active">Ativo</span>
                        @elseif($supplier->status === 'inactive')
                            <span class="badge-status badge-inactive">Inativo</span>
                        @else
                            <span class="badge-status badge-pending">Pendente</span>
                        @endif
                    </td>
                    <td style="color:var(--muted)">{{ $supplier->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn-icon me-1"><i class="bi bi-pencil"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:32px">Nenhum fornecedor cadastrado ainda.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection