<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TAILWIND CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <!-- ALPINEJS PLUGIN CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <!-- ALPINEJS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- <link rel="icon" type="image/x-icon" href="" /> -->
    <title>test</title>
    @stack('styles')
</head>
<body class="relative">
    <div class="sticky top-0 z-20">
        <x-stm::navbar id="nav-bar" >
            <x-slot:brand>
                logo
            </x-slot:brand>
            <x-slot:nav-menu>
                <p>home</p>
                <p>shop</p>
                <p>contact</p>
            </x-slot:nav-menu>
        </x-stm::navbar>
    </div>

<div class="flex relative">
    <div class="fixed top-[50px] left-0">
    <x-stm::sidebar id="side-bar" 
    :clickOutside="true" 
    position="left"
    :state="true"
    class="bg-red-500 text-white border-r-4 border-green-500 fill-gray-700">
        <x-slot:brand>
            <div class="my-5">logo</div>
        </x-slot:brand>
        
        <p><span>H</span> <span x-show="sidebar">home</span></p>
        <p><span>C</span> <span x-show="sidebar">contact</span></p>
        <template x-for="1 in 30">
            <p><span>A</span> <span x-show="sidebar">about us</span></p>
        </template>
        
    </x-stm::sidebar>
    </div>
    
    

    <main class="w-full bg-gray-100 px-20 h-[200vh] overflow-auto" x-data>
        <h1>this is the main section</h1>
        <div class="w-full flex justify-center mt-[300px]">
            <x-button color="blue" text="text-white" x-on:click="$dispatch('toggle-sidebar', {id: 'side-bar'})">click</x-button>
        </div>
    </main>

    <div class="fixed top-[50px] right-0">
        <x-stm::sidebar id="side-bar-1" 
        sidebar="expand" 
        :clickOutside="false" 
        position="right"
        :state="true"
        class="bg-red-500 text-white border-r-4 border-green-500 fill-gray-700">
            <x-slot:brand>
                <div class="my-5">logo</div>
            </x-slot:brand>
            
            <p><span>H</span> <span x-show="sidebar">home</span></p>
            <p><span>C</span> <span x-show="sidebar">contact</span></p>
            <template x-for="1 in 30">
                <p><span>A</span> <span x-show="sidebar">about us</span></p>
            </template>
            
        </x-stm::sidebar>
    </div>
</div>
    

    @stack('scripts')  
</body>
</html>

{{-- <section class="" x-data="{open : true}">
    
    <nav class="h-screen bg-gray-200 sticky top-0 py-10 transition-[border-radius_width] duration-500"
        :class="open ? 'w-52 rounded-lg' : 'w-16 rounded-[40px] shadow-lg'"  
        x-show=""
        x-transition:enter="transition-[width]  duration-500"
        x-transition:enter-start="w-20"
        x-transition:enter-end="w-52"
        x-transition:leave="transition-[width] w-20 duration-500"
        >
        <div class="z-10">
            <x-stm::button btn="icon" x-on:click="open = true" x-show="!open">open</x-button>
            <x-stm::button btn="icon" x-on:click="open = !open"> ret </x-button>
        </div>

        
            <ul class="side overflow-y-auto overflow-x-hidden h-[500px]">
                <li class="flex gap-4"><span>small</span><span x-show="true"> dashboard</span></li>
                <template x-for="1 in 30">
                    <li>page</li>
                </template>
            </ul>
  
    </nav>
</section> --}}