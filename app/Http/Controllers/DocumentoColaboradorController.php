<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'contrato_trabalho_pdf' => 'required|file|mimes:pdf|max:5120',
            'cv_pdf' => 'required|file|mimes:pdf|max:5120',
            'copia_bi_pdf' => 'required|file|mimes:pdf|max:5120',
            'copia_nif_pdf' => 'required|file|mimes:pdf|max:5120',
            'comprovativo_bancario_pdf' => 'required|file|mimes:pdf|max:5120',
            'certificado_pdf' => 'required|file|mimes:pdf|max:5120',
        ]);

        $paths = [
            'contrato_trabalho_pdf' => $request->file('contrato_trabalho_pdf')->store('documentos-colaboradores', 'public'),
            'cv_pdf' => $request->file('cv_pdf')->store('documentos-colaboradores', 'public'),
            'copia_bi_pdf' => $request->file('copia_bi_pdf')->store('documentos-colaboradores', 'public'),
            'copia_nif_pdf' => $request->file('copia_nif_pdf')->store('documentos-colaboradores', 'public'),
            'comprovativo_bancario_pdf' => $request->file('comprovativo_bancario_pdf')->store('documentos-colaboradores', 'public'),
            'certificado_pdf' => $request->file('certificado_pdf')->store('documentos-colaboradores', 'public'),
        ];

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
}
