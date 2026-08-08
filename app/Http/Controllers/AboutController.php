<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $sobres = About::orderBy('id')->get();
        return view('admin.sobre.index', compact('sobres'));
    }

    public function create()
    {
        return view('admin.sobre.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('sobre', 'public');
        }

        About::create($validated);
        return redirect()->route('admin.sobre.index')->with('success', 'Página Sobre criada com sucesso!');
    }

    public function edit(About $sobre)
    {
        return view('admin.sobre.edit', compact('sobre'));
    }

    public function update(Request $request, About $sobre)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            if ($sobre->image_path) {
                Storage::disk('public')->delete($sobre->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('sobre', 'public');
        }

        $sobre->update($validated);
        return redirect()->route('admin.sobre.index')->with('success', 'Página Sobre atualizada com sucesso!');
    }

    public function destroy(About $sobre)
    {
        if ($sobre->image_path) {
            Storage::disk('public')->delete($sobre->image_path);
        }
        $sobre->delete();
        return redirect()->route('admin.sobre.index')->with('success', 'Página Sobre eliminada!');
    }
}
