{{-- 
    attributes theme, color, size, class
    theme: 'standard', 'stm'
    size: sm, md, lg
    color: component color
    class: for styling
--}}
@props([
    'theme' => '',
    'type' => 'text',
    'size' => 'md',
    'color' => 'var(--stm-ui-primary)',
    'class' => '',
])



@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

$color = Color::colorToSnake($color);

$sizes = [
    'sm' => 'px-2 md:px-2.5 md:py-1 py-0.5 text-xs md:text-sm',
    'md' => 'px-2.5 md:px-3 md:py-1.5 py-1 text-sm md:text-base',
    'lg' => 'px-3 md:px-3.5 md:py-2 py-1.5 text-base md:text-lg',
];
if(!array_key_exists($size, $sizes)) $size = 'md';

$standard = 'disabled:opacity-60 disabled:bg-[var(--stm-ui-muted)] disabled:cursor-not-allowed';

$inputs = [
    'standard' => "block w-full bg-[var(--stm-ui-bg-2)] rounded-md focus:bg-[var(--stm-ui-bg-2)] focus:outline-0 focus:border-[$color] border border-transparent invalid:border-[--stm-ui-danger] invalid:focus:border-[--stm-ui-danger] transition-colors $standard $sizes[$size] $class",
    'stm' => "block w-full border-b border-slate-300 bg-[var(--stm-ui-bg-2)] focus:outline-none focus:[border-color:$color] invalid:focus:border-[--stm-ui-danger] invalid:border-[--stm-ui-danger] transition-colors $standard $sizes[$size] $class",
    'custom' => $class,
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $inputs) ? $theme : 'standard'; // theme fallback value
@endphp


<input type="{{ $type }}" class="{{ $inputs[$theme] }}" {{ $attributes }}>


