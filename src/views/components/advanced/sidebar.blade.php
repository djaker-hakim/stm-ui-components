{{-- ID is a must for toggleing the sidebar
EVENTS: "open-sidebar" "close-sidebar" "toggle-sidebar" with ID of the sidebar --}}
{{-- you can define the init state of sidebar with state var --}}
{{-- you can choose defrent sidebars by choosing from : "standard", "expand", "custom" --}}
{{-- by defining a class and transitionStart transitionEnd you can customize sidebar transition --}}
{{-- you can choose the side for sidebar with position var "left" "right" --}}
{{-- you can add or remove the breaking-point of the sidebar by the bp var : bool default "true"  --}}


@props([
    'id',
    'sidebar' => 'standard',
    'class' => '',
    'config' => [
        'state' => true,
        'maxWidth' => '200px',
        'minWidth' => '0px',
        'height' => 'calc(100vh-70px)',
        'backgroundColor' => 'gray',
        'position' => 'left',
        'breakpoint' => [
            'width' => 765,
            'clickOutside' => true,
        ]
    ],
])


@php

    isset($config['state']) ? '' : $config['state'] = true ;
    isset($config['maxWidth']) ? '' : $config['maxWidth'] = '200px' ;
    isset($config['minWidth']) ? '' : $config['minWidth'] = '0px' ;
    isset($config['height']) ? '' : $config['height'] = 'calc(100vh-70px)';
    isset($config['backgroundColor']) ? '' : $config['backgroundColor'] = 'gray';
    isset($config['position']) ? '' : $config['position'] = 'left';
    isset($config['breakpoint']['width']) ? '' : $config['breakpoint']['width'] = 765;
    isset($config['breakpoint']['clickOutside']) ? '' : $config['breakpoint']['clickOutside'] = true;

    


    $state= $config['state'];
    $height= $config['height'];
    $maxWidth = $config['maxWidth'];
    $minWidth = $config['minWidth'];
    $position= $config['position'];
    $backgroundColor = $config['backgroundColor'];
    $clickOutside = $config['breakpoint']['clickOutside'];


    $positions=[
        'left' => 'left-0',
        'right' => 'right-0'
    ];

    $heightClass="h-[$height]";
    $maxWidthClass="w-[$maxWidth]";
    $minWidthClass="w-[$minWidth]";

    $backgroundColorClass = "bg-[$backgroundColor]";

    $sidebars= [
        'standard' => [
            'container' => "absolute md:relative py-2 overflow-hidden z-10 bg-gray-200 transition-[width] duration-500 md:z-0 top-0 $maxWidthClass $heightClass $positions[$position] $backgroundColorClass $class"
        ],
        'custom' => [
            'container' => "$class",
        ],
    ];
    
    $containerClass= $sidebars[$sidebar]['container'];
    
    
    $number = (int)filter_var($minWidth, FILTER_SANITIZE_NUMBER_INT);

    
@endphp

<section class="relative"> 
<aside 
    x-data="sideBarFn('{{$id}}',  @js($config) )" 
    class="{{ $containerClass }}" 
    id="{{ $id }}"
    @if(!$state) x-cloak @endif
@if($number > 0)
    :class="state ? '{{ $maxWidthClass }}' : '{{ "md:$minWidthClass w-0" }}'"
@else
    x-show="state"
    x-transition:enter="transition-[width] duration-500"
    x-transition:enter-start="{{ $minWidthClass }}"
    x-transition:enter-end="{{ $maxWidthClass }}"
    x-transition:leave="transition-[width] duration-500 {{ $minWidthClass }}"
@endif
     
@if($clickOutside)
    x-on:click.outside="if(window.innerWidth < breakpoint.width) close(id)"
@endif
    x-on:resize.window ="checkSize()"
    x-on:open-sidebar.window="open($event.detail.id)"
    x-on:close-sidebar.window="close($event.detail.id)"
    x-on:toggle-sidebar.window="toggle($event.detail.id)"
    {{ $attributes }}
    >
        <div class="side">
            {{ $slot }}
        </div>
     
        
</aside>
</section>


@pushOnce('stm-scripts')
    <script>
        function sideBarFn(id, config){
            return {
                id: id,
                type:'sidebar',
                state: config.state,
                breakpoint: config.breakpoint,
                init(){
                    $stm.register(this);
                    this.checkSize();
                },
                open(id='')
                {
                    if(id){
                        (this.id == id) ? this.state = true : '';
                    }else{
                        this.state = true;
                    }  
                },
                close(id='')
                {
                    if(id){
                        (this.id == id) ? this.state = false : '';
                    }else{
                        this.state = false;
                    }
                },
                toggle(id='')
                {
                    if(id){
                        (this.id == id) ? this.state = !this.state : '';
                    }else{
                        this.state = !this.state;
                    }
                },
                checkSize()
                {
                    if(window.innerWidth < this.breakpoint.width){
                        this.state = false;
                    }else{
                        this.state = true;
                    }
                },
                getState()
                {
                    return this.state;
                },
                getId()
                {
                    return this.id;
                },
            }
        }
    </script>
@endPushOnce

