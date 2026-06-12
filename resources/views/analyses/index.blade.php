@extends('layouts.admin')
@section('title', 'Avaliações')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div><div class="page-title">Avaliação de Fornecedores</div><div class="page-sub">Tela de listagem para empresa avaliadora e administração.</div></div>
    @if(Auth::user()->role === 'admin')<a href="{{ route('analyses.create') }}" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Nova avaliação</a>@endif
</div>

<div class="table-card">
    <div class="table-header">
        <form method="GET" class="d-flex gap-2 flex-grow-1">
            <input type="text" name="search" class="form-control" placeholder="Buscar por fornecedor, status ou descrição" value="{{ request('search') }}">
            <button class="btn-primary-sm"><i class="bi bi-search"></i> Buscar</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="custom-table">
            <thead><tr><th>Fornecedor</th><th>Empresa</th><th>Status</th><th>Avaliação</th><th>Validade</th><th>Ações</th></tr></thead>
            <tbody>
            @forelse($analyses as $analysis)
                <tr>
                    <td>{{ optional($analysis->supplier->user)->name ?? '—' }}</td>
                    <td>{{ optional($analysis->company)->company_name ?? '—' }}</td>
                    <td>@include('partials.analysis-status', ['status' => $analysis->status])</td>
                    <td>{{ optional($analysis->evaluation_date)->format('d/m/Y') ?? '—' }}</td>
                    <td>{{ optional($analysis->validity_date)->format('d/m/Y') ?? '—' }}</td>
                    <td>
                        <a href="{{ (Auth::user()->role === 'company' ? route('company.analyses.show', $analysis) : route('analyses.show', $analysis)) }}" class="btn-icon"><i class="bi bi-eye"></i></a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('analyses.edit', $analysis) }}" class="btn-icon"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('analyses.destroy', $analysis) }}" method="POST" style="display:inline" onsubmit="return confirm('Excluir avaliação?')">
                                @csrf @method('DELETE')
                                <button class="btn-icon danger"><i class="bi bi-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center muted py-4">Nenhuma avaliação encontrada.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $analyses->links() }}</div>
</div>

@endsection
