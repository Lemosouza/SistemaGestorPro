@extends('layouts.admin')
@section('title', 'Fornecedores')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Fornecedores</div>
        <div class="page-sub">Lista em tabela com nome, CPF/CNPJ, categoria, status, busca e ações.</div>
    </div>
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('suppliers.create') }}" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Novo fornecedor</a>
    @endif
</div>

<div class="table-card mb-4">
    <div class="table-header">
        <form method="GET" class="d-flex gap-2 flex-grow-1">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nome, e-mail, CPF/CNPJ, categoria ou status" value="{{ request('search') }}">
            <button class="btn-primary-sm" type="submit"><i class="bi bi-search"></i> Buscar</button>
            @if(request('search'))<a href="{{ route(Auth::user()->role === 'company' ? 'company.suppliers.index' : 'suppliers.index') }}" class="btn-secondary-sm">Limpar</a>@endif
        </form>
    </div>
    <div class="table-responsive">
        <table class="custom-table">
            <thead><tr><th>Nome</th><th>CPF/CNPJ</th><th>Categoria</th><th>Status</th><th>Documentos</th><th>Ações</th></tr></thead>
            <tbody>
            @forelse($suppliers as $supplier)
                <tr>
                    <td>
                        <strong>{{ optional($supplier->user)->name ?? '—' }}</strong><br>
                        <span class="muted">{{ optional($supplier->user)->email ?? '—' }}</span>
                    </td>
                    <td>{{ $supplier->document }}</td>
                    <td>{{ $supplier->category ?? '—' }}</td>
                    <td>@include('partials.supplier-status', ['status' => $supplier->status])</td>
                    <td>{{ $supplier->documents_count ?? $supplier->documents->count() }}</td>
                    <td>
                        <a href="{{ Auth::user()->role === 'company' ? route('company.suppliers.show', $supplier) : route('suppliers.show', $supplier) }}" class="btn-icon" title="Visualizar"><i class="bi bi-eye"></i></a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('suppliers.edit', $supplier) }}" class="btn-icon" title="Editar"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display:inline" onsubmit="return confirm('Excluir este fornecedor?')">
                                @csrf @method('DELETE')
                                <button class="btn-icon danger" title="Excluir"><i class="bi bi-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center muted py-4">Nenhum fornecedor encontrado.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $suppliers->links() }}</div>
</div>

@endsection
