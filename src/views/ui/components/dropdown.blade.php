{{-- 
    attributes id, theme, color, backgroundColor class, config
    id: for identifing the component API
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
    'backgroundColor' => 'var(--stm-ui-bg-2)',
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
if(!$no_animation){
    $config['animation'] = []; // if other value then 'none'
    $config['animation']['enter'] ??= 'fadeInDown';
    $config['animation']['leave'] ??= 'fadeOutUp';
    $config['animation']['duration'] ??= '200ms';

    $animationEnter = 'animate__animated animate__'.$config['animation']['enter'];
    $animationLeave = 'animate__animated animate__'.$config['animation']['leave'];
    $duration = '[--animate-duration:'.$config['animation']['duration'].']';
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

<section x-data="dropdownFn(@js($id), @js($config))"
    class="{{ $dropdowns[$theme] }}"
    :id="id" 
    x-on:open-dropdown.window="open($event.detail.id)"
    x-on:close-dropdown.window="close($event.detail.id)" 
    x-on:toggle-dropdown.window="toggle($event.detail.id)"
    x-show="state"
    @if(!$no_animation)
        x-transition:enter="{{ "$animationEnter $duration" }}"
        x-transition:leave="{{ "$animationLeave $duration" }}"
    @endif
    x-cloak 
    {{ $anchor }} 
    @if ($clickOutside) x-on:click.outside="close(id)" @endif
    {{ $attributes }}>
    {{ $slot }}
</section>