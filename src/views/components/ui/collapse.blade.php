{{-- COLLAPSE COMPONENT HAS 2 VARIBALES "ID", "STATE" THE ID IS A MUST IF YOU HAVE MULTIPLE COMPONENETS --}}
{{-- TO HANDEL THE STATE MANUALLY BY USING ALPINEJS USE "COLLAPSE" VARIBLE --}}

@props([
    'id',
    'theme' => '',
    'color' => '',
    'backgroundColor' => 'var(--stm-ui-bg-2)',
    'class' => '',
    'config' => ['state' => false],
])

@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;

// default values
$config['state'] ??= false;


$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

$backgroundColorFormat = Color::detectColorFormat($backgroundColor);
if($backgroundColorFormat == 'rgb' || 'hsl' || 'rgba' ) $backgroundColor = str_replace(' ', '_', trim($backgroundColor));


$collapses = [
    'standard' => "p-2 bg-[$backgroundColor] text-[$color] $class",
    'stm' => "p-2 shadow-md bg-[$backgroundColor] text-[$color] $class",
    'custom' => "$class"
];


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $collapses) ? $theme : 'standard'; // theme fallback value


@endphp


<section 
:id="id"
class="{{ $collapses[$theme] }}";
x-data="collapseFn(@js($id), @js($config))" 
x-on:open-collapse.window="open($event.detail.id)"
x-on:close-collapse.window="close($event.detail.id)" 
x-on:toggle-collapse.window="toggle($event.detail.id)"
x-show="state" 
x-cloak 
x-collapse 
{{ $attributes }}>
    {{ $slot }}
</section>


@pushOnce('stm-scripts')
    <script>
        function collapseFn(id, config) {
            return {
                id: id,
                type: 'collapse',
                state: config.state,
                init() {
                    $stm.register(this);
                },
                open(id = '') {
                    if (id) {
                        (this.id == id) ?
                        this.state = true: '';
                    } else {
                        this.state = true;
                    }

                },
                close(id) {
                    if (id) {
                        (this.id == id) ? this.state = false: '';
                    } else {
                        this.state = false;
                    }

                },
                toggle(id) {
                    if (id) {
                        (this.id == id) ? this.state = !this.state: '';
                    } else {
                        this.state = !this.state;
                    }
                },
                getState() {
                    return this.state;
                },
                getId() {
                    return this.id;
                }
            }
        }
    </script>
@endpushOnce