<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Usando DB para fins de simplicidade, ou use seu Model se tiver

class ContatoController extends Controller
{
    public function index()
    {
        // 1. Marca todas as mensagens como lidas assim que o utilizador entra nesta página
        \DB::table("contatos")
            ->where("lido", false)
            ->update(["lido" => true]);

        // 2. Procura os contactos normalmente para exibir na tabela
        $contatos = \DB::table("contatos")
            ->orderBy("created_at", "desc")
            ->get();

        return view("contatos.index", compact("contatos"));
    }

    // 2. Recebe os dados do formulário e salva no banco
    public function store(Request $request)
    {
        // Validação básica dos dados
        $request->validate([
            "nome" => "required|string|max:255",
            "email" => "required|email|max:255",
            "mensagem" => "required|string",
        ]);

        // Salva na tabela 'contatos' (nome que você criou na migration)
        DB::table("contatos")->insert([
            "nome" => $request->nome,
            "email" => $request->email,
            "mensagem" => $request->mensagem,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()
            ->back()
            ->with("sucesso", "Contato enviado com sucesso!");
    }
}
