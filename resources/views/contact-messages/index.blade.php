@extends('layouts.app')

@section('content')
<div class="d-flex">

    @include('partials.sidebar')

    <main class="main-content flex-grow-1 p-5">

        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h1 class="font-serif display-5 fw-normal mb-1">Mensagens de Contacto</h1>
                <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — mensagens recebidas pelo formulário do site</p>
            </div>
            <span class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; height: 38px; display: flex; align-items: center; gap: 6px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                {{ $naoLidas }} {{ $naoLidas == 1 ? 'nova' : 'novas' }}
            </span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        @if($mensagens->count() > 0)
            <div class="card-custom shadow-sm bg-white p-4">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                                <th class="pb-3">Nome</th>
                                <th class="pb-3">Contacto</th>
                                <th class="pb-3">Assunto</th>
                                <th class="pb-3">Data</th>
                                <th class="pb-3 text-center">Estado</th>
                                <th class="pb-3 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mensagens as $m)
                                <tr class="border-bottom {{ is_null($m->read_at) ? 'fw-medium' : '' }}">
                                    <td class="py-3">
                                        <div class="text-dark">{{ $m->nome }}</div>
                                        @if($m->empresa)
                                            <span class="text-muted small">{{ $m->empresa }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        <div class="text-secondary">{{ $m->email }}</div>
                                        @if($m->telefone)
                                            <span class="text-muted small">{{ $m->telefone }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-secondary">{{ $m->assunto ?: '—' }}</td>
                                    <td class="py-3 text-secondary small">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-center py-3">
                                        @if(is_null($m->read_at))
                                            <span class="badge px-3 py-1.5 rounded-5 fw-medium text-warning" style="background-color: #fff8e1; color: #b78103 !important;">Nova</span>
                                        @else
                                            <span class="badge px-3 py-1.5 rounded-5 fw-medium" style="background-color: #e6fdfa; color: #0f5132;">Lida</span>
                                        @endif
                                    </td>
                                    <td class="text-end py-3">
                                        <div class="d-inline-flex gap-2">
                                            <button class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#modalVer{{ $m->id }}" title="Ver mensagem">
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </button>
                                            @if(Auth::user()->role !== 'CEO')
                                            <form action="{{ route('contact-messages.destroy', $m) }}" method="POST" onsubmit="return confirm('Eliminar esta mensagem?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light border text-danger" title="Eliminar">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="card-custom shadow-sm bg-white p-5 text-center">
                <p class="text-muted mb-0">Ainda não existem mensagens de contacto.</p>
            </div>
        @endif

        @foreach($mensagens as $m)
            <div class="modal fade" id="modalVer{{ $m->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 12px;">
                        <div class="modal-header text-white" style="background-color: var(--accent);">
                            <h6 class="modal-title fw-bold m-0">Mensagem de {{ $m->nome }}</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body p-3" style="font-size: 13px;">
                            <div class="row g-3">
                                <div class="col-md-6"><strong>Nome:</strong> <span class="text-secondary">{{ $m->nome }}</span></div>
                                <div class="col-md-6"><strong>Empresa:</strong> <span class="text-secondary">{{ $m->empresa ?: '—' }}</span></div>
                                <div class="col-md-6"><strong>Email:</strong> <span class="text-secondary">{{ $m->email }}</span></div>
                                <div class="col-md-6"><strong>Telefone:</strong> <span class="text-secondary">{{ $m->telefone ?: '—' }}</span></div>
                                <div class="col-md-6"><strong>Assunto:</strong> <span class="text-secondary">{{ $m->assunto ?: '—' }}</span></div>
                                <div class="col-md-6"><strong>Serviço:</strong> <span class="text-secondary">{{ $m->servico ?: '—' }}</span></div>
                                <div class="col-12"><strong>Data:</strong> <span class="text-secondary">{{ $m->created_at->format('d/m/Y H:i') }}</span></div>
                                <hr class="my-1 text-muted">
                                <div class="col-12">
                                    <strong>Mensagem:</strong>
                                    <div class="text-secondary border rounded p-3 mt-1" style="white-space: pre-wrap; background-color: rgba(0,0,0,0.02);">{{ $m->mensagem }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer py-2">
                            @if(is_null($m->read_at))
                                <form action="{{ route('contact-messages.ler', $m) }}" method="POST" class="me-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-sm text-white px-3 rounded-3" style="background-color: var(--accent);">Marcar como lida</button>
                                </form>
                            @else
                                <span class="text-muted small me-auto">Lida</span>
                            @endif
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </main>
</div>
@endsection
