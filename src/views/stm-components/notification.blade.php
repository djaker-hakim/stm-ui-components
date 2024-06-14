{{-- ID IS A MUST ON MULTIPLE NOTIFICATION COMPONENTS --}}
{{-- YOU CAN TRIGGER THE NOTIFICATION WITH AN EVENT "show-notif" AND THE "ID" Of THE NOTIFICATION
EXEMPLE : $dispatch('show-notif', {id: 'notification-id'}) --}}

@props(
    [
        'id' => 'notification',
        'notification' => 'default',
        'state' => false,
        'class' => '',
        'duration' => '1s'
    ]
)

@pushOnce('stm-scripts')
    <script>
        function notificationFn(id, state)
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
                },
                getState()
                {
                    return this.notif;
                },
                getId()
                {
                    return this.id;
                }
            };
        }
    </script>
@endPushOnce

<div x-data="notificationFn(@js($id), @js($state))" 
x-show="notif"
x-cloak 
class="animate__animated animate__fadeInDown [--animate-duration:{{ trim($duration) }}]"
x-transition:enter="animate__animated animate__fadeInDown [--animate-duration:{{ trim($duration) }}] "
x-transition:leave="animate__animated animate__fadeOutUp [--animate-duration:{{ trim($duration) }}]"
x-on:show-notif.window="notify($event.detail.id)"
>
    <x-alert 
    class="{{ $class }}" 
    alert="{{ $notification }}">
        {{$slot}}
    </x-alert>
</div>