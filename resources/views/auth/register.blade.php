<x-guest-layout>
    <x-alert type="success" :message="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto mt-8">
        @csrf

        {{-- CPF --}}
        <div class="mb-4">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" name="cpf" type="text"
                          :value="old('cpf')" required
                          class="block w-full mt-1
                                 @error('cpf') border-red-500 @enderror" />
            <x-input-error :messages="$errors->get('cpf')" />
        </div>

        {{-- E‑mail --}}
        <div class="mb-4">
            <x-input-label for="email" :value="__('E‑mail')" />
            <x-text-input id="email" name="email" type="email"
                          :value="old('email')" required
                          class="block w-full mt-1
                                 @error('email') border-red-500 @enderror" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        {{-- Senha --}}
        <div class="mb-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" name="password" type="password"
                          required autocomplete="new-password"
                          class="block w-full mt-1
                                 @error('password') border-red-500 @enderror" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        {{-- Confirmar Senha --}}
        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
            <x-text-input id="password_confirmation" name="password_confirmation"
                          type="password" required autocomplete="new-password"
                          class="block w-full mt-1
                                 @error('password_confirmation') border-red-500 @enderror" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <x-primary-button class="w-full justify-center">Registrar</x-primary-button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
        Já tem conta?
        <a href="{{ route('login') }}" class="underline text-blue-600 hover:text-blue-800">
            Faça login
        </a>
    </p>
</x-guest-layout>
