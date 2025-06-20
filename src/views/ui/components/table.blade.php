{{-- 
    attributes id, theme, color, backgroundColor data, config
    id: for identifing the component API
    theme: 'standard', 'stm'
    color: component color
    backgroundColor: component background color
    data: table data
    config: array of sortable, selectable, selectAllBtn, view, emptyMessage, table, card
        sortable: sortable columns (bool) defaut true
        selectable: row selection (bool) default false
        selectAllBtn: the select all button (bool) default true
        view: 'auto', 'desktop', 'mobile' default 'auto'
        emptyMessage: message to display when there is no data default 'no data found'
        table: array of headers, style
            headers: array of table headers KEY(key), VALUE(lable) ex: ['name' => 'Nom & Prénom', 'age' => 'Age']
            style: array of lightColor, width, height, stickyHeader, hoverable, striped, bordered, tableContainerClass, tableClass, theadClass, tbodyClass, trClass, thClass, tdClass
                lightColor: for hover and stripes
                width, height: width and height of the table ex: '800px'
                stickyHeader, hoverable, striped, bordered (bool) default false, true, false, false
                tableContainerClass, tableClass, theadClass, tbodyClass, trClass, thClass, tdClass: for styling
        card: array of cardHeader, style
            cardHeader: array of header in mobile view KEY(key), VALUE(lable) ex: ['name' => 'Nom & Prénom']
            style: array of mTableClass, mTheadClass, mTbodyClass, mTrClass, mThClass, mTdClass, cardClass, chClass, cdClass 

    slots: action, loader
        action: for action buttons you got access to the row object eg. row.id depending on the data
        loader: for a custom loader

    API: 
        available methods: setupData(data), setData(data), removeSelect(), showSelect(), toggleSelect(), getSelection(),
            removeSelect(), showSelect(), toggleSelect(): set the selectable
            setupData(): adding data
        available properties: loading
            loading: setting the load state if prosesing (bool) default false
--}}
@props([
    'id' => '',
    'theme' => '',
    'color' => 'var(--stm-color-bg-1)',
    'backgroundColor' => 'var(--stm-color-accent)',
    'data' => [],
    'config' => []
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;


    // Default Config Values
    $config['sortable'] ??= true;
    $config['selectable'] ??= false;
    $config['selectAllBtn'] ??= true;
    $config['view'] ??= 'auto'; // auto, desktop, mobile
    $config['emptyMessage'] ??= 'no data found';
    $config['table']['style']['lightColor'] ??= 'var(--stm-color-bg-2)';
    $lightColor = $config['table']['style']['lightColor'];
    // Table Default Values
    $config['table']['headers'] ??= [];
    $config['table']['style']['width'] ??= ''; 
    $config['table']['style']['height'] ??= '';
    $config['table']['style']['stickyHeader'] ??= false;
    $config['table']['style']['hoverable'] ??= true;
    $config['table']['style']['striped'] ??= false;
    $config['table']['style']['bordered'] ??= false;
    
    $config['table']['style']['tableContainerClass'] ??= '';
    $config['table']['style']['tableClass'] ??= '';
    $config['table']['style']['theadClass'] ??= '';
    $config['table']['style']['tbodyClass'] ??= '';
    $config['table']['style']['trClass'] ??= '';
    $config['table']['style']['thClass'] ??= '';
    $config['table']['style']['tdClass'] ??= '';
    // Card Default Values
    $config['card']['cardHeader'] ??= [];
    $config['card']['style']['mTableClass'] ??= '';
    $config['card']['style']['mTheadClass'] ??= '';
    $config['card']['style']['mTbodyClass'] ??= '';
    $config['card']['style']['mTrClass'] ??= '';
    $config['card']['style']['mThClass'] ??= '';
    $config['card']['style']['mTdClass'] ??= '';
    $config['card']['style']['cardClass'] ??= '';
    $config['card']['style']['chClass'] ??= '';
    $config['card']['style']['cdClass'] ??= '';

$id = Stm::id($id, 'table-');

$color = Color::colorToSnake($color);
$backgroundColor = Color::colorToSnake($backgroundColor);
$lightColor = Color::colorToSnake($lightColor);

    // Table Classes Setup
    extract($config['table']['style']);
    // Card classes Setup
    extract($config['card']['style']);
    // Table Varibales Setup
    $width = $config['table']['style']['width'] ? "w-[".$config['table']['style']['width']."]" : '';
    $height = $config['table']['style']['height'] ? "h-[".$config['table']['style']['height']."]" : '';
    $sticky = $config['table']['style']['stickyHeader'] ? "sticky top-0 z-10" : '';
    $hover = $config['table']['style']['hoverable'] ? "hover:bg-[$lightColor] cursor-pointer" : '';
    $striped = $config['table']['style']['striped'] ? "even:bg-[$lightColor]" : '';
    $bordered = $config['table']['style']['bordered'] ? "border-b border-gray-300" : '';
    $view = $config['view'];
    $tableResClass = $view == 'auto' ? 'md:block hidden' : '' ;   
    $mTableResClass = $view == 'auto' ? 'md:hidden block' : '' ;   

    // Table Themes
    $tables = [
        'standard' => [
            'tableContainer' => "overflow-auto rounded-lg shadow w-full md:max-w-[800px] max-w-[280px] p-0 $width $height $tableContainerClass",
            'table' => "w-full $tableClass",
            'thead' => "capitalize bg-[$backgroundColor] text-[$color] text-sm leading-normal $sticky $theadClass",
            'tbody' => "text-sm $tbodyClass",
            'tr' => "border-b $hover $striped $trClass",
            'th' => "py-3 px-4 text-left cursor-pointer [user-select:none] $thClass",
            'td' => "py-3 px-4 $bordered $tdClass",            
        ],
        'stm' => [
            'tableContainer' => "overflow-auto md:border md:shadow md:max-w-[800px] max-w-[280px] p-0 $width $height $tableContainerClass",
            'table' => "w-full $tableClass",
            'thead' => "capitalize bg-[$color] border-b border-[$backgroundColor] text-[$backgroundColor] text-sm leading-normal $sticky $theadClass",
            'tbody' => "text-sm $tbodyClass",
            'tr' => "border-b $hover $striped $trClass",
            'th' => "py-3 px-6 text-left cursor-pointer [user-select:none] $thClass",
            'td' => "py-3 px-6 $bordered $tdClass",            
        ],
        'custom' => [
            'tableContainer' => "$tableContainerClass",
            'table' => "$tableClass",
            'thead' => "$theadClass",
            'tbody' => "$tbodyClass",
            'tr' => "$trClass",
            'th' => "$thClass",
            'td' => "$tdClass",
        ]
    ];

    //   MOBILE table themes

    $mTables = [
        'standard' => [
            'mTable' => "w-full $mTableClass",
            'mThead' => "capitalize bg-[$backgroundColor] text-[$color] text-sm leading-normal $sticky $mTheadClass",
            'mTbody' => "text-sm $mTbodyClass",
            'mTr' => "border-b $hover $striped $mTrClass",
            'mTh' => "py-2 px-3 text-left cursor-pointer [user-select:none] $mThClass",
            'mTd' => "py-1 px-3 $bordered $mTdClass",
            'card' => "grid grid-cols-3 justify-items-start border-b $cardClass",
            'ch' => "uppercase font-semibold $chClass",
            'cd' => "break-all text-wrap col-span-2 $cdClass"
        ],
        'stm' => [
            'mTable' => "w-full $mTableClass",
            'mThead' => "capitalize bg-[$color] border-b border-[$backgroundColor] text-[$backgroundColor] text-sm leading-normal $sticky $theadClass",
            'mTbody' => "text-sm $mTbodyClass",
            'mTr' => "border-b $hover $striped $mTrClass",
            'mTh' => "py-2 px-3 text-left cursor-pointer [user-select:none] $mThClass",
            'mTd' => "py-1 px-3 $bordered $mTdClass",
            'card' => "grid grid-cols-3 justify-items-start border-b $cardClass",
            'ch' => "uppercase font-semibold $chClass",
            'cd' => "break-all text-wrap col-span-2 $cdClass"
        ],
        'custom' => [
            'mTable' => "$mTableClass",
            'mThead' => "$mTheadClass",
            'mTbody' => "$mTbodyClass",
            'mTr' => "$mTrClass",
            'mTh' => "$mThClass",
            'mTd' => "$mTdClass",
            'card' => "$cardClass",
            'ch' => "$chClass",
            'cd' => "$cdClass"
        ]
    ];


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $tables) ? $theme : 'standard'; // theme fallback value
@endphp

<section class="{{ $tables[$theme]['tableContainer'] }}" x-data="tableFn(@js($id), @js($data), @js($config))">

@if($view == 'auto' || $view == 'desktop')
    <div class="{{ $tableResClass }}">
        <table class="{{ $tables[$theme]['table'] }}"
            {{ $attributes }}>
            <thead class="{{ $tables[$theme]['thead'] }}">
                <tr>
                    <th class="{{ $tables[$theme]['th'] }}" x-show="selectable" x-cloak>
                        <span x-show="selectable && selectAllBtn" x-cloak>
                            <x-stm::checkbox :theme="$theme" :color="$backgroundColor" ::checked="selection.length === rows.length && selection.length > 0" x-on:click="selectAll()" />
                        </span>
                        <span x-show="!selectAllBtn" x-cloak></span>
                    </th>
                    <template x-for="(header, key) in headers" :key="'header' + key">
                        <th class="{{ $tables[$theme]['th'] }}" x-on:click="sortBy(key)">
                            <div class="flex items-center gap-1">
                                <span x-text="header"></span>
                                <span class="text-xs" x-cloak x-show="sortProps.key == key && sortable" x-text="sortProps.order === 'asc' ? '▲' : '▼'"></span>
                            </div>
                        </th>
                    </template>
                    @isset($action)
                        <th class="{{ $tables[$theme]['th'] }}">action</th>
                    @endisset
                </tr>
            </thead>

            <tbody class="{{ $tables[$theme]['tbody'] }}">

                <template x-for="(row, index) in rows" :key="'row' + index">
                    
                    <tr class="{{ $tables[$theme]['tr'] }}">
                        <td class="{{ $tables[$theme]['td'] }}"
                            :class="selectable ? '' : 'hidden'">
                            <x-stm::checkbox :theme="$theme" :color="$backgroundColor" ::checked="selection.includes(row)" x-on:click.stop="true" x-on:change="select(row)" />
                        </td>
                        <template x-for="(header, key) in headers" :key="'row' + key">
                            <td class="{{ $tables[$theme]['td'] }}" x-text="row[key]"></td>
                        </template>
                        @isset($action)
                            <td class="{{ $tables[$theme]['td'] }}">
                                {{ $action }}    
                            </td>
                        @endisset          
                    </tr>

                </template>
            </tbody>
        </table>

        {{--  No data found  --}}
        <div class="text-center text-[var(--stm-color-muted)] text-sm p-4" x-show="rows.length === 0 && !loading && Object.keys(headers).length > 0" x-cloak>
            {{ $config['emptyMessage'] }}
        </div>
        @isset($loader)
            {{ $loader }} 
        @else
            {{-- loader --}}
            <div class="flex justify-center items-center p-4" x-show="loading" x-cloak>
                <x-stm::spinner :theme="$theme" :color="$backgroundColor" />
            </div>
        @endisset
    </div>
@endif
 
{{-- mobile TABLE --}}

@if($view == 'auto' || $view == 'mobile')
<div class="{{ $mTableResClass }}">
    <table class="{{ $mTables[$theme]['mTable'] }}" {{ $attributes }}>
        <thead class="{{ $mTables[$theme]['mThead'] }}">
            <tr>
                <th class="{{ $mTables[$theme]['mTh'] }}" x-show="selectable" x-cloak>
                    <span x-show="selectable && selectAllBtn" x-cloak>
                        <x-stm::checkbox :theme="$theme" :color="$backgroundColor" ::checked="selection.length === rows.length && selection.length > 0" x-on:click="selectAll()" />
                    </span>
                    <span x-show="!selectAllBtn" x-cloak></span>
                </th>
                <th class="{{ $mTables[$theme]['mTh'] }}" x-on:click="sortBy(cardHeader[0])">
                    <div class="flex items-center gap-1">
                        <span x-text="cardHeader[1]"></span>
                        <span class="text-xs" x-cloak x-show="sortProps.key == cardHeader[0] && sortable" x-text="sortProps.order === 'asc' ? '▲' : '▼'"></span>
                    </div>
                </th>
            </tr>
        </thead>

        <tbody class="{{ $mTables[$theme]['mTbody'] }}">

            <template x-for="(row, index) in rows" :key="'row' + index">
                
                <tr class="{{ $mTables[$theme]['mTr'] }}" x-data="{ open: false }" x-on:click="open = !open">
                    <td class="{{ $mTables[$theme]['mTd'] }}"
                        :class="selectable ? '' : 'hidden'">
                        <x-stm::checkbox :theme="$theme" :color="$backgroundColor" ::checked="selection.includes(row)" x-on:click.stop="true" x-on:change="select(row)" />
                    </td>
                    <td class="{{ $mTables[$theme]['mTd'] }}">
                        <div class="flex items-center space-x-2">
                            <span>
                                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="size-4 rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                </svg>
                            </span>
                            <span x-text="row[cardHeader[0]]"></span>
                        </div>
                        <div x-show="open" x-collapse.min.1px class="mt-2">
                            <template x-for="(header, key) in headers" :key="'header' + key">
                                <div class="{{ $mTables[$theme]['card'] }}">
                                    <span class="{{ $mTables[$theme]['ch'] }}" x-text="header+':'"></span>
                                    <span class="{{ $mTables[$theme]['cd'] }}" x-text="row[key]"></span>
                                </div>
                            </template>
                            @isset($action)
                                <div class="{{ $mTables[$theme]['card'] }}">
                                    <span class="{{ $mTables[$theme]['ch'] }}">action</span>
                                    <span class="{{ $mTables[$theme]['cd'] }}">{{ $action }}</span>
                                </div>
                            @endisset
                        </div>
                    </td>        
                </tr>
            </template>
        </tbody>  
    </table>
    {{--  No data found  --}}
    <div class="text-center text-[var(--stm-color-muted)] text-sm p-4" x-show="rows.length === 0 && !loading && Object.keys(headers).length > 0" x-cloak>
        {{ $config['emptyMessage'] }}
    </div>
    @isset($loader)
        {{ $loader }} 
    @else
        {{-- loader --}}
        <div class="flex justify-center items-center p-4" x-show="loading" x-cloak>
            <x-stm::spinner :theme="$theme" :color="$backgroundColor" />
        </div>
    @endisset
</div> 
@endif
</section>