@props([
    'type' => '',
    'theme' => '',
    'size' => 'md',
    'color' => 'var(--stm-ui-primary)',
    'class' => '',
    'config' => []
])


@php

use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

//  default values

$config['style']['containerClass'] ??= '';
$config['style']['inputClass'] ??= '';
$config['style']['iconClass'] ??= '';


$containerClass = $config['style']['containerClass'];
$inputClass = $config['style']['inputClass'];
$iconClass = $config['style']['iconClass'];

$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));


$standard = 'focus:outline-none invalid:border-red-500 disabled:opacity-60 disabled:bg-[var(--stm-ui-muted)] disabled:cursor-not-allowed pl-10';

$sizes = [
    'sm' => 'px-1 py-1 text-sm',
    'md' => 'px-1 py-1.5 text-base',
    'lg' => 'px-1 py-2 text-lg',
];

$colors = "focus:[border-color:$color]";

$searchInputs = [
    'standard' => [
        'container' => "relative flex items-center $containerClass",
        'input' => "inline-block w-full bg-[var(--stm-ui-bg-2)] rounded-md focus:border-2 focus:[border-color:$color] focus:bg-[var(--stm-ui-bg-2)] transition-colors $standard $sizes[$size] $inputClass",
        'icon' => "absolute w-5 h-5 top-2.5 left-2.5 text-[var(--stm-ui-muted)] $iconClass"
    ],
    'stm' => [
        'container' => "relative flex items-center $containerClass",
        'input' => "inline-block w-full border-b border-slate-300 bg-[var(--stm-ui-bg-2)] focus:[border-color:$color] transition-colors $standard $sizes[$size] $inputClass",
        'icon' => "absolute w-5 h-5 top-2.5 left-2.5 text-[var(--stm-ui-muted)] $iconClass"
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
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="">
            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
        </svg>  
    </span>
    <input type="text" class="{{ $searchInputs[$theme]['input'] }}" {{ $attributes }}>
</div>