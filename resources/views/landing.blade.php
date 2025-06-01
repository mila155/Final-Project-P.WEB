<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alata&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Geist:wght@100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&family=Sofia+Sans+Semi+Condensed:ital,wght@0,1..1000;1,1..1000&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
    </style>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Landing Page</title>
</head>
<body>
    <x-navbar></x-navbar>
    
{{-- isi --}}
    <section class="px-4 py-12 mx-auto max-w-7xl bg-neutral-50 dark:bg-isidark">
    <div class="grid items-center grid-cols-1 mb-24 md:grid-cols-2 gap-y-10 md:gap-y-32 gap-x-10 md:gap-x-24">
        <div>
        <h2 class="mb-4 text-2xl font-black tracking-tight text-center text-black md:leading-tight sm:text-left md:text-4xl font-ubuntu">Who Are We?</h2>
        <p class="mb-5 text-base text-center text-gray-600 sm:text-left md:text-lg font-lato">
            Cemal Cemil berdiri pada Maret 2025 dan berfokus memproduksi keripik pisang, granola, hingga susu pisang dengan aneka rasa. Semua produk kami dibuat dari bahan-bahan pilihan dengan kualitas terbaik demi memastikan rasa lezat, sehat, dan aman untuk dikonsumsi.
        </p>
        {{-- <a href="#" class="w-full btn btn-dark btn-lg sm:w-auto">Learn More</a> --}}
        </div>
        <div class="w-full h-full py-6">
            <img src="img/whynobg.png" alt="Kenapa Cemal Cemil" class="rounded w-full order-1 md:order-2"/>
        </div>
    </div>
    <div class="grid flex-col-reverse items-center grid-cols-1 md:grid-cols-2 gap-y-10 md:gap-y-32 gap-x-10 md:gap-x-24">
        <div class="order-none md:order-2">
        <h2 class="mb-4 text-2xl font-ubuntu font-black tracking-tight text-center text-black md:leading-tight sm:text-left md:text-4xl">Why Cemal Cemil?</h2>
        <p class="mb-5 text-base text-center text-gray-600 sm:text-left md:text-lg font-lato">
            Cemal Cemil menggunakan bahan baku lokal yang berkualitas tinggi dan diproses secara higienis untuk menghasilkan keripik pisang dengan berbagai rasa yang unik dan menggugah selera. Cocok untuk segala usia, baik untuk camilan santai maupun oleh-oleh khas Indonesia.
        </p>
        {{-- <a href="#" class="w-full btn btn-dark btn-lg sm:w-auto">Learn More</a> --}}
        </div>
        <div class="w-full h-full py-6">
            <img src="img/whonobg.png" alt="Tentang Kami" class="rounded w-full order-1 md:order-2"/>
        </div>
    </div>
    </section>

    <x-footer></x-footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/kutty@latest/dist/kutty.min.js"></script>
</body>
</html>

{{-- <x-layout>

    <x-slot></x-slot>
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-10">
        <!-- Why Cemal Cemil Section -->
        <section class="grid md:grid-cols-2 gap-10 items-center mb-16">
        <img src="img/why.png" alt="Kenapa Cemal Cemil" class="rounded shadow w-full"/>
        <div>
            <h4 class="font-bold text-green-600 text-xl mb-2">Why Cemal Cemil?</h4>
            <p class="text-gray-700">Cemal Cemil menggunakan bahan baku lokal yang berkualitas tinggi dan diproses secara higienis untuk menghasilkan keripik pisang dengan berbagai rasa yang unik dan menggugah selera. Cocok untuk segala usia, baik untuk camilan santai maupun oleh-oleh khas Indonesia.</p>
        </div>
        </section>

        <!-- Who Are We Section -->
        <section class="grid md:grid-cols-2 gap-10 items-center">
        <div class="order-2 md:order-1">
            <h4 class="font-bold text-green-600 text-xl mb-2">Who Are We</h4>
            <p class="font-semibold mb-1">Bumi Raya</p>
            <p class="text-gray-700">Kami berdiri pada Maret 2025 dan berfokus memproduksi keripik pisang, granola, hingga susu pisang dengan aneka rasa. Semua produk kami dibuat dari bahan-bahan pilihan dengan kualitas terbaik demi memastikan rasa lezat, sehat, dan aman untuk dikonsumsi.</p>
        </div>
        <img src="img/who.png" alt="Tentang Kami" class="rounded shadow w-full order-1 md:order-2"/>
        </section>
    </div>

</x-layout> --}}