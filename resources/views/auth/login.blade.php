<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #0f172a; display: flex; align-items: center; justify-content: center; height: 100vh; font-family: 'Segoe UI', sans-serif; margin: 0; }
        .login-card { background: white; border-radius: 20px; width: 400px; padding: 40px; box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
        .btn-accent { background: var(--accent); color: white; border: none; width: 100%; padding: 12px; border-radius: 10px; font-weight: 600; transition: background 0.2s; }
        .btn-accent:hover { background: #0b7a70; color: white; }
        .text-accent { color: var(--accent); }
        .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 0.25rem rgba(13, 148, 136, 0.15); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-dark">Eureka<span class="text-accent"> RH.</span></h4>
            <p class="text-muted small">Bem-vinda de volta à sua plataforma de gestão.</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger border-0 py-2 small rounded-3 text-center mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">E-mail Corporativo</label>
                <input type="email" name="email" class="form-control rounded-3" placeholder="nome@eurekaconsulting.com" required value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Palavra-passe</label>
                <input type="password" name="password" class="form-control rounded-3" placeholder="••••••••" required>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <a href="#" class="text-accent small text-decoration-none">Esqueceu a senha?</a>
            </div>
            <button type="submit" class="btn btn-accent">Entrar no Painel</button>
        </form>
    </div>
</body>
</html>