<header>
    <nav class="bg-emerald-800 fixed w-full z-50 top-0 left-0">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
            <a href="/" class="flex items-center">
                <h2 class="text-xl font-bold tracking-widest text-white hover:text-yellow-200 ease-in duration-150 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Hidayah Kansai</h2>
            </a>
            <div class="flex items-center md:order-2">
    
                @if (auth()->check())
                <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <div class="relative inline-flex items-center justify-center w-9 h-9 overflow-hidden bg-gray-100 rounded-full">
                        <span class="font-medium text-gray-600 uppercase">{{ substr(Auth::user()->name, 0, 2) }}</span>
                    </div>
                </button>
                
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-90 capitalize">{{ (strlen(Auth::user()->name) > 25) ? substr(Auth::user()->name, 0, 25) . "..." : Auth::user()->name }}</span>
                        <span class="block text-sm  text-gray-500 truncate">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{ route('dashboard.home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100">Sign out</a>
                        </li>
                    </ul>
                </div>
                @else
                <a href="/login" class="px-3 py-2 text-sm font-medium text-center text-white bg-yellow-500 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300">Login</a>    
                @endif
                
                <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center ml-2 p-2 w-10 h-10 justify-center text-sm text-gray-500 bg-yellow-400 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4  rounded-lg bg-emerald-500 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-emerald-800">
                    <li>
                        <a href="/" class="block py-2 pl-3 pr-4 {{ $page == 'home' ? 'text-white bg-emerald-600 rounded md:bg-transparent md:text-yellow-300' : 'text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500' }} md:p-0">Home</a>
                    </li>
                    <li>
                        <a href="/news" class="block py-2 pl-3 pr-4 {{ $page == 'news' ? 'text-white bg-emerald-600 rounded md:bg-transparent md:text-yellow-300' : 'text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500' }} md:p-0">News</a>
                    </li>
                    <li>
                        <a href="https://muhammadiyah.or.id/" class="block py-2 pl-3 pr-4 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0">About Muhammadiyah</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>