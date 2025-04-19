@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Bem‑vindo, Agente!</h1>
    <p class="mb-2">CPF: <strong>{{ auth()->user()->use_cpf }}</strong></p>
    <p>Email: <strong>{{ auth()->user()->use_email }}</strong></p>

    <div class="mt-6">
        <p>Aqui você poderá:</p>
        <ul class="list-disc list-inside">
            <li>Registrar novas visitas epidemiológicas</li>
            <li>Cadastrar e editar locais</li>
            <li>Selecionar doenças monitoradas</li>
            <li>Visualizar seu histórico de registros</li>
        </ul>
    </div>
</div>
@endsection
