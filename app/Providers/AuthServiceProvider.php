<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
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
        Gate::define('isGestor', function ($user) {
            return $user->isGestor();
        });

        // Apenas usuários aprovados
        Gate::define('isAprovado', function ($user) {
            return $user->isAprovado();
        });
    }
}
