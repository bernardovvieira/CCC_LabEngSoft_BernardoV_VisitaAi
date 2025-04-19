<!-- resources/views/auth/confirm-password.blade.php -->
<x-guest-layout>
    <div class="max-w-md mx-auto mt-12 p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <h1 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">
            Confirme sua Senha
        </h1>

        <p class="mb-6 text-gray-700 dark:text-gray-300">
            Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Senha -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Senha')" />
                <x-text-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button>
                    {{ __('Confirmar') }}
                </x-primary-button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
            Não deseja confirmar?
            <a href="{{ route('dashboard') }}"
               class="underline text-blue-600 hover:text-blue-800 dark:text-blue-400">
                Voltar ao painel
            </a>
        </p>
    </div>
</x-guest-layout>
