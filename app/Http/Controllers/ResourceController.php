<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsActivity;

class ResourceController extends Controller
{
    use LogsActivity;
    public function index()
    {
        $recursos = Resource::all();
        return view('admin.recursos.index', compact('recursos'));
    }

    public function create()
    {
        return view('admin.recursos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'link' => 'nullable|url',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('logo_path')) {
            $validated['logo_path'] = $request->file('logo_path')->store('recursos', 'public');
        }

        Resource::create($validated);
        $this->logActivity('create', 'Recurso', null, 'Adicionou recurso/instituição');
        return redirect()->route('admin.recursos.index')->with('success', 'Recurso adicionado com sucesso!');
    }

    public function edit(Resource $recurso)
    {
        return view('admin.recursos.edit', compact('recurso'));
    }

    public function update(Request $request, Resource $recurso)
    {
        $validated = $request->validate([
            'link' => 'nullable|url',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('logo_path')) {
            if ($recurso->logo_path) {
                Storage::disk('public')->delete($recurso->logo_path);
            }
            $validated['logo_path'] = $request->file('logo_path')->store('recursos', 'public');
        }

        $recurso->update($validated);
        $this->logActivity('update', 'Recurso', $recurso->id, 'Atualizou recurso/instituição');
        return redirect()->route('admin.recursos.index')->with('success', 'Recurso atualizado com sucesso!');
    }

    public function destroy(Resource $recurso)
    {
        if ($recurso->logo_path) {
            Storage::disk('public')->delete($recurso->logo_path);
        }
        $recurso->delete();
        $this->logActivity('delete', 'Recurso', $recurso->id, 'Eliminou recurso/instituição');
        return redirect()->route('admin.recursos.index')->with('success', 'Recurso eliminado!');
    }
}