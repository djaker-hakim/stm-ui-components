{{-- POSITIONS: Bottom: bottom, bottom-start, bottom-end
                Top: top, top-start, top-end
                Left: left, left-start, left-end
                Right: right, right-start, right-end --}}
{{-- NOTE: IF YOUR POSITION DOES NOT WORK IT MEANS THERE IS NO SPACE SO IT FALL BACK TO THE OPTIMAL POSITION --}}
{{-- OFFSET IS THE MARGIN OF THE DROP-ELEMENT --}}
{{-- CLICK OUT SIDE BY DEFALT IT'S TRUE SO WHEN YOU CLICK OUTSIDE THE DROPDOWN WILL GO AWAY  --}}
{{-- YOU CAN ADD x-transition OF YOUR CHOICE FOR ANIMATIONS --}}
{{-- YOU CAN TRIGGER THE DROPDOWN WITH AN EVENT "drop" AND THE "ID" OTHE THE DROPDOWN
EXEMPLE : $dispatch('drop', {id: 'dropdown-id'})  --}}

@props([
    'id' => 'dropdown',
    'theme' => '',
    'color' => '',
    'backgroundColor' => 'var(--stm-ui-bg-2)',
    'class' => '',
    'config' => [
        'buttonId' => '',
        'state' => false,
        'position' => '',
        'offset' => '5',
        'clickOutside' => true,
    ],
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


$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

$backgroundColorFormat = Color::detectColorFormat($backgroundColor);
if($backgroundColorFormat == 'rgb' || 'hsl' || 'rgba' ) $backgroundColor = str_replace(' ', '_', trim($backgroundColor));

   

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




@pushOnce('stm-scripts')
    <script>
        function dropdownFn(id, config) {
            return {
                id: id,
                type: 'dropdown',
                state: config.state,
                init() {
                    $stm.register(this);
                },
                open(id) {
                    if (id) {
                        this.state = (this.id == id);
                    } else {
                        this.state = true;
                    }

                },
                close(id) {
                    if (id) {
                        (this.id == id) ?
                        this.state = false: '';
                    } else {
                        this.state = false;
                    }

                },
                toggle(id) {
                    if (id) {
                        (this.id == id) ? this.state = !this.state: '';
                    } else {
                        this.state = !this.state;
                    }

                },
                getState() {
                    return this.state;
                },
                getId() {
                    return this.id;
                }
            }
        }
    </script>
@endPushOnce



