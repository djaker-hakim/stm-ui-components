@props([
    'type' => '',
    'theme' => '',
    'size' => 'md',
    'color' => 'var(--stm-ui-primary)',
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
$config['style']['iconClass'] ??= '';

$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

$containerClass = $config['style']['containerClass'];
$lableClass = $config['style']['lableClass'];
$inputClass = $config['style']['inputClass'];
$iconClass = $config['style']['iconClass'];

$radios = [
    'standard' => [
        'container' => "inline-flex items-center $containerClass",
        'lable' => "relative flex items-center cursor-pointer $lableClass",
        'input' => "peer h-5 w-5 cursor-pointer appearance-none rounded-full border disabled:bg-[var(stm--ui-muted)] disabled:opacity-60 disabled:cursor-not-allowed border-slate-300 checked:border-slate-400 transition-all $inputClass",
        'icon' => "absolute peer-checked:bg-[$color] w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 peer-disabled:cursor-not-allowed $iconClass"
    ],
    'custom' => [
        'container' => "$containerClass",
        'lable' => "$lableClass",
        'input' => "$inputClass",
        'icon' => "$iconClass"
    ]
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $radios) ? $theme : 'standard'; // theme fallback value

@endphp

<div class="{{ $radios[$theme]['container'] }}">
    <label class="{{ $radios[$theme]['lable'] }}" for="{{ $attributes['id'] }}">
        <input type="radio" {{ $attributes }} class="{{ $radios[$theme]['input'] }}" >
        <span class="{{ $radios[$theme]['icon'] }}"></span>
    </label>
</div>