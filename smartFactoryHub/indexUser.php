<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiz="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="dist/output.css" rel="stylesheet" />
    <title>SmartFactory Hub</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="bg-orange-400 p-2 flex text-white justify-between items-center">
        
            <div class="space-x-2">
                <span class="text-xl pl-4 py-2 font-bold">SmartFactory<a href="#home" class="text-green-900"> Hub</a></span>
            </div>
            <div class="hidden md:flex justify-items-center space-x-6">
                <a href="#" class="hover:underline hover:scale-110 transition-transform duration-200">Fitur</a>
                <a href="#" class="hover:underline hover:scale-110 transition-transform duration-200">Belajar</a>
                <a href="#" class="hover:underline hover:scale-110 transition-transform duration-200">Bantuan</a>
            </div>
                
        <div class="flex justify-items-end">  
            <div class="mr-2">
                <button class="flex items-center">
                    <svg id="sun-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                    </svg>
                    <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>
                </button>
            </div>
            
            <button class="md:hidden text-white pr-4 text-2xl" onclick="toggleMenu()">☰</button>
        </div>
    </nav>

    <!-- Content Start-->
    <section id="content" class="bg-slate-400 pt-72 pb-72">
        <div class="absolute container">
            <div class="relative text-center text-white px-6">
                <h2 class="text-xl font-semibold tracking-wide">WELCOME TO</h2>
                <h1 class="text-6xl font-bold text-yellow-400 drop-shadow-[4px_4px_0_rgba(0,0,0,1)]">
                SmartFactory Hub
                </h1>
                <p class="mt-4 text-lg">The all-in-one solution for UMKM business management.</p>
                <button class="mt-6 px-6 py-3 bg-yellow-400 text-black font-bold text-lg rounded shadow-[4px_4px_0_rgba(0,0,0,1)] hover:shadow-none transition-all">
                <a href="login.php">Get Started</a>
                </button>
            </div>
        </div>
    </section>
    <!-- Content End -->

    <!-- Footer Start-->
    <footer class="bg-dark pt-5 ">
        <div class="container">
        <h3 class="font-bold text-3xl text-white mb-5">SmartFactory<a href="#" class="text-orange-400"> Hub</a></h3>
            <div class="flex flex-wrap">
                <div class="w-full px-4 mb-5 text-slate-300 md:w-1/3">
                    <h4 class="font-bold text-xl mb-2">Kontak Kami</h4>
                    <a href="portfolio.php" class="inline-block text-base hover:text-primary ml-5">Tentang Kami</a>
                    <p class="ml-5">bumirayapemwebD@gmail.com</p>
                    <p class="ml-5">Jl. Rungkut Madya, Gn. Anyar, Kec. Gn. Anyar, Surabaya, Jawa Timur 60294</p>
                    <p class="ml-5">Surabaya</p>
                </div>
                <div class="w-full mb-5 md:w-1/3">
                    <h4 class="font-semibold text-xl text-white mb-5">Fitur</h4>
                    <ul class="text-slate-300">
                        <li>
                            <a href="inventori.php" class="inline-block text-base hover:text-primary mb-3">Manajemen Stok</a>
                        </li>
                        <li>
                            <a href="#" class="inline-block text-base hover:text-primary mb-3">Manajemen Produksi</a>
                        </li>
                        <li>
                            <a href="#" class="inline-block text-base hover:text-primary mb-3">Laporan Keuangan</a>
                        </li>
                    </ul>
                </div>
                <div class="w-full mb-5 md:w-1/3">
                    <h3 class="font-semibold text-xl text-white mb-5">Belajar</h3>
                    <ul class="text-slate-300">
                        <li>
                            <a href="#" class="inline-block text-base hover:text-primary mb-3">Home</a>
                        </li>
                        <li>
                            <a href="#" class="inline-block text-base hover:text-primary mb-3">About Us</a>
                        </li>
                        <li>
                            <a href="#" class="inline-block text-base hover:text-primary mb-3">Our Project</a>
                        </li>
                        <li>
                            <a href="#" class="inline-block text-base hover:text-primary mb-3">Our Team</a>
                        </li>
                        <li>
                            <a href="#" class="inline-block text-base hover:text-primary mb-3">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
</body>
</html>