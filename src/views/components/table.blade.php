{{-- headers is a array of headers --}}
{{-- tables : "standard" "custom" --}}

@props([
    'headers',
    'table' => 'standard',
    'width' => '',
    'height' => '',
    'scrollable' => false,
    'sticky' => false,


    'tableClass' => '',
    'theadClass' => 'bg-gray-300 text-gray-700',
    'tbodyClass' => '',
])

@php

    $dim = "";  $scroll ="";   $stick = "";

    if($width && $height) $dim = "block w-[$width] h-[$height]";

    if($scrollable){
        $scroll = 'overflow-auto';
        if($sticky) $stick = "sticky top-0";
    }

$tables= [
    'custom' => (object) [
        'tableClass' => "$tableClass",
        'theadClass' => "$theadClass",
        'tbodyClass' => "$tbodyClass"
    ],
    'standard' => (object) [
        'tableClass' => "my-4 relative $dim $scroll $tableClass",
        'theadClass' => "capitalize $stick $theadClass",
        'tbodyClass' => "leading-none $tbodyClass"
    ]
];
@endphp

<div class="">
<table class="{{ $tables[$table]->tableClass }}">
    <thead class="{{$tables[$table]->theadClass}}">
        <tr>
            @foreach ($headers as $header)                   
            <th class="px-4 py-2">{{ $header }}</th>        
            @endforeach
        </tr>
    </thead>
    <tbody class="{{ $tables[$table]->tbodyClass }}">
        {{ $slot }}
    </tbody>
</table>
</div>

