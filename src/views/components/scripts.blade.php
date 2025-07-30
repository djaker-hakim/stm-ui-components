{{-- 
     attributes: config
        config: array of alpinejs
        alpinejs: using alpinejs and plugins CDN's (bool) default true
--}}

@props([
    'config' => [],
])
@php 
    use stm\UIcomponents\Support\Stm;
    // default values
    $config['alpinejs'] ??= true;
    
    $version = Stm::version();
    $stmUrl = "/stm-ui-components/script.js?v=$version";
   
    
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

<script src="{{ $stmUrl }}"></script>

