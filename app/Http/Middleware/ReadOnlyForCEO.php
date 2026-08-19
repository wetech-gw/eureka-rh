<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReadOnlyForCEO
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['CEO', 'Assistente']) && $request->method() !== 'GET') {
            $roleName = Auth::user()->role === 'CEO' ? 'CEO' : 'Assistente';
            return redirect()->back()->with('error', "Acesso Restrito: O utilizador {$roleName} tem apenas acesso de leitura.");
        }

        return $next($request);
    }
}
