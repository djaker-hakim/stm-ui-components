{{-- COLLAPSE COMPONENT HAS 2 VARIBALES "ID", "STATE" THE ID IS A MUST IF YOU HAVE MULTIPLE COMPONENETS --}}
{{-- TO HANDEL THE STATE MANUALLY BY USING ALPINEJS USE "COLLAPSE" VARIBLE --}}

@props([
    'id' => 'collapse',
    'config' => ['state' => false],
])

@pushOnce('stm-scripts')
    <script>
        function collapseFn(id, config) {
            return {
                id: id,
                type: 'collapse',
                collapse: config.state,
                init() {
                    $stm.register(this);
                },
                open(id = '') {
                    if (id) {
                        (this.id == id) ?
                        this.collapse = true: '';
                    } else {
                        this.collapse = true;
                    }

                },
                close(id) {
                    if (id) {
                        (this.id == id) ? this.collapse = false: '';
                    } else {
                        this.collapse = false;
                    }

                },
                toggle(id) {
                    if (id) {
                        (this.id == id) ? this.collapse = !this.collapse: '';
                    } else {
                        this.collapse = !this.collapse;
                    }
                },
                getState() {
                    return this.collapse;
                },
                getId() {
                    return this.id;
                }
            }
        }
    </script>
@endpushOnce

<section x-data="collapseFn('{{ $id }}', @js($config))" :id="id" x-on:open-collapse.window="open($event.detail.id)"
    x-on:close-collapse.window="close($event.detail.id)" x-on:toggle-collapse.window="toggle($event.detail.id)"
    x-show="collapse" x-cloak x-collapse {{ $attributes }}>
    {{ $slot }}
</section>
