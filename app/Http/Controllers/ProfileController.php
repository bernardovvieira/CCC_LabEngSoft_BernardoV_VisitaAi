<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Helpers\LogHelper;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        $user->use_nome = $request->validated()['name'];
        $user->use_email = $request->validated()['email'];
    
        $user->save();

        LogHelper::registrar(
            'Atualização de perfil',
            'Usuário',
            'update',
            'Usuário atualizou nome para: ' . $user->use_nome . ', email: ' . $user->use_email
        );
    
        return Redirect::route('profile.edit')->with('success', 'Perfil atualizado com sucesso!');
    }    
}
