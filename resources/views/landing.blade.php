<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="px-4 py-12 mx-auto max-w-7xl bg-neutral-50 dark:bg-isidark">
        <div class="grid items-center grid-cols-1 mb-24 md:grid-cols-2 gap-y-10 md:gap-y-32 gap-x-10 md:gap-x-24">
            <div>
                <h2 class="mb-4 text-2xl font-black tracking-tight text-center text-black md:leading-tight sm:text-left md:text-4xl font-ubuntu">
                    Who Are We?
                </h2>
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
                <h2 class="mb-4 text-2xl font-ubuntu font-black tracking-tight text-center text-black md:leading-tight sm:text-left md:text-4xl">
                    Why Cemal Cemil?
                </h2>
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

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/kutty@latest/dist/kutty.min.js"></script>
</x-layout>