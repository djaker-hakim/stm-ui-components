{{-- it has a standerd cutomizations for more cutumizations better create own styled textarea --}}

@props([
    'size' => 'md',
    'color' => 'blue',
    'textarea' => 'standard',
    'class' => '',
])

@php

    $standard = 'focus:outline-none invalid:border-red-500 disabled:opacity-50 disabled:cursor-not-allowed';

    $sizes = [
        'sm' => 'px-1 py-1 text-sm',
        'md' => 'px-1 py-1.5 text-base',
        'lg' => 'px-1 py-2 text-lg',
    ];

    $colors = "focus:[border-color:$color]";

    $inputStyles = [
        'custom' => '',
        'stm' => "inline-block w-full border-b border-slate-700 bg-gray-100 $colors transition-colors",
        'standard' => "inline-block w-full bg-gray-50 rounded-md focus:border-2 $colors focus:bg-gray-50 transition-colors",
    ];
    $class = "$standard $sizes[$size] $inputStyles[$textarea] $class";

@endphp

<textarea class="{{ $class }}" {{ $attributes }}>
{{ $slot }}
</textarea>
