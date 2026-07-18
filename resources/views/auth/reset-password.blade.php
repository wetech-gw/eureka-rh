<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --accent: #10637a;
            --accent-dark: #0b4b5d;
            --bg-gradient: radial-gradient(circle at top right, #1a718a, #0d3d4b);
            --input-bg: #f1f5f7;
        }

        body {
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* --- CÍRCULOS DE FUNDO DECORATIVOS --- */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(26, 113, 138, 0.6), rgba(13, 61, 75, 0.9));
            z-index: 1;
        }
        .bg-circle-1 { width: 450px; height: 450px; top: -100px; left: -100px; }
        .bg-circle-2 { width: 300px; height: 300px; bottom: -50px; right: -50px; }

        /* --- CONTAINER DO CARD SPLIT --- */
        .login-container {
            width: 100%;
            max-width: 950px;
            min-height: 550px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            display: flex;
            overflow: hidden;
            position: relative;
            z-index: 5;
        }

        /* --- COLUNA ESQUERDA (Identidade Visual) --- */
        .brand-side {
            flex: 1;
            background: linear-gradient(135deg, #10637a, #1a718a);
            padding: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
            color: #ffffff;
        }

        .brand-shape-1 {
            position: absolute;
            width: 320px;
            height: 320px;
            background: linear-gradient(180deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 100%);
            border-radius: 50%;
            top: -80px;
            right: -60px;
        }
        .brand-shape-2 {
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            bottom: 40px;
            left: 20px;
        }

        .brand-content {
            position: relative;
            z-index: 2;
        }

        .brand-side h1 {
            font-size: 2.8rem;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .brand-side h3 {
            font-size: 1.4rem;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 20px;
        }
        .brand-side p {
            font-size: 0.95rem;
            opacity: 0.75;
            max-width: 320px;
            line-height: 1.6;
        }

        /* --- COLUNA DIREITA (Formulário de Nova Senha) --- */
        .form-side {
            flex: 1.1;
            padding: 45px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .form-header h2 {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }
        .form-header p {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }

        /* Estilização Customizada dos Inputs */
        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group-custom i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.1rem;
            z-index: 10;
        }

        .input-group-custom .form-control {
            background-color: var(--input-bg);
            border: none;
            border-radius: 12px;
            padding: 15px 75px 15px 50px; /* Espaço aumentado na direita para o botão Show */
            font-size: 0.95rem;
            color: #334155;
            box-shadow: none;
            transition: all 0.2s ease;
        }

        /* Ajuste específico para o e-mail que não possui botão Show */
        .input-group-custom .form-control[type="email"] {
            padding-right: 20px;
        }

        .input-group-custom .form-control:focus {
            background-color: #e2e8f0;
            box-shadow: 0 0 0 3px rgba(16, 99, 122, 0.15);
        }

        /* Botão Mostrar/Ocultar Senha */
        .btn-toggle-password {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--accent);
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            z-index: 10;
            text-transform: uppercase;
        }

        /* Botão de Ação */
        .btn-primary-custom {
            background-color: var(--accent);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s ease;
            width: 100%;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .btn-primary-custom:hover {
            background-color: var(--accent-dark);
            transform: translateY(-1px);
        }

        /* Link de Retorno */
        .back-link {
            color: var(--accent);
            font-size: 0.88rem;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .back-link:hover {
            text-decoration: underline;
        }

        /* Rodapé de Copyright */
        .copyright {
            position: absolute;
            bottom: 20px;
            left: 0;
            width: 100%;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
            z-index: 5;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                min-height: auto;
            }
            .brand-side {
                padding: 40px 30px;
                text-align: center;
            }
            .brand-side p {
                max-width: 100%;
            }
            .form-side {
                padding: 40px 30px;
            }
            .bg-circle { display: none; }
        }
    </style>
</head>
<body>

    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>

    <div class="login-container">

        <div class="brand-side">
            <div class="brand-shape-1"></div>
            <div class="brand-shape-2"></div>
            <div class="brand-content">
                <h1>EUREKA Consulting</h1>
                <h3>Plataforma de Gestão</h3>
                <p>Crie uma credencial forte e garanta a proteção dos seus dados corporativos.</p>
            </div>
        </div>

        <div class="form-side">
            <div class="form-header">
                <h2 style="color: #10637A;">Nova Palavra-passe</h2>
                <p>Defina a sua nova credencial de acesso abaixo.</p>
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

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-group-custom">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="E-mail Corporativo" required value="{{ old('email') }}">
                </div>

                <div class="input-group-custom">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Nova Palavra-passe" required>
                    <button type="button" class="btn-toggle-password" data-target="password">Show</button>
                </div>

                <div class="input-group-custom">
                    <i class="fa-solid fa-circle-check"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmar Nova Palavra-passe" required>
                    <button type="button" class="btn-toggle-password" data-target="password_confirmation">Show</button>
                </div>

                <button type="submit" class="btn-primary-custom">Redefinir Palavra-passe</button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="back-link">
                        <i class="fa-solid fa-arrow-left"></i> Voltar ao Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="copyright">
        &copy; <span id="currentYear"></span> Eureka Consulting - Todos os direitos reservados
    </div>

    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Lógica unificada para os botões "SHOW" das duas senhas
        const toggleButtons = document.querySelectorAll('.btn-toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);

                if (input.type === 'password') {
                    input.type = 'text';
                    this.textContent = 'Hide';
                } else {
                    input.type = 'password';
                    this.textContent = 'Show';
                }
            });
        });
    </script>
</body>
</html>
