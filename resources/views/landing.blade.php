<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SistemaGestorPro — Gestão de Fornecedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --bg:#0d0f14; --surface:#13161e; --surface2:#1a1e29; --border:#252a38; --text:#e8eaf0; --muted:#8b93a8; --primary:#3b82f6; --cyan:#06b6d4; --green:#34d399; }
        * { box-sizing: border-box; margin:0; padding:0; }
        body { font-family: Inter, Segoe UI, Arial, sans-serif; background: radial-gradient(circle at top left, rgba(59,130,246,.18), transparent 35%), radial-gradient(circle at bottom right, rgba(6,182,212,.12), transparent 35%), var(--bg); color: var(--text); min-height:100vh; }
        .nav { display:flex; align-items:center; justify-content:space-between; padding:28px 7%; }
        .brand { display:flex; align-items:center; gap:12px; font-weight:800; font-size:1.1rem; }
        .brand-icon { width:38px; height:38px; border-radius:12px; display:grid; place-items:center; background:linear-gradient(135deg,var(--primary),var(--cyan)); }
        .nav a { color:var(--text); text-decoration:none; }
        .btn { display:inline-flex; align-items:center; gap:8px; padding:12px 18px; border-radius:12px; border:1px solid var(--border); text-decoration:none; font-weight:700; }
        .btn-primary { background:linear-gradient(135deg,var(--primary),var(--cyan)); color:#fff; border:0; box-shadow:0 18px 40px rgba(59,130,246,.22); }
        .btn-secondary { color:var(--text); background:rgba(19,22,30,.72); }
        .hero { display:grid; grid-template-columns:1.08fr .92fr; gap:46px; padding:70px 7% 40px; align-items:center; }
        .eyebrow { display:inline-flex; gap:8px; align-items:center; padding:8px 12px; border:1px solid rgba(59,130,246,.25); background:rgba(59,130,246,.09); color:#9ec1ff; border-radius:99px; font-size:.86rem; margin-bottom:22px; }
        h1 { font-size:clamp(2.4rem,5vw,5rem); line-height:1.02; letter-spacing:-.06em; margin-bottom:22px; }
        h1 span { background:linear-gradient(90deg,var(--primary),var(--cyan)); -webkit-background-clip:text; color:transparent; }
        .lead { color:var(--muted); font-size:1.12rem; max-width:720px; line-height:1.75; margin-bottom:28px; }
        .hero-actions { display:flex; gap:14px; flex-wrap:wrap; }
        .panel { background:rgba(19,22,30,.78); border:1px solid var(--border); border-radius:24px; padding:26px; box-shadow:0 28px 80px rgba(0,0,0,.28); }
        .panel-title { display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; }
        .mini-card { background:var(--surface2); border:1px solid var(--border); border-radius:16px; padding:16px; margin-bottom:14px; display:flex; align-items:center; justify-content:space-between; gap:16px; }
        .mini-card i { color:var(--primary); font-size:1.25rem; }
        .mini-card strong { display:block; margin-bottom:3px; }
        .mini-card small { color:var(--muted); }
        .status { padding:5px 10px; border-radius:99px; font-size:.75rem; font-weight:800; }
        .ok { background:rgba(52,211,153,.12); color:var(--green); border:1px solid rgba(52,211,153,.24); }
        .warn { background:rgba(250,204,21,.12); color:#facc15; border:1px solid rgba(250,204,21,.24); }
        .bad { background:rgba(248,113,113,.12); color:#f87171; border:1px solid rgba(248,113,113,.24); }
        .section { padding:48px 7% 70px; }
        .section h2 { font-size:2rem; margin-bottom:10px; }
        .section p { color:var(--muted); max-width:760px; line-height:1.7; }
        .features { display:grid; grid-template-columns:repeat(4,1fr); gap:18px; margin-top:28px; }
        .feature { background:rgba(19,22,30,.76); border:1px solid var(--border); border-radius:18px; padding:22px; }
        .feature i { color:var(--cyan); font-size:1.6rem; margin-bottom:14px; display:block; }
        .feature strong { display:block; margin-bottom:8px; }
        .feature span { color:var(--muted); font-size:.92rem; line-height:1.55; }
        @media (max-width: 900px) { .hero { grid-template-columns:1fr; padding-top:30px; } .features { grid-template-columns:1fr 1fr; } }
        @media (max-width: 600px) { .features { grid-template-columns:1fr; } .nav { padding:20px; } .hero,.section { padding-left:20px; padding-right:20px; } }
    </style>
</head>
<body>
    <nav class="nav">
        <div class="brand"><div class="brand-icon"><i class="bi bi-clipboard2-check"></i></div>SistemaGestorPro</div>
        <a href="{{ route('login') }}" class="btn btn-secondary"><i class="bi bi-box-arrow-in-right"></i> Entrar</a>
    </nav>

    <section class="hero">
        <div>
            <div class="eyebrow"><i class="bi bi-stars"></i> Plataforma para gestão, avaliação e regularidade documental</div>
            <h1>Transforme a gestão de fornecedores em um processo <span>simples e seguro</span>.</h1>
            <p class="lead">A Landing Page é o primeiro contato com o sistema e foi criada para vender a ideia do software: centralizar documentos, reduzir riscos, acompanhar vencimentos e facilitar a avaliação de fornecedores por empresas e administradores.</p>
            <div class="hero-actions">
                <a href="{{ route('login') }}" class="btn btn-primary"><i class="bi bi-rocket-takeoff"></i> Acessar o sistema</a>
                <a href="{{ route('register') }}" class="btn btn-secondary"><i class="bi bi-person-plus"></i> Criar conta</a>
            </div>
        </div>
        <div class="panel">
            <div class="panel-title"><strong>Visão documental</strong><span class="status ok">Online</span></div>
            <div class="mini-card"><div><i class="bi bi-file-earmark-check"></i><strong>Certidões regulares</strong><small>Documentos válidos e aprovados.</small></div><span class="status ok">Válido</span></div>
            <div class="mini-card"><div><i class="bi bi-clock-history"></i><strong>Alerta de vencimento</strong><small>Avisos para documentos próximos do prazo.</small></div><span class="status warn">Atenção</span></div>
            <div class="mini-card"><div><i class="bi bi-shield-exclamation"></i><strong>Fornecedor irregular</strong><small>Indicação automática quando há pendências.</small></div><span class="status bad">Irregular</span></div>
        </div>
    </section>

    <section class="section">
        <h2>Funcionalidades que prendem a atenção do usuário</h2>
        <p>O sistema elimina distrações e foca no que importa: fornecedores, documentos, avaliações, alertas, permissões e histórico de alterações.</p>
        <div class="features">
            <div class="feature"><i class="bi bi-speedometer2"></i><strong>Dashboard gerencial</strong><span>Cards, indicadores e lista de alertas para documentos vencidos ou próximos do vencimento.</span></div>
            <div class="feature"><i class="bi bi-people"></i><strong>Fornecedores</strong><span>Lista com busca, categoria, CNPJ/CPF, status e ações de visualizar, editar e excluir.</span></div>
            <div class="feature"><i class="bi bi-cloud-upload"></i><strong>Upload de documentos</strong><span>Fornecedor envia arquivos, informa validade e acompanha status documental.</span></div>
            <div class="feature"><i class="bi bi-person-gear"></i><strong>Área administrativa</strong><span>Gestão de usuários, permissões, avaliações, documentos e logs do sistema.</span></div>
        </div>
    </section>
</body>
</html>
