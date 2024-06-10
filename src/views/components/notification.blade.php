{{-- ID IS A MUST ON MULTIPLE NOTIFICATION COMPONENTS --}}
{{-- YOU CAN TRIGGER THE NOTIFICATION WITH AN EVENT "show-notif" AND THE "ID" OTHE THE NOTIFICATION
EXEMPLE : $dispatch('show-notif', {id: 'notification-id'}) --}}

@props(
    [
        'id' => 'notification',
        'type' => 'alert-default',
        'state' => false,
        'class' => '',
        'duration' => '1s'
    ]
)

@pushOnce('scripts')
    <script>
        function notification(id, state)
        {
            return {
                notif: state,
                id: id,
                init()
                {
                    this.notif ? this.notify(this.id) : '';
                },
                notify(id)
                {
                    this.notif = (id == this.id);
                    setTimeout(() => {
                        this.notif = false;    
                    }, 3000);
                }
            };
        }
    </script>
@endPushOnce

<div x-data="notification(@js($id), @js($state))" 
x-show="notif" class="animate__animated animate__fadeInDown [--animate-duration:{{ trim($duration) }}]"
x-transition:enter="animate__animated animate__fadeInDown [--animate-duration:{{ trim($duration) }}] "
x-transition:leave="animate__animated animate__fadeOutUp [--animate-duration:{{ trim($duration) }}]"
x-on:show-notif.window="notify($event.detail.id)"
>
    <x-alert 
    class="{{ $class }}" 
    type="{{ $type }}">
        {{$slot}}
    </x-alert>
</div>