@props(['type' => 'info'])

@php
    $colors = [
        'success' => 'alert-success', // o clases de Tailwind: bg-green-100 text-green-800
        'danger'  => 'alert-danger',
        'warning' => 'alert-warning',
        'info'    => 'alert-info',
    ];
    $class = $colors[$type] ?? $colors['info'];
@endphp

<div {{ $attributes->merge(['class' => "alert $class"]) }} role="alert">
    {{ $slot }}
</div>