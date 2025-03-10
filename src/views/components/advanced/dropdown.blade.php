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
    'config' => [
        'buttonId' => '',
        'state' => false,
        'position' => '',
        'offset' => '5',
        'clickOutside' => true,
    ],
])
@php
    isset($config['state']) ? '' : ($config['state'] = false);
    isset($config['position']) ? '' : ($config['position'] = 'bottom');
    isset($config['offset']) ? '' : ($config['offset'] = '5');
    isset($config['clickOutside']) ? '' : ($config['clickOutside'] = true);

    $position = trim($config['position']);
    $offset = trim($config['offset']);
    $clickOutside = $config['clickOutside'] ? true : false;
    $anchor = "x-anchor.offset.$offset.$position=" . "document.getElementById('$config[buttonId]')";
@endphp
@pushOnce('stm-scripts')
    <script>
        function dropdownFn(id, config) {
            return {
                id: id,
                type: 'dropdown',
                drop: config.state,
                init() {
                    $stm.register(this);
                },
                open(id) {
                    if (id) {
                        this.drop = (this.id == id);
                    } else {
                        this.drop = true;
                    }

                },
                close(id) {
                    if (id) {
                        (this.id == id) ?
                        this.drop = false: '';
                    } else {
                        this.drop = false;
                    }

                },
                toggle(id) {
                    if (id) {
                        (this.id == id) ? this.drop = !this.drop: '';
                    } else {
                        this.drop = !this.drop;
                    }

                },
                getState() {
                    return this.drop;
                },
                getId() {
                    return this.id;
                }
            }
        }
    </script>
@endPushOnce


<section x-data="dropdownFn('{{ $id }}', @js($config))" :id="id" x-on:open-dropdown.window="open($event.detail.id)"
    x-on:close-dropdown.window="close($event.detail.id)" x-on:toggle-dropdown.window="toggle($event.detail.id)"
    x-show="drop" x-cloak {{ $anchor }} @if ($clickOutside) x-on:click.outside="close(id)" @endif
    {{ $attributes }}>
    {{ $slot }}
</section>
