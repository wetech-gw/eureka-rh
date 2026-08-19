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
        html[data-theme="dark"] {
            --bg: #0f1115;
            --surface: #171a21;
            --border: #262b34;
            --text-primary: #ececea;
            --text-secondary: #a8a8a5;
            --text-muted: #6f6f6c;
            --accent: #2dd4bf;
            --accent-light: #102f2c;
            --green-badge: #14332f;
            --orange-badge: #3a2f12;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text-primary);
            font-size: 14px;
        }
        .font-serif { font-family: 'DM Serif Display', serif; }
        .text-accent { color: var(--accent); }
        .sidebar { width: 220px; position: fixed; top: 0; left: 0; bottom: 0; z-index: 100; background: var(--surface); overflow: hidden; }
        .main-content { margin-left: 220px; background-color: var(--bg); min-height: 100vh; }

        /* Links da Sidebar */
        .nav-item-hr { color: var(--text-secondary); font-size: 13px; font-weight: 400; text-decoration: none; display: flex; align-items: center; gap: 8px; padding: 7px 10px; margin-bottom: 2px; cursor: pointer; transition: all 0.2s; }
        .nav-item-hr svg { flex-shrink: 0; }
        .nav-item-hr:hover { color: var(--text-primary); }
        .nav-item-hr.active { background: var(--accent-light); color: var(--accent); font-weight: 500; }

        /* Customizações do Print */
        .card-custom { background: var(--surface); border: 1px solid var(--border); border-radius: 12px; }
        .stat-number { font-size: 38px; font-weight: 400; color: var(--text-primary); line-height: 1.1; }
        .badge-alert { background-color: #fff; border: 1px solid var(--border); border-radius: 30px; font-size: 13px; color: #333; padding: 6px 16px; }

        /* Mini gráfico simulado do seu print */
        .mini-bar { width: 6px; background-color: #e2f2f0; border-radius: 4px; transition: 0.3s; }
        .mini-bar.active { background-color: var(--accent); }

        /* Modo escuro */
        html[data-theme="dark"] .sidebar { background: var(--surface); }
        html[data-theme="dark"] .bg-white { background-color: var(--surface) !important; }
        html[data-theme="dark"] .bg-light { background-color: var(--surface) !important; }
        html[data-theme="dark"] .text-dark { color: var(--text-primary) !important; }
        html[data-theme="dark"] .text-secondary { color: var(--text-secondary) !important; }
        html[data-theme="dark"] .text-muted { color: var(--text-muted) !important; }
        html[data-theme="dark"] .table { --bs-table-bg: transparent; --bs-table-color: var(--text-primary); --bs-table-border-color: var(--border); }
        html[data-theme="dark"] .table th { color: var(--text-muted); }
        html[data-theme="dark"] .badge-alert { background-color: var(--surface); color: var(--text-primary); }
        html[data-theme="dark"] .btn-light { background-color: var(--surface) !important; border-color: var(--border) !important; color: var(--text-secondary) !important; }
        html[data-theme="dark"] .border, html[data-theme="dark"] .border-top, html[data-theme="dark"] .border-bottom, html[data-theme="dark"] .border-start, html[data-theme="dark"] .border-end { border-color: var(--border) !important; }
        html[data-theme="dark"] hr { border-color: var(--border) !important; }

        /* Modais em modo escuro */
        html[data-theme="dark"] .modal-content { background-color: var(--surface) !important; border-color: var(--border) !important; color: var(--text-primary) !important; }
        html[data-theme="dark"] .modal-header { border-bottom-color: var(--border) !important; }
        html[data-theme="dark"] .modal-footer { border-top-color: var(--border) !important; }
        html[data-theme="dark"] .modal-backdrop { background-color: #000; opacity: 0.6; }
        html[data-theme="dark"] .modal-body strong { color: var(--text-primary); }
    </style>
</head>
<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (function() {
            const root = document.documentElement;
            const saved = localStorage.getItem('eureka-theme') || 'light';
            root.setAttribute('data-theme', saved);

            const icons = {
                sun: '<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>',
                moon: '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>'
            };

            function sync(toggle) {
                const isDark = root.getAttribute('data-theme') === 'dark';
                const icon = toggle.querySelector('.theme-icon');
                const label = toggle.querySelector('.theme-label');
                if (icon) icon.innerHTML = isDark ? icons.sun : icons.moon;
                if (label) label.textContent = isDark ? 'Claro' : 'Escuro';
            }

            function setTheme(theme) {
                root.setAttribute('data-theme', theme);
                localStorage.setItem('eureka-theme', theme);
                document.querySelectorAll('.theme-toggle').forEach(sync);
            }

            document.querySelectorAll('.theme-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    setTheme(root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
                });
                sync(toggle);
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>
