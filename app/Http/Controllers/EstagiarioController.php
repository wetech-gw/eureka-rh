<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\LogsActivity;

class EstagiarioController extends Controller
{
    use LogsActivity;
    public function index(Request $request)
    {
        $query = DB::table('estagiarios')->orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('nome', 'like', "%{$q}%")
                    ->orWhere('instituicao_ensino', 'like', "%{$q}%")
                    ->orWhere('curso', 'like', "%{$q}%")
                    ->orWhere('departamento', 'like', "%{$q}%")
                    ->orWhere('supervisor_responsavel', 'like', "%{$q}%");
            });
        }

        $estagiarios = $query->get();

        return view('estagiarios.index', [
            'estagiarios' => $estagiarios,
            'totalEstagiarios' => $estagiarios->count(),
            'ativos' => $estagiarios->where('status', 'Ativo')->count(),
            'concluidos' => $estagiarios->where('status', 'Concluído')->count(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:30',
            'instituicao_ensino' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
            'supervisor_responsavel' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'plano_atividades' => 'nullable|string',
            'pontuacao_estrelas' => 'nullable|integer|min:1|max:5',
            'avaliacao_desempenho' => 'nullable|string',
            'status' => 'required|in:Ativo,Concluído,Suspenso',
            'arquivo_certificado' => 'nullable|file|mimes:pdf|max:4096',
        ]);

        $path = null;
        if ($request->hasFile('arquivo_certificado')) {
            $path = $request->file('arquivo_certificado')->store('certificados-estagio', 'public');
        }

        DB::table('estagiarios')->insert([
            'nome' => $data['nome'],
            'email' => $data['email'] ?? null,
            'telefone' => $data['telefone'] ?? null,
            'instituicao_ensino' => $data['instituicao_ensino'],
            'curso' => $data['curso'],
            'supervisor_responsavel' => $data['supervisor_responsavel'],
            'departamento' => $data['departamento'],
            'data_inicio' => $data['data_inicio'],
            'data_fim' => $data['data_fim'],
            'plano_atividades' => $data['plano_atividades'] ?? null,
            'avaliacao_desempenho' => $this->montarAvaliacao($data['pontuacao_estrelas'] ?? null, $data['avaliacao_desempenho'] ?? null),
            'arquivo_certificado' => $path,
            'status' => $data['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->logActivity('create', 'Estagiário', null, 'Registou estagiário ' . $data['nome']);

        return redirect()->route('estagiarios.index')->with('success', 'Estagiário registado com sucesso!');
    }

    public function update(Request $request, int $id)
    {
        $estagiario = DB::table('estagiarios')->where('id', $id)->first();
        if (!$estagiario) {
            return redirect()->route('estagiarios.index')->withErrors(['geral' => 'Estagiário não encontrado.']);
        }

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:30',
            'instituicao_ensino' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
            'supervisor_responsavel' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'plano_atividades' => 'nullable|string',
            'pontuacao_estrelas' => 'nullable|integer|min:1|max:5',
            'avaliacao_desempenho' => 'nullable|string',
            'status' => 'required|in:Ativo,Concluído,Suspenso',
            'arquivo_certificado' => 'nullable|file|mimes:pdf|max:4096',
        ]);

        $path = $estagiario->arquivo_certificado;
        if ($request->hasFile('arquivo_certificado')) {
            $path = $request->file('arquivo_certificado')->store('certificados-estagio', 'public');
        }

        DB::table('estagiarios')
            ->where('id', $id)
            ->update([
                'nome' => $data['nome'],
                'email' => $data['email'] ?? null,
                'telefone' => $data['telefone'] ?? null,
                'instituicao_ensino' => $data['instituicao_ensino'],
                'curso' => $data['curso'],
                'supervisor_responsavel' => $data['supervisor_responsavel'],
                'departamento' => $data['departamento'],
                'data_inicio' => $data['data_inicio'],
                'data_fim' => $data['data_fim'],
                'plano_atividades' => $data['plano_atividades'] ?? null,
                'avaliacao_desempenho' => $this->montarAvaliacao($data['pontuacao_estrelas'] ?? null, $data['avaliacao_desempenho'] ?? null),
                'arquivo_certificado' => $path,
                'status' => $data['status'],
                'updated_at' => now(),
            ]);

        $this->logActivity('update', 'Estagiário', $id, 'Atualizou estagiário ' . $data['nome']);

        return redirect()->route('estagiarios.index')->with('success', 'Estagiário atualizado com sucesso!');
    }

    private function montarAvaliacao(?int $pontuacao, ?string $texto): ?string
    {
        $texto = trim((string) $texto);
        if (!$pontuacao && $texto === '') {
            return null;
        }

        $prefixo = $pontuacao ? "Pontuação: {$pontuacao}/5 estrelas" : 'Pontuação: N/A';
        return $texto !== '' ? $prefixo . ' - ' . $texto : $prefixo;
    }
}
