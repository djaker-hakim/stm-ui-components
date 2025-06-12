{{-- 
    attributes id, theme, color, backgroundColor, data, config
    id: for identifing the component API
    color: component color
    backgroundColor: component background color
    data: table data
    config: array of navigation, sortable, selectable, selectAllBtn, view, emptyMessage, table, card, pagination
        navigation: 'none', array of searchable, perPageOptions, columns
            searchable: search input (bool) default true
            perPageOptions: array of key value pair ex: ['10' => '10', '20' => '20', '30' => '30']
            columns: add and remove table columns (bool) default true
        sortable: sort table by columns (bool) default true
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
        pagination: 'none', array of limit, style
            limit: limit of visible pages (number) default 5
            style: array of containerClass, itemClass, activeItemClass, leftArrowClass, rightArrowClass     

    API:
        available properties table, pagination
            table: table component
            pagination: pagination component
        available methods: setData(data), setSearch(string), setPerPage(number)
            setData(data): adding data to component
            setSearch(string): the table search method
            setPerPage(number): setter for item per page method
--}}
@props([
    'id' => '',
    'theme' => '',
    'color' => 'white',
    'backgroundColor' => 'var(--stm-ui-primary)',
    'data' => [],
    'config' => [],
])

@php
    use stm\UIcomponents\Support\Stm;
    use stm\UIcomponents\Support\Color;

    Stm::scripts()->enable('datatable');
    
    // default values
    $config['pagination'] ??= [];
    $config['navigation'] ??= [];

    $no_navigation = ($config['navigation'] == 'none');
    $no_pagination = ($config['pagination'] == 'none');
    
    if(!$no_navigation){

        $config['navigation']['searchable'] ??= true;
        $config['navigation']['perPageOptions'] ??= ['10' => '10', '20' => '20', '30' => '30'];
        $config['navigation']['columns'] ??= true;
        
        // varibales from config
        extract($config['navigation']);    
    }

    $pagination = $config['pagination'];
    $tableConfig = $config;

    // ids for nested components
    $id = Stm::id($id, 'data-table-');
    $tableId = Stm::id('', 'table-');
    $paginationId = Stm::id('', 'pagination-');
    $dropBtnId = Stm::id('', 'drop-btn-');
    $dropdownId = Stm::id('', 'dropdown-');

    // ids for APIs
    $config['tableId'] = $tableId;
    $config['paginationId'] = $paginationId;
    
    // colors for nested components
    $color = Color::colorToSnake($color);
    $backgroundColor = Color::colorToSnake($backgroundColor);

    // global theme for components
    $theme = $theme ? $theme : Stm::styles()->theme;
@endphp


<div x-data="dataTableFn(@js($id), @js($data), @js($config))">
    @if(!$no_navigation)
        <section class="py-4 flex flex-wrap justify-end items-center gap-2 md:max-w-full max-w-[280px]">
            @if($searchable)
                <div>
                    <x-stm::search :theme="$theme" :color="$backgroundColor" x-model="navigation.search" x-on:keyup.debounce="setFinalData()" />
                </div>
            @endif
            <div class="flex items-center gap-4">
                @if(!$no_pagination)
                    <div class="flex items-center gap-2">
                        <x-stm::select :theme="$theme" :color="$backgroundColor" x-model="pageControl.perPage" x-on:change="setFinalData()" :options="$perPageOptions" />
                        <span>/page</span>
                    </div>
                @endif
                    
                @if($columns)
                    <x-stm::button :id="$dropBtnId" :theme="$theme" :color="$color" :backgroundColor="$backgroundColor" x-on:click="$stm.toggle('{{ $dropdownId }}')" >
                        <div class="flex items-center gap-2 justify-between">
                            <span>Columns</span>
                            <span class="size-3"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512"><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></span>
                        </div> 
                    </x-stm::button>
                    <x-stm::dropdown :id="$dropdownId" :theme="$theme" class="z-20" :config="[ 'buttonId' => $dropBtnId ]">
                        <div class="space-y-1" x-sort="changeOrder($item, $position)">
                            <template x-for="(head, key) in navigation.columns" :key="'index-'+ key">

                                <div x-sort:item="key" class="w-40 p-1 rounded-sm flex justify-between items-center hover:bg-gray-200">
                                    <div class="flex gap-2 items-center">
                                        <x-stm::checkbox :color="$backgroundColor" :theme="$theme" ::checked="Object.keys(table.headers).includes(key)" x-on:change="toggleHeaders(key)" :config="['style' => ['inputClass' => 'bg-white']]" />
                                        <label x-text="head"></label>
                                    </div>
                                    <div class="size-6 cursor-move fill-[var(--stm-ui-muted)]" x-sort:handle>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M360-160q-33 0-56.5-23.5T280-240q0-33 23.5-56.5T360-320q33 0 56.5 23.5T440-240q0 33-23.5 56.5T360-160Zm240 0q-33 0-56.5-23.5T520-240q0-33 23.5-56.5T600-320q33 0 56.5 23.5T680-240q0 33-23.5 56.5T600-160ZM360-400q-33 0-56.5-23.5T280-480q0-33 23.5-56.5T360-560q33 0 56.5 23.5T440-480q0 33-23.5 56.5T360-400Zm240 0q-33 0-56.5-23.5T520-480q0-33 23.5-56.5T600-560q33 0 56.5 23.5T680-480q0 33-23.5 56.5T600-400ZM360-640q-33 0-56.5-23.5T280-720q0-33 23.5-56.5T360-800q33 0 56.5 23.5T440-720q0 33-23.5 56.5T360-640Zm240 0q-33 0-56.5-23.5T520-720q0-33 23.5-56.5T600-800q33 0 56.5 23.5T680-720q0 33-23.5 56.5T600-640Z"/></svg>
                                    </div>
                                </div>
                                    
                            </template>
                        </div>
                    </x-stm::dropdown>
                @endif
                @isset($button)
                    {{ $button }}
                @endisset
            </div>
        </section>
    @endif

    <x-stm::table :id="$tableId" :theme="$theme" :color="$color" :backgroundColor="$backgroundColor" :config="$tableConfig">
        @isset($action)
            <x-slot:action>
                <div class="p-1">
                    {{ $action }}
                </div>
            </x-slot:action>
        @endisset
    </x-stm::table>

    @if(!$no_pagination)
        <section class="py-4 flex flex-wrap justify-around items-center gap-2  md:max-w-full max-w-[280px]"
        x-on:change-page.window="paginate($event.detail.page)">

            <div class="text-sm" x-text="`${pageControl.start + 1} to ${Math.min(pageControl.end + 1, pageControl.dataLength)} from ${pageControl.dataLength}`"></div>
            <x-stm::pagination :id="$paginationId" :color="$color" :backgroundColor="$backgroundColor" size="md" :config="$pagination" />

        </section>
    @endif    
</div>