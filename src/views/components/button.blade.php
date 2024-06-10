{{--  BUTTON COMPONENT THAT USE COLOR AND TEXT COLOR FROM TAILWIND TO STYLE IT   --}}
{{--  THE DEFAULTS IS BLUE TEXT-WHITE  --}}
{{--  THE DEFAULT TYPE IS BUTTON YOU CAN CHANGE IT BY ADDING THE TYPE ATTRIBUTE --}}

@props([
    'color' => 'blue',
    'text' => 'text-white',
    'type' => 'button'
])

<button 
    type="{{ $type }}"
    {{ $attributes->merge(['class' => "focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none active:scale-95 
    disabled:opacity-50 disabled:cursor-not-allowed disabled:active:scale-100
    $text bg-$color-700 hover:bg-$color-800 focus:ring-$color-300 disabled:hover:bg-$color-700 "]) }}
    >
    {{ $slot }}
</button>