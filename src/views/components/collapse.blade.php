{{-- COLLAPSE COMPONENT HAS 2 VARIBALES "ID", "STATE" THE ID IS A MUST IF YOU HAVE MULTIPLE COMPONENETS --}}
{{-- TO HANDEL THE STATE MANUALLY BY USING ALPINEJS USE "COLLAPSE" VARIBLE --}}

@props([
    
    'id' => 'collapse',
    'state' => false
    
])

@pushOnce('scripts')
    <script>
        function collapseFn(id, state)
        {
            return {
                id: id,
                collapse : state,
                collapseIt(id)
                {
                    (this.id == id) ? this.collapse = !this.collapse : '';

                }
            }
        }
    </script>
@endpushOnce

<section 
x-data="collapseFn('{{$id}}', @js($state))"
:id="id"
x-on:collapse.window="collapseIt($event.detail.id)"
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

