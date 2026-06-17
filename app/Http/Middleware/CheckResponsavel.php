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
        if (!Auth::check() || Auth::user()->role !== 'Responsável') {
            return redirect()->route('dashboard')->with('error', 'Acesso Restrito: Apenas a Responsável de RH pode aceder a esta área.');
        }

        return $next($request);
    }
}
