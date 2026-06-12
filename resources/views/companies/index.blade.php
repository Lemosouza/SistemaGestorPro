@extends('layouts.admin')
@section('title', 'Empresas')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div><div class="page-title">Empresas Avaliadoras</div><div class="page-sub">Cadastro das empresas que avaliam fornecedores.</div></div>
    <a href="{{ route('companies.create') }}" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Nova empresa</a>
</div>

<div class="table-card">
    <div class="table-header"><form method="GET" class="d-flex gap-2 flex-grow-1"><input name="search" class="form-control" placeholder="Buscar empresa" value="{{ request('search') }}"><button class="btn-primary-sm"><i class="bi bi-search"></i> Buscar</button></form></div>
    <div class="table-responsive"><table class="custom-table"><thead><tr><th>Empresa</th><th>Documento</th><th>Usuário</th><th>Ações</th></tr></thead><tbody>
    @forelse($companies as $company)
        <tr><td>{{ $company->company_name }}</td><td>{{ $company->document }}</td><td>{{ optional($company->user)->email ?? '—' }}</td><td><a href="{{ route('companies.show', $company) }}" class="btn-icon"><i class="bi bi-eye"></i></a><a href="{{ route('companies.edit', $company) }}" class="btn-icon"><i class="bi bi-pencil"></i></a><form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline" onsubmit="return confirm('Excluir empresa?')">@csrf @method('DELETE')<button class="btn-icon danger"><i class="bi bi-trash"></i></button></form></td></tr>
    @empty
        <tr><td colspan="4" class="text-center muted py-4">Nenhuma empresa cadastrada.</td></tr>
    @endforelse
    </tbody></table></div><div class="p-3">{{ $companies->links() }}</div>
</div>

@endsection
