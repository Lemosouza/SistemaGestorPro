@extends('layouts.admin')
@section('title', 'Dashboard — Fornecedor')
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
            <div class="icon" style="background:rgba(52,211,153,.15);color:#34d399"><i class="bi bi-file-earmark-check-fill"></i></div>
            <div class="value">—</div>
            <div class="label">Documentos enviados</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(250,204,21,.15);color:#facc15"><i class="bi bi-hourglass-split"></i></div>
            <div class="value">—</div>
            <div class="label">Pendentes</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(59,130,246,.15);color:#3b82f6"><i class="bi bi-graph-up-arrow"></i></div>
            <div class="value">—</div>
            <div class="label">Análises</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="icon" style="background:rgba(248,113,113,.15);color:#f87171"><i class="bi bi-exclamation-circle-fill"></i></div>
            <div class="value">—</div>
            <div class="label">Vencendo</div>
        </div>
    </div>
</div>

<div class="table-card">
    <div class="table-header">
        <h6><i class="bi bi-file-earmark-text-fill me-2" style="color:#3b82f6"></i>Meus Documentos</h6>
        <a href="{{ route('documents.create') }}" class="btn-primary-sm">
            <i class="bi bi-plus-lg"></i> Enviar documento
        </a>
    </div>
    <div style="padding:40px;text-align:center;color:var(--muted)">
        <i class="bi bi-file-earmark" style="font-size:2rem;display:block;margin-bottom:8px"></i>
        Nenhum documento enviado ainda.
    </div>
</div>

@endsection