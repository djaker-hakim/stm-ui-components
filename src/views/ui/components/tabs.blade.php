{{-- 
    attributes: id, theme, color, backgroudColor, data, config
    id: for identifing the component API
    theme: 'standard', 'stm'
    color: component color
    backgroudColor: component backgroud color
    data: array of tabs and targets, ex: ['lable' => 'bloc A', 'value' => 'blocA',  'target' => '#bloc-a', 'disabled' => false]
    config: array of style
        style: array of tabClass, activeTabClass, containerClass
    
    API: available methods: activate(value), disable(value), enable(value)
        disable(), enable() disables and enables the tab
--}}
@props([
    'id' => '',
    'theme' => '',
    'color' => 'var(--stm-ui-bg-1)',
    'backgroundColor' => 'var(--stm-ui-primary)',
    'data', 
    'config' => []
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

// default values
$config['style']['tabClass'] ??= '';
$config['style']['activeTabClass'] ??= '';
$config['style']['containerClass'] ??= '';

// varibalse from config
extract($config['style']);

$id = Stm::id($id, 'tabs-');

$color = Color::colorToSnake($color);
$backgroundColor = Color::colorToSnake($backgroundColor);
    
$tabs=[
    'standard' => [
        'tab' => "inline-block px-4 py-3 rounded-t-lg cursor-pointer text-center hover:text-gray-900 hover:bg-gray-100 disabled:opacity-60 disabled:hover:bg-transparent disabled:text-[var(--stm-ui-muted)] disabled:cursor-not-allowed disabled:hover:text-[var(--stm-ui-muted)] $tabClass",
        'activeTab' => "inline-block px-4 py-3 rounded-t-lg cursor-pointer text-center text-[$color] bg-[$backgroundColor] $activeTabClass",
        'container' => "$containerClass",
    ],
    'stm' =>[
        'tab' => "inline-block px-4 py-3 cursor-pointer text-center hover:text-gray-900 hover:bg-gray-100 disabled:opacity-60 disabled:hover:bg-transparent disabled:text-[var(--stm-ui-muted)] disabled:cursor-not-allowed disabled:hover:text-[var(--stm-ui-muted)] $tabClass",
        'activeTab' => "inline-block px-4 py-3 cursor-pointer text-center text-[$backgroundColor] bg-[$color] border-b-2 border-[$backgroundColor] $activeTabClass",
        'container' => "$containerClass",
    ],
    'custom' => [
        'tab' => $tabClass,
        'activeTab' => $activeTabClass,
        'container' => $containerClass
    ]
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $tabs) ? $theme : 'standard'; // theme fallback value
@endphp




<section :id="id" x-data="tabsFn(@js($id), @js($data), @js($config))" {{ $attributes }}>
    <div class="flex w-full overflow-x-auto space-x-2">
        <template x-for="(tab, index) in tabs" :key="'tab-' + index">
            <button type="button" :class="activeTab == tab.value ? '{{ $tabs[$theme]["activeTab"] }}' : '{{ $tabs[$theme]["tab"]}}'" x-on:click="activate(tab.value)" :disabled="!!tab.disabled" x-html="tab.lable">
            </button>
        </template>
    </div>

    <div class="{{ $tabs[$theme]['container'] }}">
        {{ $slot }}
    </div>
</section>

