<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserApprovalController;
use App\Http\Middleware\CheckApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página pública
Route::view('/', 'welcome');

// Página de "conta pendente" (para quem digitar direto)
Route::view('/pendente', 'auth.pending')->name('pendente');

// ----------------------------
// ÁREA LOGADA
// ----------------------------
Route::middleware('auth')->group(function () {

    /*
    |-------------------------------------------------
    | DASHBOARD GENÉRICO
    |-------------------------------------------------
    | — Requer usuário autenticado
    | — Se NÃO for aprovado, CheckApproved exibe view pendente
    */
    Route::middleware(CheckApproved::class)
         ->get('/dashboard', function (Request $request) {
             return $request->user()->isGestor()
                 ? redirect()->route('gestor.dashboard')
                 : redirect()->route('agente.dashboard');
         })
         ->name('dashboard');

    /*
    |-------------------------------------------------
    | ROTAS APROVADAS – só quem tem use_aprovado = 1
    |-------------------------------------------------
    */
    Route::middleware(CheckApproved::class)->group(function () {

        // Dashboard do Agente
        Route::view('/agente/dashboard', 'agente.dashboard')
             ->name('agente.dashboard');

        // Dashboard do Gestor
        Route::view('/gestor/dashboard', 'gestor.dashboard')
             ->name('gestor.dashboard');

        // Perfil
        Route::get('/profile',   [ProfileController::class, 'edit'])   ->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update']) ->name('profile.update');
        Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    /*
    |-------------------------------------------------
    | ROTAS DE APROVAÇÃO (somente gestor)
    |-------------------------------------------------
    */
    Route::middleware([ CheckApproved::class, 'can:isGestor' ])
         ->prefix('gestor')
         ->name('gestor.')
         ->group(function () {
             Route::get('/pendentes',  [UserApprovalController::class, 'index'])
                  ->name('pendentes');
             Route::post('/approve/{user}', [UserApprovalController::class, 'approve'])
                  ->name('approve');
         });
         
         
});

// Rotas de autenticação Breeze / Fortify
require __DIR__.'/auth.php';
