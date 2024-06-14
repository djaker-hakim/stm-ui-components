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
    <style> [x-cloak] { display: none !important; } </style>
    @stack('styles')
</head>
<body class="relative">
    <x-alert alert="warning">this is an alert</x-alert>
    <div class="sticky top-0 z-20">
    <x-navbar id="nav-bar">
        <x-slot:brand>
            <img class="h-[40px]" src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" alt="">
        </x-slot:brand>

        <x-slot:nav-menu>
            <a class="block font-semibold hover:bg-green-100 px-3 py-1" href="#">Home</a>
            <a class="block font-semibold hover:bg-green-100 px-3 py-1" href="#">Services</a>
            <a class="block font-semibold hover:bg-green-100 px-3 py-1" href="#">About Us</a>
            <a class="block font-semibold hover:bg-green-100 px-3 py-1" href="#">Contact Us</a>
        </x-slot:nav-menu>
    </x-navbar>


    <x-sidebar id="side-bar" menuClass="h-[500px]" :state="false"
    :clickOutside="true"
    >
            
        <x-accordion id="acc-1" iconType="arrow" :state="true" 
        class="hover:bg-green-100 w-full"
        >
            <x-slot:head>
                <div class="font-semibold hover:font-bold">dashboard</div>
            </x-slot:head>

            <ul class="m-2 ml-3 px-5 border-l border-gray-500">
                <li class="cursor-pointer hover:font-semibold">HTML</li>
                <li class="cursor-pointer hover:font-semibold">CSS</li>
                <li class="cursor-pointer hover:font-semibold">JAVASCRIPT</li>
                <li class="cursor-pointer hover:font-semibold">PHP</li>
            </ul>
            
        </x-accordion>



        <x-accordion id="acc-2" iconType="arrow" :state="true"
        class="hover:bg-green-100 w-full"
        >
            <x-slot:head>
                <div class="font-semibold hover:font-bold">Beginner</div>
            </x-slot:head>

            <ul class="m-2 ml-3 px-5 border-l border-gray-500">
                <li class="cursor-pointer hover:font-semibold">HTML</li>
                <li class="cursor-pointer hover:font-semibold">CSS</li>
                <li class="cursor-pointer hover:font-semibold">JAVASCRIPT</li>
            </ul>
            
        </x-accordion>


        <x-accordion id="acc-3" iconType="arrow" :state="true"
        class="hover:bg-green-100 w-full"
        >
            <x-slot:head>
                <div class="font-semibold hover:font-bold">Front end</div>
            </x-slot:head>

            <ul class="m-2 ml-3 px-5 border-l border-gray-500">
                <li class="cursor-pointer hover:font-semibold">React</li>
                <li class="cursor-pointer hover:font-semibold">Vue</li>
                <li class="cursor-pointer hover:font-semibold">Svelte</li>
                <li class="cursor-pointer hover:font-semibold">Angular</li>
            </ul>
            
        </x-accordion>

        <x-accordion id="acc-4" iconType="arrow" :state="true"
        class="hover:bg-green-100 w-full"
        >
            <x-slot:head>
                <div class="font-semibold hover:font-bold">Back end</div>
            </x-slot:head>

            <ul class="m-2 ml-3 px-5 border-l border-gray-500">
                <li class="cursor-pointer hover:font-semibold">php</li>
                <li class="cursor-pointer hover:font-semibold">python</li>
                <li class="cursor-pointer hover:font-semibold">nodejs</li>
                <li class="cursor-pointer hover:font-semibold">Go</li>
            </ul>
        </x-accordion>
        <div class="px-5 cursor-pointer hover:font-semibold">parameters</div>
    </x-sidebar>
</div>
    

    <main class="flex">
        

    <section class="w-full" x-data>

        <div class="w-[95%] m-5 flex justify-end md:hidden" >
            <x-button btn="icon" x-on:click.stop="$dispatch('toggle-sidebar', {id: 'side-bar'})">sidebar</x-button>
        </div>
        
        <form class="w-full p-5 space-y-4" action="">
            <div class="w-[50%]">
                <x-input  placeholder="Name" />
                <x-error :message="'incorrect name'" />
            </div>
            <div class="w-[50%]">
                <x-textarea rows="4" cols="30"></x-textarea>
                <x-error :message="'incorrect name'" />
            </div>

            <x-dropdown id="drop-1" position="bottom" :state="false"
            x-transition:enter="animate__animated animate__fadeIn [animation-duration:300ms]"
            x-transition:leave="animate__animated animate__fadeOut [animation-duration:300ms]"
            >
                <x-slot:btn>
                    <x-button color="blue" text="text-white" x-on:click="toggle('drop-1')">choose</x-button>
                </x-slot:btn>
                <ul class="p-5 bg-gray-100 text-gray-700">
                    <li>option 1</li>
                    <li>option 2</li>
                    <li>option 3</li>
                </ul>
            </x-dropdown>

            <x-button x-on:click="$dispatch('toggle-model', {id: 'model-1'})" color="blue" text="text-white">model</x-button>

            <template x-teleport="body">
                
                    <x-model id="model-1" :state="false" >
                        <div class="p-5">
                            <h1 class="text-2xl text-gray-700">test model</h1>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam voluptatum inventore culpa corporis illo quisquam ipsa illum necessitatibus laborum ipsum?</p>
                        </div>
                    </x-model>
                
            </template>

            <x-button x-on:click="$dispatch('show-notif', {id: 'noti-1'})" color="blue" text="text-white">notify</x-button>
            <x-notification id="noti-1" notification="info" :state="false">
                <p>this is a notification</p>
            </x-notification>

            <x-spinner color="red" size="24" />

            <x-table :headers="['name', 'email', 'age']"
            tableClass="block w-[300px] h-[100px]"
            theadClass="bg-blue-700 text-gray-100 text-start" 
            :scrollable="true"
            :sticky="true"
            >
                <template x-for="1 in 30">
                    <tr class="my-2">
                        <td class="py-2">hakim</td>
                        <td>hakim@mail.com</td>
                        <td class="text-center">30</td>
                    </tr>
                </template>
            </x-table>

        
        </form>


    </section>
    
    </main>
    

    <x-stm::stm-scripts />
</body>
</html>