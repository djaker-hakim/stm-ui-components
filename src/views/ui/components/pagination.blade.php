@props([
    'id',
    'theme' => '',
    'size' => 'md',
    'color' => 'var(--stm-ui-bg-1)',
    'backgroundColor' => 'var(--stm-ui-primary)',
    'config' => [
        'pages' => 100,
        'currentPage' => 1,
        'limit' => 5,
        'style' => [
            'containerClass' => '',
            'itemClass' => '',
            'activeItemClass' => '',
            'leftArrowClass' => '',
            'rightArrowClass' => '',
        ]
    ]
    ])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

//  default values
    $config['pages'] ??= 0;
    $config['currentPage'] ??= 1;
    $config['limit'] ??= 5;

    $config['style']['containerClass'] ??= '';
    $config['style']['itemClass'] ??= '';
    $config['style']['activeItemClass'] ??= '';
    $config['style']['leftArrowClass'] ??= '';
    $config['style']['rightArrowClass'] ??= '';

$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

$backgroundColorFormat = Color::detectColorFormat($backgroundColor);
if($backgroundColorFormat == 'rgb' || 'hsl' || 'rgba' ) $backgroundColor = str_replace(' ', '_', trim($backgroundColor));

    $containerClass = $config['style']['containerClass'];
    $itemClass = $config['style']['itemClass'];
    $activeItemClass = $config['style']['activeItemClass'];
    $leftArrowClass = $config['style']['leftArrowClass'];
    $rightArrowClass = $config['style']['rightArrowClass'];
       

    $sizes = [
        'sm' => "py-1 px-2 text-xs",
        'md' => "py-2 px-3 text-sm",
        'lg' => "py-3 px-4 text-base"
    ];

    $sta ="text-center font-medium transition-all cursor-pointer";
    
    $paginations = [
        'standard' => [
            'container' => "flex $containerClass",
            'item' => "$sta border border-r-0 border-slate-300 shadow-sm hover:shadow-lg  hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] $itemClass",
            'activeItem' => "text-[$color] bg-[$backgroundColor] border-[$backgroundColor] $activeItemClass",
            'leftArrow' => "rounded-md rounded-r-none border border-r-0 border-slate-300 shadow-sm hover:shadow-lg hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] disabled:opacity-60 disabled:hover:bg-transparent disabled:hover:text-[var(--stm-ui-muted)] disabled:hover:border-[var(--stm-ui-muted)] disabled:border-[var(--stm-ui-muted)] disabled:text-[var(--stm-ui-muted)] disabled:cursor-not-allowed $leftArrowClass",
            'rightArrow' => "rounded-md rounded-l-none border border-slate-300 shadow-sm hover:shadow-lg hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] disabled:opacity-60 disabled:hover:bg-transparent disabled:hover:text-[var(--stm-ui-muted)] disabled:hover:border-[var(--stm-ui-muted)] disabled:border-[var(--stm-ui-muted)] disabled:text-[var(--stm-ui-muted)] disabled:cursor-not-allowed $rightArrowClass"
        ],
        'stm' => [
            'container' => "flex space-x-2 $containerClass",
            'item' => "$sta border border-slate-300 shadow-sm hover:shadow-lg hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] $itemClass",
            'activeItem' => "text-[$color] bg-[$backgroundColor] border-[$backgroundColor] $activeItemClass",
            'leftArrow' => "border border-slate-300 shadow-sm hover:shadow-lg hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] disabled:opacity-60 disabled:hover:bg-transparent disabled:hover:text-[var(--stm-ui-muted)] disabled:hover:border-[var(--stm-ui-muted)] disabled:border-[var(--stm-ui-muted)] disabled:text-[var(--stm-ui-muted)] disabled:cursor-not-allowed $leftArrowClass",
            'rightArrow' => "border border-slate-300 shadow-sm hover:shadow-lg hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size] disabled:opacity-60 disabled:hover:bg-transparent disabled:hover:text-[var(--stm-ui-muted)] disabled:hover:border-[var(--stm-ui-muted)] disabled:border-[var(--stm-ui-muted)] disabled:text-[var(--stm-ui-muted)] disabled:cursor-not-allowed $rightArrowClass"
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



<div :id="id" class="{{ $paginations[$theme]['container'] }}" 
    x-data="paginationFn(@js($id), @js($config))"
    {{ $attributes }}>


    <button class="{{ $paginations[$theme]['leftArrow'] }}" type="button" x-on:click="prev()" :disabled="currentPage == 1" >
      <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
        </svg>
    </button>

    <template x-if="start > 1">
        <button class="{{ $paginations[$theme]['item'] }}" x-on:click="selectPage(1)">1</button>
    </template>
    <template x-if="start > 1">
        <button class="{{ $paginations[$theme]['item'] }}" x-on:click="selectPage(start-1)">...</button>
    </template>
    
    
    <template x-for="page in pages" :key="'index-'+page">
        <button class="{{ $paginations[$theme]['item'] }}"
        :class="currentPage == page ? '{{ $paginations[$theme]["activeItem"] }}' : ''"
        x-text="page" x-on:click="selectPage(page)"></button>
    </template>
        
    <template x-if="end < totalPages">
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

@pushOnce('stm-scripts')

    <script>
        function paginationFn(id, config){
            return {
                id: id,
                currentPage: config.currentPage,
                totalPages: config.pages,
                pages: [],
                start: null,
                end: null,
                limit: config.limit,
                init(){
                    $stm.register(this);
                    this.visiblePages();
                },
                next(){
                    if(this.currentPage < this.totalPages){
                        this.currentPage++;
                        this.visiblePages();  
                    }
                },
                prev(){
                    if(this.currentPage > 1){
                        this.currentPage--;
                        this.visiblePages();
                    }
                },
                selectPage(page){
                    this.currentPage = page;
                    this.visiblePages();
                },
                visiblePages(){
                    this.pages = [];
                    this.start = Math.max(1, this.currentPage - Math.floor(this.limit / 2));
                    this.end = Math.min(this.totalPages, this.start + this.limit - 1);
                    this.start = Math.max(1, this.end - this.limit + 1);
                    for(let i = this.start; i <= this.end; i++){
                        this.pages.push(i);
                    }
                    this.sendEvent();
                },
                setLimit(value){
                    this.limit = value;
                    this.visiblePages();
                },
                setTotalPages(value){
                    this.totalPages = value;
                    this.visiblePages();
                },
                sendEvent(){
                    this.$dispatch('change-page', { id: this.id, page: this.currentPage });
                }
        }
    }
    </script>
      
@endPushOnce