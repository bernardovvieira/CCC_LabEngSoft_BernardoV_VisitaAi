<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1) Validação do campo e‑mail
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'O e‑mail é obrigatório.',
            'email.email'    => 'Formato de e‑mail inválido.',
        ]);

        // 2) Tenta enviar o link usando a coluna use_email
        $status = Password::sendResetLink([
            'use_email' => $request->input('email'),
        ]);

        // 3) Responde de volta para a view
        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', 'Link de recuperação enviado com sucesso!')
                    : back()
                        ->withInput($request->only('email'))
                        ->withErrors(['email' => 'Não encontramos esse e‑mail cadastrado.']);
    }
}