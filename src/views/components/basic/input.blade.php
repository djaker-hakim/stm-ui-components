@props([
    'type' => 'text',
    'size' => 'md',
    'color' => 'blue',
    'input' => 'standard',
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

    $fileStyles = [
        'custom' => '',
        'standard' => "inline-block w-full text-sm cursor-pointer file:cursor-pointer file:text-sm file:p-2 file:rounded-s-lg focus:outline-none file:border-none file:hover:opacity-80 file:font-medium bg-gray-50 rounded-lg border border-gray-100 file:bg-[$color] file:text-gray-100 transition-colors",
    ];
    $class = "$standard $sizes[$size] $inputStyles[$input] $class";

@endphp


  

@if ($type == 'file')
    
    <input type="{{ $type }}" class="{{ $fileStyles[$input] }}" {{ $attributes }}>

@elseif ($type == 'search')
    <div class="relative flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute w-5 h-5 top-2.5 left-2.5 text-slate-600">
        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
        </svg>
    
        <input type="{{ $type }}" class="pl-10 {{ $class }}" {{ $attributes }}>
    </div>

@elseif($type == 'radio')

    <div class="inline-flex items-center">
        <label class="relative flex items-center cursor-pointer" for="{{ $attributes['id'] }}">
            <input type="{{ $type }}" {{ $attributes }} class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all" >
            <span class="absolute bg-[{{ $color }}] w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            </span>
        </label>
    </div>

@elseif($type == 'switch')

    <div class="relative inline-block w-11 h-5">
        <input type="checkbox" {{ $attributes }} class="peer appearance-none w-11 h-5 bg-slate-100 rounded-full checked:bg-[{{ $color }}] cursor-pointer transition-colors duration-300" />
        <label for="{{ $attributes['id'] }}" class="absolute top-0 left-0 w-5 h-5 bg-white rounded-full border border-slate-300 shadow-sm transition-transform duration-300 peer-checked:translate-x-6 peer-checked:border-[{{ $color }}] cursor-pointer">
        </label>
    </div>
@elseif($type == 'checkbox')

    <div class="inline-flex items-center">
        <label class="flex items-center cursor-pointer relative">
        <input type="{{ $type }}" {{ $attributes }} class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-300 checked:bg-[{{ $color }}] checked:border-[{{ $color }}]" />
        <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
        </span>
        </label>
    </div>
@else
    <input type="{{ $type }}" class="{{ $class }}" {{ $attributes }}>
@endif

