<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserApprovalController extends Controller
{
    /**
     * Exibe todos os usuários ainda não aprovados.
     */
    public function index(): View
    {
        $pendentes = User::where('use_aprovado', false)->get();

        return view('gestor.pendentes', compact('pendentes'));
    }

    /**
     * Aprova um usuário específico e registra o gestor que aprovou.
     */
    public function approve(User $user): RedirectResponse
    {
        // Recupera o ID do gestor logado
        $gestorId = Auth::user()->use_id;

        // Atualiza o usuário: marca aprovado e define quem aprovou
        $user->update([
            'use_aprovado'  => true,
            'fk_gestor_id' => $gestorId,
        ]);

        return back()->with('status', 'Usuário aprovado com sucesso!');
    }
}
