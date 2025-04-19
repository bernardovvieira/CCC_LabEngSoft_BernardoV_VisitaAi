<?php

// app/Http/Middleware/CheckApproved.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // se não estiver aprovado, mostra página de pendência
        if ($user && ! $user->isAprovado()) {
            return response()->view('auth.pending');
        }

        return $next($request);
    }
}

