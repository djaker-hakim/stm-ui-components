{{-- 
    attributes id, theme, color, backgroundColor, size, config
    id: for identifing the component API
    theme: 'standard', 'stm'
    color: component color
    backgroundColor: component background color
    size: sm, md, lg
    config: array of pages, currentPage, limit, style
        pages: how many pages you want to paginate (number)
        currentPage: current page (number) default 1
        limit: limit of visible pages (number) default 5
        style: array of containerClass, itemClass, activeItemClass, leftArrowClass, rightArrowClass

    API: you can manipulate the pagination component with this methods
    methods: setLimit(), setTotalPages(), selectPage(), next(), prev()
  
    Events: change-page
    ex: x-on:change-page.window="doSomething($e.details)" 
    NOTE: in the detail object you will get the pagination component id and the page  
--}}
@props([
    'id' => '',
    'theme' => '',
    'size' => 'md',
    'color' => 'var(--stm-color-bg-1)',
    'backgroundColor' => 'var(--stm-color-accent)',
    'config' => []
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

//  default values
$config['pages'] ??= 5;
$config['currentPage'] ??= 1;
$config['limit'] ??= 5;

$config['style']['containerClass'] ??= '';
$config['style']['itemClass'] ??= '';
$config['style']['activeItemClass'] ??= '';
$config['style']['leftArrowClass'] ??= '';
$config['style']['rightArrowClass'] ??= '';

$id = Stm::id($id, 'pagination-');

$color = Color::colorToSnake($color);
$backgroundColor = Color::colorToSnake($backgroundColor);

// varibales from config
extract($config['style']);


$sizes = [
    'sm' => "py-1 px-2 text-xs",
    'md' => "py-2 px-3 text-sm",
    'lg' => "py-3 px-4 text-base"
];
if(!array_key_exists($size, $sizes)) $size = 'md';


$sta ="text-center font-medium transition-all cursor-pointer";

$paginations = [
    'standard' => [
        'container' => "flex $containerClass",
        'item' => "$sta border border-r-0 border-slate-300 shadow-sm hover:shadow-lg  hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] $itemClass",
        'activeItem' => "text-[$color] bg-[$backgroundColor] border-[$backgroundColor] $activeItemClass",
        'leftArrow' => "rounded-md rounded-r-none border border-r-0 border-slate-300 shadow-sm hover:shadow-lg hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] disabled:opacity-60 disabled:hover:bg-transparent disabled:hover:text-[var(--stm-color-muted)] disabled:hover:border-[var(--stm-color-muted)] disabled:border-[var(--stm-color-muted)] disabled:text-[var(--stm-color-muted)] disabled:cursor-not-allowed $leftArrowClass",
        'rightArrow' => "rounded-md rounded-l-none border border-slate-300 shadow-sm hover:shadow-lg hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] disabled:opacity-60 disabled:hover:bg-transparent disabled:hover:text-[var(--stm-color-muted)] disabled:hover:border-[var(--stm-color-muted)] disabled:border-[var(--stm-color-muted)] disabled:text-[var(--stm-color-muted)] disabled:cursor-not-allowed $rightArrowClass"
    ],
    'stm' => [
        'container' => "flex space-x-2 $containerClass",
        'item' => "$sta border border-slate-300 shadow-sm hover:shadow-lg hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] $itemClass",
        'activeItem' => "text-[$color] bg-[$backgroundColor] border-[$backgroundColor] $activeItemClass",
        'leftArrow' => "border border-slate-300 shadow-sm hover:shadow-lg hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] disabled:opacity-60 disabled:hover:bg-transparent disabled:hover:text-[var(--stm-color-muted)] disabled:hover:border-[var(--stm-color-muted)] disabled:border-[var(--stm-color-muted)] disabled:text-[var(--stm-color-muted)] disabled:cursor-not-allowed $leftArrowClass",
        'rightArrow' => "border border-slate-300 shadow-sm hover:shadow-lg hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] disabled:opacity-60 disabled:hover:bg-transparent disabled:hover:text-[var(--stm-color-muted)] disabled:hover:border-[var(--stm-color-muted)] disabled:border-[var(--stm-color-muted)] disabled:text-[var(--stm-color-muted)] disabled:cursor-not-allowed $rightArrowClass"
    ],
    'custom' => [
        'container' => $containerClass,
        'item' => $itemClass,
        'activeItem' => $activeItemClass,
        'leftArrow' => $leftArrowClass,
        'rightArrow' => $rightArrowClass
    ]
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $paginations) ? $theme : 'standard'; // theme fallback value
@endphp



<div :id="id" class="{{ $paginations[$theme]['container'] }}" x-data="paginationFn(@js($id), @js($config))" {{ $attributes }}>

    <button class="{{ $paginations[$theme]['leftArrow'] }}" type="button" x-on:click="prev()" :disabled="currentPage == 1" >
      <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
        </svg>
    </button>

    <template x-if="start > 1">
        <button class="{{ $paginations[$theme]['item'] }}" x-on:click="selectPage(1)">1</button>
    </template>
    <template x-if="start > 2">
        <button class="{{ $paginations[$theme]['item'] }}" x-on:click="selectPage(start-1)">...</button>
    </template>
    
    
    <template x-for="page in pages" :key="'index-'+page">
        <button class="{{ $paginations[$theme]['item'] }}"
        :class="currentPage == page ? '{{ $paginations[$theme]["activeItem"] }}' : ''"
        x-text="page" x-on:click="selectPage(page)"></button>
    </template>
        
    <template x-if="end < totalPages - 1">
        <button class="{{ $paginations[$theme]['item'] }}" x-on:click="selectPage(end+1)">...</button>
    </template>
    <template x-if="end < totalPages">
        <button class="{{ $paginations[$theme]['item'] }}" x-on:click="selectPage(totalPages)" x-text="totalPages"></button>
    </template>
   
    <button class="{{ $paginations[$theme]['rightArrow'] }}" type="button" x-on:click="next()" :disabled="currentPage == totalPages">
        <svg class="w-2.5 h-2.5 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
        </svg>
    </button>
</div>
