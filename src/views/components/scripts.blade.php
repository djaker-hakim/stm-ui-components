{{-- 
     attributes: config
        config: array of alpinejs
        alpinejs: using alpinejs and plugins CDN's (bool) default true
--}}

@props([
    'config' => [],
])
@php    
    // default values
    $config['alpinejs'] ??= true;
   
    
    // varibales from config
    extract($config);
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

<script src="/stm-ui-components/script.js"></script>

