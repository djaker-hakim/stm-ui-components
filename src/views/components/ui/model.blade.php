{{-- ID IS A MUST if using MULTIPLE MODEL COMPONENT --}}
{{-- CLICK OUT SIDE BY DEFALT IT'S TRUE SO WHEN YOU CLICK OUTSIDE THE DROPDOWN WILL GO AWAY  --}}
{{-- YOU CAN ADD x-transition OF YOUR CHOICE FOR ANIMATIONS --}}
{{-- YOU CAN TRIGGER THE MODEL WITH AN EVENT "open-model", "close-model" AND THE "ID" OTHE THE DROPDOWN
EXEMPLE : $dispatch('open-model', {id: 'model-id'}), $dispatch('close-model', {id: 'model-id'})  --}}

@props([
    'id',
    'class' =>
        'bg-white xl:w-[1200px] lg:w-[1000px] md:w-[800px] sm:w-[400px] w-[280px] max-h-[500px] flex flex-col items-center rounded-md mt-5 overflow-auto',
    'config' => [
        'state' => false,
        'clickOutside' => true,
        'backdrop' => 'dark',
    ],
])

@php
    isset($config['state']) ? '' : ($config['state'] = false);
    isset($config['clickOutside']) ? '' : ($config['clickOutside'] = true);
    isset($config['backdrop']) ? ($backdrop = $config['backdrop']) : ($backdrop = 'dark');
    $backdrops = [
        'dark' => 'bg-black/30',
        'light' => 'bg-white/60',
        'blur' => 'backdrop-blur-sm',
        'none' => '',
    ];
    $clickOutside = $config['clickOutside'];
@endphp

@pushOnce('stm-scripts')
    <script>
        function modelFn(id, config) {
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

<section class="fixed inset-0 z-[999] grid h-screen w-screen place-items-center {{ $backdrops[$backdrop] }} "
x-data="modelFn(@js($id), @js($config))" 
x-show="state" 
x-cloak 
x-on:open-model.window="open($event.detail.id)"
x-on:close-model.window="close($event.detail.id)" 
x-on:toggle-model.window="toggle($event.detail.id)">
    <div class="{{ $class }}"
    @if ($clickOutside) x-on:click.outside="close(id)" @endif 
        x-show="state" 
        {{ $attributes }}>
        {{ $slot }}
    </div>
</section>
