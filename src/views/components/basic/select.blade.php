{{-- exemple of options [ 'blue' => 'Blue' ] --}}

@props([
    'id',
    'size' => 'md',
    'color' => 'blue',
    'select' => 'standard',
    'class' => '',
    'options' => [],
    'selected' => '',
])

@php

    $standard = 'focus:outline-none invalid:border-red-500 disabled:opacity-50 disabled:cursor-not-allowed';

    $sizes = [
        'sm' => 'px-1 py-1 text-sm',
        'md' => 'px-1 py-1.5 text-base',
        'lg' => 'px-1 py-2 text-lg',
    ];

    $colors = "focus:[border-color:$color]";

    $selectStyles = [
        'stm' => "inline-block w-full border-b border-slate-700 bg-gray-100 focus:[border-color:$color] transition-colors $standard $sizes[$size] $class",
        'standard' => "inline-block w-full bg-gray-50 rounded-md focus:border-2 focus:[border-color:$color] focus:bg-gray-50 transition-colors $standard $sizes[$size] $class",
        'custom' => $class,
    ];
    $class = "$standard $sizes[$size] $selectStyles[$select] $class";

    is_string($options) && $options ? '' : ($options = json_encode($options));
@endphp

<select :id="id" x-data="selectFn(@js($id), @js($options), {{ $selected }})" class="{{ $selectStyles[$select] }}" {{ $attributes }}>
    <template x-for="(value, key) in options" :key="key">
        <option :selected="key == selected" :value="key" x-text="value"></option>
    </template>
</select>


<script defer>
    function selectFn(id, options, selected = '') {
        return {
            id: id,
            type: 'select',
            options: [],
            selected: '',
            init() {
                $stm.register(this)
                this.options = JSON.parse(options);
                selected ? this.selected = selected : '';
            },
            getSelected(){
                return this.selected;
            },
            getId(){
                return this.id;
            }

        }
    }
</script>

