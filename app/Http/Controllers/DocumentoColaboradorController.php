<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsActivity;

class DocumentoColaboradorController extends Controller
{
    use LogsActivity;
    public function index(Request $request)
    {
        $query = DB::table('documentos_colaboradores')
            ->join('funcionarios', 'documentos_colaboradores.funcionario_id', '=', 'funcionarios.id')
            ->select('documentos_colaboradores.*', 'funcionarios.nome as funcionario_nome', 'funcionarios.cargo as funcionario_cargo')
            ->orderBy('funcionarios.nome');

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('funcionarios.nome', 'like', "%{$q}%")
                    ->orWhere('funcionarios.cargo', 'like', "%{$q}%");
            });
        }

        $documentos = $query->get();

        $funcionarios = DB::table('funcionarios')
            ->where('estado', 'Activo')
            ->whereNotIn('id', function ($sub) {
                $sub->select('funcionario_id')->from('documentos_colaboradores');
            })
            ->orderBy('nome')
            ->get(['id', 'nome', 'cargo']);

        $totalDocumentos = $documentos->count();
        $totalCompletos = $documentos->filter(function ($d) {
            return $d->contrato_trabalho_pdf
                && $d->cv_pdf
                && $d->copia_bi_pdf
                && $d->copia_nif_pdf
                && $d->comprovativo_bancario_pdf
                && $d->certificado_pdf;
        })->count();

        return view('documentos_colaboradores.index', [
            'documentos' => $documentos,
            'funcionarios' => $funcionarios,
            'totalDocumentos' => $totalDocumentos,
            'totalCompletos' => $totalCompletos,
            'totalPendentes' => max(0, $totalDocumentos - $totalCompletos),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'funcionario_id' => 'required|exists:funcionarios,id',
            'contrato_trabalho_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'cv_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'copia_bi_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'copia_nif_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'comprovativo_bancario_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'certificado_pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $camposPdf = [
            'contrato_trabalho_pdf',
            'cv_pdf',
            'copia_bi_pdf',
            'copia_nif_pdf',
            'comprovativo_bancario_pdf',
            'certificado_pdf',
        ];

        $paths = [];
        foreach ($camposPdf as $campo) {
            if ($request->hasFile($campo)) {
                $paths[$campo] = $request->file($campo)->store('documentos-colaboradores', 'public');
            }
        }

        $existing = DB::table('documentos_colaboradores')
            ->where('funcionario_id', $data['funcionario_id'])
            ->first();

        if ($existing) {
            DB::table('documentos_colaboradores')
                ->where('funcionario_id', $data['funcionario_id'])
                ->update(array_merge($paths, ['updated_at' => now()]));
        } else {
            DB::table('documentos_colaboradores')->insert(array_merge([
                'funcionario_id' => $data['funcionario_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ], $paths));
        }

        $func = DB::table('funcionarios')->where('id', $data['funcionario_id'])->first();
        $this->logActivity('create', 'Dossiê Colaborador', null, 'Registou dossiê documental de ' . ($func->nome ?? 'desconhecido'));

        return redirect()
            ->route('documentos.colaboradores.index')
            ->with('success', 'Dossiê documental do colaborador registado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $registro = DB::table('documentos_colaboradores')->where('id', $id)->first();

        if (!$registro) {
            return redirect()
                ->route('documentos.colaboradores.index')
                ->with('error', 'Dossiê documental não encontrado.');
        }

        $request->validate([
            'contrato_trabalho_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'cv_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'copia_bi_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'copia_nif_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'comprovativo_bancario_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'certificado_pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $camposPdf = [
            'contrato_trabalho_pdf',
            'cv_pdf',
            'copia_bi_pdf',
            'copia_nif_pdf',
            'comprovativo_bancario_pdf',
            'certificado_pdf',
        ];

        $paths = [];
        foreach ($camposPdf as $campo) {
            if ($request->hasFile($campo)) {
                $paths[$campo] = $request->file($campo)->store('documentos-colaboradores', 'public');

                if (!empty($registro->{$campo})) {
                    Storage::disk('public')->delete($registro->{$campo});
                }
            }
        }

        if (!empty($paths)) {
            $paths['updated_at'] = now();

            DB::table('documentos_colaboradores')
                ->where('id', $id)
                ->update($paths);
        }

        $func = DB::table('funcionarios')->where('id', $registro->funcionario_id)->first();
        $this->logActivity('update', 'Dossiê Colaborador', $id, 'Atualizou dossiê documental de ' . ($func->nome ?? 'desconhecido'));

        return redirect()
            ->route('documentos.colaboradores.index')
            ->with('success', 'Dossiê documental do colaborador atualizado com sucesso!');
    }
}
