{{-- POSITIONS: Bottom: bottom, bottom-start, bottom-end
                Top: top, top-start, top-end
                Left: left, left-start, left-end
                Right: right, right-start, right-end --}}
{{-- NOTE: IF YOUR POSITION DOES NOT WORK IT MEANS THERE IS NO SPACE SO IT FALL BACK TO THE OPTIMAL POSITION --}}
{{-- OFFSET IS THE MARGIN OF THE DROP-ELEMENT --}}
{{-- CLICK OUT SIDE BY DEFALT IT'S TRUE SO WHEN YOU CLICK OUTSIDE THE DROPDOWN WILL GO AWAY  --}}
{{-- YOU CAN ADD x-transition OF YOUR CHOICE FOR ANIMATIONS --}}
{{-- YOU CAN TRIGGER THE DROPDOWN WITH AN EVENT "drop" AND THE "ID" OTHE THE DROPDOWN
EXEMPLE : $dispatch('drop', {id: 'dropdown-id'})  --}}

@props([
    'id' => 'dropdown',
    'position' => '',
    'class' => 'bg-white rounded-md',
    'state' => false,
    'offset' => '5',
    'clickOutside' => true 
])
@php
    $position = trim($position);
    $offset = trim($offset);
    $anchor = "x-anchor.offset.$offset.$position=".'$refs.btn';
@endphp
@pushOnce('scripts')
    <script>
        function dropdown(id, state)
        {
            return {
                drop: state,
                id: id,
                dropIt(id)
                {
                    this.drop = (this.id == id);
                } 
            }
        }
    </script>
@endPushOnce
    

<section 
class="relative"
x-data="dropdown('{{$id}}', @js($state))"
:id="id"
x-on:drop.window="dropIt($event.detail.id)">

    <div class="inline-block" x-ref="btn">
        {{ $btn }}
    </div>


    <section 
    class="{{ $class }}"
    x-show="drop"
    x-cloak 
    {{ $anchor }}
    @if ($clickOutside) x-on:click.outside="drop = false" @endif
    {{ $attributes }}>
    
        {{ $slot }}

    </section>


</section>

