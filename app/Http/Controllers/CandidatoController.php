<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ZipArchive;

class CandidatoController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table("candidaturas")
            ->join("candidatos", "candidaturas.candidato_id", "=", "candidatos.id")
            ->join("recrutamentos", "candidaturas.vaga_id", "=", "recrutamentos.id")
            ->select(
                "candidaturas.id as candidatura_id",
                "candidatos.id as candidato_id",
                "candidatos.nome as candidato_nome",
                "candidatos.email as candidato_email",
                "candidatos.telefone as candidato_telefone",
                "candidatos.profissao",
                "candidatos.nivel_academico",
                "candidatos.anos_experiencia",
                "candidatos.competencias",
                "candidatos.localizacao",
                "recrutamentos.titulo_vaga as vaga_titulo",
                "candidaturas.created_at as data_candidatura",
                "candidaturas.cv_arquivo as cv_especifico",
                "candidaturas.status",
            );

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('candidatos.nome', 'like', "%{$q}%")
                    ->orWhere('recrutamentos.titulo_vaga', 'like', "%{$q}%")
                    ->orWhere('candidatos.profissao', 'like', "%{$q}%")
                    ->orWhere('candidatos.competencias', 'like', "%{$q}%")
                    ->orWhere('candidatos.localizacao', 'like', "%{$q}%");
            });
        }

        if ($request->filled('profissao')) {
            $query->where('candidatos.profissao', 'like', '%' . trim($request->profissao) . '%');
        }

        if ($request->filled('nivel_academico')) {
            $query->where('candidatos.nivel_academico', $request->nivel_academico);
        }

        if ($request->filled('localizacao')) {
            $query->where('candidatos.localizacao', 'like', '%' . trim($request->localizacao) . '%');
        }

        if ($request->filled('anos_experiencia_min')) {
            $query->where('candidatos.anos_experiencia', '>=', (int) $request->anos_experiencia_min);
        }

        if ($request->filled('competencia')) {
            $query->where('candidatos.competencias', 'like', '%' . trim($request->competencia) . '%');
        }

        $candidaturas = $query->orderByDesc('candidaturas.created_at')->get();

        $vagas = DB::table("recrutamentos")
            ->select("id", "titulo_vaga as titulo")
            ->get();

        $totalCandidatos = $candidaturas->count();
        $totalPendentes = $candidaturas
            ->filter(fn($c) => strtolower($c->status) === "pendente")
            ->count();

        return view(
            "candidatos.index",
            compact(
                "candidaturas",
                "vagas",
                "totalCandidatos",
                "totalPendentes",
            ),
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            "vaga_id" => "required|exists:recrutamentos,id",
            "nome" => "required|string|max:255",
            "email" => "required|email|max:255",
            "telefone" => "required|string|max:50",
            "profissao" => "nullable|string|max:255",
            "nivel_academico" => "nullable|string|max:120",
            "anos_experiencia" => "nullable|integer|min:0|max:80",
            "competencias" => "nullable|string",
            "localizacao" => "nullable|string|max:255",
            "cv_arquivo" => "required|file|mimes:pdf,doc,docx|max:2048",
        ]);

        $caminhoArquivo = null;
        $cvProfissao = null;
        $cvLocalizacao = null;

        if ($request->hasFile("cv_arquivo")) {
            $file = $request->file("cv_arquivo");
            $caminhoArquivo = $file->store("cvs", "public");

            $absolutePath = storage_path('app/public/' . $caminhoArquivo);
            $dadosCv = $this->extrairDadosCv($absolutePath, strtolower($file->getClientOriginalExtension()));
            $cvProfissao = $dadosCv['profissao'];
            $cvLocalizacao = $dadosCv['localizacao'];
        }

        DB::table("candidatos")->updateOrInsert(
            ["email" => $request->email],
            [
                "nome" => $request->nome,
                "telefone" => $request->telefone,
                "profissao" => $request->profissao ?: $cvProfissao,
                "nivel_academico" => $request->nivel_academico,
                "anos_experiencia" => $request->anos_experiencia,
                "competencias" => $request->competencias,
                "localizacao" => $request->localizacao ?: $cvLocalizacao,
                "updated_at" => now(),
                "created_at" => now(),
            ],
        );

        $candidato = DB::table("candidatos")
            ->where("email", $request->email)
            ->first();

        DB::table("candidaturas")->insert([
            "vaga_id" => $request->vaga_id,
            "candidato_id" => $candidato->id,
            "cv_arquivo" => $caminhoArquivo,
            "status" => "Pendente",
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        return redirect()
            ->route("candidatos.index")
            ->with("success", "Candidatura registada com sucesso!");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "nome" => "required|string|max:255",
            "email" => "required|email|max:255",
            "telefone" => "required|string|max:50",
            "profissao" => "nullable|string|max:255",
            "nivel_academico" => "nullable|string|max:120",
            "anos_experiencia" => "nullable|integer|min:0|max:80",
            "competencias" => "nullable|string",
            "localizacao" => "nullable|string|max:255",
            "status" => "required|in:Pendente,Aceito,Rejeitado,Lista de Espera",
        ]);

        $candidatura = DB::table("candidaturas")->where("id", $id)->first();

        if ($candidatura) {
            DB::table("candidatos")
                ->where("id", $candidatura->candidato_id)
                ->update([
                    "nome" => $request->nome,
                    "email" => $request->email,
                    "telefone" => $request->telefone,
                    "profissao" => $request->profissao,
                    "nivel_academico" => $request->nivel_academico,
                    "anos_experiencia" => $request->anos_experiencia,
                    "competencias" => $request->competencias,
                    "localizacao" => $request->localizacao,
                    "updated_at" => now(),
                ]);

            DB::table("candidaturas")
                ->where("id", $id)
                ->update([
                    "status" => $request->status,
                    "updated_at" => now(),
                ]);
        }

        return redirect()
            ->back()
            ->with("success", "Dados do candidato editados com sucesso!");
    }

    public function alterarStatus(Request $request, $id)
    {
        $request->validate([
            "status" =>
                "required|string|in:Aceito,Rejeitado,Pendente,Lista de Espera",
        ]);

        DB::table("candidaturas")
            ->where("id", $id)
            ->update([
                "status" => $request->input("status"),
                "updated_at" => now(),
            ]);

        return redirect()
            ->route("candidatos.index")
            ->with("success", "Estado da candidatura atualizado com sucesso!");
    }

    private function extrairDadosCv(string $arquivo, string $extensao): array
    {
        $texto = $this->extrairTextoCv($arquivo, $extensao);
        if ($texto === '') {
            return ['profissao' => null, 'localizacao' => null];
        }

        $normalizado = preg_replace('/\s+/', ' ', Str::of($texto)->lower()->toString());

        $profissao = null;
        if (preg_match('/(?:profiss[aã]o|proficao|proficao)\s*[:\-]\s*([^\n\r\.;,]+)/iu', $texto, $m)) {
            $profissao = trim($m[1]);
        }

        $localizacao = null;
        if (preg_match('/(?:localidade|localiza[cç][aã]o|morada|resid[êe]ncia)\s*[:\-]\s*([^\n\r\.;,]+)/iu', $texto, $m)) {
            $localizacao = trim($m[1]);
        }

        if (!$profissao) {
            $profissoesChave = [
                'engenheiro', 'desenvolvedor', 'programador', 'contabilista', 'contabilista',
                'gestor', 'analista', 'assistente', 'administrativo', 'vendedor',
                'enfermeiro', 'motorista', 'técnico', 'tecnico', 'professor',
            ];
            foreach ($profissoesChave as $chave) {
                if (Str::contains($normalizado, $chave)) {
                    $profissao = ucfirst($chave);
                    break;
                }
            }
        }

        if (!$localizacao) {
            $locaisChave = [
                'bissau', 'gabu', 'gabú', 'bafatá', 'bafata', 'cacheu', 'biombo', 'quinara',
                'ombio', 'bolama', 'tombali', 'fulacunda', 'canchungo', 'catió', 'catio',
            ];
            foreach ($locaisChave as $chave) {
                if (Str::contains($normalizado, $chave)) {
                    $localizacao = ucfirst($chave);
                    break;
                }
            }
        }

        return [
            'profissao' => $profissao ?: null,
            'localizacao' => $localizacao ?: null,
        ];
    }

    private function extrairTextoCv(string $arquivo, string $extensao): string
    {
        if (!is_file($arquivo)) {
            return '';
        }

        if ($extensao === 'docx') {
            $zip = new ZipArchive();
            if ($zip->open($arquivo) === true) {
                $xml = $zip->getFromName('word/document.xml') ?: '';
                $zip->close();
                return trim(strip_tags(str_replace(['</w:p>', '</w:tr>'], ["\n", "\n"], $xml)));
            }
        }

        if ($extensao === 'pdf') {
            $content = @file_get_contents($arquivo) ?: '';
            $out = '';
            if (preg_match_all('/\((.*?)\)\s*Tj/s', $content, $matches)) {
                foreach ($matches[1] as $m) {
                    $out .= ' ' . preg_replace('/\\\\([nrtbf\\()])/', '$1', $m);
                }
            }
            if ($out !== '') {
                return $out;
            }

            if (preg_match_all('/\((.*?)\)/s', $content, $matches)) {
                $joined = implode(' ', $matches[1]);
                return preg_replace('/[^\pL\pN\s\.,:\-]/u', ' ', $joined) ?? '';
            }

            return '';
        }

        $content = @file_get_contents($arquivo) ?: '';
        $content = preg_replace('/[^\pL\pN\s\.,:\-]/u', ' ', $content) ?? '';
        return trim($content);
    }
}
