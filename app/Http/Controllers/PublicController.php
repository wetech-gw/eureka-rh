<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Support\RequisitoVaga;

class PublicController extends Controller
{
    public function index()
    {
        return response()->file(public_path('index.html'));
    }

    // Expira automaticamente as vagas cuja data_limite já passou
    private function expirarVagas(): void
    {
        DB::table('recrutamentos')
            ->where('status', 'Ativo')
            ->where('data_limite', '<', Carbon::today()->toDateString())
            ->update([
                'status' => 'Expirado',
                'updated_at' => Carbon::now(),
            ]);
    }

    // Finaliza automaticamente as formações cuja data_fim já passou
    private function finalizarFormacoes(): void
    {
        DB::table('formacoes')
            ->where('status', '!=', 'Concluída')
            ->whereNotNull('data_fim')
            ->where('data_fim', '<', Carbon::today()->toDateString())
            ->update([
                'status' => 'Concluída',
                'updated_at' => Carbon::now(),
            ]);
    }

    public function vagasFormacoes()
    {
        $this->expirarVagas();
        $this->finalizarFormacoes();

        $hoje = now()->toDateString();

        $recrutamentos = DB::table('recrutamentos')
            ->where('status', 'Ativo')
            ->where('data_limite', '>=', $hoje)
            ->orderBy('id', 'desc')
            ->get();

        $formacoes = DB::table('formacoes')
            ->where('status', '!=', 'Concluída')
            ->orderBy('data_inicio', 'desc')
            ->get();

        return response()->json([
            'recrutamentos' => $recrutamentos,
            'formacoes' => $formacoes,
            'totais' => [
                'vagas' => $recrutamentos->count(),
                'formacoes' => $formacoes->count(),
                'em_curso' => $formacoes->where('status', 'Em Curso')->count(),
            ],
            '_token' => csrf_token(),
        ]);
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
            'carta_motivacao_arquivo' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $caminhoArquivo = null;
        if ($request->hasFile('cv_arquivo')) {
            $caminhoArquivo = $request->file('cv_arquivo')->store('cvs', 'public');
        }

        $caminhoCarta = null;
        if ($request->hasFile('carta_motivacao_arquivo')) {
            $caminhoCarta = $request->file('carta_motivacao_arquivo')->store('cartas-motivacao', 'public');
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

        $vaga = DB::table('recrutamentos')
            ->where('id', $request->vaga_id)
            ->first();

        $cumpreRequisitos = $vaga
            ? RequisitoVaga::cumpre($vaga->requisitos ?? '', ['anos_experiencia' => $request->anos_experiencia])
            : false;

        DB::table('candidaturas')->insert([
            'vaga_id' => $request->vaga_id,
            'candidato_id' => $candidato->id,
            'cv_arquivo' => $caminhoArquivo,
            'carta_motivacao_arquivo' => $caminhoCarta,
            'status' => $cumpreRequisitos ? 'Aceito' : 'Pendente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Candidatura registada com sucesso! Entraremos em contacto brevemente.',
            ]);
        }

        return redirect()->route('site.inicio')
            ->with('success', 'Candidatura registada com sucesso! Entraremos em contacto brevemente.');
    }
}
