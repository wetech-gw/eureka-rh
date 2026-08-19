<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;

class ServiceController extends Controller
{
    use LogsActivity;
    public function index()
    {
        $services = Service::all();
        return view('admin.servicos.index', compact('services'));
    }

    public function create()
    {
        return view('admin.servicos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string', // Ex: código SVG ou classe FontAwesome
            'is_featured' => 'boolean'
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        Service::create($validated);
        $this->logActivity('create', 'Serviço', null, 'Criou serviço: ' . $request->title);
        return redirect()->route('admin.servicos.index')->with('success', 'Serviço adicionado com sucesso!');
    }

    public function edit(Service $servico)
    {
        return view('admin.servicos.edit', compact('servico'));
    }

    public function update(Request $request, Service $servico)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'is_featured' => 'boolean'
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        $servico->update($validated);
        $this->logActivity('update', 'Serviço', $servico->id, 'Atualizou serviço: ' . $request->title);
        return redirect()->route('admin.servicos.index')->with('success', 'Serviço atualizado com sucesso!');
    }

    public function destroy(Service $servico)
    {
        $servico->delete();
        $this->logActivity('delete', 'Serviço', $servico->id, 'Eliminou serviço');
        return redirect()->route('admin.servicos.index')->with('success', 'Serviço eliminado!');
    }
}