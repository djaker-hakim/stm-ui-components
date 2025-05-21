
@props([
    'id',
    'data', 
    'theme' => '',
    'color' => 'var(--stm-ui-bg-1)',
    'backgroundColor' => 'var(--stm-ui-primary)',
    'config' => [
        'style' => [
            'tabClass',
            'activeTabClass',
            'containerClass',
        ]
    ]
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

// default values
$config['style']['tabClass'] ??= '';
$config['style']['activeTabClass'] ??= '';
$config['style']['containerClass'] ??= '';
    
$tabClass = $config['style']['tabClass'];
$activeTabClass = $config['style']['activeTabClass'];
$containerClass = $config['style']['containerClass'];

$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

$backgroundColorFormat = Color::detectColorFormat($backgroundColor);
if($backgroundColorFormat == 'rgb' || 'hsl' || 'rgba' ) $backgroundColor = str_replace(' ', '_', trim($backgroundColor));

    
$tabs=[
    'standard' => [
        'tab' => "inline-block px-4 py-3 rounded-t-lg cursor-pointer text-center hover:text-gray-900 hover:bg-gray-100 disabled:opacity-60 disabled:hover:bg-transparent disabled:text-[var(--stm-ui-muted)] disabled:cursor-not-allowed disabled:hover:text-[var(--stm-ui-muted)] $tabClass",
        'activeTab' => "inline-block px-4 py-3 rounded-t-lg cursor-pointer text-center text-[$color] bg-[$backgroundColor] $activeTabClass",
        'container' => "$containerClass",
    ],
    'stm' =>[
        'tab' => "inline-block px-4 py-3 cursor-pointer text-center hover:text-gray-900 hover:bg-gray-100 disabled:opacity-60 disabled:hover:bg-transparent disabled:text-[var(--stm-ui-muted)] disabled:cursor-not-allowed disabled:hover:text-[var(--stm-ui-muted)] $tabClass",
        'activeTab' => "inline-block px-4 py-3 cursor-pointer text-center text-[$backgroundColor] bg-[$color] border-b-2 border-[$backgroundColor] $activeTabClass",
        'container' => "$containerClass",
    ],
    'custom' => [
        'tab' => $tabClass,
        'activeTab' => $activeTabClass,
        'container' => $containerClass
    ]
];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $tabs) ? $theme : 'standard'; // theme fallback value
@endphp




<section :id="id" x-data="tabsFn(@js($id), @js($data), @js($config))" {{ $attributes }}>

<div class="flex w-full overflow-x-auto space-x-2">
    
    <template x-for="(tab, index) in tabs" :key="'tab-' + index">
        <button type="button" :class="activeTab == tab.value ? '{{ $tabs[$theme]["activeTab"] }}' : '{{ $tabs[$theme]["tab"]}}'" x-on:click="activate(tab.value)" :disabled="!!tab.disabled" x-html="tab.lable">
        </button>
    </template>

</div>

<div class="{{ $tabs[$theme]['container'] }}">
    {{ $slot }}
</div>

</section>


@pushOnce('stm-scripts')
    
<script>
    function tabsFn(id, data, config = []) {
        return {
            id:id,
            tabs: data, // array of object lable, value, target, disabled
            activeTab: '',
            init(){
                $stm.register(this);
                this.$watch('activeTab', (value) => {
                    this.tabs.forEach((tab) => {
                        if (tab.value == this.activeTab) {
                            document.querySelector(tab.target).removeAttribute('style');
                        } else {
                            document.querySelector(tab.target).setAttribute('style', 'display:none;');
                        }
                    });
                });
                this.activateDefault();
                
            },
            activate(value){
                if(value == 'unknown'){
                    this.activeTab = value;
                    return;
                }
                if(this.checkIfDisabled(this.findTab(value))) return ;
                this.activeTab = value;
            },
            findTab(value){
                let [tab] = this.tabs.filter((tab) => {
                    return tab.value == value ;
                });
                return tab;
            },
            disable(value){
                let tab = this.findTab(value)
                tab.disabled = true;
                if(this.activeTab == tab.value) {
                    this.activateDefault();
                }
                
            },
            enable(value){
                let tab = this.findTab(value)
                tab.disabled = false;
                if(this.activeTab == 'unknown') this.activate(tab.value);
            },
            checkIfDisabled(tab){
                if(tab.hasOwnProperty('disabled')) return tab.disabled == true;
                return false;
            },
            getDefaultTab(){
                let defaultTab = {value: 'unknown'};
                for(let i=0; i < this.tabs.length; i++){
                  if(!this.checkIfDisabled(this.tabs[i])){
                    defaultTab = this.tabs[i];
                    break;
                  }
                }
                return defaultTab;
            },
            activateDefault(){
                this.activate(this.getDefaultTab().value);
            },
        }            
    }
</script>
@endPushOnce
