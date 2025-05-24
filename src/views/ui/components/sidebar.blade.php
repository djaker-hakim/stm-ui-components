{{-- 
    attributes id, theme, color, backgroudColor, class, config
    id: for identifing the component API
    color: component color
    backgroudColor: component backgroud color
    class: for styling
    config: array of state, maxWidth, minWidth, height, position, breakpoint
        state: sidebar init state (bool) default true
        maxWidth: expanded sidebar full width default '200px'
        minWidth: min width that the sidebar in off state (just in large screens) default '0px'
        height: the height of sidebar default '100dvh'
        position: left, right
        beakpoint: array of width, clickOutside
            width: breakpoint width
            clickOutside: enable clickOutside
    
    API: available methods: open(), close(), toggle();
    NOTE: if using btn outside make sure you stop propagation because it will make a conflic with clickOutside
    
    Events: open-sidebar, close-sidebar, toggle-sidebar
    ex: dispatch('open-sidebar', {id: 'sidebar-1'}) 
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

    //  default values
    $config['state'] ??= true;
    $config['maxWidth'] ??= '200px';
    $config['minWidth'] ??= '0px';
    $config['height'] ??= '100dvh';
    $config['position'] ??= 'left';
    $config['breakpoint']['width'] ??= 765;
    $config['breakpoint']['clickOutside'] ??= true;

    $id = Stm::id($id, 'sidebar-');

    $color = Color::colorToSnake($color);
    $backgroundColor = Color::colorToSnake($backgroundColor);

    $state = $config['state'];
    $height = $config['height'];
    $maxWidth = $config['maxWidth'];
    $minWidth = $config['minWidth'];
    $position = $config['position'];
    $clickOutside = $config['breakpoint']['clickOutside'];

    $positions = [
        'left' => 'left-0',
        'right' => 'right-0',
    ];
    if (!array_key_exists($position, $positions)) $position = 'left';

    $heightClass = "h-[$height]";
    $maxWidthClass = "w-[$maxWidth]";
    $minWidthClass = "w-[$minWidth]";

    $sidebars = [
        'standard' => [
            'container' => "absolute md:relative md:p-2 py-2 overflow-hidden z-10 transition-[width] duration-200 md:z-0 top-0 $heightClass $positions[$position] text-[$color] bg-[$backgroundColor] $class",
        ],
        'custom' => [
            'container' => "$class",
        ],
    ];

    $number = (int) filter_var($minWidth, FILTER_SANITIZE_NUMBER_INT);

    $theme = $theme ? $theme : Stm::styles()->theme;
    $theme = array_key_exists($theme, $sidebars) ? $theme : 'standard'; // theme fallback value
@endphp

<section class="relative">
    <aside x-data="sideBarFn('{{ $id }}', @js($config))" class="{{ $sidebars[$theme]['container'] }}" id="{{ $id }}"
        @if (!$state) x-cloak @endif
        @if ($number > 0) :class="state ? '{{ $maxWidthClass }}' : '{{ "md:$minWidthClass w-0" }}'"
    @else
        x-show="state"
        x-transition:enter="transition-[width] duration-500"
        x-transition:enter-start="{{ $minWidthClass }}"
        x-transition:enter-end="{{ $maxWidthClass }}"
        x-transition:leave="transition-[width] duration-500 {{ $minWidthClass }}" @endif
        @if ($clickOutside) x-on:click.outside="if(window.innerWidth < breakpoint.width) close(id)" @endif
        x-on:resize.window ="checkSize()" x-on:open-sidebar.window="open($event.detail.id)"
        x-on:close-sidebar.window="close($event.detail.id)" x-on:toggle-sidebar.window="toggle($event.detail.id)"
        {{ $attributes }}>
        <div class="side">
            {{ $slot }}
        </div>

    </aside>
</section>
