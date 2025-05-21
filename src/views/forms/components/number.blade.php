@props([
    'type' => '',
    'size' => 'md',
    'color' => 'var(--stm-ui-primary)',
    'class' => '',
    'theme' => '',
])

@php

use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;


$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

$standard = 'pr-8 focus:outline-none invalid:border-red-500 disabled:opacity-60 disabled:bg-[var(--stm-ui-muted)] disabled:cursor-not-allowed';

$sizes = [
    'sm' => 'px-1 py-1 text-sm',
    'md' => 'px-1 py-1.5 text-base',
    'lg' => 'px-1 py-2 text-lg',
];

$colors = "focus:[border-color:$color]";

$numberInputs = [
    'standard' => "inline-block w-full bg-[var(--stm-ui-bg-2)] rounded-md focus:border-2 focus:[border-color:$color] focus:bg-[var(--stm-ui-bg-2)] transition-colors $standard $sizes[$size] $class",
    'stm' => "inline-block w-full border-b border-slate-300 bg-[var(--stm-ui-bg-2)] focus:[border-color:$color] transition-colors $standard $sizes[$size] $class",
    'custom' => $class,
];


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $numberInputs) ? $theme : 'standard'; // theme fallback value

@endphp

<input type="number" class="{{ $numberInputs[$theme] }}" {{ $attributes }}>