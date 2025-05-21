{{-- ID IS A MUST if using MULTIPLE MODEL COMPONENT --}}
{{-- CLICK OUT SIDE BY DEFALT IT'S TRUE SO WHEN YOU CLICK OUTSIDE THE DROPDOWN WILL GO AWAY  --}}
{{-- YOU CAN ADD x-transition OF YOUR CHOICE FOR ANIMATIONS --}}
{{-- YOU CAN TRIGGER THE MODEL WITH AN EVENT "open-model", "close-model" AND THE "ID" OTHE THE DROPDOWN
EXEMPLE : $dispatch('open-model', {id: 'model-id'}), $dispatch('close-model', {id: 'model-id'})  --}}

@props([
    'id',
    'theme' => '',
    'color' => '',
    'backgroundColor' => 'var(--stm-ui-bg-1)',
    'class' => '',
    'config' => [
        'state' => false,
        'clickOutside' => true,
        'backdrop' => 'dark',
        'style' => [
            'backdropClass' => '',
        ]
    ],
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

// default values
$config['state'] ??= false ;
$config['clickOutside'] ??= true;
$config['backdrop'] ??= 'dark';
$config['style']['backdropClass'] ??= '';
    
$backdrop = $config['backdrop'];
$backdropClass = $config['style']['backdropClass'];
$clickOutside = $config['clickOutside'];


// animations
$config['animation'] ??= [];

$no_animation = ($config['animation'] == 'none');
if(!$no_animation){
    $config['animation'] = []; // if other value then 'none'
    $config['animation']['enter'] ??= 'fadeInUp';
    $config['animation']['leave'] ??= 'fadeOutDown';
    $config['animation']['duration'] ??= '200ms';

    $animationEnter = 'animate__animated animate__'.$config['animation']['enter'];
    $animationLeave = 'animate__animated animate__'.$config['animation']['leave'];
    $duration = '[--animate-duration:'.$config['animation']['duration'].']';
}

$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

$backgroundColorFormat = Color::detectColorFormat($backgroundColor);
if($backgroundColorFormat == 'rgb' || 'hsl' || 'rgba' ) $backgroundColor = str_replace(' ', '_', trim($backgroundColor));

$backdrops = [
    'dark' => 'bg-black/30',
    'light' => 'bg-white/60',
    'blur' => 'backdrop-blur-sm',
    'none' => '',
];

$modals = [
    'standard' => [
        'backdrop' => "fixed inset-0 z-[999] grid h-screen w-screen place-items-center $backdrops[$backdrop] $backdropClass",
        'modal' => "xl:max-w-[1200px] lg:max-w-[1000px] md:max-w-[800px] sm:max-w-[400px] max-w-[280px] max-h-[500px] p-2 rounded-md mt-5 overflow-auto bg-[$backgroundColor] text-[$color] $class",
    ],
    'stm' => [
        'backdrop' => "fixed inset-0 z-[999] grid h-screen w-screen place-items-center $backdrops[$backdrop] $backdropClass",
        'modal' => "xl:max-w-[1200px] lg:max-w-[1000px] md:max-w-[800px] sm:max-w-[400px] max-w-[280px] max-h-[500px] p-2 overflow-auto bg-[$backgroundColor] text-[$color] $class", 
    ],
    'custom' => [
        'backdrop' => $backdropClass,
        'modal' => $class,
    ]
]; 


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $modals) ? $theme : 'standard'; // theme fallback value
@endphp

<section class="{{ $modals[$theme]['backdrop'] }}"
x-data="modalFn(@js($id), @js($config))" 
x-show="state" 
x-cloak 
x-on:open-modal.window="open($event.detail.id)"
x-on:close-modal.window="close($event.detail.id)" 
x-on:toggle-modal.window="toggle($event.detail.id)">
    <div class="{{ $modals[$theme]['modal'] }}"
    @if ($clickOutside) x-on:click.outside="close(id)" @endif 
        x-show="state"
        @if(!$no_animation)
            x-transition:enter="{{ "$animationEnter $duration" }}"
            x-transition:leave="{{ "$animationLeave $duration" }}"
        @endif 
        {{ $attributes }}>
        {{ $slot }}
    </div>
</section>


@pushOnce('stm-scripts')
    <script>
        function modalFn(id, config) {
            return {
                id: id,
                state: config.state,
                init() {
                    $stm.register(this);
                },
                open(id = '') {
                    if (id) {
                        this.state = (this.id == id);
                    } else {
                        this.state = true;
                    }
                },
                close(id = '') {
                    if (id) {
                        this.id == id ? this.state = false : '';
                    } else {
                        this.state = false;
                    }
                },
                toggle(id = '') {
                    if (id) {
                        this.id == id ? this.state = !this.state : '';
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