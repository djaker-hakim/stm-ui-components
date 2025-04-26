
@props([
    'id',
    'tabs' => 'standard',
    'color' => 'blue',
    'data', 
    'config' => [
        'style' => [
            'tabClass',
            'activeTabClass',
            'containerClass',
        ]
    ]
])

@php
    
    isset($config['style']['tabClass']) ? '' : $config['style']['tabClass'] = '';
    isset($config['style']['activeTabClass']) ? '' : $config['style']['activeTabClass'] = '';
    isset($config['style']['containerClass']) ? '' : $config['style']['containerClass'] = '';

    
    
    $tabClass=$config['style']['tabClass'];
    $activeTabClass=$config['style']['activeTabClass'];
    $containerClass=$config['style']['containerClass'];
    


    $tabStyle=[
        'standard' => [
            'tabClass' => "inline-block px-4 py-3 rounded-lg cursor-pointer text-center hover:text-gray-900 hover:bg-gray-100 $tabClass",
            'activeTabClass' => "inline-block px-4 py-3 rounded-lg cursor-pointer text-center text-white bg-[$color] $activeTabClass",
            'containerClass' => "$containerClass",
        ],
        'custom' => [
            'tabClass' => $tabClass,
            'activeTabClass' => $activeTabClass,
            'containerClass' => $containerClass
        ]
    ];


@endphp




<section :id="id" x-data="tabsFn(@js($id), @js($data), @js($config))" {{ $attributes }}>

<ul class="flex flex-wrap space-x-2">
    
    <template x-for="tab in tabs" :key="tab.value">
        <li :class="activeTab == tab.value ? '{{ $tabStyle[$tabs]["activeTabClass"] }}' : '{{ $tabStyle[$tabs]["tabClass"]}}'" x-on:click="activate(tab)" x-html="tab.lable">
        </li>
    </template>

</ul>

<div class="{{ $tabStyle[$tabs]['containerClass'] }}">
    {{ $slot }}
</div>

</section>


@pushOnce('stm-scripts')
    
<script>
    function tabsFn(id, data, config = []) {
        return {
            id:id,
            tabs: data, // array of object lable, value, target
            activeTab:'',
            init(){
                $stm.register(this);
                this.$watch('activeTab', (value) => {
                    this.tabs.forEach((tab) => {
                        if (tab.value == this.activeTab) {
                            document.getElementById(tab.target).removeAttribute('style');
                        } else {
                            document.getElementById(tab.target).setAttribute('style', 'display:none;');
                        }
                    });
                });
                this.activate(this.tabs[0]);
            },
            activate(tab){
                this.activeTab = tab.value;
            },
        }            
    }
</script>
@endPushOnce
