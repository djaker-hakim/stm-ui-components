{{-- 
    attributes theme, color, backgroundColor, size, class
    theme: 'standard', 'stm'
    size: sm, md, lg
    color: component color
    backgroundColor: component background color
    class: for styling
--}}

@props([
    'type' => '',
    'theme' => '',
    'size' => 'md',
    'color' => 'var(--stm-color-bg-1)',
    'backgroundColor' => 'var(--stm-color-accent)',
    'class' => '',
])

@php

use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

$color = Color::colorToSnake($color);
$backgroundColor = Color::colorToSnake($backgroundColor);

$standard = "disabled:opacity-60 file:disabled:hover:opacity-60 file:disabled:cursor-not-allowed disabled:cursor-not-allowed file:disabled:bg-[var(--stm-color-muted)]";

$sizes = [
    'sm' => 'file:px-2 file:md:px-2.5 file:md:py-1 file:py-0.5 text-xs md:text-sm file:text-xs file:md:text-sm',
    'md' => 'file:px-2.5 file:md:px-3 file:md:py-1.5 file:py-1 text-sm md:text-base file:text-sm file:md:text-base',
    'lg' => 'file:px-3 file:md:px-3.5 file:md:py-2 file:py-1.5 text-base md:text-lg file:text-base file:md:text-lg',
];
if(!array_key_exists($size, $sizes)) $size = 'md';


$fileInputs = [
    'standard' => "block w-full cursor-pointer file:cursor-pointer file:rounded-s-md focus:outline-none file:border-none file:hover:opacity-80 file:font-medium bg-[var(--stm-color-bg-2)] rounded-md file:bg-[$backgroundColor] file:text-[$color] transition-colors $sizes[$size] $standard $class",
    'stm' => "block w-full border-b cursor-pointer file:cursor-pointer file:border-none file:bg-[$backgroundColor] file:text-[$color] file:hover:opacity-80 transition-colors file:font-semibold $sizes[$size] $standard $class",
    'custom' => $class,
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $fileInputs) ? $theme : 'standard'; // theme fallback value
@endphp

<input type="file" class="{{ $fileInputs[$theme] }}" {{ $attributes }}>