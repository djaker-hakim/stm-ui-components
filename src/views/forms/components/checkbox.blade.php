{{-- 
    attributes: theme, color, size, config
    theme: 'standard'
    color: component color 
    size: sm, md, lg
    config: array of style
        style: array of containerClass, lableClass, inputClass, iconClass to style the checkbox
--}}
@props([
    'type' => '',
    'theme' => '',
    'color' => 'var(--stm-color-accent)',
    'size' => 'md',
    'config' => []
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

// default Values
$config['style']['containerClass'] ??= '';
$config['style']['lableClass'] ??= '';
$config['style']['inputClass'] ??= '';
$config['style']['iconClass'] ??= '';


$color = Color::colorToSnake($color);

// varibales from config
extract($config['style']);

$sizes = [
    'sm' => "size-4 md:size-[18px]",
    'md' => "size-[18px] md:size-5",
    'lg' => "size-5 md:size-[22px]",
];
$iconSizes = [
    'sm' => "size-3 md:size-3.5",
    'md' => "size-3.5 md:size-4",
    'lg' => "size-4 md:size-[18px]",
];
if(!array_key_exists($size, $sizes)) $size = 'md';

$checkboxes = [
    'standard' => [
        'container' => "inline-flex items-center $containerClass",
        'lable' => "flex items-center cursor-pointer relative $lableClass",
        'input' => "peer cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-300 bg-white checked:bg-[$color] checked:border-[$color] disabled:bg-[var(--stm-color-muted)] disabled:opacity-60 $sizes[$size] $inputClass",
        'icon' => "absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none $iconSizes[$size] $iconClass"
    ],
    'custom' => [
        'container' => "$containerClass",
        'lable' => "$lableClass",
        'input' => "$inputClass",
        'icon' => "$iconClass"
    ]
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $checkboxes) ? $theme : 'standard'; // theme fallback value
@endphp

<div class="{{ $checkboxes[$theme]['container'] }}">
    <label class="{{ $checkboxes[$theme]['lable'] }}">
    <input type="checkbox" {{ $attributes }} class="{{ $checkboxes[$theme]['input'] }}" />
    <span class="{{ $checkboxes[$theme]['icon'] }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
    </span>
    </label>
</div>