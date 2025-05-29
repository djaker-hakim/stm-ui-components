@props([
    'id' => 'data',
    'data',
])

@php
    
@endphp


<div x-data="dataTableFn(@js($id))">
    <section class="py-4 flex flex-wrap justify-end items-center gap-2 md:max-w-full max-w-[280px]">
        <div>
            <x-stm::search size="sm" />
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <x-stm::select size="sm" :options="['10' => '10', '20' => '20', '30' => '30']" selected="20" />
                <label for="">/page</label>
            </div> 
                
            <x-stm::button size="sm" id="cols" x-data x-on:click="$stm.toggle('drop')" >
                <div class="flex items-center gap-2 justify-between">
                    <span>Columns</span>
                    <span>v</span>
                </div> 
            </x-stm::button>
            <x-stm::dropdown id="drop" :config="[ 'buttonId' => 'cols' ]">
            <div class="space-y-1">
                <template x-for="(head, index) in table.headers" :key="'index-'+ index">

                    <div class="w-40 p-1 rounded-sm flex gap-2 justify-start items-center hover:bg-gray-200">
                        <x-stm::checkbox :config="['style' => ['inputClass' => 'bg-white']]" />
                        <label x-text="head"></label>
                    </div>
                        
                </template>
            </div>
            </x-stm::dropdown>
            <x-stm::button size="sm" >...</x-stm::button>
        </div>
    </section>

    <x-stm::table id="table-data" :data="$data" :config="['selectable' => true]" >
        <x-slot:action>
            <div class="p-1">
                <x-stm::button size="sm" >Edit</x-stm::button>
            </div>
        </x-slot:action>
    </x-stm::table>

    <section class="py-4 flex flex-wrap justify-around items-center gap-2  md:max-w-full max-w-[280px]">
        <div class="text-sm">1 to 10 from 12</div>
        <x-stm::pagination id="table-page" size="md" :config="[ 'pages' => 12, 'limit' => 3 ]" />
    </section>         
</div>


@pushOnce('stm-scripts')
    <script>
        function dataTableFn(id){
            return {
                id: id,
                type:'datatable',
                table: {headers: [],},
                pagination: null,
                headers: [],
                init(){
                    this.$nextTick(() => { 
                       this.table = $stm.component('table-data');
                       this.pagination = $stm.component('table-page');
                       this.headers = this.table.headers;
                       $stm.register(this);
                       console.log(this.table)
                    });
                },



            }
        }
    </script>
@endPushOnce