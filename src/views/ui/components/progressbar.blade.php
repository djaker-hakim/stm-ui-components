{{-- 
    attributes id, theme, color, size, config
    id: for identifing the component API
    theme: 'standard', 'stm'
    color: component color
    size: xs, sm, md, lg
    config: array of progress, duration, pourcentage, style
        progress: initial progress (number) default 0
        duration: speed to get from progress to target progress
        pourcentage: 'none', 'start', 'center', 'end' default none
        style: array of lableClass, containerClass, fillClass, pourcentageClass
    
    API: available methods: setProgess(), setLable(), setDuration();

    NOTE: for the infinite you need to set progress to 'infinite'
--}}
@props([
    'id' => '',
    'theme' => '',
    'color'=> 'var(--stm-ui-primary)',
    'size' => 'md',
    'config' => [],    
])
@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;


// default values
$config['progress'] ??= 0; 
$config['duration'] ??= 16; 
$config['pourcentage'] ??= 'none';
$config['style']['lableClass'] ??= '';
$config['style']['containerClass'] ??= '';
$config['style']['fillClass'] ??= '';
$config['style']['pourcentageClass'] ??= '';

$id = Stm::id($id, 'dropdown-');

$color = Color::colorToSnake($color);

// varibales from config
$duration = $config['duration'];
extract($config['style']);

$sizes = [
    'xs' => "h-1",
    'sm' => "h-2",
    'md' => "h-4",
    'lg' => "h-6"
];
if(!array_key_exists($size, $sizes)) $size = 'md';


$pourcentages = [
    'start' => "flex justify-start",
    'center' => "flex justify-center",
    'end' => "flex justify-end",
    'in' => "",
    'none' => "hidden"
];
if(!array_key_exists($pourcentage, $pourcentages)) $pourcentage = 'none';

$progressbars = [
    'standard' => [
        'lable' => "text-sm $lableClass",
        'container' => "w-full bg-gray-200 rounded-full overflow-hidden $sizes[$size] $containerClass",
        'fill' => "bg-[$color] flex justify-center items-center h-full transition-all duration-[$duration"."ms]",
        'pourcentage' => "text-sm " .$pourcentages[$config['pourcentage']]." $pourcentageClass"
    ],
    'stm' => [
        'lable' => "text-sm $lableClass",
        'container' => "w-full bg-gray-200 overflow-hidden $sizes[$size] $containerClass",
        'fill' => "bg-[$color] flex justify-center items-center h-full transition-all duration-[$duration"."ms]",
        'pourcentage' => "text-sm " .$pourcentages[$config['pourcentage']]." $pourcentageClass"
    ],
    'custom' => [
        'lable' => "$lableClass",
        'container' => "$containerClass",
        'fill' => "$fillClass",
        'pourcentage' => "$pourcentageClass"
    ]
];


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $progressbars) ? $theme : 'standard'; // theme fallback value
@endphp

<section :id="id" x-data="progressBarFn(@js($id), @js($config))" {{ $attributes }}>

    {{-- <!-- Progress Bar lable --> --}}
    <div class="{{ $progressbars[$theme]['lable'] }}"
        x-text="lable"
    ></div>
    {{-- <!-- Progress Bar Container --> --}}
    <div class="{{ $progressbars[$theme]['container'] }}"
        :class="progress === -1 ? 'relative' : '' " 
    >
        {{-- <!-- Progress Fill --> --}}
        <div
            class="{{ $progressbars[$theme]['fill'] }}"
            :class="progress === -1 ? 'absolute animate-progress-bar w-1/3' : ''" 
            :style="progress === -1 ? '' : `width: ${progress}%`"
        >
            @if($config['pourcentage'] == 'in')
                <div class="{{ $progressbars[$theme]['pourcentage'] }}" >
                    <span x-text="progress === -1 || progress === 0 ? '' : progress + '%'"></span>
                </div>
            @endif
        </div>
    </div>
    @if($config['pourcentage'] != 'in')
        <div class="{{ $progressbars[$theme]['pourcentage'] }}" >
            <span x-text="progress === -1 ? '' : progress + '%'"></span>
        </div>
    @endif

</section>
