<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckResponsavel
{
    public function handle(Request $request, Closure $next)
    {
        // Bloqueia se não estiver logado ou não tiver perfil adequado
        if (!Auth::check() || !in_array(Auth::user()->role, ['Responsável', 'CEO', 'Assistente'])) {
            return redirect()->route('dashboard')->with('error', 'Acesso Restrito: Não tem permissão para aceder a esta área.');
        }

        return $next($request);
    }
}
