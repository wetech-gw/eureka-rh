<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidatoController extends Controller
{
    public function index()
    {
        // 1. Consulta à base de dados usando 'status' (como está real na DB)
        $candidaturas = DB::table('candidaturas')
            ->join('candidatos', 'candidaturas.candidato_id', '=', 'candidatos.id')
            ->join('recrutamentos', 'candidaturas.vaga_id', '=', 'recrutamentos.id')
            ->select(
                'candidaturas.id as candidatura_id',
                'candidatos.nome as candidato_nome',
                'candidatos.email as candidato_email',
                'candidatos.telefone as candidato_telefone',
                'recrutamentos.titulo_vaga as vaga_titulo',
                'candidaturas.created_at as data_candidatura',
                'candidaturas.cv_arquivo as cv_especifico',
                'candidaturas.status' // Voltamos para 'status' porque é o que existe na DB
            )
            ->get();

        // 2. Buscar as vagas para o select/filtro
        $vagas = DB::table('recrutamentos')->select('id', 'titulo_vaga as titulo')->get();

    // 3. Contagens
        $totalCandidatos = $candidaturas->count();
        $totalPendentes = $candidaturas->where('status', 'Pendente')->count();

        // 4. Retorno direto para o ficheiro candidatos.blade.php
        return view('candidatos.index', compact('candidaturas', 'vagas', 'totalCandidatos', 'totalPendentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vaga_id'    => 'required', // Este ID virá da tabela recrutamentos agora
            'nome'       => 'required|string|max:255',
            'email'      => 'required|email',
            'telefone'   => 'required|string',
            'cv_arquivo' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $caminhoArquivo = null;
        if ($request->hasFile('cv_arquivo')) {
            $caminhoArquivo = $request->file('cv_arquivo')->store('cvs', 'public');
        }

        // Insere ou atualiza o candidato
        DB::table('candidatos')->updateOrInsert(
            ['email' => $request->email],
            [
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $candidato = DB::table('candidatos')->where('email', $request->email)->first();

        // Liga o candidato ao recrutamento (vaga_id)
    // Modifica apenas esta parte dentro do DB::table('candidaturas')->insert([...])
    DB::table('candidaturas')->insert([
        'vaga_id'      => $request->vaga_id,
        'candidato_id' => $candidato->id,
        'cv_arquivo'   => $caminhoArquivo,
        'status'       => 'pendente', // <-- MUDA DE 'Pendente' PARA 'pendente' (minúsculas)
        'created_at'   => now(),
        'updated_at'   => now()
    ]);

        return redirect()->route('candidatos.index')->with('success', 'Candidatura registada com sucesso!');
    }

    public function update(Request $request, $id)
    {
        // 1. Validar os dados recebidos do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'telefone' => 'required|string',
            'status' => 'required|in:Pendente,Aceito,Rejeitado',
        ]);

        // 2. Descobrir qual é o candidato_id associado a esta candidatura
        $candidatura = DB::table('candidaturas')->where('id', $id)->first();

        if ($candidatura) {
            // 3. Atualizar a tabela de Candidatos
            DB::table('candidatos')
                ->where('id', $candidatura->candidato_id)
                ->update([
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'telefone' => $request->telefone,
                    'updated_at' => now()
                ]);

            // 4. Atualizar o estado na tabela de Candidaturas
            DB::table('candidaturas')
                ->where('id', $id)
                ->update([
                    'status' => $request->status,
                    'updated_at' => now()
                ]);
        }

            return redirect()->back()->with('success', 'Dados do candidato editados com sucesso!');
        }
    public function alterarStatus(Request $request, $id)
    {
        // 1. Validar se o status enviado é um dos permitidos
        $request->validate([
            'status' => 'required|string|in:Aceito,Rejeitado,Pendente,Lista de Espera'
        ]);

        // 2. Atualizar o status diretamente na tabela de candidaturas
        DB::table('candidaturas')
            ->where('id', $id)
            ->update([
                'status' => $request->input('status') // Garante que atualiza a coluna ativa na BD
            ]);

        // 3. Redirecionar de volta para a listagem com uma mensagem de sucesso
        return redirect()->route('candidatos.index')->with('success', 'Estado da candidatura atualizado com sucesso!');
    }
}