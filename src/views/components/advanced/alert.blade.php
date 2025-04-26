{{-- alerts : "danger", "info", "warning", "success", "default", "custom" --}}

@props([
    'id',
    'alert' => 'default',
    'class' => '',
    'config' => [
        'state' => true,
    ]
    ])

@php
    isset($config['state']) ? '' : ($config['state'] = true);

    $standard = "relative block p-1 text-base leading-5 rounded-lg";

    $classes = [
        'danger' => "bg-red-500 text-white $standared $class",
        'info' => "bg-sky-500 text-white $standared $class",
        'warning' => "bg-amber-500 text-white $standared $class",
        'success' => "bg-green-500 text-white $standared $class",
        'default' => "bg-gray-300 text-gray-800 $standared $class",
        'custom' => $class,
    ];
@endphp

<section class="{{ $classes[$alert] }} "     
    x-data="alertFn(@js($id), @js($config))"
    x-show="state"
    x-cloak
    x-on:open-alert.window="open($event.detail.id)"
    x-on:close-alert.window="close($event.detail.id)" 
    x-on:toggle-alert.window="toggle($event.detail.id)"
    {{$attributes}}>
    
    <div class="mr-8 max-h-[180px] overflow-y-auto overflow-x-hidden"> 
        {{ $slot }} 
    </div>

    <div class="absolute top-0 right-0 ml-6 m-1">
        <button
            class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg text-center font-sans text-xs font-medium transition-all hover:bg-white/10 active:bg-white/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            x-on:click="close(id)">
            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="size-6" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </span>
        </button>
    </div>
    
</section>

@pushOnce('stm-scripts')
    <script>
        function alertFn(id, config) {
            return {
                id: id,
                type: 'alert',
                state: config.state,
                init() {
                    $stm.register(this);
                },
                open(id = '') {
                    if (id) {
                        this.id == id ? this.state = true : '';
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
                getstate() {
                    return this.state;
                },
                getId() {
                    return this.id;
                },
                getType() {
                    return this.type;
                }
            }
        }
    </script>
@endpushOnce
