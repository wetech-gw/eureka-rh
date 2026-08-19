@extends('layouts.app')

@section('title', 'Atividade Recente')

@section('content')
<div class="d-flex">

    @include('partials.sidebar')

    <main class="main-content flex-grow-1 p-5">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold m-0 text-dark">Atividade Recente</h2>
        <p class="text-muted mb-0">Registo de todas as ações realizadas no sistema</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card-custom p-4">
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-6">
            <input type="text" name="busca" class="form-control" placeholder="Pesquisar por descrição, utilizador ou tipo..." value="{{ request('busca') }}">
        </div>
        <div class="col-md-3">
            <select name="acao" class="form-select">
                <option value="">Todas as ações</option>
                <option value="create" {{ request('acao') == 'create' ? 'selected' : '' }}>Criação</option>
                <option value="update" {{ request('acao') == 'update' ? 'selected' : '' }}>Edição</option>
                <option value="delete" {{ request('acao') == 'delete' ? 'selected' : '' }}>Eliminação</option>
                <option value="status" {{ request('acao') == 'status' ? 'selected' : '' }}>Mudança de Estado</option>
            </select>
        </div>
        <div class="col-md-3 d-grid">
            <button type="submit" class="btn btn-outline-secondary">Filtrar</button>
        </div>
    </form>

    @if($registos->count() > 0)
        <div class="table-scrollable-container">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Utilizador</th>
                        <th>Ação</th>
                        <th>Descrição</th>
                        <th>Data / Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registos as $registo)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold text-secondary" style="width:32px; height:32px; font-size: 12px;">
                                        {{ strtoupper(substr($registo->user->name ?? '?', 0, 2)) }}
                                    </div>
                                    <span class="fw-bold text-dark">{{ $registo->user->name ?? 'Sistema' }}</span>
                                </div>
                            </td>
                            <td>
                                @if($registo->action == 'create')
                                    <span class="badge px-3 py-1.5 rounded-5 fw-medium" style="background-color: #d1e7dd; color: #0f5132;">Criação</span>
                                @elseif($registo->action == 'update')
                                    <span class="badge px-3 py-1.5 rounded-5 fw-medium" style="background-color: #cff4fc; color: #055160;">Edição</span>
                                @elseif($registo->action == 'delete')
                                    <span class="badge bg-danger-subtle text-danger px-3 py-1.5 rounded-5 fw-medium">Eliminação</span>
                                @elseif($registo->action == 'status')
                                    <span class="badge px-3 py-1.5 rounded-5 fw-medium" style="background-color: #fff8e1; color: #b78103;">Estado</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-1.5 rounded-5 fw-medium">{{ $registo->action }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-dark">{{ $registo->description }}</span>
                                @if($registo->subject_type)
                                    <br><small class="text-muted">{{ $registo->subject_type }}{{ $registo->subject_id ? ' #' . $registo->subject_id : '' }}</small>
                                @endif
                            </td>
                            <td class="text-muted small">{{ $registo->created_at ? $registo->created_at->diffForHumans() : '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $registos->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fa-solid fa-clock-rotate-left fa-2x mb-3" style="color: #d1d5db;"></i>
            <p class="text-muted mb-0">Nenhuma atividade registada.</p>
        </div>
    @endif
</div>

    </main>
</div>
@endsection
