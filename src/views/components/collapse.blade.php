{{-- COLLAPSE COMPONENT HAS 2 VARIBALES "ID", "STATE" THE ID IS A MUST IF YOU HAVE MULTIPLE COMPONENETS --}}
{{-- TO HANDEL THE STATE MANUALLY BY USING ALPINEJS USE "COLLAPSE" VARIBLE --}}

@props([
    
    'id' => 'collapse',
    'state' => false
])

@pushOnce('stm-scripts')
    <script>
        function collapseFn(id, state)
        {
            return {
                id: id,
                collapse : state,
                open(id)
                {
                    (this.id == id) ? this.collapse = true : '';
                },
                close(id)
                {
                    (this.id == id) ? this.collapse = false : '';
                },
                toggle(id)
                {
                    (this.id == id) ? this.collapse = !this.collapse : '';
                },
                getState()
                {
                    return this.collapse;
                },
                getId()
                {
                    return this.id;
                }
            }
        }
    </script>
@endpushOnce

<section 
x-data="collapseFn('{{$id}}', @js($state))"
:id="id"
x-on:open-collapse.window="open($event.detail.id)"
x-on:close-collapse.window="close($event.detail.id)"
x-on:toggle-collapse.window="toggle($event.detail.id)"
{{ $attributes }}
>
    <div x-ref="btn">
        {{ $btn }}
    </div>


    <section 
    x-show="collapse"
    x-cloak
    x-collapse
    >

        {{ $slot }}

    </section>


</section>

