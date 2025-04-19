@props(['type' => 'error', 'message'])

@php
    $colors = $type === 'success'
        ? ['bg-green-100','text-green-800']
        : ['bg-red-100','text-red-800'];
@endphp

@if ($message)
    <div class="p-3 mb-4 rounded {{ $colors[0] }} {{ $colors[1] }}">
        {{ $message }}
    </div>
@endif
