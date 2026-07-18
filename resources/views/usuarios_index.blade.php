<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Gestão de Utilizadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; min-height: 100vh; margin: 0; }
        .wrapper { display: flex; width: 100%; min-height: 100vh; }
        .sidebar { width: 220px; height: 100vh; position: sticky; top: 0; background: white; flex-shrink: 0; overflow-y: auto; }
        .main-content { flex-grow: 1; padding: 1.5rem; background-color: #f8f9fa; overflow-y: auto; }
        .nav-item-hr { display: flex; align-items: center; gap: 8px; padding: 7px 10px; color: #495057; text-decoration: none; border-radius: 8px; margin-bottom: 2px; font-size: 13px; transition: all 0.2s; }
        .nav-item-hr:hover { background-color: #f1f3f5; color: #212529; text-decoration: none; }
        .nav-item-hr.active { background-color: #e6fdfa; color: var(--accent); font-weight: 600; text-decoration: none; }
        .text-accent { color: var(--accent); }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        .btn-accent { background-color: var(--accent); color: white; border: none; border-radius: 8px; font-weight: 500; transition: background 0.2s; }
        .btn-accent:hover { background-color: #0b7a70; color: white; }
        .form-control:focus, .form-select:focus { border-color: var(--accent); box-shadow: 0 0 0 0.25rem rgba(13, 148, 136, 0.15); }

        .badge-responsavel { background-color: #e0f2fe; color: #0369a1; }
        .badge-assistente { background-color: #f3e8ff; color: #6b21a8; }

        /* Estilos dos Novos Estados */
        .badge-ativo { background-color: #dcfce7; color: #15803d; }
        .badge-inativo { background-color: #f3f4f6; color: #4b5563; }
        .badge-suspenso { background-color: #fee2e2; color: #b91c1c; }

        .modern-search-group { position: relative; max-width: 380px; width: 100%; }
        .modern-search-input { padding: 9px 16px 9px 40px; font-size: 13px; border-radius: 10px; border: 1px solid #e2e8f0; background-color: #f8fafc; transition: all 0.2s ease-in-out; }
        .modern-search-input:focus { background-color: #ffffff; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15); outline: none; }
        .modern-search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; display: flex; align-items: center; }

        /* NOVO: Estilos para fixar a tabela e ativar o Scroll */
        .table-scrollable-container {
            max-height: 400px; /* Altere este valor para controlar a altura visível da tabela */
            overflow-y: auto;  /* Ativa o scroll vertical */
            overflow-x: auto;  /* Ativa o scroll horizontal se a tela for pequena */
            border: 1px solid #dee2e6;
            border-radius: 8px;
            position: relative;
        }

        .table-scrollable-container table {
            border-collapse: separate; /* Necessário para o efeito sticky funcionar corretamente */
            margin-bottom: 0;
        }

        .table-scrollable-container thead th {
            position: sticky;
            top: 0;
            z-index: 5;
            background-color: #f1f3f5 !important; /* Cor de fundo para não sobrepor o texto rolando por baixo */
            box-shadow: inset 0 -1px 0 rgba(0,0,0,0.12); /* Garante a linha divisória inferior */
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <aside class="sidebar border-end p-3 d-flex flex-column">
        <div class="mb-4">
            <div class="font-serif fs-5 fw-normal text-dark lh-1">Eureka<span class="text-accent"> Consulting.</span></div>
            <span class="text-uppercase text-muted fw-bold d-block mt-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</span>
        </div>
        <nav class="flex-grow-1">
            <a href="{{ route('dashboard') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Dashboard
            </a>

            <a href="{{ route('funcionarios.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Funcionarios
            </a>
            <a href="{{ route('ferias.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Férias & Licenças
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Avaliações
            </a>
            <a href="{{ route('formacoes.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('formacoes.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Formações
            </a>
            <a href="{{ route('presencas.index')}}" class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="9" r="7"></circle><polyline points="9 5 9 9 11.5 10.5"></polyline></svg>
                Presenças
            </a>
            <a href="{{ route('folhas.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('folhas.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12.5 2h-7a1.5 1.5 0 0 0-1.5 1.5v11A1.5 1.5 0 0 0 5.5 16h7a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 12.5 2z"></path>
                    <path d="M7 6h4"></path>
                    <path d="M7 9h4"></path>
                    <path d="M7 12h2"></path>
                </svg>
                Folha-Salarial
            </a>
            <a href="{{ route('recrutamento.index') }}"
            class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('recrutamento.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="14" height="11" rx="1.5"></rect>
                    <path d="M6 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"></path>
                </svg>
                Recrutamentos
            </a>

            <a href="{{ route('candidatos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Candidatos
            </a>
            <a href="{{ route('financeiro.index')}}" class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                Financeiro
            </a>
            <a href="{{ route('estrategia.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('estrategia.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                Operacional/Estratégia
            </a>
            <a href="{{ route('usuarios.index') }}" class="nav-item-hr active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                Utilizadores / Acessos
            </a>
        </nav>
        <div class="pt-2">
            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                @csrf
                <button type="submit" class="btn btn-link text-danger p-0 border-0 text-decoration-none d-flex align-items-center gap-1 small fw-bold" style="font-size: 11px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Terminar Sessão
                </button>
            </form>
        </div>
        <div class="pt-3 border-top d-flex align-items-center gap-2 mt-auto">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold text-uppercase"
                style="width:36px; height:36px; background-color: #00796b; font-size:11px; letter-spacing: 0.05em;">
                @php
                    $words = explode(' ', Auth::user()->name);
                    $initials = (count($words) >= 2) ? $words[0][0] . end($words)[0] : $words[0][0];
                @endphp
                {{ $initials }}
            </div>

            <div class="overflow-hidden">
                <div class="fw-bold text-dark text-truncate" style="font-size: 13px; line-height: 1.2;" title="{{ Auth::user()->name }}">
                    {{ Auth::user()->name }}
                </div>
                <div class="text-muted text-capitalize text-truncate" style="font-size: 11px;" title="{{ Auth::user()->role }}">
                    {{ Auth::user()->role }}
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-3" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0 text-dark">Utilizadores do Sistema</h2>
                <p class="text-accent">Gerir credenciais, permissões e contas da equipa de Recursos Humanos</p>
            </div>
            <div class="modern-search-group">
                <span class="modern-search-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </span>
                <input type="text" class="form-control modern-search-input" id="searchUsuario" placeholder="Pesquisar por nome ou email...">
            </div>
            <button class="btn btn-accent px-3 py-2 small d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalCriarUsuario">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Novo Utilizador
            </button>
        </div>

        <div class="card-custom p-4">
            <h5 class="fw-bold text-dark mb-3">Contas Ativas no Departamento</h5>
            <div class="table-scrollable-container">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nome / Detalhes</th>
                            <th>E-mail</th>
                            <th>Nível de Acesso (Função)</th>
                            <th>Estado</th>
                            <th class="text-end">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold text-secondary" style="width:36px; height:36px; font-size: 13px;">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 14px;">{{ $user->name }}</div>
                                            <span class="text-muted small">ID: #00{{ $user->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-secondary" style="font-size: 13px;">{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->role == 'Responsável' ? 'badge-responsavel' : 'badge-assistente' }} px-2.5 py-1 rounded-3">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Badge Dinâmico de Estado -->
                                    @if(($user->status ?? 'Ativo') == 'Ativo')
                                        <span class="badge badge-ativo px-2.5 py-1 rounded-3">Ativo</span>
                                    @elseif($user->status == 'Inativo')
                                        <span class="badge badge-inativo px-2.5 py-1 rounded-3">Inativo</span>
                                    @else
                                        <span class="badge badge-suspenso px-2.5 py-1 rounded-3">Suspenso</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-light border p-1 rounded-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditarUsuario"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-role="{{ $user->role }}"
                                            data-status="{{ $user->status ?? 'Ativo' }}">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Modal Criar Usuário -->
<div class="modal fade" id="modalCriarUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px;">
            <div class="modal-header text-white" style="background-color: #0d9488;">
                <h5 class="modal-title fw-bold m-0">Criar Conta de Acesso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4 pb-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Nome Completo</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="Ex: Nhana Carla Seide" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Endereço de E-mail</label>
                        <input type="email" name="email" class="form-control rounded-3" placeholder="nome@eurekaconsulting.com" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Nivel de Acesso</label>
                            <select name="role" class="form-select rounded-3" required>
                                <option value="Responsável">Responsável (Acesso Total)</option>
                                <option value="Assistente">Assistente (Operacional)</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Estado Inicial</label>
                            <select name="status" class="form-select rounded-3" required>
                                <option value="Ativo" selected>Ativo</option>
                                <option value="Inativo">Inativo</option>
                                <option value="Suspenso">Suspenso</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted text-uppercase">Palavra-passe Inicial</label>
                        <input type="password" name="password" class="form-control rounded-3" placeholder="Mínimo 6 caracteres" required>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light p-3" style="border-bottom-right-radius: 14px; border-bottom-left-radius: 14px;">
                    <button type="button" class="btn btn-sm btn-white border px-3 py-2 rounded-3 text-secondary fw-medium" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-accent px-4 py-2 rounded-3">Criar Utilizador</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Usuário -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px;">
            <div class="modal-header text-white" style="background-color: #0d9488;">
                <h5 class="modal-title fw-bold m-0">Modificar Conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarUsuario" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4 pb-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Nome Completo</label>
                        <input type="text" name="name" id="edit_name" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Endereço de E-mail</label>
                        <input type="email" name="email" id="edit_email" class="form-control rounded-3" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Função / Nivel</label>
                            <select name="role" id="edit_role" class="form-select rounded-3" required>
                                <option value="Responsável">Responsável (Acesso Total)</option>
                                <option value="Assistente">Assistente (Operacional)</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Estado da Conta</label>
                            <select name="status" id="edit_status" class="form-select rounded-3" required>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                                <option value="Suspenso">Suspenso</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted text-uppercase">Nova Palavra-passe (Deixe em branco para não alterar)</label>
                        <input type="password" name="password" class="form-control rounded-3" placeholder="Opcional">
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light p-3" style="border-bottom-right-radius: 14px; border-bottom-left-radius: 14px;">
                    <button type="button" class="btn btn-sm btn-white border px-3 py-2 rounded-3 text-secondary fw-medium" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-sm btn-accent px-4 py-2 rounded-3">Guardar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const modalEditarUser = document.getElementById('modalEditarUsuario');
    if (modalEditarUser) {
        modalEditarUser.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const role = button.getAttribute('data-role');
            const status = button.getAttribute('data-status'); // Captura o status enviado pelo botão

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            document.getElementById('edit_status').value = status; // Define o status no select do Modal

            document.getElementById('formEditarUsuario').action = `/usuarios/${id}`;
        });
    }
    // Filtro / Pesquisa Instantânea em Javascript
        document.getElementById('searchUsuario').addEventListener('keyup', function() {
            const value = this.value.toLowerCase();
            const rows = document.querySelectorAll('#tabelaUsuarios .user-row');

            rows.forEach(row => {
                const name = row.querySelector('.user-name').textContent.toLowerCase();
                const email = row.querySelector('.user-email').textContent.toLowerCase();

                if (name.includes(value) || email.includes(value)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
