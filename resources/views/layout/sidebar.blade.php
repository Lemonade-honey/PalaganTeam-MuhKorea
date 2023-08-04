<div class="fixed top-0 bg-white inline-flex items-center shadow-md w-full py-1">
    <button data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
           <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>

    </button>
    <h2 class="text-lg ml-3">Dashboard</h2>
</div>
 
 <!-- drawer component -->
 <aside id="drawer-example" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-emerald-600 w-64" tabindex="-1" aria-labelledby="drawer-label">
    <div class="h-full flex flex-col justify-between">
        <div class="top">
            <a href="{{ route('home') }}" class="flex items-center pl-2.5 mb-5">
                <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Hidayah Kansai</span>
            </a>
            <ul class="font-medium">
                <li>
                    <a href="{{ route('dashboard.home') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-emerald-200 hover:text-black group">
                        <span class="flex-1 ml-3 whitespace-nowrap">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 rounded-lg text-white hover:bg-emerald-200 hover:text-black group">
                        <span class="flex-1 ml-3 whitespace-nowrap">Form</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="bottom">
            <ul class="font-medium">
                <li>
                    <a href="{{ route('logout') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-rose-700 group">
                        <span class="flex-1 ml-3 whitespace-nowrap">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
 </aside>