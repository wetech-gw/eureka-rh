<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HeroStat;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;

class HeroStatController extends Controller
{
    use LogsActivity;
    public function index()
    {
        $stats = HeroStat::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.estatisticas.index', compact('stats'));
    }

    public function create()
    {
        return view('admin.estatisticas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:20',
            'suffix' => 'nullable|string|max:10',
            'label' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);

        HeroStat::create($validated);
        $this->logActivity('create', 'Estatística', null, 'Adicionou estatística: ' . $request->label);
        return redirect()->route('admin.estatisticas.index')->with('success', 'Estatística adicionada com sucesso!');
    }

    public function edit(HeroStat $estatistica)
    {
        return view('admin.estatisticas.edit', compact('estatistica'));
    }

    public function update(Request $request, HeroStat $estatistica)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:20',
            'suffix' => 'nullable|string|max:10',
            'label' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);

        $estatistica->update($validated);
        $this->logActivity('update', 'Estatística', $estatistica->id, 'Atualizou estatística: ' . $request->label);
        return redirect()->route('admin.estatisticas.index')->with('success', 'Estatística atualizada com sucesso!');
    }

    public function destroy(HeroStat $estatistica)
    {
        $estatistica->delete();
        $this->logActivity('delete', 'Estatística', $estatistica->id, 'Eliminou estatística');
        return redirect()->route('admin.estatisticas.index')->with('success', 'Estatística eliminada!');
    }
}
