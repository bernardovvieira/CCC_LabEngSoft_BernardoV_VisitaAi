<?php

namespace App\Providers;

use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Responses\RegisterResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Sobrescreve o response padrão de registro para adicionar flash de sucesso
        $this->app->singleton(RegisterResponseContract::class, RegisterResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // 0) Define quais views o Fortify deve usar
        Fortify::loginView(fn() => view('auth.login'));
        Fortify::registerView(fn() => view('auth.register'));
        Fortify::requestPasswordResetLinkView(fn() => view('auth.forgot-password'));
        Fortify::resetPasswordView(fn($request) => view('auth.reset-password', ['request' => $request]));
        Fortify::verifyEmailView(fn() => view('auth.verify-email'));
        Fortify::confirmPasswordView(fn() => view('auth.confirm-password'));

        //
        // 1) Usa 'login' em vez de 'email'
        Fortify::username('login');

        //
        // 2) Ações padrão de criação/atualização de usuários
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        //
        // 3) Autenticação customizada por CPF ou e‑mail
        Fortify::authenticateUsing(function (Request $request) {
            // validação de presença dos campos
            $request->validate([
                'login'    => 'required|string',
                'password' => 'required|string',
            ], [
                'login.required'    => 'O campo CPF ou e‑mail é obrigatório.',
                'password.required' => 'O campo senha é obrigatório.',
            ]);

            $login    = (string) $request->input('login');
            $password = (string) $request->input('password');

            // busca usuário por email ou CPF
            $user = User::where('use_email', $login)
                        ->orWhere('use_cpf',   $login)
                        ->first();

            if (! $user) {
                throw ValidationException::withMessages([
                    'login' => 'Usuário não encontrado.',
                ]);
            }

            if (! Hash::check($password, $user->use_senha)) {
                throw ValidationException::withMessages([
                    'password' => 'Senha incorreta.',
                ]);
            }

            return $user;
        });

        //
        // 4) Throttle: 3 tentativas de login por minuto
        RateLimiter::for('login', function (Request $request) {
            $key = Str::transliterate(
                Str::lower($request->input('login')).'|'.$request->ip()
            );
            return Limit::perMinute(3)->by($key);
        });

        //
        // 5) Throttle para two‑factor (caso use)
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)
                        ->by($request->session()->get('login.id'));
        });
    }
}
