<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckResponsavel
{
    public function handle(Request $request, Closure $next)
    {
        // Se não estiver logado ou não for Responsável, bloqueia o acesso
        if (!Auth::check() || !in_array(Auth::user()->role, ['Responsável', 'CEO'])) {
            return redirect()->route('dashboard')->with('error', 'Acesso Restrito: Apenas a Direção pode aceder a esta área.');
        }

        return $next($request);
    }
}
