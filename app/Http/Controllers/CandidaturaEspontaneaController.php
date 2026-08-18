<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CandidaturaEspontanea;

class CandidaturaEspontaneaController extends Controller
{
    public function index(Request $request)
    {
        $query = CandidaturaEspontanea::query();

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('nome', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('profissao', 'like', "%{$q}%")
                    ->orWhere('competencias', 'like', "%{$q}%")
                    ->orWhere('localizacao', 'like', "%{$q}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('nivel_academico')) {
            $query->where('nivel_academico', $request->nivel_academico);
        }

        $registos = $query->orderByDesc('created_at')->get();

        $total = $registos->count();
        $pendentes = $registos->where('status', 'Pendente')->count();
        $avaliados = $registos->where('status', 'Em Avaliação')->count();
        $aceites = $registos->where('status', 'Aceito')->count();
        $rejeitados = $registos->where('status', 'Rejeitado')->count();

        return view('candidaturas-espontaneas.index', compact(
            'registos', 'total', 'pendentes', 'avaliados', 'aceites', 'rejeitados'
        ));
    }

    public function alterarStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pendente,Em Avaliação,Aceito,Rejeitado,Lista de Espera',
        ]);

        CandidaturaEspontanea::where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('candidaturas-espontaneas.index')
            ->with('success', 'Estado atualizado com sucesso!');
    }

    public function destroy($id)
    {
        CandidaturaEspontanea::where('id', $id)->delete();

        return redirect()->route('candidaturas-espontaneas.index')
            ->with('success', 'Registo eliminado com sucesso!');
    }
}
