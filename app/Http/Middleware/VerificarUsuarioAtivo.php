<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarUsuarioAtivo
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status !== "Ativo") {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route("login")
                ->with(
                    "error",
                    "A sua conta está inativa ou suspensa. Contacte o Administrador.",
                );
        }

        return $next($request);
    }
}
