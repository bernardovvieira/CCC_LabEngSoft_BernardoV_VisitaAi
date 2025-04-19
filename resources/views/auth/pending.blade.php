<x-guest-layout>
    <h1 class="text-xl font-bold mb-4">Cadastro enviado!</h1>

    <p>Sua conta está aguardando aprovação de um gestor.</p>
    <p class="mt-4">Você receberá um e‑mail quando ela for liberada.</p>

    <form method="POST" action="{{ route('logout') }}" class="mt-6">
        @csrf
        <x-primary-button>Sair</x-primary-button>
    </form>
</x-guest-layout>
