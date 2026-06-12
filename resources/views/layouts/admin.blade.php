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
            --muted: #6b7590;
            --sidebar-w: 260px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--dark); color: var(--text); font-family: 'Segoe UI', sans-serif; display: flex; flex-direction: column; min-height: 100vh; }

        /* TOPBAR */
        .topbar { height: 60px; background: var(--surface); border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 24px; position: fixed; top: 0; left: 0; right: 0; z-index: 200; }
        .topbar-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 32px; height: 32px; background: linear-gradient(135deg, var(--primary), #06b6d4); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: .9rem; flex-shrink: 0; }
        .brand-name { font-weight: 700; font-size: 1rem; color: var(--text); }
        .topbar-right { display: flex; align-items: center; gap: 16px; }
        .user-pill { display: flex; align-items: center; gap: 8px; background: var(--surface2); border: 1px solid var(--border); border-radius: 99px; padding: 6px 14px; font-size: .85rem; }
        .user-avatar { width: 28px; height: 28px; background: linear-gradient(135deg, var(--primary), #06b6d4); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: .75rem; font-weight: 700; }
        .btn-logout { background: none; border: 1px solid var(--border); color: var(--muted); border-radius: 8px; padding: 6px 14px; font-size: .82rem; cursor: pointer; transition: border-color .2s, color .2s; }
        .btn-logout:hover { border-color: #f87171; color: #f87171; }

        /* SIDEBAR */
        .sidebar { width: var(--sidebar-w); background: var(--surface); border-right: 1px solid var(--border); position: fixed; top: 60px; left: 0; bottom: 0; overflow-y: auto; padding: 20px 0; z-index: 100; }
        .sidebar-section { padding: 0 16px; margin-bottom: 8px; }
        .sidebar-section-label { font-size: .7rem; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: var(--muted); padding: 8px 12px 4px; }
        .sidebar-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 8px; text-decoration: none; color: var(--muted); font-size: .88rem; transition: background .2s, color .2s; }
        .sidebar-link:hover { background: var(--surface2); color: var(--text); }
        .sidebar-link.active { background: rgba(59,130,246,.12); color: var(--primary); border: 1px solid rgba(59,130,246,.2); }
        .sidebar-link i { font-size: 1rem; width: 18px; text-align: center; }
        .sidebar-divider { height: 1px; background: var(--border); margin: 12px 16px; }

        /* MAIN */
        .main { margin-left: var(--sidebar-w); margin-top: 60px; flex: 1; padding: 32px; }

        /* CARDS */
        .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: 12px; padding: 24px; }
        .stat-card .icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 16px; }
        .stat-card .value { font-size: 1.8rem; font-weight: 800; }
        .stat-card .label { color: var(--muted); font-size: .85rem; margin-top: 4px; }
        .stat-card .change { font-size: .78rem; margin-top: 8px; }

        /* TABLE */
        .table-card { background: var(--surface); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
        .table-card .table-header { padding: 20px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .table-card .table-header h6 { margin: 0; font-weight: 700; }
        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table th { padding: 12px 16px; font-size: .75rem; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); border-bottom: 1px solid var(--border); font-weight: 600; background: var(--surface2); }
        .custom-table td { padding: 14px 16px; font-size: .88rem; border-bottom: 1px solid var(--border); vertical-align: middle; }
        .custom-table tr:last-child td { border-bottom: none; }
        .custom-table tr:hover td { background: var(--surface2); }
        .badge-status { display: inline-block; border-radius: 99px; padding: 3px 12px; font-size: .75rem; font-weight: 600; }
        .badge-active { background: rgba(52,211,153,.12); color: #34d399; border: 1px solid rgba(52,211,153,.25); }
        .badge-inactive { background: rgba(248,113,113,.12); color: #f87171; border: 1px solid rgba(248,113,113,.25); }
        .badge-pending { background: rgba(250,204,21,.12); color: #facc15; border: 1px solid rgba(250,204,21,.25); }
        .btn-icon { background: none; border: 1px solid var(--border); color: var(--muted); border-radius: 6px; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: all .2s; text-decoration: none; }
        .btn-icon:hover { border-color: var(--primary); color: var(--primary); }
        .btn-icon.danger:hover { border-color: #f87171; color: #f87171; }
        .btn-primary-sm { background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: 8px 16px; font-size: .85rem; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: background .2s; }
        .btn-primary-sm:hover { background: var(--primary-dark); color: #fff; }
        .page-title { font-size: 1.3rem; font-weight: 800; margin-bottom: 4px; }
        .page-sub { color: var(--muted); font-size: .88rem; }

        /* MODAL */
        .modal-content { background: var(--surface); border: 1px solid var(--border); border-radius: 14px; color: var(--text); }
        .modal-header { border-bottom: 1px solid var(--border); }
        .modal-footer { border-top: 1px solid var(--border); }
        .btn-close { filter: invert(1); }
        .form-control, .form-select { background: var(--surface2); border: 1px solid var(--border); color: var(--text); border-radius: 8px; }
        .form-control:focus, .form-select:focus { background: var(--surface2); border-color: var(--primary); color: var(--text); box-shadow: 0 0 0 3px rgba(59,130,246,.2); }
        .form-control::placeholder { color: var(--muted); }
        .form-label { font-size: .8rem; font-weight: 600; text-transform: uppercase; letter-spacing: .06em; color: #9aa3bb; margin-bottom: 6px; }
        label { color: #9aa3bb; }
        .form-select option { background: var(--surface2); }

        /* ALERT */
        .alert-success-custom { background: rgba(52,211,153,.1); border: 1px solid rgba(52,211,153,.25); color: #34d399; border-radius: 8px; padding: 12px 16px; font-size: .88rem; }
        .alert-error-custom { background: rgba(248,113,113,.1); border: 1px solid rgba(248,113,113,.25); color: #f87171; border-radius: 8px; padding: 12px 16px; font-size: .88rem; }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 20px; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <a class="topbar-brand" href="{{ route('landing') }}">
        <div class="brand-icon"><i class="bi bi-clipboard2-check"></i></div>
        <span class="brand-name">SistemaGestorPro</span>
    </a>
    <div class="topbar-right">
        <div class="user-pill">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <span>{{ Auth::user()->name }}</span>
            @if(Auth::user()->role === 'admin')
                <span style="background:rgba(234,179,8,.15);color:#eab308;border:1px solid rgba(234,179,8,.3);border-radius:99px;padding:2px 8px;font-size:.7rem;">Admin</span>
            @elseif(Auth::user()->role === 'company')
                <span style="background:rgba(59,130,246,.15);color:#3b82f6;border:1px solid rgba(59,130,246,.3);border-radius:99px;padding:2px 8px;font-size:.7rem;">Empresa</span>
            @else
                <span style="background:rgba(52,211,153,.15);color:#34d399;border:1px solid rgba(52,211,153,.3);border-radius:99px;padding:2px 8px;font-size:.7rem;">Fornecedor</span>
            @endif
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i>Sair</button>
        </form>
    </div>
</div>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-section">
        <div class="sidebar-section-label">Menu</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="{{ route('suppliers.index') }}" class="sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Fornecedores
        </a>
        <a href="{{ route('documents.index') }}" class="sidebar-link {{ request()->routeIs('documents.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text-fill"></i> Documentos
        </a>
        <a href="{{ route('analyses.index') }}" class="sidebar-link {{ request()->routeIs('analyses.*') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i> Análises
        </a>
    </div>

    @if(Auth::user()->role === 'admin')
    <div class="sidebar-divider"></div>
    <div class="sidebar-section">
        <div class="sidebar-section-label">Administrativo</div>
        <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="bi bi-person-lines-fill"></i> Listagem de Usuários
        </a>
        <a href="{{ route('admin.users.create') }}" class="sidebar-link {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
            <i class="bi bi-person-plus-fill"></i> Criar Usuário
        </a>
    </div>
    @endif
</aside>

<!-- MAIN -->
<main class="main">
    @if(session('success'))
        <div class="alert-success-custom mb-4">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert-error-custom mb-4">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>