@props([
    'id',
    'progressbar' => 'standard',
    'color'=> 'blue',
    'size' => 'md',
    'config' => [
        'progress' => 0,
        'duration' => 16,
        'pourcentage' => 'none',
        'style' =>[
            'lableClass' => '',
            'containerClass' => '',
            'fillClass' => '',
            'pourcentageClass' => '',
        ]
    ],
    
])
@php
    isset($config['progress']) ? '' : $config['progress'] = 0;
    isset($config['duration']) ? '' : $config['duration'] = 16;
    isset($config['pourcentage']) ? '' : $config['pourcentage'] = 'none';

    $duration = $config['duration'];

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

    $lableClass = $config['style']['lableClass'] ?? '';
    $containerClass = $config['style']['containerClass'] ?? '';
    $fillClass = $config['style']['fillClass'] ?? '';
    $pourcentageClass = $config['style']['pourcentageClass'] ?? '';


    // $infiniteContainer= $config['infinite'] ? 'relative' : '';
    // $infiniteFill= $config['infinite'] ? 'absolute animate-progress-bar w-1/3' : '';


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


@endphp

<section :id="id" x-data="progressBarFn(@js($id), @js($config))" {{ $attributes }}>

    <!-- Progress Bar lable -->
    <div class="{{ $progressbars[$progressbar]['lable'] }}"
        x-text="lable"
    ></div>
    <!-- Progress Bar Container -->
    <div class="{{ $progressbars[$progressbar]['container'] }}"
        :class="progress === -1 ? 'relative' : '' " 
    >
        <!-- Progress Fill -->
        <div
            class="{{ $progressbars[$progressbar]['fill'] }}"
            :class="progress === -1 ? 'absolute animate-progress-bar w-1/3' : ''" 
            :style="progress === -1 ? '' : `width: ${progress}%`"
        >
            @if($config['pourcentage'] == 'in')
                <div class="{{ $progressbars[$progressbar]['pourcentage'] }}" >
                    <span x-text="progress === -1 || progress === 0 ? '' : progress + '%'"></span>
                </div>
            @endif
        </div>
    </div>
    @if($config['pourcentage'] != 'in')
        <div class="{{ $progressbars[$progressbar]['pourcentage'] }}" >
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
            setProgress(value) {
                if (value == 'infinite') {
                    this.progress = -1;
                    return;
                }
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