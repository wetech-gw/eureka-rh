@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">BOOST_ME — Acelerador de Empresas</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — gestão da secção BOOST_ME do site público</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        <a href="{{ route('admin.boost.create') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
            + Novo Registo
        </a>
    </div>
</div>

<div class="card-custom shadow-sm bg-white p-4">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                    <th class="pb-3">#</th>
                    <th class="pb-3">Imagem</th>
                    <th class="pb-3">Título</th>
                    <th class="pb-3">Descrição</th>
                    <th class="pb-3">Estado</th>
                    <th class="pb-3 text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($boosts as $boost)
                    <tr class="border-bottom">
                        <td class="py-3 text-muted">#{{ $boost->id }}</td>
                        <td class="py-3">
                            @if($boost->image_path)
                                <img src="{{ asset('storage/' . $boost->image_path) }}" alt="Imagem do BOOST_ME" style="width: 64px; height: 44px; object-fit: cover; border-radius: 8px; border: 1px solid #e9ecef;">
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="fw-bold text-dark">{{ $boost->title ?: 'BOOST_ME — Acelerador de Empresas' }}</div>
                            @if($boost->eyebrow)
                                <div class="text-muted small">{{ $boost->eyebrow }}</div>
                            @endif
                        </td>
                        <td class="py-3 text-secondary" style="max-width: 360px;">{{ Str::limit(strip_tags($boost->description), 100) }}</td>
                        <td class="py-3">
                            @if($boost->is_active)
                                <span class="badge px-3 py-1.5 rounded-5 fw-medium text-success" style="background-color: #e6fdfa;">Ativo</span>
                            @else
                                <span class="badge px-3 py-1.5 rounded-5 fw-medium text-secondary" style="background-color: #f1f3f5; color: #495057;">Inativo</span>
                            @endif
                        </td>
                        <td class="py-3 text-end">
                            <a href="{{ route('admin.boost.edit', $boost) }}" class="btn btn-sm btn-outline-secondary rounded-3">Editar</a>
                            <form action="{{ route('admin.boost.destroy', $boost) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Eliminar este registo BOOST_ME?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Ainda não existem registos BOOST_ME. Adicione o primeiro.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
