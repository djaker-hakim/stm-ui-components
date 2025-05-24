{{-- 
    attributes theme, color, size, class
    size: sm, md, lg
    color: component color
    class: for styling
--}}
@props([
    'type' => '',
    'theme' => '',
    'color' => 'var(--stm-ui-primary)',
    'size' => 'md',
    'class' => '',
])


@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

$color = Color::colorToSnake($color);

$sizes = [
    'sm' => 'px-1 py-1 text-sm',
    'md' => 'px-1 py-1.5 text-base',
    'lg' => 'px-1 py-2 text-lg',
];
if(!array_key_exists($size, $sizes)) $size = 'md';

$standard = 'focus:outline-none invalid:border-red-500 disabled:opacity-60 disabled:bg-[var(--stm-ui-muted)] disabled:cursor-not-allowed';

$textareas = [
    'standard' => "inline-block w-full bg-gray-50 rounded-md focus:border-2 focus:[border-color:$color] focus:bg-gray-50 transition-colors $standard $sizes[$size] $class",
    'stm' => "inline-block w-full border-b border-slate-700 bg-gray-100 focus:[border-color:$color] transition-colors $standard $sizes[$size] $class",
    'custom' => $class,
];
    
$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $textareas) ? $theme : 'standard'; // theme fallback value
@endphp

<textarea class="{{ $textareas[$theme] }}" {{ $attributes }}>
{{ $slot }}
</textarea>
