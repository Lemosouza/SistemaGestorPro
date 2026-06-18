<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Criar Conta — SistemaGestorPro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

    <style>
        /* ── Reset & Variables ─────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:          #0d0f14;
            --surface:     #13161e;
            --surface-2:   #1a1e29;
            --border:      #252a38;
            --border-focus:#3b82f6;
            --accent:      #3b82f6;
            --accent-glow: rgba(59,130,246,.35);
            --accent-2:    #06b6d4;
            --text:        #e8eaf0;
            --text-muted:  #6b7590;
            --error:       #f87171;
            --success:     #34d399;
            --radius:      12px;
            --radius-sm:   8px;
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        /* ── Layout ────────────────────────────────────────── */
        .page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 480px;
        }

        /* ── Left Panel ────────────────────────────────────── */
        .panel-left {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 56px;
            background: linear-gradient(135deg, #0d0f14 0%, #0f1726 60%, #0a1628 100%);
        }

        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 60% at 20% 80%, rgba(59,130,246,.18) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 80% 20%, rgba(6,182,212,.12) 0%, transparent 60%);
        }

        .grid-lines {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(59,130,246,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .panel-left-content { position: relative; z-index: 1; }

        .brand {
            position: absolute;
            top: 56px; left: 56px;
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1;
        }

        .brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .brand-icon svg { width: 22px; height: 22px; color: #fff; }

        .brand-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: -.02em;
        }

        .panel-left h1 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(2rem, 3vw, 2.8rem);
            line-height: 1.15;
            letter-spacing: -.03em;
            margin-bottom: 20px;
        }

        .panel-left h1 span {
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .panel-left p {
            color: var(--text-muted);
            font-size: .95rem;
            max-width: 360px;
            margin-bottom: 40px;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: .9rem;
            color: #8b92a8;
        }

        .feature-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            flex-shrink: 0;
        }

        /* ── Right Panel (form) ─────────────────────────────── */
        .panel-right {
            background: var(--surface);
            border-left: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 48px;
        }

        .form-container {
            width: 100%;
            max-width: 360px;
        }

        .form-header { margin-bottom: 32px; }

        .form-header h2 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -.025em;
            margin-bottom: 6px;
        }

        .form-header p {
            color: var(--text-muted);
            font-size: .875rem;
        }

        .form-header p a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .form-header p a:hover { text-decoration: underline; }

        /* ── Alert Messages ────────────────────────────────── */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: .875rem;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-success {
            background: rgba(52,211,153,.1);
            border: 1px solid rgba(52,211,153,.25);
            color: var(--success);
        }

        .alert-error {
            background: rgba(248,113,113,.1);
            border: 1px solid rgba(248,113,113,.25);
            color: var(--error);
        }

        /* ── Form Fields ───────────────────────────────────── */
        .form-group { margin-bottom: 18px; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 18px;
        }

        .form-row .form-group { margin-bottom: 0; }

        label {
            display: block;
            font-size: .8rem;
            font-weight: 500;
            color: #9aa3bb;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: var(--text-muted);
            pointer-events: none;
            transition: color .2s;
        }

        input, select {
            width: 100%;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 11px 14px 11px 40px;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            color: var(--text);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
            appearance: none;
        }

        select { cursor: pointer; }

        input::placeholder { color: var(--text-muted); opacity: .7; }

        input:focus, select:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        input:focus + svg, select:focus + svg,
        .input-wrap:focus-within svg {
            color: var(--accent);
        }

        .is-invalid {
            border-color: var(--error) !important;
        }

        .is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(248,113,113,.2) !important;
        }

        .field-error {
            font-size: .78rem;
            color: var(--error);
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Password toggle */
        .toggle-pw {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            color: var(--text-muted);
            transition: color .2s;
        }

        .toggle-pw:hover { color: var(--text); }
        .toggle-pw svg { width: 16px; height: 16px; display: block; }

        /* Password strength */
        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 8px;
        }

        .strength-seg {
            flex: 1;
            height: 3px;
            border-radius: 99px;
            background: var(--border);
            transition: background .3s;
        }

        .strength-label {
            font-size: .75rem;
            color: var(--text-muted);
            margin-top: 5px;
        }

        /* Role selector */
        .role-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .role-option { position: relative; }

        .role-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0; height: 0;
        }

        .role-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 14px 10px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: border-color .2s, background .2s, box-shadow .2s;
            text-align: center;
        }

        .role-label svg {
            width: 22px; height: 22px;
            color: var(--text-muted);
            transition: color .2s;
        }

        .role-label span {
            font-size: .78rem;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .05em;
            transition: color .2s;
        }

        .role-option input:checked + .role-label {
            border-color: var(--accent);
            background: rgba(59,130,246,.08);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .role-option input:checked + .role-label svg,
        .role-option input:checked + .role-label span {
            color: var(--accent);
        }

        .role-option input[type="radio"]:focus + .role-label {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        /* ── Submit Button ──────────────────────────────────── */
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--accent), #2563eb);
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-weight: 600;
            font-size: .95rem;
            letter-spacing: .01em;
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: opacity .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 20px rgba(59,130,246,.3);
            margin-top: 8px;
            position: relative;
            overflow: hidden;
        }

        .btn-submit:hover {
            opacity: .92;
            transform: translateY(-1px);
            box-shadow: 0 6px 28px rgba(59,130,246,.45);
        }

        .btn-submit:active { transform: translateY(0); }

        .btn-submit.loading {
            pointer-events: none;
            opacity: .7;
        }

        .spinner {
            display: none;
            width: 18px; height: 18px;
            border: 2px solid rgba(255,255,255,.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
            margin: 0 auto;
        }

        .btn-submit.loading .btn-text { display: none; }
        .btn-submit.loading .spinner  { display: block; }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Divider ────────────────────────────────────────── */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
            color: var(--text-muted);
            font-size: .8rem;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── Section label ──────────────────────────────────── */
        .section-label {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        /* ── Responsive ─────────────────────────────────────── */
        @media (max-width: 860px) {
            .page { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 32px 24px; min-height: 100vh; }
        }

        /* ── Fade-in animation ──────────────────────────────── */
        .form-container {
            animation: fadeUp .5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="page">

    
    <div class="panel-left">
        <div class="grid-lines"></div>

        <div class="brand">
            <div class="brand-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12h3.75M9 15h3.75M9 18h3.75m3-9H9m6 9v-3.375c0-.621-.503-1.125-1.125-1.125H6.375A1.125 1.125 0 005.25 13.5V18a2.25 2.25 0 002.25 2.25h9A2.25 2.25 0 0019.5 18v-4.5A1.125 1.125 0 0018.375 12.375H15" />
                </svg>
            </div>
            <span class="brand-name">SistemaGestorPro</span>
        </div>

        <div class="panel-left-content">
            <h1>Gestão<br/>inteligente,<br/><span>resultado real.</span></h1>
            <p>Centralize fornecedores, documentos e análises em uma única plataforma segura e colaborativa.</p>

            <div class="features">
                <div class="feature">
                    <div class="feature-dot"></div>
                    Controle de acesso por perfil (admin, empresa, fornecedor)
                </div>
                <div class="feature">
                    <div class="feature-dot"></div>
                    Gestão completa de documentos e análises
                </div>
                <div class="feature">
                    <div class="feature-dot"></div>
                    Dashboard em tempo real
                </div>
            </div>
        </div>
    </div>

    
    <div class="panel-right">
        <div class="form-container">

            <div class="form-header">
                <h2>Criar conta</h2>
                <p>Já tem uma conta? <a href="{{ route('login') }}">Entrar</a></p>
            </div>

            
            @if(session('success'))
                <div class="alert alert-success">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z"/></svg>
                    <div>Corrija os campos destacados abaixo.</div>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" id="registerForm" novalidate>
                @csrf

                
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <div class="input-wrap">
                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Seu nome"
                                value="{{ old('name') }}"
                                class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                                autocomplete="name"
                                required
                            />
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        @error('name')
                            <div class="field-error">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefone <span style="color:var(--text-muted);font-weight:400">(opcional)</span></label>
                        <div class="input-wrap">
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                placeholder="(11) 99999-9999"
                                value="{{ old('phone') }}"
                                class="{{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                autocomplete="tel"
                            />
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        @error('phone')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-wrap">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="voce@empresa.com.br"
                            value="{{ old('email') }}"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                            autocomplete="email"
                            required
                        />
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    @error('email')
                        <div class="field-error">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="password">Senha</label>
                    <div class="input-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Mínimo 8 caracteres"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                            autocomplete="new-password"
                            required
                        />
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <button type="button" class="toggle-pw" aria-label="Mostrar/ocultar senha" onclick="togglePassword('password', this)">
                            <svg id="eye-password" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                    <div class="strength-bar" id="strengthBar">
                        <div class="strength-seg" id="seg1"></div>
                        <div class="strength-seg" id="seg2"></div>
                        <div class="strength-seg" id="seg3"></div>
                        <div class="strength-seg" id="seg4"></div>
                    </div>
                    <div class="strength-label" id="strengthLabel">Digite uma senha</div>
                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="password_confirmation">Confirmar senha</label>
                    <div class="input-wrap">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Repita a senha"
                            autocomplete="new-password"
                            required
                        />
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <button type="button" class="toggle-pw" aria-label="Mostrar/ocultar confirmação" onclick="togglePassword('password_confirmation', this)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>

                
                <div style="margin-bottom: 24px;">
                    <div class="section-label">Perfil de acesso</div>
                    <div class="role-grid">

                        <label class="role-option">
                            <input type="radio" name="role" value="admin" {{ old('role') === 'admin' ? 'checked' : '' }} />
                            <div class="role-label">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Admin</span>
                            </div>
                        </label>

                        <label class="role-option">
                            <input type="radio" name="role" value="company" {{ old('role', 'company') === 'company' ? 'checked' : '' }} />
                            <div class="role-label">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Empresa</span>
                            </div>
                        </label>

                        <label class="role-option">
                            <input type="radio" name="role" value="supplier" {{ old('role') === 'supplier' ? 'checked' : '' }} />
                            <div class="role-label">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                <span>Fornecedor</span>
                            </div>
                        </label>

                    </div>
                    @error('role')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-text">Criar conta</span>
                    <div class="spinner"></div>
                </button>

            </form>
        </div>
    </div>

</div>

<script>
    // ── Toggle senha ─────────────────────────────────────────
    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        btn.querySelector('svg').style.opacity = isHidden ? '.5' : '1';
    }

    // ── Força da senha ───────────────────────────────────────
    const pwInput   = document.getElementById('password');
    const segs      = [document.getElementById('seg1'), document.getElementById('seg2'),
                       document.getElementById('seg3'), document.getElementById('seg4')];
    const label     = document.getElementById('strengthLabel');
    const colors    = ['#f87171', '#fb923c', '#facc15', '#34d399'];
    const labels    = ['Senha fraca', 'Razoável', 'Boa senha', 'Senha forte'];

    function calcStrength(pw) {
        let score = 0;
        if (pw.length >= 8)              score++;
        if (/[A-Z]/.test(pw))            score++;
        if (/[0-9]/.test(pw))            score++;
        if (/[^A-Za-z0-9]/.test(pw))     score++;
        return score;
    }

    pwInput.addEventListener('input', () => {
        const score = pwInput.value.length ? calcStrength(pwInput.value) : 0;
        segs.forEach((s, i) => {
            s.style.background = i < score ? colors[score - 1] : 'var(--border)';
        });
        label.textContent = pwInput.value.length ? labels[score - 1] ?? labels[0] : 'Digite uma senha';
        label.style.color  = pwInput.value.length ? colors[score - 1] : 'var(--text-muted)';
    });

    // ── Máscara de telefone ──────────────────────────────────
    document.getElementById('phone').addEventListener('input', function () {
        let v = this.value.replace(/\D/g, '').slice(0, 11);
        if (v.length > 6)      v = '(' + v.slice(0,2) + ') ' + v.slice(2,7) + '-' + v.slice(7);
        else if (v.length > 2) v = '(' + v.slice(0,2) + ') ' + v.slice(2);
        this.value = v;
    });

    // ── Loading no submit ────────────────────────────────────
    document.getElementById('registerForm').addEventListener('submit', function () {
        document.getElementById('submitBtn').classList.add('loading');
    });
</script>

</body>
</html>