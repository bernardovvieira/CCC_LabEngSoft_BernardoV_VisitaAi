@props(['messages'])

@if ($messages)
    <p {{ $attributes->merge(['class' => 'mt-1 text-sm text-red-600']) }}>
        {{ is_array($messages) ? implode(', ', $messages) : $messages }}
    </p>
@endif
