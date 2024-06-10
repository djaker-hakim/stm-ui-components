{{-- THE ERROR CAN BE A STRING OR AN ARRAY --}}

@props([
    'message' => '',
])
@php
    $messages = [];
    is_string($message) ? $messages[] = $message : $messages = $message;
@endphp


@foreach($messages as $error)
<div class="text-red-500 text-xs m-0">    
    {{ $error }} 
</div>
@endforeach

