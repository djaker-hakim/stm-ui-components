@props([
    'config' => [
        'alpinejs' => true,
    ],
])
@php
    use stm\UIcomponents\Support\Stm;
    
    // default values
    $config['alpinejs'] ??= true;
    $scripts = Stm::scripts()->getScripts();
    $scripts['datatable'] ??= false;
    
    // varibales from config
    extract($config);
    extract($scripts);

@endphp

@if ($alpinejs)
    <!-- ALPINEJS PLUGIN CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <!-- ALPINEJS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endif

<x-stm::stm-scripts />

@if($datatable)
    <x-stm::datatable-script />
@endif
