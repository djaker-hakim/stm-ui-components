@props([
    'config' => [
        'size' => 'md',
        'border-radious' => '100%'
    ]
])

@php
    isset($config['size']) ? $size = trim($config['size']) : $size = 'sm';
    isset($config['border-radious']) ? $config['border-radious'] = trim($config['border-radious']) : $config['border-radious'] = '100%';
    $sizes = [
        'sm' => 'size-12',
        'md' => 'size-16',
        'lg' => 'size-20',
    ];
    if(!array_key_exists($size, $sizes)) $sizes[$size] = "size-[$size]";
@endphp


<img
    class="relative inline-block {{ $sizes[$size] }} !rounded-[{{ $config['border-radious'] }}]  object-cover object-center"
    {{ $attributes }}
    />