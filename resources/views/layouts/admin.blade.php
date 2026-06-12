<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'SistemaGestorPro')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --dark: #0d0f14;
            --surface: #13161e;
            --surface2: #1a1e29;
            --border: #252a38;
            --text: #e8eaf0;
            --muted: #8b93a8;
            --sidebar-w: 270px;
        }
        * { box-sizing: border-box; }
        body { background: radial-gradient(circle at top left, rgba(59,130,246,.08), transparent 30%), var(--dark); color: var(--text); font-family: 'Segoe UI', sans-serif; min-height: 100vh; }
        a { color: inherit; }
        .topbar { height: 60px; background: rgba(19,22,30,.94); border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 24px; position: fixed; top: 0; left: 0; right: 0; z-index: 200; backdrop-filter: blur(12px); }
        .topbar-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 34px; height: 34px; background: linear-gradient(135deg, var(--primary), #06b6d4); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; }
        .brand-name { font-weight: 800; color: var(--text); }
        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .user-pill { display: flex; align-items: center; gap: 8px; background: var(--surface2); border: 1px solid var(--border); border-radius: 99px; padding: 6px 14px; font-size: .85rem; }
        .user-avatar { width: 28px; height: 28px; background: linear-gradient(135deg, var(--primary), #06b6d4); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: .75rem; font-weight: 700; }
        .btn-logout { background: transparent; border: 1px solid var(--border); color: var(--muted); border-radius: 8px; padding: 6px 14px; font-size: .82rem; }
        .btn-logout:hover { border-color: #f87171; color: #f87171; }
        .sidebar { width: var(--sidebar-w); background: rgba(19,22,30,.96); border-right: 1px solid var(--border); position: fixed; top: 60px; left: 0; bottom: 0; overflow-y: auto; padding: 22px 16px; }
        .sidebar-section-label { color: var(--muted); font-size: .72rem; text-transform: uppercase; letter-spacing: .12em; margin: 10px 12px; }
        .sidebar-link { display: flex; align-items: center; gap: 10px; padding: 11px 12px; border-radius: 10px; color: var(--muted); text-decoration: none; font-size: .92rem; margin-bottom: 4px; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(59,130,246,.12); color: #fff; }
        .sidebar-divider { border-top: 1px solid var(--border); margin: 18px 0; }
        .main { margin-left: var(--sidebar-w); padding: 88px 28px 28px; }
        .page-title { font-size: 1.45rem; font-weight: 800; margin-bottom: 4px; }
        .page-sub { color: var(--muted); font-size: .92rem; }
        .stat-card, .table-card, .content-card { background: rgba(19,22,30,.94); border: 1px solid var(--border); border-radius: 14px; box-shadow: 0 18px 40px rgba(0,0,0,.14); }
        .stat-card { padding: 22px; }
        .stat-card .icon { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.15rem; margin-bottom: 14px; }
        .stat-card .value { font-size: 1.8rem; font-weight: 850; }
        .stat-card .label { color: var(--muted); font-size: .86rem; }
        .stat-card .change { font-size: .78rem; margin-top: 8px; }
        .table-card { overflow: hidden; }
        .table-header { padding: 18px 22px; border-bottom: 1px solid var(--border); display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px; }
        .table-header h6 { margin: 0; font-weight: 800; }
        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table th { padding: 12px 16px; font-size: .74rem; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); border-bottom: 1px solid var(--border); background: var(--surface2); }
        .custom-table td { padding: 14px 16px; font-size: .9rem; border-bottom: 1px solid var(--border); vertical-align: middle; }
        .custom-table tr:last-child td { border-bottom: none; }
        .custom-table tr:hover td { background: rgba(26,30,41,.7); }
        .badge-status { display: inline-block; border-radius: 99px; padding: 4px 11px; font-size: .75rem; font-weight: 700; white-space: nowrap; }
        .badge-active { background: rgba(52,211,153,.12); color: #34d399; border: 1px solid rgba(52,211,153,.25); }
        .badge-inactive { background: rgba(248,113,113,.12); color: #f87171; border: 1px solid rgba(248,113,113,.25); }
        .badge-pending { background: rgba(250,204,21,.12); color: #facc15; border: 1px solid rgba(250,204,21,.25); }
        .btn-primary-sm { background: var(--primary); color: #fff; border: none; border-radius: 9px; padding: 8px 14px; font-size: .85rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
        .btn-primary-sm:hover { background: var(--primary-dark); color: #fff; }
        .btn-secondary-sm { background: var(--surface2); color: var(--text); border: 1px solid var(--border); border-radius: 9px; padding: 8px 14px; font-size: .85rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
        .btn-icon { background: transparent; border: 1px solid var(--border); color: var(--muted); border-radius: 7px; width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; }
        .btn-icon:hover { border-color: var(--primary); color: var(--primary); }
        .btn-icon.danger:hover { border-color: #f87171; color: #f87171; }
        .form-control, .form-select, textarea.form-control { background: var(--surface2); border: 1px solid var(--border); color: var(--text); border-radius: 9px; }
        .form-control:focus, .form-select:focus { background: var(--surface2); border-color: var(--primary); color: var(--text); box-shadow: 0 0 0 3px rgba(59,130,246,.16); }
        .form-control::placeholder { color: #596276; }
        .form-select option { background: var(--surface2); color: var(--text); }
        .form-label { color: #a1a9bb; font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; }
        .alert-success-custom { background: rgba(52,211,153,.1); border: 1px solid rgba(52,211,153,.25); color: #34d399; border-radius: 10px; padding: 12px 16px; }
        .alert-error-custom { background: rgba(248,113,113,.1); border: 1px solid rgba(248,113,113,.25); color: #f87171; border-radius: 10px; padding: 12px 16px; }
        .muted { color: var(--muted); }
        .detail-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
        .detail-item { background: var(--surface2); border: 1px solid var(--border); border-radius: 10px; padding: 14px; }
        .detail-label { color: var(--muted); font-size: .76rem; text-transform: uppercase; letter-spacing: .07em; margin-bottom: 6px; }
        .detail-value { font-weight: 700; }
        .pagination .page-link { background: var(--surface); border-color: var(--border); color: var(--text); }
        .pagination .active .page-link { background: var(--primary); border-color: var(--primary); }
        @media (max-width: 900px) { .sidebar { display: none; } .main { margin-left: 0; padding: 82px 16px 24px; } .detail-grid { grid-template-columns: 1fr; } }
    </style>
    @stack('styles')
</head>
<body>
<div class="topbar">
    <a class="topbar-brand" href="{{ route('landing') }}">
        <div class="brand-icon"><i class="bi bi-clipboard2-check"></i></div>
        <span class="brand-name">SistemaGestorPro</span>
    </a>
    <div class="topbar-right">
        <div class="user-pill">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <span>{{ Auth::user()->name }}</span>
            @php
                // Tradução visual apenas para o front-end.
                $currentRole = strtolower(trim(Auth::user()->role ?? ''));
                $roleLabels = [
                    'admin' => 'Administrador',
                    'company' => 'Empresa',
                    'supplier' => 'Fornecedor',
                ];
            @endphp
            <span class="badge-status {{ $currentRole === 'admin' ? 'badge-pending' : 'badge-active' }}">
                {{ $roleLabels[$currentRole] ?? Auth::user()->role }}
            </span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i>Sair</button>
        </form>
    </div>
</div>

<aside class="sidebar">
    <div class="sidebar-section">
        <div class="sidebar-section-label">Menu</div>

        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a href="{{ route('suppliers.index') }}" class="sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}"><i class="bi bi-people-fill"></i> Fornecedores</a>
            <a href="{{ route('documents.index') }}" class="sidebar-link {{ request()->routeIs('documents.*') ? 'active' : '' }}"><i class="bi bi-file-earmark-text-fill"></i> Documentos</a>
            <a href="{{ route('analyses.index') }}" class="sidebar-link {{ request()->routeIs('analyses.*') ? 'active' : '' }}"><i class="bi bi-graph-up-arrow"></i> Avaliações</a>
            <a href="{{ route('companies.index') }}" class="sidebar-link {{ request()->routeIs('companies.*') ? 'active' : '' }}"><i class="bi bi-buildings-fill"></i> Empresas</a>
        @elseif(Auth::user()->role === 'company')
            <a href="{{ route('company.dashboard') }}" class="sidebar-link {{ request()->routeIs('company.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a href="{{ route('company.suppliers.index') }}" class="sidebar-link {{ request()->routeIs('company.suppliers.*') ? 'active' : '' }}"><i class="bi bi-people-fill"></i> Fornecedores</a>
            <a href="{{ route('documents.index') }}" class="sidebar-link {{ request()->routeIs('documents.*') ? 'active' : '' }}"><i class="bi bi-file-earmark-text-fill"></i> Documentos</a>
            <a href="{{ route('company.analyses') }}" class="sidebar-link {{ request()->routeIs('company.analyses') || request()->routeIs('analyses.*') ? 'active' : '' }}"><i class="bi bi-graph-up-arrow"></i> Avaliações</a>
        @else
            <a href="{{ route('supplier.dashboard') }}" class="sidebar-link {{ request()->routeIs('supplier.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a href="{{ route('documents.index') }}" class="sidebar-link {{ request()->routeIs('documents.*') ? 'active' : '' }}"><i class="bi bi-file-earmark-arrow-up-fill"></i> Meus Documentos</a>
            <a href="{{ route('documents.create') }}" class="sidebar-link {{ request()->routeIs('documents.create') ? 'active' : '' }}"><i class="bi bi-cloud-upload-fill"></i> Enviar Documento</a>
        @endif
    </div>

    @if(Auth::user()->role === 'admin')
        <div class="sidebar-divider"></div>
        <div class="sidebar-section">
            <div class="sidebar-section-label">Administrativo</div>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="bi bi-person-lines-fill"></i> Gestão de Usuários</a>
            <a href="{{ route('admin.logs.index') }}" class="sidebar-link {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}"><i class="bi bi-clock-history"></i> Histórico / Logs</a>
        </div>
    @endif
</aside>

<main class="main">
    @if(session('success'))
        <div class="alert-success-custom mb-4"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error-custom mb-4"><i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error-custom mb-4">
            <strong>Verifique os campos:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
