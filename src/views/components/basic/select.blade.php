@props([
    'size' => 'md',
    'color' => 'blue',
    'select' => 'standard',
    'class' => '',
    'options' => [
        'orange' => 'Orange',
        'blue' => 'Blue',
        'green' => 'Green',
    ],
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
        'custom' => '',
        'stm' => "inline-block w-full border-b border-slate-700 bg-gray-100 $colors transition-colors",
        'standard' => "inline-block w-full bg-gray-50 rounded-md focus:border-2 $colors focus:bg-gray-50 transition-colors",
    ];
    $class = "$standard $sizes[$size] $selectStyles[$select] $class";

    is_string($options) && $options ? '' : ($options = json_encode($options));
@endphp

<select x-data="selectFn(@js($options), {{ $selected }})" class="{{ $class }}" {{ $attributes }}>
    <template x-for="(value, key) in options" :key="key">
        <option :selected="key == selected" :value="key" x-text="value"></option>
    </template>
</select>


<script defer>
    function selectFn(options, selected = '') {
        return {
            options: [],
            selected: '',
            init() {
                this.options = JSON.parse(options);
                selected ? this.selected = selected : '';
            },

        }
    }
</script>

