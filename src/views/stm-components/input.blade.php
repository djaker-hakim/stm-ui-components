@props([
    'type' => 'text',
    'size' => 'md',
    'color' => 'blue',
    'input' => 'standard',
    'class' => ''
])

@php

    $sizes = [
        'sm' => 'px-1 py-1',
        'md' => 'px-1 py-1.5',
        'lg' => 'px-1 py-2'
    ];
    $standard = "focus:outline-none invalid:border-red-500 disabled:opacity-50 disabled:cursor-not-allowed";

    $inputStyles = [
        'custom' => '',
        'stm' => "inline-block w-full border-b border-slate-700 bg-gray-100 focus:border-$color-600 transition-colors",
        'standard' => "inline-block w-full bg-gray-50 rounded-md focus:border-2 focus:border-$color-500 focus:bg-gray-50 transition-colors",     
    ]; 
    $class="$standard $sizes[$size] $inputStyles[$input] $class";


@endphp

<input 
type="{{ $type }}"
class="{{ $class }}"
{{ $attributes }}>

