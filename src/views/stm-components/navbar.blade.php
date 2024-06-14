{{-- ID is a must for toggleing the collapse menu of the nav-bar
EVENTS: "open-navbar" "close-navbar" "toggle-navbar" with ID of the navbar --}}
{{-- there is no option for a custom nav only add supported classes --}}
{{-- bgcolor, color varibales of class names it uses tailwind class as default  --}}
{{-- clickOutside default is true --}}

@props([
    'id' => '',
    'class' => '',
    'bgColor' => 'bg-gray-100',
    'color' => 'text-gray-700',
    'clickOutside' => true
])
@php
    $collapseId = uniqid(); 
@endphp
@push('scripts')
    <script>
        function navbarFn(id, collapseId)
        {
            return {
                id: id,
                collapseId: collapseId,
                open(id)
                {
                    this.id == id ? this.$dispatch('open-collapse', {id: this.collapseId}) : '';
                },
                close(id)
                {
                    this.id == id ? this.$dispatch('close-collapse', {id: this.collapseId}) : '';
                },
                toggle(id)
                {
                    this.id == id ? this.$dispatch('toggle-collapse', {id: this.collapseId}) : '';
                }
            }
        }    
    </script>    
@endpush


<section x-data="navbarFn('{{$id}}', '{{$collapseId}}')">
    <nav class="{{"flex justify-between items-center px-5 sm:px-10 md:px-20 h-[50px] md:h-[70px] $bgColor $color $class"}}"
    id="{{$id}}"
    x-on:open-navbar.window="open($event.detail.id)"
    x-on:close-navbar.window="close($event.detail.id)"
    x-on:toggle-navbar.window="toggle($event.detail.id)"
    @if($clickOutside)
    x-on:click.outside="if(window.innerWidth < 765) $dispatch('close-collapse', {id: '{{ $collapseId }}'})"
    @endif
    {{ $attributes }}
    >
        <div class="max-h-[50px] md:max-h-[70px]">
            {{ $brand }}
        </div>
        {{ $slot }}
        <div>
            <div class="hidden md:flex gap-4">
                {{ $navMenu }}
            </div>

            <x-button btn="icon" class="md:hidden" size="sm" x-on:click="$dispatch('toggle-collapse', {id: '{{ $collapseId }}'})">
                <svg class="fill-gray-900 size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                    <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                </svg>
            </x-button>
        </div>
    </nav>
    <x-collapse 
        id="{{ $collapseId }}" 
        :class="'px-5 sm:px-10 md:px-20 md:hidden'.' '.$bgColor.' '.$color">
            <x-slot:btn>
                <div></div>
            </x-slot:btn>   
        <div class="space-y-2">
            @isset($collapseNavMenu)
                {{ $collapseNavMenu }}
            @else
                {{ $navMenu }}
            @endisset     
        </div>  
    </x-collapse>
</section>
