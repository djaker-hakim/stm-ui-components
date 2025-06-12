{{-- 
    attributes: theme, color, size, config
    theme: 'standard', 'stm'
    config: array of style
        style: array of containerClass, inputClass, iconClass to style the search
--}}

@props([
    'type' => '',
    'theme' => '',
    'size' => 'md',
    'color' => 'var(--stm-ui-primary)',
    'config' => []
])


@php

use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

//  default values
$config['style']['containerClass'] ??= '';
$config['style']['inputClass'] ??= '';
$config['style']['iconClass'] ??= '';

// varibales from config
extract($config['style']);

$color = Color::colorToSnake($color);

$sizes = [
    'sm' => 'px-2 md:px-2.5 md:py-1 py-0.5 text-xs md:text-sm pl-7 md:pl-8',
    'md' => 'px-2.5 md:px-3 md:py-1.5 py-1 text-sm md:text-base pl-8 md:pl-9',
    'lg' => 'px-3 md:px-3.5 md:py-2 py-1.5 text-base md:text-lg pl-9 md:pl-10',
];
$iconSizes = [
    'sm' => "size-4 md:size-5",
    'md' => "size-5 md:size-6",
    'lg' => "size-6 md:size-7"
];
if(!array_key_exists($size, $sizes)) $size = 'md';

$standard = 'disabled:opacity-60 disabled:bg-[var(--stm-ui-muted)] disabled:cursor-not-allowed';

$searchInputs = [
    'standard' => [
        'container' => "relative flex items-center $containerClass",
        'input' => "block w-full bg-[var(--stm-ui-bg-2)] rounded-md focus:bg-[var(--stm-ui-bg-2)] focus:outline-0 focus:border-[$color] border border-transparent invalid:border-[--stm-ui-danger] invalid:focus:border-[--stm-ui-danger] transition-colors $standard $sizes[$size] $inputClass",
        'icon' => "absolute top-1/2 left-2 -translate-y-1/2 text-[var(--stm-ui-muted)] $iconSizes[$size] $iconClass"
    ],
    'stm' => [
        'container' => "relative flex items-center $containerClass",
        'input' => "block w-full border-b border-slate-300 bg-[var(--stm-ui-bg-2)] focus:outline-none focus:[border-color:$color] invalid:focus:border-[--stm-ui-danger] invalid:border-[--stm-ui-danger] transition-colors $standard $sizes[$size] $inputClass",
        'icon' => "absolute top-1/2 left-2 -translate-y-1/2 text-[var(--stm-ui-muted)] $iconSizes[$size] $iconClass"
    ],
    'custom' => [
        'container' => "$containerClass",
        'input' => "$inputClass",
        'icon' => "$iconClass",
    ]
];


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $searchInputs) ? $theme : 'standard'; // theme fallback value
@endphp

<div class="{{ $searchInputs[$theme]['container'] }}">
    <span class="{{ $searchInputs[$theme]['icon'] }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" >
            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
        </svg>  
    </span>
    <input type="text" class="{{ $searchInputs[$theme]['input'] }}" {{ $attributes }}>
</div>