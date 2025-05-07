@props([
    'id',
    'pagination' => 'standard',
    'size' => 'md',
    'color' => 'white',
    'backgroundColor' => 'blue',
    'config' => [
        'pages' => 10,
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

    isset($config['pages']) ? '' : $config['pages'] = 0;
    isset($config['currentPage']) ? '' : $config['currentPage'] = 1;
    isset($config['limit']) ? '' : $config['limit'] = 5;

    isset($config['style']['containerClass']) ? $containerClass=$config['style']['containerClass'] : $containerClass='' ;
    isset($config['style']['itemClass']) ? $itemClass=$config['style']['itemClass'] : $itemClass='' ;
    isset($config['style']['activeItemClass']) ? $activeItemClass=$config['style']['activeItemClass'] : $activeItemClass='';
    isset($config['style']['leftArrowClass']) ? $leftArrowClass=$config['style']['leftArrowClass'] : $leftArrowClass='';
    isset($config['style']['rightArrowClass']) ? $rightArrowClass=$config['style']['rightArrowClass'] : $rightArrowClass='';
       

    $sizes = [
        'sm' => "py-1 px-2 text-xs",
        'md' => "py-2 px-3 text-sm",
        'lg' => "py-3 px-4 text-base"
    ];

    $sta ="text-center font-medium transition-all cursor-pointer";
    
    $paginationStyles = [
        'standard' => [
            'container' => "flex",

            'item' => "$sta border border-r-0 border-slate-300 shadow-sm hover:shadow-lg text-slate-600 hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size]",

            'activeItem' => "text-[$color] bg-[$backgroundColor] border-[$backgroundColor]",

            'leftArrow' => "rounded-md rounded-r-none border border-r-0 border-slate-300 shadow-sm hover:shadow-lg text-slate-600 hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size]",

            'rightArrow' => "rounded-md rounded-l-none border border-slate-300 shadow-sm hover:shadow-lg text-slate-600 hover:text-[$color] hover:bg-[$backgroundColor] hover:border-[$backgroundColor] $sizes[$size]"
        ],
        'custom' => [
            'container' => $containerClass,
            'item' => $itemClass,
            'activeItem' => $activeItemClass,
            'leftArrow' => $leftArrowClass,
            'rightArrow' => $rightArrowClass
        ]
    ];


@endphp



<div :id="id" class="{{ $paginationStyles[$pagination]['container'] }}" 
    x-data="paginationFn(@js($id), @js($config))">


    <button class="{{ $paginationStyles[$pagination]['leftArrow'] }}" type="button" x-on:click="prev()">
      <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
        </svg>
    </button>

    
    <template x-if="start > 1">
        <button class="{{ $paginationStyles[$pagination]['item'] }}" x-on:click="selectPage(start-1)">...</button>
    </template>
    
    <template x-for="page in pages" :key="'index-'+page">
        <button class="{{ $paginationStyles[$pagination]['item'] }}"
        :class="currentPage == page ? '{{ $paginationStyles[$pagination]["activeItem"] }}' : ''"
        x-text="page" x-on:click="selectPage(page)"></button>
    </template>
        
    <template x-if="end < totalPages">
        <button class="{{ $paginationStyles[$pagination]['item'] }}" x-on:click="selectPage(end+1)">...</button>
    </template>
   
    <button class="{{ $paginationStyles[$pagination]['rightArrow'] }}" type="button" x-on:click="next()">
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
                sendEvent(){
                    this.$dispatch('change-page', { id: this.id, page: this.currentPage });
                }
        }
    }
    </script>
      
@endPushOnce