<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FormacaoController extends Controller
{
    public function index(Request $request)
    {
        $formacoes = DB::table('formacoes')
            ->orderBy('data_inicio', 'desc')
            ->get();

        $totalFormacoes = $formacoes->count();
        $emAndamento = $formacoes->where('status', 'Em Curso')->count();
        $concluidas = $formacoes->where('status', 'Concluída')->count();

        return view('formacoes', compact('formacoes', 'totalFormacoes', 'emAndamento', 'concluidas'));
    }

    // 🟢 NOVO MÉTODO PARA PEGAR OS DADOS DO MODAL E SALVAR
    public function store(Request $request)
    {
        $request->validate([
            'tema'          => 'required|string|max:255',
            'entidade'      => 'required|string|max:255',
            'data_inicio'   => 'required|date',
            'data_fim'      => 'required|date|after_or_equal:data_inicio',
            'carga_horaria' => 'required|integer|min:1',
            'status'        => 'required|string'
        ]);

        DB::table('formacoes')->insert([
            'tema'          => $request->tema,
            'entidade'      => $request->entidade,
            'data_inicio'   => $request->data_inicio,
            'data_fim'      => $request->data_fim,
            'carga_horaria' => $request->carga_horaria,
            'status'        => $request->status,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Nova formação agendada e guardada no sistema!');
    }

    // 🟢 NOVO MÉTODO: Alterar o estado da formação dinamicamente
    public function alterarEstado(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Planeada,Em Curso,Concluída'
        ]);

        DB::table('formacoes')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Estado da formação atualizado com sucesso!');
    }

    public function apiIndex()
{
    // Faz a mesma busca da tua tabela de recrutamento
    $formacoes = DB::table('formacoes')
        ->orderBy('created_at', 'desc')
        ->get();

    // Devolve os dados puros em formato JSON com status 200 (Sucesso)
    return response()->json([
        'success' => true,
        'message' => 'Lista de formacoes recuperada com sucesso.',
        'data'    => $formacoes
    ], 200);
}
}