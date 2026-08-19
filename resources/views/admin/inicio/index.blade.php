@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Secção Início (Hero)</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — gestão do conteúdo da página inicial</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        @if(Auth::user()->role !== 'CEO')
        <a href="{{ route('admin.inicio.create') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
            + Nova Secção
        </a>
        @endif
    </div>
</div>

<div class="card-custom shadow-sm bg-white p-4">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                    <th class="pb-3">ID</th>
                    <th class="pb-3">Título</th>
                    <th class="pb-3">Subtítulo</th>
                    <th class="pb-3">Imagem</th>
                    <th class="pb-3 text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inicios as $inicio)
                    <tr class="border-bottom">
                        <td class="py-3 text-muted">#{{ $inicio->id }}</td>
                        <td class="py-3">
                            <div class="fw-bold text-dark">{{ Str::limit(strip_tags($inicio->title), 60) }}</div>
                        </td>
                        <td class="py-3 text-secondary">{{ Str::limit($inicio->subtitle, 50) }}</td>
                        <td class="py-3">
                            @if($inicio->image_path)
                                <img src="{{ asset('storage/' . $inicio->image_path) }}" alt="" style="width: 60px; height: 36px; object-fit: cover; border-radius: 6px;">
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="py-3 text-end">
                            @if(Auth::user()->role !== 'CEO')
                            <a href="{{ route('admin.inicio.edit', $inicio) }}" class="btn btn-sm btn-outline-secondary rounded-3">Editar</a>
                            <form action="{{ route('admin.inicio.destroy', $inicio) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Eliminar esta secção?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Eliminar</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Ainda não existe conteúdo para a secção Início.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
