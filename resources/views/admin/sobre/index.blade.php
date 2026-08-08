@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Página Sobre</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — conteúdo da secção "Sobre nós"</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        <a href="{{ route('admin.sobre.create') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
            + Novo Conteúdo
        </a>
    </div>
</div>

<div class="card-custom shadow-sm bg-white p-4">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                    <th class="pb-3">ID</th>
                    <th class="pb-3">Imagem</th>
                    <th class="pb-3">Título</th>
                    <th class="pb-3">Descrição</th>
                    <th class="pb-3 text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sobres as $sobre)
                    <tr class="border-bottom">
                        <td class="py-3 text-muted">#{{ $sobre->id }}</td>
                        <td class="py-3">
                            @if($sobre->image_path)
                                <img src="{{ asset('storage/' . $sobre->image_path) }}" alt="" style="width: 60px; height: 40px; object-fit: cover; border-radius: 6px;">
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="fw-bold text-dark" style="max-width: 280px;">{{ Str::limit($sobre->title, 60) }}</div>
                        </td>
                        <td class="py-3 text-secondary" style="max-width: 320px;">{{ Str::limit($sobre->description, 80) }}</td>
                        <td class="py-3 text-end">
                            <a href="{{ route('admin.sobre.edit', $sobre) }}" class="btn btn-sm btn-outline-secondary rounded-3">Editar</a>
                            <form action="{{ route('admin.sobre.destroy', $sobre) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Eliminar este conteúdo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Ainda não existe conteúdo para a secção Sobre.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
