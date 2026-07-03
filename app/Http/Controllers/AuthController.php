<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Exibe a tela externa de Login na raiz do sistema
     */
    public function showLogin()
    {
        return view("auth.login");
    }

    /**
     * Processa a tentativa de autenticação
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // VERIFICAÇÃO DE SEGURANÇA: Bloqueia utilizadores Inativos ou Suspensos
            if (($user->status ?? "Ativo") !== "Ativo") {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withErrors([
                        "email" =>
                            "A sua conta encontra-se inativa ou suspensa. Contacte o Administrador.",
                    ])
                    ->withInput($request->only("email"));
            }

            // Se estiver Ativo, o login continua normalmente
            $request->session()->regenerate();
            return redirect()->intended(route("dashboard"));
        }

        return back()
            ->withErrors([
                "email" => "O e-mail ou a palavra-passe estão incorretos.",
            ])
            ->withInput($request->only("email"));
    }

    /**
     * Exibe o painel do Dashboard com as estatísticas (Apenas uma declaração)
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Conta o total de funcionários ativos
        $totalFuncionarios = DB::table("funcionarios")->count();

        // Conta quantos foram criados no mês atual
        $novosEsteMes = DB::table("funcionarios")
            ->whereMonth("created_at", now()->month)
            ->whereYear("created_at", now()->year)
            ->count();

        return view(
            "dashboard",
            compact("user", "totalFuncionarios", "novosEsteMes"),
        );
    }

    /**
     * Finaliza a sessão do utilizador (Logout)
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }
}
