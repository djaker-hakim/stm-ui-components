{{-- 
    attributes id, theme, color, backgroundColor class, config
    id: for identifing the component API
    theme: 'standard', 'stm'
    color: component color
    backgroundColor: component background color
    class: for styling
    config: array of buttonId, state, position, offset, clickOutside, animation
    buttonId: the button of the dropdown
    state: state of component (bool)
    positions: Bottom: bottom, bottom-start, bottom-end
                Top: top, top-start, top-end
                Left: left, left-start, left-end
                Right: right, right-start, right-end
    offset: value offset of the button (number) default 5
    clickOutside: option to be availibale or not (bool) default true
    animation: none, array of enter, leave, duration
        none: no animation;
        enter: animation name ex: 'fadeInDown' . (from animate.css)
        leave: animation name ex: 'fadeOutUp' . (from animate.css)
        duration: animation duration ex: '300ms'
    NOTE: in case of html attributes you can't add x-transition or x-transition.scale... you must add x-transition:enter="" (blade component limitation);

    API: available methods: open(), close(), toggle()
  
    Events: open-dropdown, close-dropdown, toggle-dropdown
    ex: dispatch('open-dropdown', {id: 'dropdown-1'}) 
    NOTE: if you dispatch the event it should have the component id else it will broadcast to all components 
--}}
@props([
    'id' => '',
    'theme' => '',
    'color' => '',
    'backgroundColor' => 'var(--stm-color-bg-2)',
    'class' => '',
    'config' => [],
])
@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

// default values
$config['state'] ??= false;
$config['position'] ??= 'bottom';
$config['offset'] ??= '5';
$config['clickOutside'] ??= true;


// animations
$config['animation'] ??= [];

$no_animation = ($config['animation'] == 'none');
$transitionEnter = "";
$transitionLeave = "";
if(!$no_animation){
    $config['animation'] = []; // if other value then 'none'
    $config['animation']['enter'] ??= 'fadeInDown';
    $config['animation']['leave'] ??= 'fadeOutUp';
    $config['animation']['duration'] ??= '200ms';

    $animationEnter = 'animate__animated animate__'.$config['animation']['enter'];
    $animationLeave = 'animate__animated animate__'.$config['animation']['leave'];
    $duration = '[--animate-duration:'.$config['animation']['duration'].']';

    $transitionEnter = "x-transition:enter='$animationEnter $duration'";
    $transitionLeave = "x-transition:leave='$animationLeave $duration'";
}

$id = Stm::id($id, 'dropdown-');

$color = Color::colorToSnake($color);
$backgroundColor = Color::colorToSnake($backgroundColor);

$position = trim($config['position']);
$offset = trim($config['offset']);
$clickOutside = $config['clickOutside'] ? true : false;
$anchor = "x-anchor.offset.$offset.$position=" . "document.getElementById('$config[buttonId]')";

$dropdowns = [
    'standard' => "p-2 shadow rounded-md bg-[$backgroundColor] text-[$color] $class",
    'stm' => "p-2 shadow-md bg-[$backgroundColor] text-[$color] $class",
    'custom' => $class
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $dropdowns) ? $theme : 'standard'; // theme fallback value
@endphp

<section x-data="$stm.dropdown(@js($id), @js($config))"
    :id="id" 
    class="{{ $dropdowns[$theme] }}"
    x-on:click.outside="clickOutsideFn()"
    x-on:open-dropdown.window="open($event.detail.id)"
    x-on:close-dropdown.window="close($event.detail.id)" 
    x-on:toggle-dropdown.window="toggle($event.detail.id)"
    x-cloak 
    x-show="state"
    {!! $transitionEnter !!}
    {!! $transitionLeave !!}
    {{ $anchor }} 
    {{ $attributes }}>
    {{ $slot }}
</section>