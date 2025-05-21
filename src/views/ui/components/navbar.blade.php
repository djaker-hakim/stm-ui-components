{{-- ID is a must for toggleing the collapse menu of the nav-bar
EVENTS: "open-navbar" "close-navbar" "toggle-navbar" with ID of the navbar --}}
{{-- there is no option for a custom nav only add supported classes --}}
{{-- bgcolor, color varibales of class names it uses tailwind class as default  --}}
{{-- clickOutside default is true --}}

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

$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

$backgroundColorFormat = Color::detectColorFormat($backgroundColor);
if($backgroundColorFormat == 'rgb' || 'hsl' || 'rgba' ) $backgroundColor = str_replace(' ', '_', trim($backgroundColor));

     
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

