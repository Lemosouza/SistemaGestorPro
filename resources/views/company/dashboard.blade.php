@extends('layouts.admin')
@section('title', 'Dashboard — Empresa')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Dashboard</div>
        <div class="page-sub">Bem-vindo de volta, {{ Auth::user()->name }}!</div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(59,130,246,.15);color:#3b82f6"><i class="bi bi-people-fill"></i></div>
            <div class="value">—</div>
            <div class="label">Fornecedores</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(52,211,153,.15);color:#34d399"><i class="bi bi-file-earmark-text-fill"></i></div>
            <div class="value">—</div>
            <div class="label">Documentos</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(250,204,21,.15);color:#facc15"><i class="bi bi-graph-up-arrow"></i></div>
            <div class="value">—</div>
            <div class="label">Análises</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(6,182,212,.15);color:#06b6d4"><i class="bi bi-check2-circle"></i></div>
            <div class="value">—</div>
            <div class="label">Aprovados</div>
        </div>
    </div>
</div>

<div class="table-card">
    <div class="table-header">
        <h6><i class="bi bi-clock-history me-2" style="color:#3b82f6"></i>Atividade Recente</h6>
    </div>
    <div style="padding:40px;text-align:center;color:var(--muted)">
        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px"></i>
        Nenhuma atividade recente.
    </div>
</div>

@endsection