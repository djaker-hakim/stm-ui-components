<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TAILWIND CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- ALPINEJS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- ALPINEJS PLUGIN CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <!-- <link rel="icon" type="image/x-icon" href="" /> -->
    <title>test</title>
</head>
<body>
    hello
    <x-stm::button color="blue" text="text-white">click</x-button>

    <x-button color="blue" text="text-white">click 2</x-button>

    <div class="flex justify-center" x-data>

        <x-stm::table 
        height="60vh"
        width="100%"
        :scrollable="true"
        :sticky="true"
        theadClass="bg-blue-600 text-white"
        :headers="['#', 'name', 'age', 'action']">
            <template x-for="1 in 20">
                <tr class="border-b hover:bg-blue-100">
                    <td class="px-4"><input type="checkbox"></td>
                    <td class="min-w-[200px] text-center py-3">hakim</td>
                    <td class="min-w-[200px] text-center py-3">30</td>
                    <td>edit</td>
                </tr>
            </template>   
        </x-stm::table>

    </div>
</body>
</html>

{{-- 
:headers="['#','name','lastname', 'firstname', 'date', 'age', 'status', 'action']">
            <template x-for="1 in 20">
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4"><input type="checkbox"></td>
                    <td class="min-w-[200px] text-center py-3">hakim</td>
                    <td class="min-w-[200px] text-center py-3">30</td>
                    <td class="min-w-[200px] text-center py-3">active</td>
                    <td class="min-w-[200px] text-center py-3">edit</td>
                    <td class="min-w-[200px] text-center py-3">edit</td>
                    <td class="min-w-[200px] text-center py-3">edit</td>
                    <td class="min-w-[200px] text-center py-3">edit</td>
                </tr>
            </template>    
--}}