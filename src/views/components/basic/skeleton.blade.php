@props([
    'config' => [
        'width' => '100%'
    ],
])
@php
    isset($config['width']) ?: $config['width'] = '100%';
@endphp


<div class="max-w-full animate-pulse">
    <div
      class="w-56 h-3 mb-4 text-5xl antialiased font-semibold leading-tight tracking-normal bg-gray-300 rounded-full text-inherit">
      &nbsp;
    </div>
    <div
      class="h-2 mb-2 text-base antialiased font-light leading-relaxed bg-gray-300 rounded-full text-inherit w-[{{ $config['width'] }}]">
      &nbsp;
    </div>
    <div
      class="h-2 mb-2 text-base antialiased font-light leading-relaxed bg-gray-300 rounded-full text-inherit w-[{{ $config['width'] }}]">
      &nbsp;
    </div>
    <div
      class="h-2 mb-2 text-base antialiased font-light leading-relaxed bg-gray-300 rounded-full text-inherit w-[{{ $config['width'] }}]">
      &nbsp;
    </div>
    <div
      class="h-2 mb-2 text-base antialiased font-light leading-relaxed bg-gray-300 rounded-full text-inherit w-[{{ $config['width'] }}]">
      &nbsp;
    </div>
</div>