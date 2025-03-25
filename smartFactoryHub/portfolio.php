<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiz="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="dist/output.css" rel="stylesheet" />
    <title>SmartFactory Hub</title>
</head>

<body class="bg-green-50">
    <!-- Navbar -->
    <nav class="bg-orange-400 p-2 flex text-white justify-between items-center">
        <div class="flex justify-center">
            <div class="space-x-2">
                <span class="text-xl pl-4 py-2 font-bold">SmartFactory<a href="#home" class="text-green-900"> Hub</a></span>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="hover:underline hover:scale-110 transition-transform duration-200">Fitur</a>
                <a href="#" class="hover:underline hover:scale-110 transition-transform duration-200">Belajar</a>
                <a href="#" class="hover:underline hover:scale-110 transition-transform duration-200">Bantuan</a>
            </div>
        </div>

        <div class="flex justify-end">
            <div class="mr-2">
                <button>
                    <svg id="sun-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                    </svg>
                    <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>
                </button>
            </div>

            <button class="hidden md:block bg-white text-orange-600 px-4 py-2 mr-2 rounded-lg hover:bg-gray-100 hover:shadow-black/50 hover:shadow-lg"><a href="#">Daftar</a></button>
            <button class="hidden md:block bg-white text-orange-600 px-4 py-2 mr-7 rounded-lg hover:bg-gray-100 hover:shadow-black/50 hover:shadow-lg"><a href="#">Masuk</a></button>
            <button class="md:hidden text-white pr-4 text-2xl" onclick="toggleMenu()">☰</button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden flex-col bg-orange-400 mx-5 text-white p-4 space-y-2">
        <a href="#" class="hover:underline">About Us</a>
        <a href="#" class="hover:underline">Project</a>
        <button class="bg-white text-orange-600 px-4 py-2 rounded-lg hover:bg-gray-100">Contact Us</button>
    </div>

    <!-- Hero Section Start -->
    <section id="home" class="pt-28"> 
        <div class="container">
            <div class="flex flex-wrap">
                <div class="w-full self-center px-4 lg:w-1/2">
                    <h1 class=" text-base font-bold text-primary md:text-xl">HI👋, We Are <span class="block text-left font-bold text-dark text-4xl lg:text-5xl mt-2">Bumi Raya</h1>
                    <h2 class="font-medium text-green-900 mt-3 mb-10">A Group of Information System Student at UPN Veteran Jawa Timur</h2>
                    <p class="text-dark w-auto font-medium">Belajar Web Programming itu mudah dan menyenangkan sekali!</p>
                </div>
                <div class="w-full self-end px-4 lg:w-1/2">
                    <div class="relative mt-10 lg:mt-9 lg:right-0">
                        <img src="picture/gambar2.png" alt="Bumi Raya"
                         class="max-w-full mx-auto">
                         <span class="absolute -bottom-0 -z-10 left-1/2 -translate-x-1">
                            <svg width="300" height="300" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#14532d" d="M33.4,-30.5C49.2,-26.5,72.1,-21.6,78.8,-10C85.5,1.7,76,20.1,62.7,29.8C49.4,39.5,32.3,40.5,16.1,48.1C-0.1,55.7,-15.3,69.7,-30.2,70C-45.2,70.2,-59.9,56.6,-69.3,40.1C-78.8,23.6,-83,4.1,-76.6,-10.3C-70.2,-24.7,-53.2,-33.9,-38.7,-38.2C-24.2,-42.5,-12.1,-41.7,-1.7,-39.7C8.8,-37.7,17.5,-34.5,33.4,-30.5Z" transform="translate(100 100) scale(1.1)" />
                              </svg>
                         </span>
                         <span class="absolute -bottom-0 -z-10 left-1/3 -translate-x-1/2">
                            <svg width="300" height="300" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#2563eb" d="M31,-33.6C40.4,-29.1,48.3,-19.5,55.8,-5.6C63.3,8.3,70.4,26.5,66,42C61.7,57.5,45.9,70.2,27.4,78.3C8.8,86.4,-12.5,89.8,-29.1,82.6C-45.7,75.5,-57.6,57.8,-62.6,40.4C-67.6,22.9,-65.9,5.8,-58.2,-5.5C-50.5,-16.8,-36.8,-22.2,-26.1,-26.5C-15.5,-30.8,-7.7,-34,1.5,-35.9C10.8,-37.7,21.6,-38.2,31,-33.6Z" transform="translate(100 100)" />
                              </svg>
                         </span>
                         <span class="absolute -bottom-0 sm:-top-10 -z-10 left-1/4 -translate-x-1">
                            <svg width="300" height="300" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#FF0066" d="M23.4,-30.8C35.3,-17.9,53.4,-15.2,58.1,-7.5C62.8,0.3,54,13.2,45.3,24.1C36.5,35,27.8,43.8,17.6,47C7.3,50.3,-4.6,47.9,-22.1,47.3C-39.6,46.8,-62.7,48.2,-68.3,39.1C-73.9,30.1,-62,10.6,-56.5,-8.2C-51.1,-27,-52.1,-45.2,-43.8,-58.8C-35.4,-72.4,-17.7,-81.4,-6,-74.3C5.7,-67.1,11.5,-43.8,23.4,-30.8Z" transform="translate(100 100)" />
                              </svg>
                         </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About section start -->
    <section id="about" class="pt-36 pb-32">
        <div class="container">
            <div class="flex flex-wrap">
                <div class="w-full px-4 mb-10 lg:w-1/2">
                    <h4 class="font-bold uppercase text-primary text-lg mb-3">About Us</h4>
                    <h2 class="font-bold text-dark text-3xl mb-5 max-w-md lg:text-3xl">Yuk, gunakan SmartFactory hub</h2>
                    <p class="font-medium text-base text-slate-500 max-w-xl lg:text-lg">
                        Yuk, gunakan SmartFactory Hub untuk solusi industri cerdas Anda! 
                        Temukan berbagai fitur dan layanan yang akan membantu meningkatkan 
                        efisiensi dan produktivitas bisnis Anda.
                        </p>
                </div>
                <div class="w-full px-4 lg:w-1/2">
                    <h3 class="font-bold text-dark text-3xl mb-5 lg:text-3xl lg:pt-10">Lets be Friend!</h3>
                    <p class="font-medium text-base text-slate-500 mb-5 lg:text-lg">Bergabunglah dengan komunitas 
                        SmartFactory Hub dan jalin hubungan dengan para profesional industri. 
                        Bersama-sama, kita bisa berbagi ide dan inovasi untuk menciptakan masa 
                        depan industri yang lebih baik.</p>
                    <div class="flex items-center mb-5">
                        <!-- youtube -->
                         <a 
                            href="https://youtube.com/@kkhonsaa?si=oOmRytg3v6RI-XAP" 
                            target="_blank" class="w-9 h-9 mr-3 rounded-full flex justify-center 
                            items-center border border-slate-300 hover:border-orange-400 hover:bg-orange-400 hover:text-white">
                            <svg role="img" width="20" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>YouTube</title><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            <path></path>
                         </a>

                         <!-- github -->
                         <a 
                            href="https://github.com/mila155/Final-Project-P.WEB" 
                            target="_blank" class="w-9 h-9 mr-3 rounded-full flex justify-center 
                            items-center border border-slate-300 hover:border-orange-400 hover:bg-orange-400 hover:text-white">
                            <svg role="img" width="20" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>GitHub</title><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                            <path></path>
                         </a>

                         <!-- instagram -->
                         <a 
                            href="https://www.instagram.com/kkhonsaa/" 
                            target="_blank" class="w-9 h-9 mr-3 rounded-full flex justify-center 
                            items-center border border-slate-300 hover:border-orange-400 hover:bg-orange-400 hover:text-white">
                            <svg role="img" width="20" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M7.0301.084c-1.2768.0602-2.1487.264-2.911.5634-.7888.3075-1.4575.72-2.1228 1.3877-.6652.6677-1.075 1.3368-1.3802 2.127-.2954.7638-.4956 1.6365-.552 2.914-.0564 1.2775-.0689 1.6882-.0626 4.947.0062 3.2586.0206 3.6671.0825 4.9473.061 1.2765.264 2.1482.5635 2.9107.308.7889.72 1.4573 1.388 2.1228.6679.6655 1.3365 1.0743 2.1285 1.38.7632.295 1.6361.4961 2.9134.552 1.2773.056 1.6884.069 4.9462.0627 3.2578-.0062 3.668-.0207 4.9478-.0814 1.28-.0607 2.147-.2652 2.9098-.5633.7889-.3086 1.4578-.72 2.1228-1.3881.665-.6682 1.0745-1.3378 1.3795-2.1284.2957-.7632.4966-1.636.552-2.9124.056-1.2809.0692-1.6898.063-4.948-.0063-3.2583-.021-3.6668-.0817-4.9465-.0607-1.2797-.264-2.1487-.5633-2.9117-.3084-.7889-.72-1.4568-1.3876-2.1228C21.2982 1.33 20.628.9208 19.8378.6165 19.074.321 18.2017.1197 16.9244.0645 15.6471.0093 15.236-.005 11.977.0014 8.718.0076 8.31.0215 7.0301.0839m.1402 21.6932c-1.17-.0509-1.8053-.2453-2.2287-.408-.5606-.216-.96-.4771-1.3819-.895-.422-.4178-.6811-.8186-.9-1.378-.1644-.4234-.3624-1.058-.4171-2.228-.0595-1.2645-.072-1.6442-.079-4.848-.007-3.2037.0053-3.583.0607-4.848.05-1.169.2456-1.805.408-2.2282.216-.5613.4762-.96.895-1.3816.4188-.4217.8184-.6814 1.3783-.9003.423-.1651 1.0575-.3614 2.227-.4171 1.2655-.06 1.6447-.072 4.848-.079 3.2033-.007 3.5835.005 4.8495.0608 1.169.0508 1.8053.2445 2.228.408.5608.216.96.4754 1.3816.895.4217.4194.6816.8176.9005 1.3787.1653.4217.3617 1.056.4169 2.2263.0602 1.2655.0739 1.645.0796 4.848.0058 3.203-.0055 3.5834-.061 4.848-.051 1.17-.245 1.8055-.408 2.2294-.216.5604-.4763.96-.8954 1.3814-.419.4215-.8181.6811-1.3783.9-.4224.1649-1.0577.3617-2.2262.4174-1.2656.0595-1.6448.072-4.8493.079-3.2045.007-3.5825-.006-4.848-.0608M16.953 5.5864A1.44 1.44 0 1 0 18.39 4.144a1.44 1.44 0 0 0-1.437 1.4424M5.8385 12.012c.0067 3.4032 2.7706 6.1557 6.173 6.1493 3.4026-.0065 6.157-2.7701 6.1506-6.1733-.0065-3.4032-2.771-6.1565-6.174-6.1498-3.403.0067-6.156 2.771-6.1496 6.1738M8 12.0077a4 4 0 1 1 4.008 3.9921A3.9996 3.9996 0 0 1 8 12.0077"/></svg>
                            <path></path>
                         </a>

                    </div>
                </div>
            </div>
        </div>
     </section>
    <!-- About section end -->

    <!-- Project Start -->
    <section id="project" class="pt-36 pb-32">
        <div class="container">
            <div class="w-full px-4">
                <div class="max-w-xl mx-auto text-center mb-16">
                    <h4 class="font-semibold text-lg text-primary mb-2">Project</h4>
                    <h2 class="font-bold text-dark text-3xl mb-4 sm:text-4xl
                    lg:text-5xl">Our Project</h2>
                </div> 
                <div class="flex flex-wrap">
                    <div class="w-full px-4 mb-8 lg:w-1/3">
                        <div class="p-6 rounded-lg shadow-lg">
                            <h3 class="font-bold text-xl mb-2">SmartFactory Hub</h3>
                            <p class="text-gray-600 mb-4">A comprehensive platform designed to enhance industrial efficiency through smart technology integration.</p>
                            <a href="smartFactory.html" class="text-primary font-semibold hover:underline">Learn More</a>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Project End -->

    <!-- Team Start -->
     <section id="team" class="pt-36 pb-32">
        <div class="comtainer">
            <div class="w-full px-4">
                <div class="max-w-xl mx-auto text-center mb-16">
                    <h4 class="font-semibold text-lg text-primary mb-2">Team</h4>
                    <h2 class="font-bold text-dark text-3xl mb-4 sm:text-4xl
                    lg:text-5xl">Our Team</h2>
                </div> 
                <div class="flex flex-wrap">
                    <div class="w-full px-4 mb-8 lg:w-1/4">
                        <div class="p-6 rounded-lg shadow-lg">
                            <img src="dist/img/gambar2.png" alt="Team Member" class="w-32 h-32 object-cover rounded-t-lg mb-4">
                            <h3 class="font-bold text-lg">Khonsa' Abidah</h3>
                            <p class="text-gray-600">Project Manager</p>
                        </div>
                    </div>
                    <div class="w-32 px-4 mb-8 lg:w-1/4">
                        <div class="p-6 rounded-lg shadow-lg">
                            <img src="dist/img/gambar2.png" alt="Team Member" class="w-32 h-32 object-cover rounded-t-lg mb-4">
                            <h3 class="font-bold text-lg">Jamila Farhana</h3>
                            <p class="text-gray-600">Lead Developer</p>
                        </div>
                    </div>
                    <div class="w-full px-4 mb-8 lg:w-1/4">
                        <div class="p-6 rounded-lg shadow-lg">
                            <img src="dist/img/gambar2.png" alt="Team Member" class="w-32 h-32 object-cover rounded-t-lg mb-4">
                            <h3 class="font-bold text-lg">Indi Aryanti Sardi</h3>
                            <p class="text-gray-600">UI/UX Designer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </section>
    <!-- Team End -->

    <!-- Contact Form-->
    <section id="contact" class="pt-36 pb-32">
        <div class="container">
            <div class="w-full px-4">
                <div class="max-w-xl mx-auto text-center mb-16">
                    <h4 class="font-semibold text-lg text-primary mb-2">Contact</h4>
                    <h2 class="font-bold text-dark text-3xl mb-4 sm:text-4xl
                    lg:text-5xl">Contact Us</h2>
                </div> 
            </div>

            <form>
                <div class="w-full lg:w-2/3 lg:mx-auto">
                    <div class="w-full px-4 mb-8">
                        <label for="name" class="text-base text-primary font-bold">Name</label>
                        <input type="text" id="name" class="w-full bg-slate-300 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary"/>
                    </div>
                    <div class="w-full px-4 mb-8">
                        <label for="email" class="text-base text-primary font-bold">Email</label>
                        <input type="email" id="email" class="w-full bg-slate-300 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary"/>
                    </div>
                    <div class="w-full px-4 mb-8">
                        <label for="message" class="text-base text-primary font-bold">Message</label>
                        <textarea type="text" id="message" class="w-full bg-slate-300 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:ring-1 focus:border-primary h-32"></textarea>
                    </div>
                    <div>
                        <div class="w-full px-4">
                            <button class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full w-full hover:opacity-80 hover:shadow-lg transition duratio">Send</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Contact Form-->

    <script>
        function toggleMenu() {
            const menu = document.getElementById("mobileMenu");
            menu.classList.toggle("hidden");}
    </script>
</body>
</head>