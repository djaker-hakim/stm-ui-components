{{-- NOTE: IN THE HEAD SLOT TRY NOT TO ADD BUTTON COMPONENT BECAUSE ITS ALREADY A BUTTON --}}

@props(
[
    'id' => 'accordion',
    'state' => false,
    'iconType' => '',
    'class' => 'w-full border-b font-semibold border-slate-100 text-slate-700 bg-gray-300',
    'disabled' => false
])

<x-collapse id="{{ $id }}" :state="$state"
{{ $attributes }}
>
    <x-slot:btn>
        <button class="flex justify-between items-center py-1 px-3 disabled:opacity-50 disabled:cursor-not-allowed {{ $class }}"
        x-on:click="collapse = !collapse" @disabled($disabled)>
            <span>
                {{ $head }}
            </span>
            @if(isset($icon))              
                <span>
                    {{ $icon }}
                </span>
            @else
                @if($iconType == 'arrow')
                    <span 
                        class="transition-transform duration-300"
                        :class="collapse ? 'rotate-90' : '' ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" 
                        class="size-6 fill-slate-700">
                            <path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/>
                        </svg>
                    </span>
                @else
                    <span x-cloak x-show="!collapse">
                        <svg class="fill-slate-700 size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" 
                        >
                            <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/>
                        </svg>
                    </span>
                    <span x-cloak x-show="collapse">
                        <svg class="fill-slate-700 size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                            <path d="M200-440v-80h560v80H200Z"/>
                        </svg>
                    </span>
                @endif
            @endif  
        </button>
    </x-slot:btn>
    
    {{ $slot }}

</x-collapse>