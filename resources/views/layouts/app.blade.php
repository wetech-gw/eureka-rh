<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka — Recursos Humanos</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --bg: #fdfdfd;
            --surface: #ffffff;
            --border: #f1f1f0;
            --text-primary: #111111;
            --text-secondary: #666664;
            --text-muted: #999996;
            --accent: #0d9488;
            --accent-light: #f0fdfa;
            --green-badge: #e6f6f4;
            --orange-badge: #fff3cd;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text-primary);
            font-size: 14px;
        }
        .font-serif { font-family: 'DM Serif Display', serif; }
        .text-accent { color: var(--accent); }
        .sidebar { width: 220px; position: fixed; top: 0; left: 0; bottom: 0; z-index: 100; background: var(--surface); }
        .main-content { margin-left: 220px; background-color: #fafafa; min-height: 100vh; }

        /* Links da Sidebar */
        .nav-item-hr { color: var(--text-secondary); font-size: 13px; font-weight: 400; text-decoration: none; display: flex; align-items: center; gap: 8px; padding: 7px 10px; margin-bottom: 2px; cursor: pointer; transition: all 0.2s; }
        .nav-item-hr svg { flex-shrink: 0; }
        .nav-item-hr:hover { color: var(--text-primary); }
        .nav-item-hr.active { background: var(--accent-light); color: var(--accent); font-weight: 500; }

        /* Customizações do Print */
        .card-custom { background: #fff; border: 1px solid var(--border); border-radius: 12px; }
        .stat-number { font-size: 38px; font-weight: 400; color: #222; line-height: 1.1; }
        .badge-alert { background-color: #fff; border: 1px solid var(--border); border-radius: 30px; font-size: 13px; color: #333; padding: 6px 16px; }

        /* Mini gráfico simulado do seu print */
        .mini-bar { width: 6px; background-color: #e2f2f0; border-radius: 4px; transition: 0.3s; }
        .mini-bar.active { background-color: var(--accent); }
    </style>
</head>
<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
