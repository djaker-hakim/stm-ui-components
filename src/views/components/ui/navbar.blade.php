{{-- ID is a must for toggleing the collapse menu of the nav-bar
EVENTS: "open-navbar" "close-navbar" "toggle-navbar" with ID of the navbar --}}
{{-- there is no option for a custom nav only add supported classes --}}
{{-- bgcolor, color varibales of class names it uses tailwind class as default  --}}
{{-- clickOutside default is true --}}

@props([
    'id',
    'navbar' => 'standard',
    'backgroundColor' => 'gray',
    'color' => 'black',
    'class' => '',
    'config' => [
        'sticky' => false,
    ]
])
@php
    isset($config['sticky']) ? '' : $config['sticky'] = false;
    $config['sticky'] ? $stickyClass =  'sticky top-0' : $stickyClass = '';
    $navbars = [
        'standard' => [
            'navContainer' => "flex justify-between items-center px-5 sm:px-10 md:px-20 max-h-[50px] md:max-h-[70px] bg-[$backgroundColor] text-[$color] $stickyClass $class",
        ],
        'custom' => [
            'navContainer' => $class,
        ],
    ];

    $navbarContainer = $navbars[$navbar]['navContainer'];
@endphp



<nav x-data="navbarFn('{{$id}}')"
    class="{{ $navbarContainer }}"
    :id="id"
    {{ $attributes }}
>
    <div {{ $start->attributes }}>
        {{ $start }}
    </div>

    <div {{ $center->attributes }}>
        {{ $center }}
    </div>

    <div {{ $end->attributes }}>
        {{ $end }}
    </div>
</nav>


@pushOnce('stm-scripts')
    <script>
        function navbarFn(id)
        {
            return {
                id: id,
                type: 'navbar',
                init(){
                    $stm.register(this);
                },
                getId()
                {
                    return this.id
                }
            }
        }    
    </script>    
@endpushOnce
