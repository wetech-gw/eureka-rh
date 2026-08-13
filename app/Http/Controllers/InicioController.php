<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InicioController extends Controller
{
    public function index()
    {
        $inicios = HeroSection::all();
        return view('admin.inicio.index', compact('inicios'));
    }

    public function create()
    {
        return view('admin.inicio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp,avif|max:10240',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('inicio', 'public');
        }

        HeroSection::create($validated);
        return redirect()->route('admin.inicio.index')->with('success', 'Secção Início criada com sucesso!');
    }

    public function edit(HeroSection $inicio)
    {
        return view('admin.inicio.edit', compact('inicio'));
    }

    public function update(Request $request, HeroSection $inicio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp,avif|max:10240',
        ]);

        if ($request->hasFile('image_path')) {
            if ($inicio->image_path) {
                Storage::disk('public')->delete($inicio->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('inicio', 'public');
        }

        $inicio->update($validated);
        return redirect()->route('admin.inicio.index')->with('success', 'Secção Início atualizada com sucesso!');
    }

    public function destroy(HeroSection $inicio)
    {
        if ($inicio->image_path) {
            Storage::disk('public')->delete($inicio->image_path);
        }
        $inicio->delete();
        return redirect()->route('admin.inicio.index')->with('success', 'Secção Início eliminada!');
    }
}