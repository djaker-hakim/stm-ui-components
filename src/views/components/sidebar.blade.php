{{-- ID is a must for toggleing the sidebar
EVENTS: "open-sidebar" "close-sidebar" "toggle-sidebar" with ID of the sidebar --}}
{{-- you can define the init state of sidebar with state var --}}
{{-- you can choose defrent sidebars by choosing from : "standard", "expand", "custom" --}}
{{-- by defining a class and transitionStart transitionEnd you can customize sidebar transition --}}
{{-- you can choose the side for sidebar with position var "left" "right" --}}
{{-- you can add or remove the breaking-point of the sidebar by the bp var : bool default "true"  --}}


@props([
    'id' => '',
    'class' => 'bg-gray-100 fill-gray-700',
    'state' => true,
    'sidebar' => 'standard',
    'transitionEnd' => '',
    'transitionStart' => '',
    'clickOutside' => true,
    'position' => 'left',
    'bp' => true,
    'menuClass' => 'h-[65vh]'
])
@php
    $positionClasses = (object) [
        'left' => (object) [
            'position' => 'left-0',
            'box' => 'justify-end',
            'svg' => '',
        ],
        'right' => (object)[
            'position' => 'right-0',
            'box' => 'justify-start',
            'svg' => 'rotate-180',
        ],
    ];
    $con = ($sidebar == 'expand');
    $sidebars = (object) [
        'custom' => (object) [
            'class' => "$class",
            'transitionStart' => "$transitionStart",
            'transitionEnd' => "$transitionEnd"
        ],
        'expand' => (object) [
            'class' => "h-[calc(100vh-50px)] md:h-[calc(100vh-70px)] py-2 transition-[width] duration-500 $class",
            'transitionStart' => 'w-16',
            'transitionEnd' => 'w-52'
        ],
        'standard' => (object) [
            'class' => "w-52 absolute top-0 md:relative h-[calc(100vh-50px)] md:h-[calc(100vh-70px)] py-2 overflow-hidden z-20 $class ".$positionClasses->$position->position,
            'transitionStart' => 'w-0',
            'transitionEnd' => 'w-52'
        ]
    ];   
@endphp
@pushOnce('stm-scripts')
    <script>
        function sideBarFn(id, state){
            return {
                sidebar: state,
                id: id,
                open(id)
                {
                    (this.id == id) ? this.sidebar = true : '';
                },
                close(id)
                {
                    (this.id == id) ? this.sidebar = false : '';
                },
                toggle(id)
                {
                    (this.id == id) ? this.sidebar = !this.sidebar : '';
                },
                getState()
                {
                    return this.sidebar;
                },
                getId()
                {
                    return this.id;
                }
            }
        }
    </script>
@endPushOnce

<section class="relative" x-data="sideBarFn('{{$id}}', {{ $state }})" >
    
    <nav class="{{ $sidebars->$sidebar->class }}"
    id="{{ $id }}"
    @if($bp)
        x-init="window.innerWidth < 765 ? sidebar = false : sidebar = true"
    @endif
    @if(!$con)
    x-show="sidebar"
    x-cloak
    x-transition:enter="transition-[width] duration-500"
    x-transition:enter-start="{{ $sidebars->$sidebar->transitionStart }}"
    x-transition:enter-end="{{ $sidebars->$sidebar->transitionEnd }}"
    x-transition:leave="transition-[width] duration-500 {{ $sidebars->$sidebar->transitionStart }}"
    @else
        :class="sidebar ? '{{ $sidebars->$sidebar->transitionEnd }}' : '{{ $sidebars->$sidebar->transitionStart }}'"
    @endif
    @if($clickOutside)
    x-on:click.outside="if(window.innerWidth < 765) close(id)"
    @endif
    x-on:open-sidebar.window="open($event.detail.id)"
    x-on:close-sidebar.window="close($event.detail.id)"
    x-on:toggle-sidebar.window="toggle($event.detail.id)"
    {{ $attributes }}
    >
        @isset($brand)
            {{ $brand }}
        @endisset


        @if($con)
            <div class="flex {{ $positionClasses->$position->box }}">
                @isset($icon)
                    {{ $icon }}
                @else
                    <x-stm::button btn="icon" x-on:click="toggle(id)">
                        <div class="transition-transform duration-300" :class="sidebar ? '[transform:rotateY(180deg)]' : ''">
                            <svg class="size-6 {{$positionClasses->$position->svg}}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" >
                                <path d="m560-240-56-58 142-142H160v-80h486L504-662l56-58 240 240-240 240Z" />
                            </svg>
                        </div>
                    </x-stm::button>
                @endisset
            </div>
        @endif

        <div class="side overflow-y-auto overflow-x-hidden {{ $menuClass }}">
            {{ $slot }}
        </div>
  
    </nav>
    <template x-teleport="head">
        <style>
            .side::-webkit-scrollbar {
            width: 2px;
            }
            /* Track */
            .side::-webkit-scrollbar-track {
            background: transparent; 
            }
            
            /* Handle */
            .side::-webkit-scrollbar-thumb {
            background: gray ;
            }
        
            /* Handle on hover */
            .side::-webkit-scrollbar-thumb:hover {
            background: darkgray ;
            width: 10px;
            }
        </style>
    </template>
</section>



