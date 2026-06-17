<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        // Vai buscar todos os utilizadores da tabela 'users'
        $usuarios = DB::table('users')->get();
        return view('usuarios_index', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // Coluna para diferenciar 'Responsável' de 'Assistente'
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Utilizador criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string',
        ]);

        $dados = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'updated_at' => now(),
        ];

        // Se introduzir nova palavra-passe, atualiza-a de forma segura
        if ($request->filled('password')) {
            $dados['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($dados);

        return redirect()->back()->with('success', 'Conta de utilizador atualizada!');
    }
}