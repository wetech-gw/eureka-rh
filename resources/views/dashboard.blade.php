@extends('layouts.app')

@section('content')
<div class="d-flex">
    
    <aside class="sidebar border-end p-4 d-flex flex-column">
        <div class="mb-5">
            <div class="font-serif fs-5 fw-normal text-dark lh-1">Eureka<span class="text-accent"> Consulting.</span></div>
            <span class="text-uppercase text-muted fw-bold d-block mt-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</span>
        </div>

        <nav class="flex-grow-1">
            <a class="nav-item-hr active p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Dashboard
            </a>
            <a class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Funcionarios
            </a>
            <a class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Férias & Ausências
            </a>
            <a class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Formacoes
            </a>
            <a class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="9" r="7"></circle><polyline points="9 5 9 9 11.5 10.5"></polyline></svg>
                Presenças
            </a>
            <a class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12.5 2h-7a1.5 1.5 0 0 0-1.5 1.5v11A1.5 1.5 0 0 0 5.5 16h7a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 12.5 2z"></path><path d="M7 6h4"></path><path d="M7 9h4"></path><path d="M7 12h2"></path></svg>
                Folha-Salarial
            </a>
            <a class="nav-item-hr p-2.5 rounded-3 mb-2 d-flex align-items-center gap-2">
                <!-- Ícone Recrutamento (Corrigido o alinhamento) -->
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="14" height="11" rx="1.5"></rect>
                    <path d="M6 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"></path>
                </svg>
                Recrutamentos
            </a>

            <a class="nav-item-hr p-2.5 rounded-3 mb-2 d-flex align-items-center gap-2">
                <!-- Ícone Candidatos (Corrigido viewBox e tamanho do desenho) -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Candidatos
            </a>

            <a class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                Financeiro
            </a>
            <a class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                Relatórios
            </a>
            <a class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                Operacional/Estratégia
            </a>
        </nav>

        <div class="pt-3 border-top d-flex align-items-center gap-2">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:34px; height:34px; background-color: #00796b; font-size:12px;">NS</div>
            <div>
                <div class="fw-bold text-dark" style="font-size: 13px; line-height: 1.2;">Nhana Carla Seide</div>
                <div class="text-muted" style="font-size: 11px;">Gestora de RH</div>
            </div>
        </div>
    </aside>

    <main class="main-content flex-grow-1 p-5">
        
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h1 class="font-serif display-5 fw-normal mb-1">Recursos Humanos</h1>
                <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — visão geral da equipa</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px;">Exportar</button>
                <button class="btn text-white px-3 py-2 fw-medium rounded-3" style="background-color: var(--accent); font-size: 13px;">+ Novo Funcionario</button>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card-custom p-4 shadow-sm">
                    <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.02em;">Total Funcionario</span>
                    
                    <div class="stat-number">{{ $totalFuncionarios }}</div>
                    
                    @if($novosEsteMes > 0)
                        <span class="text-success small fw-medium d-block mt-2">↑ {{ $novosEsteMes }} este mês</span>
                    @else
                        <span class="text-muted small d-block mt-2">Sem novas contratações</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4 shadow-sm">
                    <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.02em;">Presença Hoje</span>
                    <div class="stat-number">
                        {{ $presencasHoje }} <span class="text-muted fs-4">/{{ $totalFuncionarios }}</span>
                    </div>
                    <span class="text-secondary small d-block mt-2">{{ $ausentesHoje }} ausentes</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4 shadow-sm">
                    <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.02em;">Contratos a Expirar</span>
                    
                    <div class="stat-number" style="color: #c94a4a;">{{ $contratosAExpirar }}</div>
                    
                    @if($contratosAExpirar > 0 && !is_null($diasRestantes))
                        @if($diasRestantes == 0)
                            <span class="text-danger small fw-bold d-block mt-2">⚠️ Atenção: Termina HOJE!</span>
                        @elseif($diasRestantes == 1)
                            <span class="text-danger small fw-bold d-block mt-2">⚠️ Atenção: Termina AMANHÃ!</span>
                        @elseif($diasRestantes <= 9)
                            <span class="text-danger small fw-bold d-block mt-2">⚠️ Urgente: Termina em {{ $diasRestantes }} dias!</span>
                        @else
                            <span class="text-warning small fw-medium d-block mt-2">↓ Aviso: Termina em {{ $diasRestantes }} dias</span>
                        @endif
                    @else
                        <span class="text-muted small d-block mt-2">Tudo em dia</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4 shadow-sm">
                    <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.02em;">Total Candidatos</span>
                    <div class="stat-number">88</div>
                    <span class="text-success small fw-medium d-block mt-2">↑ 4 dia anterior</span>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-3 align-items-center mb-4">
            <span class="text-uppercase text-muted fw-bold me-2" style="font-size: 11px; letter-spacing: 0.05em;">Atenção</span>
            
            <!-- Alerta de Contrato (Vermelho) -->
            <div class="d-flex align-items-center gap-2 bg-light border border-danger-subtle rounded px-2 py-1" style="font-size: 13px;">
                <span class="rounded-circle bg-danger" style="width: 8px; height: 8px;"></span>
                <span class="fw-medium">Contrato Elson Djaló expira em 8 dias · <span class="text-muted fw-normal">Renovação pendente</span></span>
            </div>
            
            <!-- Alerta de Avaliação (Laranja) -->
            <div class="d-flex align-items-center gap-2 bg-light border border-warning-subtle rounded px-2 py-1" style="font-size: 13px;">
                <span class="rounded-circle" style="width: 8px; height: 8px; background-color: #fd7e14;"></span>
                <span class="fw-medium">3 avaliações de desempenho em atraso · <span class="text-muted fw-normal">Jun 2025</span></span>
            </div>
        </div>


        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card-custom shadow-sm p-4 h-100 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fs-5 fw-bold text-dark m-0">Funcionarios</h3>
                        <a href="#" class="text-accent text-decoration-none small fw-medium">Ver todos →</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <thead>
                                <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                                    <th class="pb-3">Nome</th>
                                    <th class="pb-3 text-center">Estado</th>
                                    <th class="pb-3">Contrato</th>
                                    <th class="pb-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-medium" style="width:36px; height:36px; background-color: #0d9488;">SD</div>
                                            <div>
                                                <div class="fw-bold text-dark">Sidia Malam Inquade</div>
                                                <div class="text-muted small">Dev Frontend</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge px-3 py-1.5 rounded-5 fw-medium text-success" style="background-color: #e6fdfa;">Activo</span>
                                    </td>
                                    <td><span class="text-secondary">Permanente</span></td>
                                    <td class="text-muted text-end">···</td>
                                </tr>
                                <tr>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-medium" style="width:36px; height:36px; background-color: #2563eb;">AB</div>
                                            <div>
                                                <div class="fw-bold text-dark">Elson Sakhir  Ba</div>
                                                <div class="text-muted small">Dev Backend</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge px-3 py-1.5 rounded-5 fw-medium text-warning" style="background-color: #fff8e1; color: #b78103 !important;">Contrato · 8d</span>
                                    </td>
                                    <td><span class="text-secondary">Prazo fixo</span></td>
                                    <td class="text-muted text-end">···</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-custom shadow-sm p-4 bg-white mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fs-5 fw-bold text-dark m-0">Ausências — Maio</h3>
                        <a href="#" class="text-accent text-decoration-none small fw-medium">Gerir →</a>
                    </div>
                    <div class="d-grid text-center text-muted fw-medium mb-2" style="grid-template-columns: repeat(7, 1fr); font-size: 11px;">
                        <span>S</span><span>T</span><span>Q</span><span>Q</span><span>S</span><span>S</span><span>D</span>
                    </div>
                    <div class="d-grid text-center align-items-center text-secondary row-gap-2" style="grid-template-columns: repeat(7, 1fr); font-size: 13px;">
                        <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span>
                        <span class="rounded-2 p-1 fw-bold text-dark" style="background-color: var(--orange-badge);">7</span>
                        <span class="rounded-2 p-1 fw-bold text-dark" style="background-color: var(--orange-badge);">8</span>
                        <span>9</span><span>10</span><span>11</span><span>12</span>
                        <span class="rounded-2 p-1 text-white fw-medium" style="background-color: var(--accent);">13</span>
                        <span>14</span>
                    </div>
                </div>

                <div class="card-custom shadow-sm p-4 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fs-6 fw-bold text-dark m-0">Presença — Hoje</h3>
                        <a href="#" class="text-accent text-decoration-none small fw-medium">Ver todos →</a>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:28px; height:28px; background-color: #0d9488; font-size: 10px;">SD</div>
                            <div>
                                <div class="fw-bold text-dark" style="font-size: 13px;">Sidia Malam Inquade</div>
                                <div class="text-muted" style="font-size: 11px;">Dev Frontend</div>
                            </div>
                        </div>
                        <span class="small text-success fw-medium d-flex align-items-center gap-1">
                            <span class="rounded-circle d-inline-block" style="width: 6px; height: 6px; background-color: var(--green-badge);"></span>
                            ● Presente
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="card-custom p-4 shadow-sm bg-white">
                    <span class="text-secondary fw-normal d-block mb-1" style="font-size: 14px;">Produtividade</span>
                    <div class="display-6 text-dark mb-3">92<span class="fs-4 text-muted">%</span></div>
                    <div class="progress rounded-pill" style="height: 4px;">
                        <div class="progress-bar" style="width: 92%; background-color: var(--accent);"></div>
                    </div>
                    <span class="text-muted small d-block mt-2">Média da equipa</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 shadow-sm bg-white">
                    <span class="text-secondary fw-normal d-block mb-1" style="font-size: 14px;">Novas Contratações</span>
                    <div class="display-6 text-dark mb-3">3 <span class="fs-6 text-muted">maio</span></div>
                    <div class="d-flex align-items-end gap-1.5" style="height: 24px;">
                        <div class="mini-bar" style="height: 30%"></div>
                        <div class="mini-bar" style="height: 50%"></div>
                        <div class="mini-bar" style="height: 40%"></div>
                        <div class="mini-bar" style="height: 70%"></div>
                        <div class="mini-bar" style="height: 60%"></div>
                        <div class="mini-bar active" style="height: 90%"></div>
                        <div class="mini-bar" style="height: 20%"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 shadow-sm bg-white">
                    <span class="text-secondary fw-normal d-block mb-1" style="font-size: 14px;">Taxa de Retenção de Recursos Humanos</span>
                    <div class="display-6 text-dark mb-3">94<span class="fs-4 text-muted">%</span></div>
                    <div class="progress rounded-pill" style="height: 4px;">
                        <div class="progress-bar" style="width: 94%; background-color: var(--accent);"></div>
                    </div>
                    <span class="text-success small fw-medium d-block mt-2">↑ 2% vs ano anterior</span>
                </div>
            </div>
        </div>

    </main>
</div>
@endsection