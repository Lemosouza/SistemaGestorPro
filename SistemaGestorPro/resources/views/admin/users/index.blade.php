@extends('layouts.admin')
@section('title', 'Gestão de Usuários')
@section('content')

@php
    // Tradução visual apenas para o front-end.
    // O banco continua usando: admin, supplier e company.
    $roleLabels = [
        'admin' => 'Administrador',
        'supplier' => 'Fornecedor',
        'company' => 'Empresa',
    ];

    $roleClasses = [
        'admin' => 'badge-pending',
        'supplier' => 'badge-active',
        'company' => 'badge-active',
    ];
@endphp

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Gestão de Usuários</div>
        <div class="page-sub">Área administrativa com lista, criação, edição e permissões por perfil.</div>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn-primary-sm">
        <i class="bi bi-person-plus"></i> Criar usuário
    </a>
</div>

<div class="table-card">
    <div class="table-header">
        <form method="GET" class="d-flex gap-2 flex-grow-1">
            <input
                name="search"
                class="form-control"
                placeholder="Buscar por nome, e-mail, telefone ou perfil"
                value="{{ request('search') }}"
            >
            <button class="btn-primary-sm"><i class="bi bi-search"></i> Buscar</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Permissão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    @php
                        $roleKey = strtolower(trim($user->role ?? ''));
                    @endphp
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '—' }}</td>
                        <td>
                            <span class="badge-status {{ $roleClasses[$roleKey] ?? 'badge-pending' }}">
                                {{ $roleLabels[$roleKey] ?? $user->role }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn-icon">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline" onsubmit="return confirm('Excluir este usuário?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-icon danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center muted py-4">Nenhum usuário encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-3">{{ $users->links() }}</div>
</div>

@endsection
