<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Certifica-te de que a classe se chama DocumentController (sem o 'o')
class DocumentController extends Controller
{
    public function index()
    {
        $documentos = DB::table("documentos")
            ->orderBy("data_operacao", "desc")
            ->get();

        $totalDocumentos = $documentos->count();
        $totalEntradas = $documentos->where("tipo", "Entrada")->count();
        $totalSaidas = $documentos->where("tipo", "Saída")->count();

        return view(
            "documentos.index",
            compact(
                "documentos",
                "totalDocumentos",
                "totalEntradas",
                "totalSaidas",
            ),
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            "nome" => "required|string|max:255",
            "tipo" => "required|in:Entrada,Saída",
            "data_operacao" => "required|date",
            "departamento" => "required|string|max:255",
            "arquivo_pdf" => "required|file|mimes:pdf|max:2048",
        ]);

        $path = null;
        if ($request->hasFile("arquivo_pdf")) {
            $path = $request
                ->file("arquivo_pdf")
                ->store("documentos", "public");
        }

        DB::table("documentos")->insert([
            "nome" => $request->nome,
            "tipo" => $request->tipo,
            "data_operacao" => $request->data_operacao,
            "departamento" => $request->departamento,
            "arquivo_pdf" => $path,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        return redirect()
            ->route("documentos.index")
            ->with("success", "Documento registado com sucesso!");
    }
}
