<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecrutamentoController extends Controller
{
    public function index()
    {
        $recrutamentos = DB::table('recrutamentos')->orderBy('id', 'desc')->get();
        $formacoes = DB::table('formacoes')->orderBy('data_inicio', 'desc')->get();

        return view('recrutamento', compact('recrutamentos', 'formacoes'));
    }

    public function alterarEstado(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Ativo,Expirado,Inativo'
        ]);

        DB::table('recrutamentos')
            ->where('id', $id)
            ->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Estado da vaga atualizado com sucesso!');
    }

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
            'status' => 'Ativo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Vaga de recrutamento publicada com sucesso!');
    }

    public function candidatar(Request $request)
    {
        $request->validate([
            'vaga_id' => 'required|exists:recrutamentos,id',
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:50',
            'profissao' => 'nullable|string|max:255',
            'nivel_academico' => 'nullable|string|max:120',
            'anos_experiencia' => 'nullable|integer|min:0|max:80',
            'competencias' => 'nullable|string',
            'localizacao' => 'nullable|string|max:255',
            'cv_arquivo' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $caminhoArquivo = null;
        if ($request->hasFile('cv_arquivo')) {
            $caminhoArquivo = $request->file('cv_arquivo')->store('cvs', 'public');
        }

        DB::table('candidatos')->updateOrInsert(
            ['email' => $request->email],
            [
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'profissao' => $request->profissao,
                'nivel_academico' => $request->nivel_academico,
                'anos_experiencia' => $request->anos_experiencia,
                'competencias' => $request->competencias,
                'localizacao' => $request->localizacao,
                'updated_at' => now(),
                'created_at' => now(),
            ],
        );

        $candidato = DB::table('candidatos')
            ->where('email', $request->email)
            ->first();

        DB::table('candidaturas')->insert([
            'vaga_id' => $request->vaga_id,
            'candidato_id' => $candidato->id,
            'cv_arquivo' => $caminhoArquivo,
            'status' => 'Pendente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Candidatura registada com sucesso! A sua candidatura está em análise.');
    }

    public function apiIndex()
    {
        $recrutamentos = DB::table('recrutamentos')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Lista de recrutamentos recuperada com sucesso.',
            'data'    => $recrutamentos
        ], 200);
    }
}