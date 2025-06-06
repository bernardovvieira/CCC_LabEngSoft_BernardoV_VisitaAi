<!-- resources/views/agente/locais/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-4xl space-y-6">
    <div>
        <a href="{{ route('agente.locais.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold text-sm rounded-lg shadow transition">
            <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Voltar
        </a>
    </div>

    <section class="p-4 bg-white dark:bg-gray-700 rounded-lg shadow">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Cadastrar Local</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">
            Preencha os dados do local. Preencha o CEP para preencher automaticamente os campos de endereço, bairro, cidade e estado.
            Utilize o botão "Minha Localização" para obter as coordenadas do dispositivo.
        </p>
    </section>

    <section class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow space-y-6">
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('agente.locais.store') }}" class="space-y-6"
            x-data="{ carregando: false }"
            x-on:submit="carregando = true">

            @csrf

            <fieldset class="space-y-3">
                <legend class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Características Principais</legend>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="loc_tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Imóvel <span class="text-red-500">*</span></label>
                        <select id="loc_tipo" name="loc_tipo" required
                                class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                            <option value="" disabled selected>Selecione o tipo de imóvel</option>
                            <option value="R" {{ old('loc_tipo') == 'R' ? 'selected' : '' }}>Residencial (R)</option>
                            <option value="C" {{ old('loc_tipo') == 'C' ? 'selected' : '' }}>Comercial (C)</option>
                            <option value="T" {{ old('loc_tipo') == 'T' ? 'selected' : '' }}>Terreno Baldio (T)</option>
                        </select>
                    </div>
                    <div>
                        <label for="loc_zona" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Zona <span class="text-red-500">*</span></label>
                        <select id="loc_zona" name="loc_zona" required
                                class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                            <option value="" disabled selected>Selecione a zona</option>
                            <option value="U" {{ old('loc_zona') == 'U' ? 'selected' : '' }}>Urbana (U)</option>
                            <option value="R" {{ old('loc_zona') == 'R' ? 'selected' : '' }}>Rural (R)</option>
                        </select>
                    </div>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 italic">
                    Os campos acima serão utilizados em relatórios e análises de localização, certifique-se de escolher as opções corretas.
            </fieldset> 

            <fieldset class="space-y-3">
                <legend class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Endereço Completo</legend>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="cep" class="block text-sm font-medium text-gray-700 dark:text-gray-300">CEP <span class="text-red-500">*</span></label>
                        <input id="loc_cep" name="loc_cep" type="text" maxlength="9" placeholder="00000-000" required
                            class="cep mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                    <div>
                        <label for="loc_endereco" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Logradouro <span class="text-red-500">*</span></label>
                        <input id="loc_endereco" name="loc_endereco" type="text" value="{{ old('loc_endereco') }}" required
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                    <div>
                        <label for="numero" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Número</label>
                        <input id="loc_numero" name="loc_numero" type="number"
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="loc_bairro" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bairro/Localidade <span class="text-red-500">*</span></label>
                        <input id="loc_bairro" name="loc_bairro" type="text" value="{{ old('loc_bairro') }}" required
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                    <div>
                        <label for="loc_complemento" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Complemento</label>
                        <input id="loc_complemento" name="loc_complemento" type="text" value="{{ old('loc_complemento') }}"
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="cidade" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cidade <span class="text-red-500">*</span></label>
                        <input id="loc_cidade" required readonly name="loc_cidade" type="text" class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado <span class="text-red-500">*</span></label>
                        <input id="loc_estado" required readonly name="loc_estado" type="text" class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                    <div>
                        <label for="pais" class="block text-sm font-medium text-gray-700 dark:text-gray-300">País <span class="text-red-500">*</span></label>
                        <input id="loc_pais" name="loc_pais" type="text" required readonly class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                </div>
            </fieldset>

            <p class="text-sm text-gray-600 dark:text-gray-400 italic">
                Os campos <strong>cidade</strong>, <strong>estado</strong> e <strong>país</strong> serão preenchidos automaticamente após digitar um CEP válido.
            </p>

            <fieldset class="space-y-3">
                <legend class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Informações Complementares</legend>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="loc_codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código da Localidade <span class="text-red-500">*</span></label>
                        <input id="loc_codigo" name="loc_codigo" type="number" value="{{ old('loc_codigo') }}" required
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                    <div>
                        <label for="loc_categoria" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoria da Localidade</label>
                        <input id="loc_categoria" name="loc_categoria" type="text" value="{{ old('loc_categoria') }}"
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="loc_quarteirao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quarteirão</label>
                        <input id="loc_quarteirao" name="loc_quarteirao" type="number" value="{{ old('loc_quarteirao') }}"
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                    <div>
                        <label for="loc_sequencia" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sequência</label>
                        <input id="loc_sequencia" name="loc_sequencia" type="number" value="{{ old('loc_sequencia') }}"
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                    <div>
                        <label for="loc_lado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lado</label>
                        <input id="loc_lado" name="loc_lado" type="number" value="{{ old('loc_lado') }}"
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>  
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 italic">
                    Os campos <strong>quarteirão</strong>, <strong>sequência</strong> e <strong>lado</strong> são utilizados para identificar a localização exata do imóvel.    
            </fieldset>

            <fieldset class="space-y-3">
                <legend class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Geolocalização</legend>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Latitude <span class="text-red-500">*</span></label>
                        <input id="loc_latitude" name="loc_latitude" type="text" required
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Longitude <span class="text-red-500">*</span></label>
                        <input id="loc_longitude" name="loc_longitude" type="text" required
                            class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="obterMinhaLocalizacao()"
                                class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow transition">
                            Minha Localização
                        </button>
                    </div>
                </div>

                <div>
                    <div id="map" class="h-72 rounded-md shadow border border-gray-300"></div>
                    <p class="text-sm mt-2 text-gray-600 dark:text-gray-400 italic">
                        Você pode ajustar manualmente a posição do marcador no mapa para maior precisão.
                    </p>
                </div>
            </fieldset>

            <div class="flex justify-end">
                <button type="submit"
                        x-bind:disabled="carregando"
                        class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm rounded-lg shadow-md transition disabled:opacity-50 disabled:cursor-not-allowed">
                    Cadastrar
                </button>
            </div>
        </form>
    </section>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    $('#loc_cep').mask('00000-000');
});

