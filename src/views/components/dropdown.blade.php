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
        function dropdownFn(id, state)
        {
            return {
                drop: state,
                id: id,
                open(id)
                {
                    this.drop = (this.id == id);
                },
                close(id)
                {
                    (this.id == id) ? this.drop = false : '';
                },
                toggle(id)
                {
                    (this.id == id) ? this.drop = !this.collapse : '';
                },
                getState()
                {
                    return this.drop;
                },
                getId()
                {
                    return this.id;
                }
            }
        }
    </script>
@endPushOnce
    

<section 
class="relative"
x-data="dropdownFn('{{$id}}', @js($state))"
:id="id"
x-on:open-dropdown.window="open($event.detail.id)"
x-on:close-dropdown.window="close($event.detail.id)"
x-on:toggle-dropdown.window="toggle($event.detail.id)"
>

    <div class="inline-block" x-ref="btn">
        {{ $btn }}
    </div>


    <section 
    class="{{ $class }}"
    x-show="drop"
    x-cloak 
    {{ $anchor }}
    @if ($clickOutside) 
        x-on:click.outside="close(id)" 
    @endif
    {{ $attributes }}>
    
        {{ $slot }}

    </section>


</section>

