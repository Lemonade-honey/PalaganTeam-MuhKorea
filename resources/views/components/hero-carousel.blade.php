<main class="">
    @if ($slider != null)
    
    @if (count($slider) <= 1)
    @foreach ($slider as $item)
    <div class="relative w-full">
        <div class="relative h-56 xl:h-128 md:h-96 overflow-hidden rounded-b-lg">
            <img src="{{ asset('image/slider/' . $item->img) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
       </div>
    </div>
    @endforeach
    @else
    <div id="default-carousel" class="relative mt-2 w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 xl:h-128 md:h-96 overflow-hidden rounded-b-lg">
             <!-- Item 1 -->
            @foreach ($slider as $item)
            <div class="hidden duration-900 ease-in-out" data-carousel-item>
                <img src="{{ asset('image/slider/' . $item->img) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            @endforeach
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            @foreach ($slider as $key => $item)
                @if ($key == 0)
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                @else
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide {{ $key }}" data-carousel-slide-to="{{ $key }}"></button>
                @endif
            @endforeach
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
    @endif

    @else
    
    @endif

</main>