let map = L.map('map').setView([-28.7, -52.3], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);
let marker = L.marker([-28.7, -52.3], { draggable: true }).addTo(map);

marker.on('dragend', function(e) {
    const pos = e.target.getLatLng();
    document.getElementById('loc_latitude').value = pos.lat.toFixed(7);
    document.getElementById('loc_longitude').value = pos.lng.toFixed(7);
});

function setMapPosition(lat, lng) {
    marker.setLatLng([lat, lng]);
    map.setView([lat, lng], 16);
    document.getElementById('loc_latitude').value = lat;
    document.getElementById('loc_longitude').value = lng;
}

function obterMinhaLocalizacao() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(pos) {
            const lat = pos.coords.latitude.toFixed(7);
            const lng = pos.coords.longitude.toFixed(7);
            setMapPosition(lat, lng);
        }, function(error) {
            alert('Erro ao obter localização: ' + error.message);
        }, {
            enableHighAccuracy: true,
            timeout: 20000,
            maximumAge: 0
        });
    } else {
        alert('Geolocalização não suportada.');
    }
}

const cepInput = document.getElementById('loc_cep');
cepInput.addEventListener('blur', () => {
    let cep = cepInput.value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(res => res.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('loc_endereco').value = data.logradouro || '';
                    document.getElementById('loc_bairro').value = data.bairro || '';
                    document.getElementById('loc_cidade').value = data.localidade || '';
                    document.getElementById('loc_estado').value = data.uf || '';
                    document.getElementById('loc_pais').value = 'Brasil';
                } else {
                    alert('CEP não encontrado.');
                }
            });
    }
});
</script>
@endsection