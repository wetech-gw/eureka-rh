<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckResponsavel;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 🟢 CORREÇÃO: Passamos o caminho diretamente sem o parâmetro 'guest:'
        $middleware->redirectTo('/'); 

        // Mantém a exceção do Token CSRF temporariamente para o Login
        $middleware->validateCsrfTokens(except: [
            '/login',
        ]);

        // Mantém o apelido do seu middleware de permissões
        $middleware->alias([
            'responsavel' => CheckResponsavel::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();