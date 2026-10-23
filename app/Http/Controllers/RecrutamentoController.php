<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Support\RequisitoVaga;
use App\Services\SmsService;
use App\Traits\LogsActivity;

class RecrutamentoController extends Controller
{
    use LogsActivity;
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

    public function index()
    {
        $this->expirarVagas();

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

        $vaga = DB::table('recrutamentos')->where('id', $id)->first();
        $this->logActivity('status', 'Recrutamento', $id, 'Mudou estado da vaga ' . ($vaga->titulo_vaga ?? '#'.$id) . ' para ' . $request->status);

        return redirect()->back()->with('success', 'Estado da vaga atualizado com sucesso!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo_vaga' => 'required|string|max:255',
            'departamento' => 'required|string',
            'tipo_contrato' => 'required|string',
            'vagas_disponiveis' => 'required|integer|min:1',
            'requisitos' => 'required|string',
            'data_limite' => 'required|date',
            'termo_referencia' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $caminhoTermo = null;
        if ($request->hasFile('termo_referencia')) {
            $caminhoTermo = $request->file('termo_referencia')->store('termos-referencia', 'public');
        }

        DB::table('recrutamentos')->insert([
            'titulo_vaga' => $request->titulo_vaga,
            'departamento' => $request->departamento,
            'tipo_contrato' => $request->tipo_contrato,
            'vagas_disponiveis' => $request->vagas_disponiveis,
            'descricao_vaga' => '',
            'requisitos' => $request->requisitos,
            'termo_referencia' => $caminhoTermo,
            'data_limite' => $request->data_limite,
            'status' => 'Ativo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $this->logActivity('create', 'Recrutamento', null, 'Criou vaga: ' . $request->titulo_vaga);

        return redirect()->back()->with('success', 'Vaga de recrutamento publicada com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $vaga = DB::table('recrutamentos')->where('id', $id)->first();

        if (!$vaga) {
            return redirect()->back()->with('error', 'Vaga de recrutamento não encontrada.');
        }

        $request->validate([
            'titulo_vaga' => 'required|string|max:255',
            'departamento' => 'required|string',
            'tipo_contrato' => 'required|string',
            'vagas_disponiveis' => 'required|integer|min:1',
            'requisitos' => 'required|string',
            'data_limite' => 'required|date',
            'termo_referencia' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $caminhoTermo = $vaga->termo_referencia;
        if ($request->hasFile('termo_referencia')) {
            if ($caminhoTermo) {
                Storage::disk('public')->delete($caminhoTermo);
            }
            $caminhoTermo = $request->file('termo_referencia')->store('termos-referencia', 'public');
        }

        DB::table('recrutamentos')->where('id', $id)->update([
            'titulo_vaga' => $request->titulo_vaga,
            'departamento' => $request->departamento,
            'tipo_contrato' => $request->tipo_contrato,
            'vagas_disponiveis' => $request->vagas_disponiveis,
            'requisitos' => $request->requisitos,
            'termo_referencia' => $caminhoTermo,
            'data_limite' => $request->data_limite,
            'updated_at' => Carbon::now(),
        ]);

        $this->logActivity('update', 'Recrutamento', $id, 'Atualizou a vaga: ' . $request->titulo_vaga);

        return redirect()->back()->with('success', 'Vaga de recrutamento atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $vaga = DB::table('recrutamentos')->where('id', $id)->first();

        if (!$vaga) {
            return redirect()->back()->with('error', 'Vaga de recrutamento não encontrada.');
        }

        if ($vaga->termo_referencia) {
            Storage::disk('public')->delete($vaga->termo_referencia);
        }

        DB::table('recrutamentos')->where('id', $id)->delete();

        $this->logActivity('delete', 'Recrutamento', $id, 'Apagou a vaga: ' . $vaga->titulo_vaga);

        return redirect()->back()->with('success', 'Vaga de recrutamento apagada com sucesso!');
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
            'cv_arquivo' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'carta_motivacao_arquivo' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
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

        // Enviar SMS de confirmação
        $numero = preg_replace('/[^0-9+]/', '', $request->telefone);
        SmsService::enviar(
            $numero,
            'Eureka Consulting: A sua candidatura para a vaga "' . ($vaga->titulo_vaga ?? '') . '" foi registada com sucesso. Entraremos em contacto brevemente.'
        );

        return redirect()->back()->with('success', 'Candidatura registada com sucesso! A sua candidatura está em análise.');
    }

    public function apiIndex()
    {
        $this->expirarVagas();

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