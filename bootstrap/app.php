<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckApproved;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        /*
        |-----------------------------------------------------------------
        | Aliases de middleware
        |-----------------------------------------------------------------
        | O método `alias()` mapeia um nome curto para a classe.  Depois
        | você usa 'approved' nas rotas normalmente.
        */
        $middleware->alias([
            'approved' => CheckApproved::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
