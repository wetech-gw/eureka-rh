<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\LogsActivity;

class UsuarioController extends Controller
{
    use LogsActivity;
    public function index()
    {
        // Vai buscar todos os utilizadores da tabela 'users'
        $usuarios = DB::table("users")->get();
        return view("usuarios_index", compact("usuarios"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
            "role" => "required|string",
            "password" => "required|string|min:6",
            "status" => "required|string", // Validação do estado adicionada
        ]);

        DB::table("users")->insert([
            "name" => $request->name,
            "email" => $request->email,
            "role" => $request->role,
            "status" => $request->status,
            "password" => Hash::make($request->password),
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        $this->logActivity('create', 'Utilizador', null, 'Criou utilizador: ' . $request->name . ' (' . $request->role . ')');

        return redirect()
            ->back()
            ->with("success", "Utilizador criado com sucesso!");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email," . $id,
            "role" => "required|string",
            "status" => "required|string",
        ]);

        $dados = [
            "name" => $request->name,
            "email" => $request->email,
            "role" => $request->role,
            "status" => $request->status, // <- ADICIONADO AQUI PARA ATUALIZAR NA BASE DE DADOS
            "updated_at" => now(),
        ];

        // Se introduzir nova palavra-passe, atualiza-a de forma segura
        if ($request->filled("password")) {
            $dados["password"] = Hash::make($request->password);
        }

        DB::table("users")->where("id", $id)->update($dados);

        $this->logActivity('update', 'Utilizador', $id, 'Atualizou utilizador: ' . $request->name);

        return redirect()
            ->back()
            ->with("success", "Conta de utilizador atualizada!");
    }
}
