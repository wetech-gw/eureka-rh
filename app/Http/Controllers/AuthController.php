<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

    /**
     * Exibe o formulário de solicitação de redefinição de senha
     */
    public function showForgotForm()
    {
        return view("auth.forgot-password");
    }

    /**
     * Gera o token e redireciona diretamente para o formulário de redefinição
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users,email",
        ]);

        $user = \App\Models\User::where("email", $request->email)->first();
        $token = Password::broker()->createToken($user);

        return redirect()->route("password.reset", ["token" => $token]);
    }

    /**
     * Exibe o formulário de redefinição de senha
     */
    public function showResetForm(string $token)
    {
        return view("auth.reset-password", ["token" => $token]);
    }

    /**
     * Processa a redefinição da senha
     */
    public function reset(Request $request)
    {
        $request->validate([
            "token" => "required",
            "email" => "required|email|exists:users,email",
            "password" => "required|confirmed|min:8",
        ]);

        $status = Password::reset(
            $request->only(
                "email",
                "password",
                "password_confirmation",
                "token",
            ),
            function ($user, $password) {
                $user
                    ->forceFill([
                        "password" => bcrypt($password),
                    ])
                    ->setRememberToken(Str::random(60));

                $user->save();
            },
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()
                ->route("login")
                ->with(
                    "status",
                    __(
                        "Palavra-passe redefinida com sucesso! Faça login com a nova palavra-passe.",
                    ),
                )
            : back()->withErrors([
                "email" => [__("Token de redefinição inválido ou expirado.")],
            ]);
    }
}
