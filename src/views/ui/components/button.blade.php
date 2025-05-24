{{-- 
    attributes theme, color, backgroudColor, variant, size, class
    color: component color
    backgroudColor: component backgroud color
    variant: solid, outline, elevated
    size: sm, md, lg
    class: for styling
--}}
@props([
    'type' => 'button',
    'theme' => '',
    'color' => 'var(--stm-ui-bg-1)',
    'backgroundColor' => 'var(--stm-ui-primary)',
    'variant' => 'solid',
    'size' => 'md',
    'class' => '',
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

$color = Color::colorToSnake($color);
$backgroundColor = Color::colorToSnake($backgroundColor);


$sizes = [
    'sm' => 'text-sm px-3 py-1',
    'md' => 'text-base px-5 py-2.5',
    'lg' => 'text-lg px-6 py-3',
];
if(!array_key_exists($size, $sizes)) $size = 'md';

$btnVariants = [
    'solid' => "[color:$color] hover:opacity-80 [background-color:$backgroundColor]",
    'outline' => "border [border-color:$backgroundColor] hover:[background-color:$backgroundColor] hover:[color:$color] [color:$backgroundColor]",
    'elevated' => "[color:$color] hover:-translate-y-0.5 hover:shadow-md [background-color:$backgroundColor]",
];
if(!array_key_exists($variant, $btnVariants)) $variant = 'solid';

$standard ='focus:outline-none  disabled:opacity-60 disabled:cursor-not-allowed disabled:active:scale-100 active:scale-95';

$btns = [
    'standard' => "focus:ring-2 font-medium rounded-md $btnVariants[$variant] $sizes[$size] $standard $class",
    'stm' => "font-semibold shadow-sm $btnVariants[$variant] $sizes[$size] $standard $class",
    'custom' => $class,
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $btns) ? $theme : 'standard'; // theme fallback value
@endphp

<button type="{{ $type }}" class="{{ $btns[$theme] }}" {{ $attributes }}>
    {{ $slot }}
</button>
