@props([
    'theme' => '',
    'size' => 'md',
    'class' => '',
])

@php
use stm\UIcomponents\Support\Stm;


$sizes = [
    'sm' => 'size-12',
    'md' => 'size-16',
    'lg' => 'size-20',
];
if(!array_key_exists($size, $sizes)) $sizes[$size] = "size-[$size]";

$avatars = [
    'standard' => "relative inline-block $sizes[$size] rounded-[100%] object-cover object-center $class",
    'custom' => "$class",
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $btns) ? $theme : 'standard'; // theme fallback value

@endphp


<img
    class="{{ $avatars[$theme] }}"
    {{ $attributes }}
    />