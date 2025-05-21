{{-- exemple of options [ 'blue' => 'Blue' ] --}}

@props([
    'id',
    'size' => 'md',
    'color' => 'blue',
    'theme' => '',
    'class' => '',
    'options' => [],
    'selected' => '',
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;


$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

    $standard = 'focus:outline-none invalid:border-red-500 disabled:opacity-60 disabled:bg-[var(--stm-ui-muted)] disabled:cursor-not-allowed';

    $sizes = [
        'sm' => 'px-1 py-1 text-sm',
        'md' => 'px-1 py-1.5 text-base',
        'lg' => 'px-1 py-2 text-lg',
    ];


    $selects = [
        'standard' => "inline-block w-full bg-gray-50 rounded-md focus:border-2 focus:[border-color:$color] focus:bg-gray-50 transition-colors $standard $sizes[$size] $class",
        'stm' => "inline-block w-full border-b border-slate-700 bg-gray-100 focus:[border-color:$color] transition-colors $standard $sizes[$size] $class",
        'custom' => $class,
    ];

$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $selects) ? $theme : 'standard'; // theme fallback value


@endphp

<select :id="id" x-data="selectFn(@js($id), @js($options), @js($selected))" class="{{ $selects[$theme] }}" {{ $attributes }}>
    <template x-for="(value, key) in options" :key="key">
        <option :selected="key == selected" :value="key" x-text="value"></option>
    </template>
</select>


@pushOnce('stm-scripts')
<script>
    function selectFn(id, options, selected = '') {
        return {
            id: id,
            type: 'select',
            options: [],
            selected: '',
            init() {
                $stm.register(this)
                this.options = options;
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

@endpushOnce

