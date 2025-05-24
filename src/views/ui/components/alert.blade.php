{{-- 
    attributes id, theme, color, config
    id: for identifing the component API
    config: array of state, position, style, animation
    state: state of component
    position: start, center, end 
    style: array of containerClass, alertClass to style the alert
    animation: none, array of enter, leave, duration
        none: no animation;
        enter: animation name ex: 'fadeInDown' . (from animate.css)
        leave: animation name ex: 'fadeOutUp' . (from animate.css)
        duration: animation duration ex: '300ms'
    NOTE: in case of html attributes you can't add x-transition or x-transition.scale... you must add x-transition:enter="" (blade component limitation);

    API: you can set the alert message and mode with this methods
    methods: error(), warn(), success(), info(), setContent(), open(), close(), toggle(), openTmp()
    set content with mode: error(), warn(), success(), info()
    set dynamic mode: setContent(content, mode)
    modes: error, warning, info, success
    open or close the alert whith: open(), close(), toggle(), openTmp(duration) open temporerly (4s default)
    
    Events: open-alert, close-alert, toggle-alert
    ex: dispatch('open-alert', {id: 'alert-1'}) 
    NOTE: if you dispatch the event it should have the component id else it will broadcast to all components 
--}}
@props([
    'id' => '',
    'theme' => '',
    'color' => '',
    'config' => []
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

// default values
$config['state'] ??= true;
$config['style']['containerClass']  ??= '';
$config['style']['alertClass']  ??= '';
$config['position'] ??= 'end';
$config['content'] = $slot->toHtml();

$position = $config['position'];
$containerClass = $config['style']['containerClass'];
$alertClass = $config['style']['alertClass'];

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

$id = Stm::id($id, 'alert-');
$color = Color::colorToSnake($color);


$positions = [
    'start' => 'top-[80px] left-[50px]',
    'center' => 'top-[80px] right-1/2 translate-x-1/2',
    'end' => 'top-[80px] right-[50px]',
];
if(!array_key_exists($position, $positions)) $position = 'end';


    $alerts = [
        'standard' => [
            'container' => "absolute $positions[$position] z-[99] p-2 md:max-w-[800px] sm:max-w-[400px] max-w-[280px] text-sm leading-5 rounded-lg $containerClass",
            'alert' => "mr-8 max-h-[180px] overflow-auto text-[$color] $alertClass"
        ],
        'stm' => [
            'container' => "relative p-2 text-sm leading-5 $containerClass",
            'alert' => "mr-8 max-h-[180px] overflow-y-auto overflow-x-hidden text-[$color] $alertClass"
        ],
        'custom' => [
            'container' => $containerClass,
            'alert' => $alertClass
        ]
    ];


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $alerts) ? $theme : 'standard'; // theme fallback value
@endphp

<section class="{{ $alerts[$theme]['container'] }}"
    :class="{ 'bg-[#fccaca]': mode == 'error', 'bg-[#e6f7ff]': mode == 'info', 'bg-[#fcedca]': mode == 'warning', 'bg-[#c7fccb]': mode == 'success' }"
    x-data="alertFn(@js($id), @js($config))"
    x-show="state"
    @if(!$no_animation)
        x-transition:enter="{{ "$animationEnter $duration" }}"
        x-transition:leave="{{ "$animationLeave $duration" }}"
    @endif
    x-cloak
    x-on:open-alert.window="open($event.detail.id)"
    x-on:close-alert.window="close($event.detail.id)" 
    x-on:toggle-alert.window="toggle($event.detail.id)"
    {{$attributes}}>
    
    <div class="{{ $alerts[$theme]['alert'] }}" x-html="content"></div>

    <div class="absolute top-0 right-0 ml-6 m-1">
        <button
            class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg text-center font-sans text-xs font-medium transition-all hover:bg-white/20 active:bg-white/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            x-on:click="close(id)">
            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="size-5" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </span>
        </button>
    </div>
    
</section>

