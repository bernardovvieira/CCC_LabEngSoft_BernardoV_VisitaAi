<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Http\RedirectResponse;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Return the response after a user registers.
     */
    public function toResponse($request): RedirectResponse
    {
        // redireciona ao dashboard com um flash de sucesso
        return redirect()->intended('/dashboard')
                         ->with('status', 'Cadastro realizado com sucesso!');
    }
}
