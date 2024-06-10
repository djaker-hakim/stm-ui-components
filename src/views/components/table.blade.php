@props([
    'headers',
    'type' => '',
    'width' => '',
    'height' => '',
    'scrollable' => false,
    'sticky' => false,


    'tableClass' => '',
    'theadClass' => 'bg-gray-300 text-gray-700',
    'tbodyClass' => '',
])

@php
if(!($type == 'custom')){
    $dim = "";  $scroll ="";   $stick = "";

    if($width && $height) $dim = "block w-[$width] h-[$height]";

    if($scrollable){
        $scroll = 'overflow-auto';
        if($sticky) $stick = "sticky top-0";
    }

    $tableClass = "my-4 relative $dim $scroll $tableClass";
    $theadClass = "capitalize $theadClass $stick";
    $tbodyClass = "leading-none $tbodyClass";
}
@endphp

<div class="">
<table class="{{ $tableClass }}">
    <thead class="{{$theadClass}}">
        <tr>
            @foreach ($headers as $header)                   
            <th class="px-4 py-2">{{ $header }}</th>        
            @endforeach
        </tr>
    </thead>
    <tbody class="{{ $tbodyClass }}">
        {{ $slot }}
    </tbody>
</table>
</div>

