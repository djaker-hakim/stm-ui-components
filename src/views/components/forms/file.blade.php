@props([
    'type' => '',
    'theme' => '',
    'size' => 'md',
    'color' => 'var(--stm-ui-primary)',
    'class' => '',
])

@php

use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));


$standard = "disabled:opacity-60 file:disabled:hover:opacity-60 file:disabled:cursor-not-allowed disabled:cursor-not-allowed file:disabled:bg-[var(--stm-ui-muted)]";

$sizes = [
        'sm' => 'px-1.5 py-1.5 text-sm file:text-xs file:p-1.5',
        'md' => 'px-1.5 py-2 text-base file:p-2 file:text-sm',
        'lg' => 'px-1.5 py-2 text-lg file:text-base file:p-2',
];


$fileInputs = [
    'standard' => "inline-block w-full cursor-pointer file:cursor-pointer file:rounded-s-lg focus:outline-none file:border-none file:hover:opacity-80 file:font-medium bg-[var(--stm-ui-bg-2)] rounded-lg border border-gray-100 file:bg-[$color] file:text-gray-100 transition-colors $sizes[$size] $standard $class",
    'stm' => "inline-block w-full border-b cursor-pointer file:cursor-pointer file:border-none file:bg-[$color] file:text-gray-100 file:hover:opacity-80 transition-colors file:font-bold $sizes[$size] $standard $class",
    'custom' => $class,
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $fileInputs) ? $theme : 'standard'; // theme fallback value

@endphp

<input type="file" class="{{ $fileInputs[$theme] }}" {{ $attributes }}>