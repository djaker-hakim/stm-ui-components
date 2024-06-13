{{-- ID IS A MUST if using MULTIPLE MODEL COMPONENT --}}
{{-- CLICK OUT SIDE BY DEFALT IT'S TRUE SO WHEN YOU CLICK OUTSIDE THE DROPDOWN WILL GO AWAY  --}}
{{-- YOU CAN ADD x-transition OF YOUR CHOICE FOR ANIMATIONS --}}
{{-- YOU CAN TRIGGER THE MODEL WITH AN EVENT "open-model", "close-model" AND THE "ID" OTHE THE DROPDOWN
EXEMPLE : $dispatch('open-model', {id: 'model-id'}), $dispatch('close-model', {id: 'model-id'})  --}}

@props([
    'id' => 'model',
    'state' => false,
    'clickOutside' => true 
])

@pushOnce('scripts')
    <script>
        function model(id, state)
        {
            return {
                id: id,
                model : state,
                open(id)
                {
                    this.model =  (this.id == id);
                },
                close(id)
                {
                    this.id == id ? this.model = false : '';
                },
                toggle(id)
                {
                    this.id == id ? this.model = !this.model : '';
                },
                getState()
                {
                    return this.model;
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
    x-data="model(@js($id), @js($state))"
    x-show="model"
    x-cloak
    x-on:open-model.window="open($event.detail.id)"
    x-on:close-model.window="close($event.detail.id)"
    x-on:toggle-model.window="close($event.detail.id)"
    class="fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black/30 ">

    <div 
    @if ($clickOutside) 
    x-on:click.outside="close(id)" 
    @endif
        class="bg-white sm:w-[400px] w-[280px] max-h-[500px] flex flex-col items-center rounded-md mt-5 overflow-auto"
        x-show="model"
        {{ $attributes }}>

        {{ $slot }}
        
    </div>
</section>