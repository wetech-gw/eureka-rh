@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Estatísticas do Hero</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — números apresentados na página inicial (10+ anos, 200+ clientes, etc.)</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        <a href="{{ route('admin.estatisticas.create') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
            + Nova Estatística
        </a>
    </div>
</div>

<div class="card-custom shadow-sm bg-white p-4">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                    <th class="pb-3">#</th>
                    <th class="pb-3">Valor</th>
                    <th class="pb-3">Sufixo</th>
                    <th class="pb-3">Rótulo</th>
                    <th class="pb-3">Ordem</th>
                    <th class="pb-3 text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stats as $stat)
                    <tr class="border-bottom">
                        <td class="py-3 text-muted">#{{ $stat->id }}</td>
                        <td class="py-3">
                            <span class="fw-bold text-dark" style="font-size: 20px;">{{ $stat->value }}</span>
                        </td>
                        <td class="py-3 text-secondary">{{ $stat->suffix }}</td>
                        <td class="py-3">{{ Str::limit($stat->label, 60) }}</td>
                        <td class="py-3 text-muted">{{ $stat->sort_order }}</td>
                        <td class="py-3 text-end">
                            <a href="{{ route('admin.estatisticas.edit', $stat) }}" class="btn btn-sm btn-outline-secondary rounded-3">Editar</a>
                            <form action="{{ route('admin.estatisticas.destroy', $stat) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Eliminar esta estatística?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Ainda não existem estatísticas. Adicione as primeiras (ex.: 10+, anos de experiência).</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
