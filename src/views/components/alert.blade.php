{{-- alerts : "danger", "info", "warning", "success", "default", "custom" --}}

@props([
    'alert' => 'default',
    'class' => ''
])

@php
    $classes = [
        'danger' => 'bg-red-500 text-white',
        'info' => 'bg-sky-500 text-white',
        'warning' => 'bg-amber-500 text-white',
        'success' => 'bg-green-500 text-white',
        'default' => 'bg-gray-300 text-gray-800',
        'custom' => $class
    ];
@endphp

<section 
class="relative block p-2 text-base leading-5 {{ $classes[trim($type)] }} rounded-lg"
x-data="{ close: false }"
x-show="!close"
x-cloak
>
   <div class="flex justify-between items-center">

        <div> {{ $slot }} </div>

        <button class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg text-center font-sans text-xs font-medium transition-all hover:bg-white/10 active:bg-white/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        x-on:click="close = true"
        >
            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              class="size-6"
              stroke-width="2">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"
              ></path>
            </svg>
          </span>
        </button>
   </div>
</section>