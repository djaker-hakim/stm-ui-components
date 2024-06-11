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
</head>
<body>

    {{-- nav bar --}}
    <nav x-data class="flex justify-between items-center px-5 sm:px-10 md:px-20 h-[50px] md:h-[70px] bg-gray-100 text-gray-700">
        <div>
            logo
        </div>

        <div>
            <ul class="hidden md:flex gap-4">
                <li>home</li> 
                <x-stm::dropdown id="drop" position="bottom-end" :state="false">
                    <x-slot:btn>
                        <li x-on:click="drop = !drop">services</li>
                    </x-slot:btn>
                    <li>service1</li>
                    <li>service2</li>
                    <li>service3</li>
                </x-dropdown>
                <li>about us</li>
                <li>contact us</li>
            </ul>
            <x-stm::button btn="icon" size="sm">icon</x-button>
            
        </div>
    </nav>
    <x-stm::collapse id="coll" class="bg-gray-100 text-gray-700 px-5 sm:px-10 md:px-20" >
            <x-slot:btn>
            </x-slot:btn>   

        <ul class="space-y-2">
            <li>home</li>
            <x-stm::collapse id="collap" >
                <x-slot:btn>
                    <li x-on:click="collapse = !collapse">services</li>
                </x-slot:btn>
                <li>service1</li>
                <li>service2</li>
                <li>service3</li>
            </x-collapse>
            <li>about us</li>
            <li>contact us</li>
        </ul>
                
    </x-collapse>
    

    @stack('scripts')
</body>
</html>
