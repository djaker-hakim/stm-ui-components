{{-- 
    attributes: theme, color, size
        theme: 'standard'
        size: sm, md, lg 
        config: array of style
            style: array of containerClass, lableClass, inputClass to style the switch
--}}
@props([
    'type' => '',
    'theme' => '',
    'size' => 'md',
    'color' => 'var(--stm-color-accent)',
    'config' => [
        'style' => [
            'containerClass' => '',
            'lableClass' => '',
            'inputClass' => '',
        ]
    ]
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

// default Values
$config['style']['containerClass'] ??= '';
$config['style']['lableClass'] ??= '';
$config['style']['inputClass'] ??= '';

$color = Color::colorToSnake($color);

// varibales from config
extract($config['style']);

$sizes = [
    'sm' => 20,
    'md' => 25,
    'lg' => 30,
];
if(!array_key_exists($size, $sizes)) $size = 'md';

$switches = [
    'standard' => [
        'container' => "relative inline-block w-[". $sizes[$size] * 2 ."px] h-[$sizes[$size]px] $containerClass",
        'lable' => "absolute top-0 left-0 size-[$sizes[$size]px] bg-white rounded-full border border-slate-300 shadow-sm transition-transform duration-200 peer-checked:translate-x-[$sizes[$size]px] peer-checked:border-[$color] cursor-pointer peer-disabled:opacity-60 peer-disabled:cursor-not-allowed $lableClass",
        'input' => "peer appearance-none w-[". $sizes[$size] * 2 ."px] h-[$sizes[$size]px] bg-[var(--stm-color-muted)] rounded-full checked:bg-[$color] cursor-pointer transition-colors duration-200 disabled:opacity-60 disabled:cursor-not-allowed"
    ],
    'custom' => [
        'container' => $containerClass,
        'lable' => $lableClass,
        'input' => $inputClass
    ]
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $switches) ? $theme : 'standard'; // theme fallback value
@endphp


<div class="{{ $switches[$theme]['container'] }}">
    <input type="checkbox" {{ $attributes }} class="{{ $switches[$theme]['input'] }}" />
    <label for="{{ $attributes['id'] }}" class="{{ $switches[$theme]['lable'] }}"></label>
</div>