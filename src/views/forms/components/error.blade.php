{{-- 
    attributes id, theme, color, size, class, message
    theme: 'standard'
    id: for identifing the component API
    size: sm, md, lg
    class: for styling
    message: for initial message befor the component renders
    
    API: you can set message or reset message by this methods
    methods: setMessage(), reset()
--}}

@props([
    'id' => '',
    'theme' => '',
    'color' => 'var(--stm-color-danger)',
    'size' => 'md',
    'class' => '',
    'message' => '',
])


@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

$id = Stm::id($id, 'err-');
$color = Color::colorToSnake($color);

$sizes=[
    'sm' => 'text-xs',
    'md' => 'text-sm',
    'lg' => 'text-base', 
];

if(!array_key_exists($size, $sizes)) $size = 'md';

$errs = [
    'standard' => "text-[$color] $sizes[$size] $class",
    'custom' => $class,
];


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $errs) ? $theme : 'standard'; // theme fallback value
@endphp



<div class="{{ $errs[$theme] }}" x-data="errorFn(@js($id), @js($message))" x-text="message"></div>
