{{-- 
    attributes theme, color, backgroudColor, class, config
    color: component color
    backgroudColor: component backgroud color
    class: for styling
    config: array of sticky
        sticky: option (bool) default false
--}}
@props([
    'theme' => '',
    'color' => '',
    'backgroundColor' => 'var(--stm-ui-bg-2)',
    'class' => '',
    'config' => [
        'sticky' => false,
    ]
])
@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

// default values
$config['sticky'] ??= false;
$stickyClass = $config['sticky'] ? 'sticky top-0' : '' ;
 
$color = Color::colorToSnake($color);
$backgroundColor = Color::colorToSnake($backgroundColor);

$navbars = [
    'standard' => "flex justify-between items-center px-5 sm:px-10 md:px-20 max-h-[50px] md:max-h-[70px] bg-[$backgroundColor] text-[$color] $stickyClass $class",
    'custom' => $class,
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $navbars) ? $theme : 'standard'; // theme fallback value
@endphp

<nav class="{{ $navbars[$theme] }}" {{ $attributes }}>
    <div {{ $start->attributes }}>
        {{ $start }}
    </div>

    <div {{ $center->attributes }}>
        {{ $center }}
    </div>

    <div {{ $end->attributes }}>
        {{ $end }}
    </div>
</nav>

