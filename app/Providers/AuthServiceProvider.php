<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapas de policies (adicione aqui quando criar políticas).
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Registra automaticamente as policies acima
        $this->registerPolicies();

        /*
        |---------------------------------------------------------------
        | GATES SIMPLES
        |---------------------------------------------------------------
        */

        // Apenas usuários com perfil 'gestor'
        Gate::define('isGestor', fn(User $user) => $user->isGestor());

        // Apenas usuários aprovados
        Gate::define('isAprovado', fn(User $user) => $user->isAprovado());
    }
}
