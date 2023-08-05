{{-- Navbar Start --}}
<div class="w-full text-gray-700 fixed bg-white shadow z-40">
    <div x-data="{ open: false }"
        class="flex flex-col px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
        <div class="flex flex-row items-center justify-between p-4">
            <a href="/"
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
            class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-center md:flex-row">
            <a class="px-4 py-2 mt-2 text-sm font-semibold {{ $page == 'home' ? 'text-blue-700 bg-gray-200' : 'bg-transparent' }} rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-blue-700 focus:text-blue-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="#">Home</a>
            <a class="px-4 py-2 mt-2 text-sm font-semibold {{ $page == 'news' ? 'text-blue-700 bg-gray-200' : 'bg-transparent' }} rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-blue-700 focus:text-blue-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="#">News</a>
            <a class="px-4 py-2 mt-2 text-sm font-semibold {{ $page == 'activity' ? 'text-blue-700 bg-gray-200' : 'bg-transparent' }} rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-blue-700 focus:text-blue-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="#">Activity</a>
            <a class="px-4 py-2 mt-2 text-sm font-semibold {{ $page == 'about' ? 'text-blue-700 bg-gray-200' : 'bg-transparent' }} rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-blue-700 focus:text-blue-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="https://muhammadiyah.or.id/">About Muhammadiyah</a>

        </nav>
        <div :class="{ 'flex': open, 'hidden': !open }" class="ml-3 md:block">
            @if (auth()->check())
                <div class="dropdown dropdown-right">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" />
                        </div>
                    </label>
                    <ul tabindex="0"
                        class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                        <li>
                            <a href="#">Profile</a>
                        </li>
                        <li><a href="/dashboard/logout">Logout</a></li>
                    </ul>
                </div>
            @else
                <div class="flex flex-row space-x-3 mb-4 md:mb-0 ">
                    <a href="/login"
                        class="flex flex-row mt-2 md:w-auto md:mt-0 md:ml-4 text-white font-semibold  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</a>

                    <a href="/register"
                        class="flex flex-row mt-2 md:w-auto md:mt-0 md:ml-4 text-white font-semibold  bg-slate-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 ">Register</a>
                </div>
            @endif
        </div>
    </div>
</div>
{{--  --}}
