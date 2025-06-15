{{-- 
    attributes id, theme, color, size, class, options, selected
        theme: 'standard', 'stm'
        id: for identifing the component API
        size: sm, md, lg
        class: for styling
        options: array of the select options KEY is the value in option and VALUE is the innertext ex: ['blue' => 'Blue', 'red' => 'Red']
        selected: give a KEY(value) of option to be selected ex: 'blue'
        
    API: you can get the selected value by this method
    method: getSelected();
--}}

@props([
    'id' => '',
    'theme' => '',
    'size' => 'md',
    'color' => 'var(--stm-ui-accent)',
    'class' => '',
    'options' => [],
    'selected' => '',
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

$id = Stm::id($id, 'select-');
$color = Color::colorToSnake($color);

$sizes = [
    'sm' => 'px-2 md:px-2.5 md:py-1 py-0.5 text-xs md:text-sm',
    'md' => 'px-2.5 md:px-3 md:py-1.5 py-1 text-sm md:text-base',
    'lg' => 'px-3 md:px-3.5 md:py-2 py-1.5 text-base md:text-lg',
];

if(!array_key_exists($size, $sizes)) $size = 'md';

$standard = 'disabled:opacity-60 disabled:bg-[var(--stm-ui-muted)] disabled:cursor-not-allowed';

$selects = [
    'standard' => "block w-full bg-[var(--stm-ui-bg-2)] rounded-md focus:bg-[var(--stm-ui-bg-2)] focus:outline-0 focus:border-[$color] border border-transparent invalid:border-[--stm-ui-danger] invalid:focus:border-[--stm-ui-danger] transition-colors $standard $sizes[$size] $class",
    'stm' => "block w-full border-b border-slate-300 bg-[var(--stm-ui-bg-2)] focus:outline-none focus:[border-color:$color] invalid:focus:border-[--stm-ui-danger] invalid:border-[--stm-ui-danger] transition-colors $standard $sizes[$size] $class",
    'custom' => $class,
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $selects) ? $theme : 'standard'; // theme fallback value
@endphp

<select :id="id" x-data="selectFn(@js($id), @js($options), @js($selected))" class="{{ $selects[$theme] }}" {{ $attributes }}>
    <template x-for="(value, key) in options" :key="key">
        <option :selected="key == selected" :value="key" x-text="value"></option>
    </template>
</select>