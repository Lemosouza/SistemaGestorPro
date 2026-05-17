<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Admin</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #0d0f14; color: #e8eaf0; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { background: #13161e; border: 1px solid #252a38; border-radius: 12px; padding: 40px; text-align: center; max-width: 400px; width: 100%; }
        .badge { display: inline-block; background: rgba(234,179,8,.15); color: #eab308; border: 1px solid rgba(234,179,8,.3); border-radius: 99px; padding: 4px 14px; font-size: .8rem; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 20px; }
        h1 { font-size: 1.5rem; margin-bottom: 8px; }
        p { color: #6b7590; margin-bottom: 32px; }
        form button { background: #3b82f6; color: #fff; border: none; border-radius: 8px; padding: 10px 24px; cursor: pointer; font-size: .9rem; }
        form button:hover { opacity: .85; }
    </style>
</head>
<body>
    <div class="card">
        <div class="badge">Admin</div>
        <h1>Olá, {{ Auth::user()->name }}!</h1>
        <p>Você está logado como <strong>administrador</strong>.<br/>O dashboard completo está em construção.</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Sair</button>
        </form>
    </div>
</body>
</html>