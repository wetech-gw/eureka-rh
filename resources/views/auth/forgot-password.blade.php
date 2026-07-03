<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Recuperar Palavra-passe</title>
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
            <h4 class="fw-bold text-dark">Recuperar <span class="text-accent">Acesso</span></h4>
            <p class="text-muted small">Introduza o seu e-mail corporativo para receber as instruções de redefinição.</p>
        </div>

        @if(session('status'))
            <div class="alert alert-success border-0 py-2 small rounded-3 text-center mb-3">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-0 py-2 small rounded-3 text-center mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">E-mail Corporativo</label>
                <input type="email" name="email" class="form-control rounded-3" placeholder="nome@eurekaconsulting.com" required value="{{ old('email') }}">
            </div>
            
            <button type="submit" class="btn btn-accent mb-3">Enviar Link de Recuperação</button>
            
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-accent small text-decoration-none">← Voltar ao Login</a>
            </div>
        </form>
    </div>
</body>
</html>