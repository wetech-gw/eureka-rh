<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Candidaturas Espontâneas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; min-height: 100vh; margin: 0; }
        .wrapper { display: flex; width: 100%; min-height: 100vh; }
        .sidebar { width: 220px; height: 100vh; position: sticky; top: 0; background: white; flex-shrink: 0; overflow: hidden; scrollbar-width: thin; scrollbar-color: #d4d4d4 transparent; }
        .main-content { flex-grow: 1; padding: 1.5rem; background-color: #f8f9fa; overflow-y: auto; }
        .nav-item-hr { display: flex; align-items: center; gap: 8px; padding: 7px 10px; color: #495057; text-decoration: none; border-radius: 8px; margin-bottom: 2px; font-size: 13px; transition: all 0.2s; cursor: pointer; }
        .nav-item-hr:hover { background-color: #f1f3f5; color: #212529; text-decoration: none; }
        .nav-item-hr.active { background-color: #e6fdfa; color: var(--accent); font-weight: 600; text-decoration: none; }
        .text-accent { color: var(--accent); }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        .table th { background-color: #f1f3f5; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 10px; letter-spacing: 0.05em; }
        .table-scrollable-container { max-height: 650px; overflow-y: auto; overflow-x: auto; border: 1px solid #dee2e6; border-radius: 8px; position: relative; }
        .table-scrollable-container table { border-collapse: separate; margin-bottom: 0; }
        .table-scrollable-container thead th { position: sticky; top: 0; z-index: 5; background-color: #f1f3f5 !important; box-shadow: inset 0 -1px 0 rgba(0,0,0,0.12); color: #495057; font-weight: 600; text-transform: uppercase; font-size: 10px; letter-spacing: 0.05em; }
        .modern-search-group { position: relative; max-width: 380px; width: 100%; }
        .modern-search-input { padding: 9px 16px 9px 40px; font-size: 13px; border-radius: 10px; border: 1px solid #e2e8f0; background-color: #f8fafc; transition: all 0.2s ease-in-out; }
        .modern-search-input:focus { background-color: #ffffff; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15); outline: none; }
        .modern-search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; display: flex; align-items: center; }
    </style>
@include('partials.theme-head')
</head>
<body>
<div class="wrapper">
    @include('partials.sidebar')

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0 text-dark">Candidaturas Espontâneas</h2>
                <p class="text-accent">Gestão de CVs submetidos sem vaga específica</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" onclick="exportarAceitosPDF()" class="btn btn-light border btn-sm fw-semibold rounded-3 d-inline-flex align-items-center gap-2 shadow-sm text-dark px-3" style="height: 38px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="12" y2="18"></line>
                        <line x1="15" y1="15" x2="12" y2="18"></line>
                    </svg>
                    Exportar PDF (Aceitos)
                </button>
                <div class="modern-search-group">
                    <span class="modern-search-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </span>
                    <input type="text" class="form-control modern-search-input" id="searchCE" placeholder="Pesquisar por nome, profissão, competências...">
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="small fw-medium">{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-2 mb-4 row-cols-2 row-cols-md-5">
            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #495057;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Total</span>
                        <h4 class="fw-bold m-0 text-dark">{{ $total }}</h4>
                    </div>
                    <div class="bg-light text-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fa-solid fa-file-lines" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #f59e0b;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Pendentes</span>
                        <h4 class="fw-bold m-0 text-warning">{{ $pendentes }}</h4>
                    </div>
                    <div class="bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fa-solid fa-clock" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #3b82f6;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Em Avaliação</span>
                        <h4 class="fw-bold m-0" style="color: #3b82f6;">{{ $avaliados }}</h4>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: #eff6ff; color: #3b82f6;">
                        <i class="fa-solid fa-magnifying-glass" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #10b981;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Aceites</span>
                        <h4 class="fw-bold m-0 text-success">{{ $aceites }}</h4>
                    </div>
                    <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fa-solid fa-check" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #ef4444;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Rejeitados</span>
                        <h4 class="fw-bold m-0 text-danger">{{ $rejeitados }}</h4>
                    </div>
                    <div class="bg-danger-subtle text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fa-solid fa-xmark" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-custom p-4 shadow-sm">
            <div class="pb-2 mb-3 border-bottom">
                <h6 class="fw-bold text-dark m-0">Candidaturas Recebidas</h6>
            </div>

            <div class="table-scrollable-container">
                <table class="table table-hover align-middle" id="tabelaCE">
                    <thead>
                        <tr>
                            <th>Candidato</th>
                            <th>Contacto</th>
                            <th>Nível Académico</th>
                            <th>Experiência</th>
                            <th>Competências</th>
                            <th>Data</th>
                            <th class="text-center">CV</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nivelLabels = [
                                'secundario' => 'Ensino Secundário',
                                'bacharel' => 'Bacharelato',
                                'licenciatura' => 'Licenciatura',
                                'mestrado' => 'Mestrado',
                                'doutoramento' => 'Doutoramento',
                                'outro' => 'Outro',
                            ];
                        @endphp
                        @forelse($registos as $r)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $r->nome }}</div>
                                    <span class="text-muted small d-block"><i class="fa-solid fa-envelope me-1"></i>{{ $r->email }}</span>
                                    @if($r->profissao)
                                        <span class="text-muted small d-block"><i class="fa-solid fa-briefcase me-1"></i>{{ $r->profissao }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted small d-block"><i class="fa-solid fa-phone me-1"></i>{{ $r->telefone ?? '—' }}</span>
                                    <span class="text-muted small d-block"><i class="fa-solid fa-location-dot me-1"></i>{{ $r->localizacao ?? '—' }}</span>
                                </td>
                                <td>
                                    <span class="fw-medium text-dark">{{ $nivelLabels[$r->nivel_academico] ?? '—' }}</span>
                                </td>
                                <td>
                                    <span class="fw-medium text-dark">{{ $r->anos_experiencia !== null ? $r->anos_experiencia . ' ano(s)' : '—' }}</span>
                                </td>
                                <td>
                                    @if(!empty($r->competencias))
                                        @foreach(explode(',', $r->competencias) as $skill)
                                            <span class="badge bg-light text-dark border me-1 mb-1">{{ trim($skill) }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td class="small text-muted">{{ date('d/m/Y', strtotime($r->created_at)) }}</td>
                                <td class="text-center">
                                    @if($r->cv_arquivo)
                                        <a href="{{ asset('storage/' . $r->cv_arquivo) }}" target="_blank" class="btn btn-sm btn-light border text-dark fw-medium">
                                            <i class="fa-solid fa-file-pdf text-danger me-1"></i> CV
                                        </a>
                                    @else
                                        <span class="text-muted small">Sem arquivo</span>
                                    @endif
                                    @if($r->carta_motivacao_arquivo)
                                        <a href="{{ asset('storage/' . $r->carta_motivacao_arquivo) }}" target="_blank" class="btn btn-sm btn-light border text-dark fw-medium mt-1">
                                            <i class="fa-solid fa-file-lines text-warning me-1"></i> Carta
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php $s = strtolower($r->status); @endphp
                                    @if($s === 'pendente')
                                        <span class="badge bg-warning-subtle text-warning border border-warning px-3 py-1.5 rounded-5 fw-medium">Pendente</span>
                                    @elseif($s === 'em avaliação')
                                        <span class="badge border border-primary px-3 py-1.5 rounded-5 fw-medium" style="background-color:#eff6ff;color:#3b82f6;">Em Avaliação</span>
                                    @elseif($s === 'aceito')
                                        <span class="badge bg-success-subtle text-success border border-success px-3 py-1.5 rounded-5 fw-medium">Aceito</span>
                                    @elseif($s === 'lista de espera')
                                        <span class="badge border px-3 py-1.5 rounded-5 fw-medium" style="background-color:#f3e8ff;color:#6b21a8;border-color:#d8b4fe !important;">Lista de Espera</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger px-3 py-1.5 rounded-5 fw-medium">Rejeitado</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-1 flex-wrap">
                                        @if($s !== 'aceito')
                                            <form action="{{ route('candidaturas-espontaneas.status', $r->id) }}" method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="Aceito">
                                                <button type="submit" class="btn btn-sm btn-outline-success fw-medium" title="Aceitar">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if($s !== 'rejeitado')
                                            <form action="{{ route('candidaturas-espontaneas.status', $r->id) }}" method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="Rejeitado">
                                                <button type="submit" class="btn btn-sm btn-outline-danger fw-medium" title="Rejeitar">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if($s !== 'lista de espera')
                                            <form action="{{ route('candidaturas-espontaneas.status', $r->id) }}" method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="Lista de Espera">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary fw-medium" title="Lista de Espera">
                                                    <i class="fa-solid fa-pause"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if($s !== 'em avaliação')
                                            <form action="{{ route('candidaturas-espontaneas.status', $r->id) }}" method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="Em Avaliação">
                                                <button type="submit" class="btn btn-sm btn-outline-primary fw-medium" title="Em Avaliação">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('candidaturas-espontaneas.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja eliminar este registo?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-dark fw-medium" title="Eliminar">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-5">
                                    <i class="fa-solid fa-file-circle-plus fa-2x mb-3 d-block" style="color:#d1d5db;"></i>
                                    Nenhuma candidatura espontânea recebida.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchCE');
        const tableRows = document.querySelectorAll('#tabelaCE tbody tr');

        searchInput.addEventListener('keyup', function (e) {
            const searchTerm = e.target.value.toLowerCase().trim();

            tableRows.forEach(row => {
                if (row.cells.length === 1 && row.querySelector('td').getAttribute('colspan')) {
                    return;
                }

                const rowText = row.textContent.toLowerCase();

                if (rowText.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    function exportarAceitosPDF() {
        const linhas = document.querySelectorAll("#tabelaCE tbody tr");
        let linhasHTML = "";
        let totalAceites = 0;

        linhas.forEach(linha => {
            const colunas = linha.querySelectorAll("td");
            if (colunas.length < 6 || linha.innerText.includes("Nenhuma candidatura")) return;

            const estado = colunas[7]?.innerText.trim() || '';
            if (!estado.toLowerCase().includes('aceito')) return;

            totalAceites++;

            const nome = colunas[0].querySelector('.fw-bold')?.innerText.trim() || '';
            const subLines = Array.from(colunas[0].querySelectorAll('.text-muted')).map(e => e.innerText.trim());
            const contacto = subLines.join(' | ') || '—';
            const nivel = colunas[2]?.innerText.trim() || '—';
            const exp = colunas[3]?.innerText.trim() || '—';
            const comp = colunas[4]?.innerText.trim() || '—';
            const data = colunas[5]?.innerText.trim() || '—';

            linhasHTML += `
                <tr>
                    <td>
                        <div style="font-weight: 700; color: #0f172a;">${nome}</div>
                        <div style="font-size: 8pt; color: #64748b;">${contacto}</div>
                    </td>
                    <td>${nivel}</td>
                    <td style="text-align: center;">${exp}</td>
                    <td style="font-size: 7.5pt; color: #475569;">${comp}</td>
                    <td style="text-align: center;">${data}</td>
                    <td style="text-align: center;">
                        <span class="badge-aceito">Aceito</span>
                    </td>
                </tr>
            `;
        });

        if (totalAceites === 0) {
            alert("Nenhum candidato aceito encontrado para exportar.");
            return;
        }

        const dataEmissao = new Date().toLocaleDateString('pt-PT');

        const container = document.createElement('div');
        container.innerHTML = `
            <style>
                .pdf-container {
                    font-family: 'Segoe UI', Arial, sans-serif;
                    padding: 15px;
                    color: #1e293b;
                    background-color: #ffffff;
                }
                .pdf-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    border-bottom: 2px solid #0d9488;
                    padding-bottom: 12px;
                    margin-bottom: 15px;
                }
                .logo-box {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                .logo-img {
                    width: 38px;
                    height: 38px;
                    border-radius: 50%;
                    object-fit: cover;
                }
                .company-title {
                    font-size: 14px;
                    font-weight: 800;
                    color: #0f172a;
                    text-transform: uppercase;
                    margin: 0;
                    line-height: 1.1;
                }
                .company-sub {
                    font-size: 9px;
                    color: #0d9488;
                    font-weight: 700;
                    letter-spacing: 0.8px;
                    text-transform: uppercase;
                    margin: 0;
                }
                .pdf-title-block {
                    text-align: right;
                }
                .pdf-title-block h2 {
                    margin: 0;
                    color: #0d9488;
                    font-size: 16px;
                    font-weight: 800;
                    text-transform: uppercase;
                }
                .pdf-title-block p {
                    margin: 2px 0 0 0;
                    font-size: 9px;
                    color: #64748b;
                }
                .kpi-cards {
                    display: flex;
                    gap: 10px;
                    margin-bottom: 15px;
                }
                .kpi-card {
                    flex: 1;
                    background: #f8fafc;
                    border: 1px solid #e2e8f0;
                    border-radius: 6px;
                    padding: 8px 10px;
                }
                .kpi-card-title {
                    font-size: 8px;
                    font-weight: 700;
                    color: #64748b;
                    text-transform: uppercase;
                }
                .kpi-card-value {
                    font-size: 14px;
                    font-weight: 800;
                    margin-top: 2px;
                    color: #0f172a;
                }
                .pdf-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 5px;
                }
                .pdf-table th {
                    background-color: #0d9488;
                    color: #ffffff;
                    font-size: 8pt;
                    font-weight: 700;
                    text-transform: uppercase;
                    padding: 6px 8px;
                    text-align: left;
                }
                .pdf-table td {
                    padding: 8px;
                    font-size: 8pt;
                    border-bottom: 1px solid #f1f5f9;
                }
                .pdf-table tr:nth-child(even) td {
                    background-color: #f8fafc;
                }
                .badge-aceito {
                    background-color: #d1fae5;
                    color: #059669;
                    padding: 3px 8px;
                    border-radius: 10px;
                    font-size: 7.5pt;
                    font-weight: 700;
                    display: inline-block;
                }
                .footer-note {
                    margin-top: 25px;
                    padding-top: 10px;
                    border-top: 1px dashed #cbd5e1;
                    font-size: 7.5pt;
                    color: #94a3b8;
                    text-align: center;
                }
            </style>

            <div class="pdf-container">
                <div class="pdf-header">
                    <div class="logo-box">
                        <img src="{{ asset('eureka.jpeg') }}" class="logo-img" alt="Eureka Consulting">
                        <div>
                            <div class="company-title">Eureka Consulting</div>
                            <div class="company-sub">Recursos Humanos</div>
                        </div>
                    </div>
                    <div class="pdf-title-block">
                        <h2>Candidaturas Espontâneas</h2>
                        <p>CVs Aceitos | Gerado em: ${dataEmissao}</p>
                    </div>
                </div>

                <div class="kpi-cards">
                    <div class="kpi-card">
                        <div class="kpi-card-title">Candidatos Aceitos</div>
                        <div class="kpi-card-value" style="color: #0d9488;">${totalAceites} Registo(s)</div>
                    </div>
                </div>

                <table class="pdf-table">
                    <thead>
                        <tr>
                            <th style="width: 28%;">Candidato</th>
                            <th style="width: 18%;">Nível Académico</th>
                            <th style="width: 10%; text-align: center;">Exp.</th>
                            <th style="width: 22%;">Competências</th>
                            <th style="width: 12%; text-align: center;">Data</th>
                            <th style="width: 10%; text-align: center;">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${linhasHTML}
                    </tbody>
                </table>

                <div class="footer-note">
                    Este relatório inclui apenas candidaturas espontâneas aceitas, para facilitar a triagem. Gerado automaticamente pelo Sistema Eureka RH.
                </div>
            </div>
        `;

        const opt = {
            margin: [8, 8, 8, 8],
            filename: `candidaturas_espontaneas_aceitos_${new Date().toISOString().slice(0, 10)}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, logging: false, useCORS: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

        html2pdf().set(opt).from(container).save();
    }
</script>
@include('partials.theme-script')
</body>
</html>
