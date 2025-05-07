@props([
    'id',
    'table' => 'standard',
    'color' => 'blue',
    'data' => [],
    'config' => []
])

@php
    // Default Config Values
    $config['selectable'] ??= false;
    $config['emptyMessage'] ??= 'no data found';
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
    $config['card']['style']['cardContainerClass'] ??= '';
    $config['card']['style']['cardClass'] ??= '';
    $config['card']['style']['cheadClass'] ??= '';
    $config['card']['style']['cbodyClass'] ??= '';
    $config['card']['style']['chClass'] ??= '';
    $config['card']['style']['cdClass'] ??= '';
    
    // Table Varibales Setup
    $width = $config['table']['style']['width'] ? "w-[$config[table][style][width]]" : '';
    $height = $config['table']['style']['height'] ? "h-[$config[table][style][height]]" : '';
    $sticky = $config['table']['style']['stickyHeader'] ? "sticky top-0 z-10" : '';
    $hover = $config['table']['style']['hoverable'] ? "hover:bg-[$color]/15 cursor-pointer" : '';
    $striped = $config['table']['style']['striped'] ? "even:bg-[$color]/15" : '';
    $bordered = $config['table']['style']['bordered'] ? "border-b border-gray-300" : '';
    // Table Classes Setup
    $tableContainerClass = $config['table']['style']['tableContainerClass'];
    $tableClass = $config['table']['style']['tableClass'];
    $theadClass = $config['table']['style']['theadClass'];
    $tbodyClass = $config['table']['style']['tbodyClass'];
    $trClass = $config['table']['style']['trClass'];
    $thClass = $config['table']['style']['thClass'];
    $tdClass = $config['table']['style']['tdClass'];
    // Card classes Setup
    $cardContainerClass = $config['card']['style']['cardContainerClass'];
    $cardClass = $config['card']['style']['cardClass'];
    $cheadClass = $config['card']['style']['cheadClass'];
    $cbodyClass = $config['card']['style']['cbodyClass'];
    $chClass = $config['card']['style']['chClass'];
    $cdClass = $config['card']['style']['cdClass'];
    
    // Table Themes
    $tables = [
        'standard' => [
            'tableContainer' => "overflow-auto md:border md:rounded-lg md:shadow md:p-0 p-4 $width $height $tableContainerClass",
            'table' => "w-full md:table hidden",
            'thead' => "capitalize bg-[$color] text-white text-sm leading-normal $sticky $theadClass",
            'tbody' => "text-gray-700 text-sm $tbodyClass",
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

    // Card Themes
    $cards = [
        'standard' => [
            'cardContainer' => "grid gap-4 md:hidden overflow-auto $cardContainerClass",
            'card' => "border rounded-lg p-4 shadow hover:shadow-md transition $cardClass",
            'chead' => "font-semibold text-gray-800 $cheadClass",
            'cbody' => "mt-4 text-gray-700 text-sm *:border-b $cbodyClass",
            'ch' => "uppercase font-semibold $chClass",
            'cd' => "$cdClass",
        ],
        'custom' => [
            'cardContainer' => "$cardContainerClass",
            'card' => "$cardClass",
            'chead' => "$cheadClass",
            'cbody' => "$cbodyClass",
            'ch' => "$chClass",
            'cd' => "$cdClass",
        ]
    ];



@endphp

<section x-data="tableFn(@js($id), @js($data), @js($config))"
    class="{{ $tables[$table]['tableContainer'] }}">

    <table class="{{ $tables[$table]['table'] }}"
        {{ $attributes }}>
        <thead class="{{ $tables[$table]['thead'] }}">
            <tr>
                <th class="{{ $tables[$table]['th'] }}" :class="selectable ? '' : 'hidden'" x-cloak>
                    <input type="checkbox" class="w-4 h-4 text-[{{ $color }}] border-gray-300 rounded focus:ring-[{{ $color }}] focus:ring-2" :checked="selection.length === rows.length && selection.length > 0" x-on:click="selectAll()">
                </th>
                <template x-for="(header, key) in headers" :key="'header' + key">
                    <th class="{{ $tables[$table]['th'] }}" x-on:click="sortBy(key)">
                        <span x-text="header"></span>
                        <span class="text-xs" x-cloak x-show="sortProps.key == key && sortable" x-text="sortProps.order === 'asc' ? '▲' : '▼'"></span>
                    </th>
                </template>
                @isset($action)
                    <th class="{{ $tables[$table]['th'] }}">action</th>
                @endisset

            </tr>
        </thead>

        <tbody class="{{ $tables[$table]['tbody'] }}">

            <template x-for="(row, index) in rows" :key="'row' + index">
                
                <tr class="{{ $tables[$table]['tr'] }}">
                    <td class="{{ $tables[$table]['td'] }}"
                        :class="selectable ? '' : 'hidden'">
                        
                        <input type="checkbox" class="w-4 h-4 text-[{{ $color }}] border-gray-300 rounded focus:ring-[{{ $color }}] focus:ring-2" :checked="selection.includes(row)" x-on:click.stop x-on:change="select(row)">
                    </td>
                    <template x-for="(header, key) in headers" :key="'row' + key">
                        <td class="{{ $tables[$table]['td'] }}" x-text="row[key]"></td>
                    </template>
                    @isset($action)
                        <td class="{{ $tables[$table]['td'] }}">
                            {{ $action }}    
                        </td>
                    @endisset          
                </tr>

            </template>
            

        </tbody>
        
    </table>
    {{--  No data found  --}}
    <div class="text-center text-gray-500 md:block hidden text-sm p-4" x-show="rows.length === 0 && !loading && Object.keys(headers).length > 0" x-cloak>
       {{ $config['emptyMessage'] }}
    </div>
    @isset($loader)
        <div class="md:block hidden">
           {{ $loader }}
        </div> 
    @else
        {{-- loader --}}
        <div class="md:flex hidden justify-center items-center p-4" x-show="loading" x-cloak>
            <svg class="text-gray-300 animate-spin" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                <path
                    d="M32 3C35.8083 3 39.5794 3.75011 43.0978 5.20749C46.6163 6.66488 49.8132 8.80101 52.5061 11.4939C55.199 14.1868 57.3351 17.3837 58.7925 20.9022C60.2499 24.4206 61 28.1917 61 32C61 35.8083 60.2499 39.5794 58.7925 43.0978C57.3351 46.6163 55.199 49.8132 52.5061 52.5061C49.8132 55.199 46.6163 57.3351 43.0978 58.7925C39.5794 60.2499 35.8083 61 32 61C28.1917 61 24.4206 60.2499 20.9022 58.7925C17.3837 57.3351 14.1868 55.199 11.4939 52.5061C8.801 49.8132 6.66487 46.6163 5.20749 43.0978C3.7501 39.5794 3 35.8083 3 32C3 28.1917 3.75011 24.4206 5.2075 20.9022C6.66489 17.3837 8.80101 14.1868 11.4939 11.4939C14.1868 8.80099 17.3838 6.66487 20.9022 5.20749C24.4206 3.7501 28.1917 3 32 3L32 3Z"
                    stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path
                    d="M32 3C36.5778 3 41.0906 4.08374 45.1692 6.16256C49.2477 8.24138 52.7762 11.2562 55.466 14.9605C58.1558 18.6647 59.9304 22.9531 60.6448 27.4748C61.3591 31.9965 60.9928 36.6232 59.5759 40.9762"
                    stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"
                    class="text-[{{ $color }}]">
                </path>
            </svg>
        </div>
    @endisset

    {{-- Mobile Table --}}
    <div class="{{ $cards[$table]['cardContainer'] }} ">
        <template x-for="(row, index) in rows" :key="'row' + index">
            <div x-data="{ open: false }" 
                class="{{ $cards[$table]['card'] }}">
                {{--  Header  --}}
                <div class="flex justify-between items-center cursor-pointer" x-on:click="open = !open">
                    <div class="{{ $cards[$table]['chead'] }}">

                        <input type="checkbox" class="w-3 h-3 mr-2 text-[{{ $color }}] border-gray-300 rounded focus:ring-[{{ $color }}] focus:ring-2" :checked="selection.includes(row)" x-on:click.stop x-on:change="select(row)" :class="selectable ? '' : 'hidden'" x-cloak>

                        <span class="{{ $cards[$table]['ch'] }}" x-text="cardHeader[1]+': '"></span>
                        <span class="{{ $cards[$table]['cd'] }}" x-text="row[cardHeader[0]]"></span> 
                    </div>

                    <div class="rounded-full p-2 bg-[{{ $color }}]">
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </div>
                </div>

                {{--  Collapsible Content  --}}
                <div x-show="open" x-collapse class="{{ $cards[$table]['cbody'] }}">

                    <template x-for="(header, key) in headers" :key="'header' + key">
                        <div class="flex justify-between mb-2">
                            <span class="{{ $cards[$table]['ch'] }}" x-text="header+':'"></span>
                            <span class="{{ $cards[$table]['cd'] }}" x-text="row[key]"></span>
                        </div>
                    </template>
                    @isset($action)
                        <div class="flex justify-between mb-2">
                            <span class="{{ $cards[$table]['ch'] }}">action</span>
                            <span class="{{ $cards[$table]['cd'] }}">{{ $action }}</span>
                        </div>
                    @endisset
                </div>
            </div>
        </template>
            {{--  No data found  --}}
        <div class="text-center text-gray-500 md:hidden text-sm" x-show="rows.length === 0 && !loading && Object.keys(headers).length > 0" x-cloak>
            {!! $config['emptyMessage'] !!}
        </div>
        @isset($loader)
        <div class="md:hidden block">
            {{ $loader }}
        </div>
        @else
            {{-- loader --}}
            <div class="md:hidden flex justify-center items-center p-4" x-show="loading" x-cloak>
                <svg class="text-gray-300 animate-spin" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                    <path
                        d="M32 3C35.8083 3 39.5794 3.75011 43.0978 5.20749C46.6163 6.66488 49.8132 8.80101 52.5061 11.4939C55.199 14.1868 57.3351 17.3837 58.7925 20.9022C60.2499 24.4206 61 28.1917 61 32C61 35.8083 60.2499 39.5794 58.7925 43.0978C57.3351 46.6163 55.199 49.8132 52.5061 52.5061C49.8132 55.199 46.6163 57.3351 43.0978 58.7925C39.5794 60.2499 35.8083 61 32 61C28.1917 61 24.4206 60.2499 20.9022 58.7925C17.3837 57.3351 14.1868 55.199 11.4939 52.5061C8.801 49.8132 6.66487 46.6163 5.20749 43.0978C3.7501 39.5794 3 35.8083 3 32C3 28.1917 3.75011 24.4206 5.2075 20.9022C6.66489 17.3837 8.80101 14.1868 11.4939 11.4939C14.1868 8.80099 17.3838 6.66487 20.9022 5.20749C24.4206 3.7501 28.1917 3 32 3L32 3Z"
                        stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path
                        d="M32 3C36.5778 3 41.0906 4.08374 45.1692 6.16256C49.2477 8.24138 52.7762 11.2562 55.466 14.9605C58.1558 18.6647 59.9304 22.9531 60.6448 27.4748C61.3591 31.9965 60.9928 36.6232 59.5759 40.9762"
                        stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"
                        class="text-[{{ $color }}]">
                    </path>
                </svg>
            </div>
        @endisset
    </div>
   
</section>

@pushOnce('stm-scripts')
<script>
    function tableFn(id, data, config){
        return {
            id: id,
            type: 'table',
            rows: [],
            selection: [],
            loading: false,
            selectable: false,
            sortable: true,
            sortProps: {},
            cardHeader: [],
            headers: {},
            init(){
                $stm.register(this);
                this.selectable = config.selectable ? config.selectable : false;
                this.sortable = config.sortable ? config.sortable : true;
                this.setupData(data);
            },
            setupData(rows){
                if(rows.length > 0 || Object.keys(config.table.headers).length > 0){
                    Object.keys(config.table.headers).length > 0 ? this.headers = config.table.headers : Object.keys(rows[0]).map(key => this.headers[key] = key);                               
                    let obj = Object.keys(config.card.cardHeader).length > 0 ? config.card.cardHeader : this.headers;
                    this.cardHeader.push(Object.keys(obj)[0]);
                    this.cardHeader.push(Object.values(obj)[0]);
                    this.sortProps.unsortedRows = rows.slice();
                    this.rows = rows.slice();
                }
            },
            removeSelect(){
                this.selectable = false;
                this.selection = [];
            },
            showSelect(){
                this.selectable = true;
                this.selection = [];
            },
            toggleSelect(){
                this.selectable = !this.selectable;
                this.selection = [];
            },
            select(row){
                this.selection.includes(row) ? this.selection = this.selection.filter(r => r !== row) : this.selection.push(row);
            },
            selectAll(){
                this.selection = this.selection.length === this.rows.length ? [] : this.rows;
            },
            getId(){
                return this.id;
            },
            getSelection(){
                return this.selection;
            },
            sortBy(key){
                if(!this.sortable || !this.rows.length > 0) return;
                if(this.sortProps.key == key){
                    this.sortProps.order = this.sortProps.order === 'asc' ? 'desc' : 'unsort';
                    this.sortProps.order === 'unsort' ? this.sortProps.key = '' : '';
                    this.sortRows(key, this.sortProps.order);
                    return;
                } 
                this.sortProps.order = 'asc',
                this.sortProps.key = key;
                this.sortRows(key, this.sortProps.order);
            },
            sortRows(key, order){
                if(order == 'unsort'){
                    this.rows = this.sortProps.unsortedRows.slice();
                    return;
                }
                this.rows = this.rows.sort((a, b) => {
                        if(order === 'asc'){   
                            if(a[key] === b[key]) return 0;
                            return a[key] < b[key] ? -1 : 1;
                        }else if(order === 'desc'){
                            if(a[key] === b[key]) return 0;
                            return a[key] > b[key] ? -1 : 1;
                        }
                    }
                );
            }
        }
    }
</script>
@endpushOnce