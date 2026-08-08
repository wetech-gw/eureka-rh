<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $noticias = News::orderBy('published_at', 'desc')->get();
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('admin.noticias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('noticias', 'public');
        }

        News::create($validated);
        return redirect()->route('admin.noticias.index')->with('success', 'Notícia publicada com sucesso!');
    }

    public function edit(News $noticia) // Usando o model bind direto
    {
        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, News $noticia)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            if ($noticia->image_path) {
                Storage::disk('public')->delete($noticia->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('noticias', 'public');
        }

        $noticia->update($validated);
        return redirect()->route('admin.noticias.index')->with('success', 'Notícia atualizada com sucesso!');
    }

    public function destroy(News $noticia)
    {
        if ($noticia->image_path) {
            Storage::disk('public')->delete($noticia->image_path);
        }
        $noticia->delete();
        return redirect()->route('admin.noticias.index')->with('success', 'Notícia eliminada!');
    }
}