<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecrutamentoController extends Controller
{
    // Exibir a página com o formulário e a listagem
    public function index()
    {
        // Procura todas as vagas na tabela do banco de dados
        $recrutamentos = DB::table('recrutamentos')->orderBy('id', 'desc')->get();

        return view('recrutamento', compact('recrutamentos'));
    }

    public function alterarEstado(Request $request, $id)
    {
        // 1. Valida a coluna correta que é 'status'
        $request->validate([
            'status' => 'required|in:Ativo,Expirado,Inativo'
        ]);

        // 2. Atualiza a base de dados usando 'status' e recebe o valor correto da Request
        DB::table('recrutamentos')
            ->where('id', $id)
            ->update(['status' => $request->status]); // Alinhado com a base de dados

        return redirect()->back()->with('success', 'Estado da vaga atualizado com sucesso!');
    }

    // Gravar a nova vaga enviada pelo formulário
    public function store(Request $request)
    {
        $request->validate([
            'titulo_vaga' => 'required|string|max:255',
            'departamento' => 'required|string',
            'tipo_contrato' => 'required|string',
            'vagas_disponiveis' => 'required|integer|min:1',
            'descricao_vaga' => 'required|string',
            'requisitos' => 'required|string',
            'data_limite' => 'required|date',
        ]);

        DB::table('recrutamentos')->insert([
            'titulo_vaga' => $request->titulo_vaga,
            'departamento' => $request->departamento,
            'tipo_contrato' => $request->tipo_contrato,
            'vagas_disponiveis' => $request->vagas_disponiveis,
            'descricao_vaga' => $request->descricao_vaga,
            'requisitos' => $request->requisitos,
            'data_limite' => $request->data_limite,
            'status' => 'Ativo', // Aqui confirmamos que o nome da coluna é 'status'
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Vaga de recrutamento publicada com sucesso!');
    }

    public function apiIndex()
{
    // Faz a mesma busca da tua tabela de recrutamento
    $recrutamentos = DB::table('recrutamentos')
        ->orderBy('created_at', 'desc')
        ->get();

    // Devolve os dados puros em formato JSON com status 200 (Sucesso)
    return response()->json([
        'success' => true,
        'message' => 'Lista de recrutamentos recuperada com sucesso.',
        'data'    => $recrutamentos
    ], 200);
}
}