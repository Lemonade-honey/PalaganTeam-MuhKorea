<section class="my-10" id="news">
    <h1 class="text-2xl sm:text-4xl text-center font-bold text-emerald-600 mb-3">Our Recent News</h1>
    <div class="berita flex flex-wrap justify-around gap-4">
        
        @forelse ($news as $item)
        <div class="border border-gray-200 hover:border-gray-400 ease-in duration-150 p-2 rounded-md max-w-xs">
            <a href="{{ route('newsPublic', ['slug' => $item->slug]) }}">
                <div class="img-thumbnail mb-3">
                    <img src="{{ asset('/image/news/thumbnail/' . $item->img) }}" alt="">
                </div>
                <p class="text-xs font-light">{{ date("M d, Y", strtotime($item->created_at)) }}</p>
                <h2 class="font-medium text-xl capitalize text-emerald-600">{{ $item->title }}</h2>
            </a>
        </div>
        @empty
        <div class="w-full border border-gray-200 rounded-md">
            <div class="h-20 flex justify-center items-center">No News</div>
        </div>
        @endforelse

    </div>
</section>