{{-- ID is a must for toggleing the sidebar
EVENTS: "open-sidebar" "close-sidebar" "toggle-sidebar" with ID of the sidebar --}}
{{-- you can define the init state of sidebar with state var --}}
{{-- NOTE: if using btn outside make sure you stop propagation because it will make a conflic with clickOutside --}}


@props([
    'id',
    'theme' => '',
    'color' => '',
    'backgroundColor' => 'var(--stm-ui-bg-2)',
    'class' => '',
    'config' => []
])


@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

 //  default values
$config['state'] ??= true ;
$config['maxWidth'] ??= '200px' ;
$config['minWidth'] ??= '0px' ;
$config['height'] ??= '100dvh';
$config['position'] ??= 'left';
$config['breakpoint']['width'] ??= 765;
$config['breakpoint']['clickOutside'] ??= true;

$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

$backgroundColorFormat = Color::detectColorFormat($backgroundColor);
if($backgroundColorFormat == 'rgb' || 'hsl' || 'rgba' ) $backgroundColor = str_replace(' ', '_', trim($backgroundColor));

   

$state= $config['state'];
$height= $config['height'];
$maxWidth = $config['maxWidth'];
$minWidth = $config['minWidth'];
$position= $config['position'];
$clickOutside = $config['breakpoint']['clickOutside'];


$positions=[
    'left' => 'left-0',
    'right' => 'right-0'
];

$heightClass="h-[$height]";
$maxWidthClass="w-[$maxWidth]";
$minWidthClass="w-[$minWidth]";

$sidebars= [
    'standard' => [
        'container' => "absolute md:relative md:p-2 py-2 overflow-hidden z-10 transition-[width] duration-200 md:z-0 top-0 $heightClass $positions[$position] text-[$color] bg-[$backgroundColor] $class"
    ],
    'custom' => [
        'container' => "$class",
    ],
];
    
$number = (int)filter_var($minWidth, FILTER_SANITIZE_NUMBER_INT);


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $sidebars) ? $theme : 'standard'; // theme fallback value
   
@endphp

<section class="relative"> 
<aside 
    x-data="sideBarFn('{{$id}}',  @js($config) )" 
    class="{{ $sidebars[$theme]['container'] }}"
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

