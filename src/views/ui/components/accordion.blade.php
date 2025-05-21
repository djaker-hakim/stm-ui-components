@props([
    'id',
    'theme' => '',
    'color' => '',
    'backgroundColor' => 'var(--stm-ui-primary)',
    'data' => [],
    'config' => []
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;




// Card Themes
    $accordions = [
        'standard' => [
            'accordionHead' => "",
            'card' => "border rounded-lg p-4 shadow hover:shadow-md transition $cardClass",
            'chead' => "font-semibold text-gray-800 $cheadClass",
            'cbody' => "mt-4 text-gray-700 text-sm *:border-b $cbodyClass",
            'ch' => "uppercase font-semibold $chClass",
            'cd' => "$cdClass",
        ],
        'custom' => [
            'cardContainer' => "$cardContainerClass",
            'card' => "$cardClass",
            'chead' => "$cheadClass",
            'cbody' => "$cbodyClass",
            'ch' => "$chClass",
            'cd' => "$cdClass",
        ]
    ];

// Card Themes
    // $cards = [
    //     'standard' => [
    //         'cardContainer' => "grid gap-4 md:hidden overflow-auto $cardContainerClass",
    //         'card' => "border rounded-lg p-4 shadow hover:shadow-md transition $cardClass",
    //         'chead' => "font-semibold text-gray-800 $cheadClass",
    //         'cbody' => "mt-4 text-gray-700 text-sm *:border-b $cbodyClass",
    //         'ch' => "uppercase font-semibold $chClass",
    //         'cd' => "$cdClass",
    //     ],
    //     'custom' => [
    //         'cardContainer' => "$cardContainerClass",
    //         'card' => "$cardClass",
    //         'chead' => "$cheadClass",
    //         'cbody' => "$cbodyClass",
    //         'ch' => "$chClass",
    //         'cd' => "$cdClass",
    //     ]
    // ];


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $tables) ? $theme : 'standard'; // theme fallback value
@endphp


<div class="accordionHead" x-data="{ open: false }">
    <div class="{{ $cards[$theme]['card'] }}">
        {{--  Header  --}}
        <div class="flex justify-between items-center cursor-pointer" x-on:click="open = !open">
            <div class="Head">
                Accordion
            </div>

            <div class="rounded-full p-2 bg-[{{ $backgroundColor }}]">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </div>
        </div>

        {{--  Collapsible Content  --}}
        <div x-show="open" x-collapse class="container">

            <div class="flex justify-between mb-2">
                <span class="{{ $cards[$theme]['ch'] }}" x-text="header+':'"></span>
                <span class="{{ $cards[$theme]['cd'] }}" x-text="row[key]"></span>
            </div>
           
        </div>
    </div>      
</div>

{{-- Mobile Table
    <div class="{{ $cards[$theme]['cardContainer'] }} ">
        <template x-for="(row, index) in rows" :key="'row' + index">
            <div x-data="{ open: false }" 
                class="{{ $cards[$theme]['card'] }}">
                 Header 
                <div class="flex justify-between items-center cursor-pointer" x-on:click="open = !open">
                    <div class="{{ $cards[$theme]['chead'] }}">

                        <input type="checkbox" class="w-3 h-3 mr-2 text-[{{ $color }}] border-gray-300 rounded focus:ring-[{{ $color }}] focus:ring-2" :checked="selection.includes(row)" x-on:click.stop x-on:change="select(row)" :class="selectable ? '' : 'hidden'" x-cloak>

                        <span class="{{ $cards[$theme]['ch'] }}" x-text="cardHeader[1]+': '"></span>
                        <span class="{{ $cards[$theme]['cd'] }}" x-text="row[cardHeader[0]]"></span> 
                    </div>

                    <div class="rounded-full p-2 bg-[{{ $backgroundColor }}]">
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </div>
                </div>

                 Collapsible Content 
                <div x-show="open" x-collapse class="{{ $cards[$theme]['cbody'] }}">

                    <template x-for="(header, key) in headers" :key="'header' + key">
                        <div class="flex justify-between mb-2">
                            <span class="{{ $cards[$theme]['ch'] }}" x-text="header+':'"></span>
                            <span class="{{ $cards[$theme]['cd'] }}" x-text="row[key]"></span>
                        </div>
                    </template>
                    @isset($action)
                        <div class="flex justify-between mb-2">
                            <span class="{{ $cards[$theme]['ch'] }}">action</span>
                            <span class="{{ $cards[$theme]['cd'] }}">{{ $action }}</span>
                        </div>
                    @endisset
                </div>
            </div>
        </template>
             No data found 
        <div class="text-center text-gray-500 md:hidden text-sm" x-show="rows.length === 0 && !loading && Object.keys(headers).length > 0" x-cloak>
            {!! $config['emptyMessage'] !!}
        </div>
        @isset($loader)
        <div class="md:hidden block">
            {{ $loader }}
        </div>
        @else
            loader
            <div class="md:hidden flex justify-center items-center p-4" x-show="loading" x-cloak>
                <svg class="text-gray-300 animate-spin" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                    <path
                        d="M32 3C35.8083 3 39.5794 3.75011 43.0978 5.20749C46.6163 6.66488 49.8132 8.80101 52.5061 11.4939C55.199 14.1868 57.3351 17.3837 58.7925 20.9022C60.2499 24.4206 61 28.1917 61 32C61 35.8083 60.2499 39.5794 58.7925 43.0978C57.3351 46.6163 55.199 49.8132 52.5061 52.5061C49.8132 55.199 46.6163 57.3351 43.0978 58.7925C39.5794 60.2499 35.8083 61 32 61C28.1917 61 24.4206 60.2499 20.9022 58.7925C17.3837 57.3351 14.1868 55.199 11.4939 52.5061C8.801 49.8132 6.66487 46.6163 5.20749 43.0978C3.7501 39.5794 3 35.8083 3 32C3 28.1917 3.75011 24.4206 5.2075 20.9022C6.66489 17.3837 8.80101 14.1868 11.4939 11.4939C14.1868 8.80099 17.3838 6.66487 20.9022 5.20749C24.4206 3.7501 28.1917 3 32 3L32 3Z"
                        stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path
                        d="M32 3C36.5778 3 41.0906 4.08374 45.1692 6.16256C49.2477 8.24138 52.7762 11.2562 55.466 14.9605C58.1558 18.6647 59.9304 22.9531 60.6448 27.4748C61.3591 31.9965 60.9928 36.6232 59.5759 40.9762"
                        stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"
                        class="text-[{{ $backgroundColor }}]">
                    </path>
                </svg>
            </div>
        @endisset
    </div> --}}