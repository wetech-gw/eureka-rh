<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BoostMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsActivity;

class BoostMeController extends Controller
{
    use LogsActivity;
    public function index()
    {
        $boosts = BoostMe::orderBy('id')->get();
        return view('admin.boost.index', compact('boosts'));
    }

    public function create()
    {
        return view('admin.boost.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'eyebrow' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:10240',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'cta1' => 'nullable|string|max:255',
            'cta2' => 'nullable|string|max:255',
            'cta3' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('boost', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        BoostMe::create($validated);
        $this->logActivity('create', 'BOOST_ME', null, 'Criou registo BOOST_ME');
        return redirect()->route('admin.boost.index')->with('success', 'Registo BOOST_ME criado com sucesso!');
    }

    public function edit(BoostMe $boost)
    {
        return view('admin.boost.edit', compact('boost'));
    }

    public function update(Request $request, BoostMe $boost)
    {
        $validated = $request->validate([
            'eyebrow' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:10240',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'cta1' => 'nullable|string|max:255',
            'cta2' => 'nullable|string|max:255',
            'cta3' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image_path')) {
            if ($boost->image_path) {
                Storage::disk('public')->delete($boost->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('boost', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $boost->update($validated);
        $this->logActivity('update', 'BOOST_ME', $boost->id, 'Atualizou registo BOOST_ME');
        return redirect()->route('admin.boost.index')->with('success', 'Registo BOOST_ME atualizado com sucesso!');
    }

    public function destroy(BoostMe $boost)
    {
        if ($boost->image_path) {
            Storage::disk('public')->delete($boost->image_path);
        }
        $boost->delete();
        $this->logActivity('delete', 'BOOST_ME', $boost->id, 'Eliminou registo BOOST_ME');
        return redirect()->route('admin.boost.index')->with('success', 'Registo BOOST_ME eliminado!');
    }
}
