<nav class="top-0 left-0 right-0 bg-navlight dark:bg-navdark z-50 border-gray-200 px-4 lg:px-6 py-2.5 ">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl font-medium font-ubuntu">
        <a href="/" class="flex items-center">
            <img src="./img/logoajanew.png" class="mr-3 h-6 sm:h-9" alt="Cemal Cemil" />
            {{-- <span class="self-center text-xl whitespace-nowrap dark:text-white">Cemal Cemil</span> --}}
        </a>
        <div class="flex items-center lg:order-2 relative" x-data="{ open: false }">
            @guest
                <a href="/login" class="text-gray-700 font-semibold px-2 md:hover:text-primary-700 lg:px-5 py-2 lg:py-2.5 mr-2 dark:text-white dark:hover:bg-gray-900">Log in</a>
            @endguest

            @auth
                <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 font-semibold px-4 py-2 rounded dark:text-white dark:hover:bg-gray-900">
                    <span>Admin {{ Auth::user()->user_name }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-20 w-40 bg-white rounded-md shadow-lg z-50">
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>    
            @endauth

            <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-200" aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <div class="hidden justify-between items-center w-full font-lato font-semibold lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 lg:flex-row lg:space-x-6 lg:mt-0">
                <li>
                    <a href="/admin" class="block py-2 pr-4 pl-3 text-white rounded lg:bg-transparent lg:p-0 dark:text-white" aria-current="page">Dashboard</a>
                </li>
                <li>
                    <a href="" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:opacity-50 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:opacity-100 lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Produk</a>
                </li>
                <li>
                    <a href="" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:opacity-50 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:opacity-100 lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Stok Produk</a>
                </li>
                <li>
                    <a href="" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:opacity-50 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:opacity-100 lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Penjualan</a>
                </li>
                <li>
                    <a href="" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:opacity-50 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:opacity-100 lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Keuangan</a>
                </li>
                <li>
                    <a href="" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:opacity-50 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:opacity-100 lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Daftar Pelanggan</a>
                </li>
                <li>
                    <a href="" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:opacity-50 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:opacity-100 lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Kelola Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>