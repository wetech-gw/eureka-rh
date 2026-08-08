@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Recursos</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — instituições de apoio ao empreendedorismo</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        <a href="{{ route('admin.recursos.create') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
            + Novo Recurso
        </a>
    </div>
</div>

<div class="card-custom shadow-sm bg-white p-4">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                    <th class="pb-3">Sigla</th>
                    <th class="pb-3">Nome</th>
                    <th class="pb-3">Descrição</th>
                    <th class="pb-3">Link</th>
                    <th class="pb-3 text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recursos as $recurso)
                    <tr class="border-bottom">
                        <td class="py-3">
                            <span style="font-family: serif; font-weight: 700; color: #0d9488; padding: 6px 10px; border: 1.5px solid #ccfbf1; border-radius: 8px; font-size: 13px;">
                                {{ Str::upper(Str::limit($recurso->title, 6, '')) }}
                            </span>
                        </td>
                        <td class="py-3">
                            <div class="fw-bold text-dark">{{ $recurso->title }}</div>
                        </td>
                        <td class="py-3 text-secondary" style="max-width: 320px;">{{ Str::limit($recurso->description, 90) }}</td>
                        <td class="py-3">
                            @if($recurso->link)
                                <a href="{{ $recurso->link }}" target="_blank" rel="noopener" class="text-accent small text-decoration-none">Visitar →</a>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="py-3 text-end">
                            <a href="{{ route('admin.recursos.edit', $recurso) }}" class="btn btn-sm btn-outline-secondary rounded-3">Editar</a>
                            <form action="{{ route('admin.recursos.destroy', $recurso) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Eliminar este recurso?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Ainda não existem recursos registados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
