{{--  BUTTON COMPONENT THAT USE COLOR AND TEXT COLOR FROM TAILWIND TO STYLE IT   --}}
{{--  THE DEFAULTS IS BLUE TEXT-WHITE  --}}
{{--  THE DEFAULT TYPE IS BUTTON YOU CAN CHANGE IT BY ADDING THE TYPE ATTRIBUTE --}}

@props([
    'btn' => 'normal',
    'color' => 'blue',
    'text' => 'text-white',
    'type' => 'button',
    'size' => 'md',
    'class' => ''
])

@php
    if(!$class){
        $sizes = [
            'sm' => 'text-sm px-3 py-1',
            'md' => 'text-sm px-5 py-2.5',
            'lg' => 'text-base px-6 py-3'
        ];
        $standard = "focus:outline-none  disabled:opacity-50 disabled:cursor-not-allowed disabled:active:scale-100";
        $btnStyle = [
            'normal' => "focus:ring-4 font-medium rounded-lg active:scale-95 $text bg-$color-700 hover:bg-$color-800 focus:ring-$color-300 disabled:hover:bg-$color-700",
            'outline' => "rounded-lg active:scale-95 border border-$color-700 text-$color-700 hover:bg-$color-700 hover:$text",
            'icon' => "rounded-lg hover:bg-gray-300/30 active:scale-95 active:bg-gray-300/30"
        ];
        $class="$standard $sizes[$size] $btnStyle[$btn]";
    }
@endphp

<button 
    type="{{ $type }}"
    class="{{ $class }}"
    {{ $attributes }}
    >
    {{ $slot }}
</button>