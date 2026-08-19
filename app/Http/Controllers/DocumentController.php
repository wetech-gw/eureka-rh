<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\LogsActivity;

class DocumentController extends Controller
{
    use LogsActivity;
    public function index(Request $request)
    {
        $query = DB::table("documentos")->orderBy("data_operacao", "desc");

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('nome', 'like', "%{$q}%")
                    ->orWhere('numero_referencia', 'like', "%{$q}%")
                    ->orWhere('categoria', 'like', "%{$q}%")
                    ->orWhere('departamento', 'like', "%{$q}%");
            });
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        $documentos = $query->get();

        $totalDocumentos = $documentos->count();
        $totalEntradas = $documentos->where("tipo", "Entrada")->count();
        $totalSaidas = $documentos->where("tipo", "Saída")->count();

        $categorias = DB::table('documentos')->select('categoria')->distinct()->orderBy('categoria')->pluck('categoria');

        return view(
            "documentos.index",
            compact(
                "documentos",
                "totalDocumentos",
                "totalEntradas",
                "totalSaidas",
                "categorias",
            ),
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            "nome" => "required|string|max:255",
            "numero_referencia" => "required|string|max:50",
            "categoria" => "required|string|max:120",
            "tipo" => "required|in:Entrada,Saída",
            "data_operacao" => "required|date",
            "departamento" => "required|string|max:255",
            "arquivo_pdf" => "nullable|file|mimes:pdf|max:4096",
        ]);

        $path = null;
        if ($request->hasFile("arquivo_pdf")) {
            $path = $request
                ->file("arquivo_pdf")
                ->store("documentos", "public");
        }

        DB::table("documentos")->insert([
            "nome" => $request->nome,
            "numero_referencia" => $request->numero_referencia,
            "categoria" => $request->categoria,
            "tipo" => $request->tipo,
            "data_operacao" => $request->data_operacao,
            "departamento" => $request->departamento,
            "arquivo_pdf" => $path,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        $this->logActivity('create', 'Documento', null, 'Registou documento: ' . $request->nome . ' (' . $request->numero_referencia . ')');

        return redirect()
            ->route("documentos.index")
            ->with("success", "Documento registado com sucesso!");
    }
}
