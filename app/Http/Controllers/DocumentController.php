<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table("documentos")->orderBy("data_operacao", "desc");

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('nome', 'like', "%{$q}%")
                    ->orWhere('categoria', 'like', "%{$q}%")
                    ->orWhere('departamento', 'like', "%{$q}%");
                    // ->orWhere('versao', 'like', "%{$q}%");
            });
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // if ($request->filled('nivel_acesso')) {
        //     $query->where('nivel_acesso', $request->nivel_acesso);
        // }

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
            "categoria" => "required|string|max:120",
            // "versao" => "required|string|max:20",
            // "nivel_acesso" => "required|in:Interno,RH,Gestão,Confidencial",
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
            "categoria" => $request->categoria,
            // "versao" => $request->versao,
            // "nivel_acesso" => $request->nivel_acesso,
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
