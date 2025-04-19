@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Usuários pendentes</h1>

@if(session('status'))
    <x-alert type="success" :message="session('status')" />
@endif

<table class="w-full text-left border">
    <thead>
        <tr class="border-b bg-gray-800 text-white">
            <th class="p-2">CPF</th>
            <th class="p-2">E‑mail</th>
            <th class="p-2">Ação</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pendentes as $u)
            <tr class="border-b">
                <td class="p-2 text-white">{{ $u->use_cpf }}</td>
                <td class="p-2 text-white">{{ $u->use_email }}</td>
                <td class="p-2">
                    <form method="POST" action="{{ route('gestor.approve', $u) }}">
                        @csrf
                        <x-primary-button>Aprovar</x-primary-button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="p-4 text-center">Nenhum usuário pendente.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
