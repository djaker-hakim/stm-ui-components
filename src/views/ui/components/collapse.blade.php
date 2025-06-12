{{-- 
    attributes id, theme, color, backgroundColor class, config
    id: for identifing the component API
    theme: 'standard', 'stm'
    color: component color
    backgroundColor: component background color
    class: for styling
    config: array of state
    state: state of component
    
    API: you can set the collapse state this methods
    methods: open(), close(), toggle()
  
    Events: open-collapse, close-collapse, toggle-collapse
    ex: dispatch('open-collapse', {id: 'collapse-1'}) 
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

$id = Stm::id($id, 'collapse-');

$color = Color::colorToSnake($color);
$backgroundColor = Color::colorToSnake($backgroundColor);

$collapses = [
    'standard' => "p-2 bg-[$backgroundColor] text-[$color] $class",
    'stm' => "p-2 shadow-md bg-[$backgroundColor] text-[$color] $class",
    'custom' => "$class"
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $collapses) ? $theme : 'standard'; // theme fallback value
@endphp


<section 
:id="id"
class="{{ $collapses[$theme] }}";
x-data="collapseFn(@js($id), @js($config))" 
x-on:open-collapse.window="open($event.detail.id)"
x-on:close-collapse.window="close($event.detail.id)" 
x-on:toggle-collapse.window="toggle($event.detail.id)"
x-show="state" 
x-cloak 
x-collapse 
{{ $attributes }}>
    {{ $slot }}
</section>
