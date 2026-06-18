<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Entrar — SistemaGestorPro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

    <style>
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

        .page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 480px;
        }

        /* ── Left Panel ── */
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

        .features { display: flex; flex-direction: column; gap: 14px; }

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

        /* ── Right Panel ── */
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
            animation: fadeUp .5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
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

        /* ── Alerts ── */
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

        /* ── Fields ── */
        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            font-size: .8rem;
            font-weight: 500;
            color: #9aa3bb;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 7px;
        }

        .input-wrap { position: relative; }

        .input-wrap > svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: var(--text-muted);
            pointer-events: none;
            transition: color .2s;
        }

        .input-wrap:focus-within > svg { color: var(--accent); }

        input {
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
        }

        input::placeholder { color: var(--text-muted); opacity: .7; }

        input:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .is-invalid { border-color: var(--error) !important; }
        .is-invalid:focus { box-shadow: 0 0 0 3px rgba(248,113,113,.2) !important; }

        .field-error {
            font-size: .78rem;
            color: var(--error);
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

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

        /* ── Remember + Forgot ── */
        .form-extras {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: .85rem;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-muted);
        }

        .remember input[type="checkbox"] {
            width: 16px; height: 16px;
            padding: 0;
            accent-color: var(--accent);
            cursor: pointer;
        }

        .forgot {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot:hover { text-decoration: underline; }

        /* ── Submit ── */
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
            position: relative;
        }

        .btn-submit:hover {
            opacity: .92;
            transform: translateY(-1px);
            box-shadow: 0 6px 28px rgba(59,130,246,.45);
        }

        .btn-submit:active { transform: translateY(0); }

        .btn-submit.loading { pointer-events: none; opacity: .7; }

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

        @media (max-width: 860px) {
            .page { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 32px 24px; min-height: 100vh; }
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
            <h1>Bem-vindo<br/>de <span>volta.</span></h1>
            <p>Acesse sua conta e continue gerenciando fornecedores, documentos e análises com total controle.</p>

            <div class="features">
                <div class="feature">
                    <div class="feature-dot"></div>
                    Controle de acesso por perfil
                </div>
                <div class="feature">
                    <div class="feature-dot"></div>
                    Gestão completa de documentos
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
                <h2>Entrar</h2>
                <p>Não tem conta? <a href="{{ route('register') }}">Criar conta</a></p>
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
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" id="loginForm" novalidate>
                @csrf

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
                            placeholder="Sua senha"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                            autocomplete="current-password"
                            required
                        />
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <button type="button" class="toggle-pw" aria-label="Mostrar/ocultar senha" onclick="togglePassword()">
                            <svg id="eye-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-extras">
                    <label class="remember">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                        Lembrar de mim
                    </label>

                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-text">Entrar</span>
                    <div class="spinner"></div>
                </button>

            </form>
        </div>
    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eye-icon');
        const show  = input.type === 'password';
        input.type  = show ? 'text' : 'password';
        icon.style.opacity = show ? '.5' : '1';
    }

    document.getElementById('loginForm').addEventListener('submit', function () {
        document.getElementById('submitBtn').classList.add('loading');
    });
</script>

</body>
</html>
