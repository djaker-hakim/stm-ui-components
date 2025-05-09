@props([
    'tailwindcss' => false,
    'alpinejs' => true,
    'animatecss' => true,
])
@if ($tailwindcss)
    <!-- TAILWIND CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endif

@if ($animatecss)
    <!-- animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endif

@if ($alpinejs)
    <!-- ALPINEJS PLUGIN CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <!-- ALPINEJS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endif

<script>
    window.$stm = {
        list: [],
        register(component) {
            this.list.push(component)
        },
        unregister(id) {
            this.list = this.list.filter(item => item.id != id)
        },
        component(id) {
            return this.list.find(item => item.id == id)
        },
        allComponents() {
            return this.list
        },
        open(id){
            this.component(id).open();
        },
        close(id){
            this.component(id).close();
        },
        toggle(id){
            this.component(id).toggle();
        }
    };
</script>
