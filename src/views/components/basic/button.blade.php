{{--  BUTTON COMPONENT THAT USE COLOR AND TEXT COLOR FROM TAILWIND TO STYLE IT   --}}
{{--  THE DEFAULTS IS BLUE TEXT-WHITE  --}}
{{--  THE DEFAULT TYPE IS BUTTON YOU CAN CHANGE IT BY ADDING THE TYPE ATTRIBUTE --}}

@props([
    'btn' => 'standard',
    'color' => 'blue',
    'textColor' => 'white',
    'type' => 'button',
    'size' => 'md',
    'class' => '',
])

@php

    $standard =
        'focus:outline-none  disabled:opacity-50 disabled:cursor-not-allowed disabled:active:scale-100 active:scale-95';

    $sizes = [
        'sm' => 'text-sm px-3 py-1',
        'md' => 'text-base px-5 py-2.5',
        'lg' => 'text-lg px-6 py-3',
    ];

    $text = "[color:$textColor]";

    $btnStyle = [
        'custom' => '',
        'standard' => "focus:ring-2 font-medium rounded-lg $text hover:opacity-80 [background-color:$color]",
        'outline' => "rounded-lg border [border-color:$color] hover:[background-color:$color] hover:$text",
        'icon' => 'rounded-lg hover:bg-gray-300/30 active:bg-gray-300/30',
    ];

    $class = "$standard $sizes[$size] $btnStyle[$btn] $class";

@endphp

<button type="{{ $type }}" class="{{ $class }}" {{ $attributes }}>
    {{ $slot }}
</button>
