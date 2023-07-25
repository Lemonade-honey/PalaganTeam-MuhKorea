{{-- Navbar Start --}}
<div class="w-full text-gray-700 fixed bg-white shadow-sm z-40">
    <div x-data="{ open: false }"
        class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
        <div class="flex flex-row items-center justify-between p-4">
            <a href="#"
                class="text-lg font-bold tracking-widest text-blue-700 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">HIDAYAH</a>
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <nav :class="{ 'flex': open, 'hidden': !open }"
            class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
            <a class="px-4 py-2 mt-2 text-sm font-semibold text-blue-700 bg-gray-200 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-blue-700 focus:text-blue-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="#">Home</a>
            <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-blue-700 focus:text-blue-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="#">News</a>
            <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-blue-700 focus:text-blue-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="#">Activity</a>
            <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-blue-700 focus:text-blue-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="https://muhammadiyah.or.id/">About Muhammadiyah</a>
            <div class="relative">
                @if (auth()->check())
                    <button class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-blue bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-blue-700 focus:text-blue-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    login</button>
                @else
                    <a href="/login" class="flex flex-row mt-2 md:w-auto md:mt-0 md:ml-4 text-white font-semibold  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</a>
                @endif
            </div>
        </nav>
    </div>
</div>
{{--  --}}
