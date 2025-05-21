{{-- for the infinite you need to set progress ti infinite --}}

@props([
    'id',
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


$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));


$duration = $config['duration'];

$lableClass = $config['style']['lableClass'];
$containerClass = $config['style']['containerClass'];
$fillClass = $config['style']['fillClass'];
$pourcentageClass = $config['style']['pourcentageClass'];



$sizes = [
    'xs' => "h-1",
    'sm' => "h-2",
    'md' => "h-4",
    'lg' => "h-6"
];

$pourcentages = [
    'start' => "flex justify-start",
    'center' => "flex justify-center",
    'end' => "flex justify-end",
    'in' => "",
    'none' => "hidden"
];




$progressbars = [
    'standard' => [
        'lable' => "text-sm $lableClass",
        'container' => "w-full bg-gray-200 rounded-full overflow-hidden $sizes[$size] $containerClass",
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
<style>
    @keyframes progress-bar {
        0% {
            left: -33%;
        }
        100% {
            left: 100%;
        }
    }
    .animate-progress-bar {
        animation: progress-bar 1200ms infinite linear;
    }
</style>
@pushOnce('stm-scripts')
<script>
    function progressBarFn(id, config) {
        return {
            id: id,
            type: 'progressbar',
            lable:'',
            progress: 0,
            target: 0,
            duration: config.duration,
            interval: null,
            init(){
                $stm.register(this);
                this.setProgress(config.progress);
            },
            validateProgress(value){
                if(isNaN(Number(value))) return 0;
                value = Number(value);
                value = value < 0 ? 0 : value;
                value = value > 100 ? 100 : value;
                return value;
            },
            setProgress(value) {
                if (value == 'infinite') {
                    this.progress = -1;
                    return;
                }
                value = this.validateProgress(value);
                if (this.progress > value) this.progress = 0;
                this.target = value;
                clearInterval(this.interval);
                this.interval = setInterval(() => {
                    if(this.progress >= this.target) {
                        clearInterval(this.interval);
                        return;
                    }
                    this.progress += 1;
                }, this.duration); // ~60fps
            },
            setLable(value) {
                this.lable = value;
            },
            setDuration(value) {
                this.duration = value;
            },
            getId() {
                return this.id;
            },
            getType() {
                return this.type;
            },
        };
    }
</script>
@endpushOnce