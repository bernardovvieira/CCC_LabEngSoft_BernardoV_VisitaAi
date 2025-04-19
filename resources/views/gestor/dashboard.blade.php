@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Painel do Gestor</h1>

    <!-- Botão para usuários pendentes -->
    <div class="mb-8">
        <a href="{{ route('gestor.pendentes') }}"
           class="inline-block px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow">
            Ver Usuários Pendentes
        </a>
    </div>

    <!-- Aqui pode vir o restante dos cards/estatísticas do dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Exemplo de card -->
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
            <h2 class="text-lg font-medium">Total de Agentes</h2>
            <p class="mt-2 text-3xl">{{ \App\Models\User::where('use_perfil','agente')->count() }}</p>
        </div>

        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
            <h2 class="text-lg font-medium">Agentes Pendentes</h2>
            <p class="mt-2 text-3xl">{{ \App\Models\User::where('use_perfil','agente')->where('use_aprovado', false)->count() }}</p>
        </div>
    </div>
</div>
@endsection
