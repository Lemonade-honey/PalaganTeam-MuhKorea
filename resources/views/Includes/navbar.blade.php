<header>
    <nav class="bg-blue-800 fixed w-full z-50 top-0 left-0">
        <div class="flex flex-wrap items-center justify-between mx-auto p-2">
            <a href="/" class="flex items-center">
                <h2 class="text-xl font-bold tracking-widest text-white hover:text-yellow-200 ease-in duration-150 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Muhammadiyah KorSel</h2>
            </a>
            <div class="flex items-center md:order-2">
                <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 py-2.5 text-center" type="button">
                    <i class="fa-solid fa-language"></i>
                </button>

                <!-- Main modal -->
                <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Language Service
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="defaultModal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6 flex justify-center">
                                <div id="google_translate_element"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4  rounded-lg bg-blue-500 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-blue-800">
                    <li>
                        <a href="/" class="block py-2 pl-3 pr-4 {{ $page == 'home' ? 'text-white bg-blue-600 rounded md:bg-transparent md:text-yellow-300' : 'text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500' }} md:p-0">Home</a>
                    </li>
                    <li>
                        <a href="/news" class="block py-2 pl-3 pr-4 {{ $page == 'news' ? 'text-white bg-blue-600 rounded md:bg-transparent md:text-yellow-300' : 'text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500' }} md:p-0">News</a>
                    </li>
                    <li>
                        <a href="/gallery" class="block py-2 pl-3 pr-4 {{ $page == 'gallery' ? 'text-white bg-blue-600 rounded md:bg-transparent md:text-yellow-300' : 'text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500' }} md:p-0">Gallery</a>
                    </li>
                    {{-- <li>
                        <div id="google_translate_element"></div>
                    </li> --}}
                    <li>
                        <a href="https://muhammadiyah.or.id/" class="block py-2 pl-3 pr-4 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0">About Muhammadiyah</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

@push('scripts')
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'id'}, 'google_translate_element');
    }
</script>
@endpush