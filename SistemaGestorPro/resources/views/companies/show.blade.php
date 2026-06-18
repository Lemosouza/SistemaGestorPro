@extends('layouts.admin')
@section('title', 'Detalhes da Empresa')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4"><div><div class="page-title">Detalhes da Empresa</div><div class="page-sub">Dados e avaliações vinculadas.</div></div><div class="d-flex gap-2"><a href="{{ route('companies.edit', $company) }}" class="btn-primary-sm"><i class="bi bi-pencil"></i> Editar</a><a href="{{ route('companies.index') }}" class="btn-secondary-sm"><i class="bi bi-arrow-left"></i> Voltar</a></div></div>

<div class="content-card p-4 mb-4"><div class="detail-grid"><div class="detail-item"><div class="detail-label">Empresa</div><div class="detail-value">{{ $company->company_name }}</div></div><div class="detail-item"><div class="detail-label">Documento</div><div class="detail-value">{{ $company->document }}</div></div><div class="detail-item"><div class="detail-label">Usuário</div><div class="detail-value">{{ optional($company->user)->name }}</div></div><div class="detail-item"><div class="detail-label">E-mail</div><div class="detail-value">{{ optional($company->user)->email }}</div></div></div></div>

<div class="table-card"><div class="table-header"><h6>Avaliações realizadas</h6></div><div class="table-responsive"><table class="custom-table"><thead><tr><th>Fornecedor</th><th>Status</th><th>Avaliação</th><th></th></tr></thead><tbody>@forelse($company->analyses as $analysis)<tr><td>{{ optional($analysis->supplier->user)->name ?? '—' }}</td><td>@include('partials.analysis-status', ['status' => $analysis->status])</td><td>{{ optional($analysis->evaluation_date)->format('d/m/Y') ?? '—' }}</td><td><a href="{{ route('analyses.show', $analysis) }}" class="btn-icon"><i class="bi bi-eye"></i></a></td></tr>@empty<tr><td colspan="4" class="text-center muted py-4">Nenhuma avaliação vinculada.</td></tr>@endforelse</tbody></table></div></div>

@endsection
