@props([
    'id',
    'theme' => '',
    'color' => 'var(--stm-ui-danger)',
    'size' => 'md',
    'class' => '',
    'message' => '',
])


@php
use stm\UIcomponents\Support\Stm;
use stm\UIcomponents\Support\Color;


$colorFormat = Color::detectColorFormat($color);
if($colorFormat == 'rgb' || 'hsl' || 'rgba' ) $color = str_replace(' ', '_', trim($color));

$sizes=[
    'sm' => 'text-xs',
    'md' => 'text-sm',
    'lg' => 'text-base', 
];

$errs = [
    'standard' => "text-[$color] $sizes[$size] $class",
    'custom' => $class,
];


$theme = $theme ? $theme : Stm::styles()->theme;
$theme = array_key_exists($theme, $errs) ? $theme : 'standard'; // theme fallback value
@endphp



<div class="{{ $errs[$theme] }}" x-data="errorFn(@js($id), @js($message))" x-text="message"></div>



@pushOnce('stm-scripts')
<script>
    function errorFn(id, message){
        return {
            id: id,
            message: message,
            init(){
                $stm.register(this);
            },
            setMessage(message){
                this.message = message;
            },
            reset(){
                this.message = '';
            }
        }
    }
</script>


@endpushOnce