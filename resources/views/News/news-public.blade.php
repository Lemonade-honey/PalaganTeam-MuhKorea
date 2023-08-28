@extends('layout.app', ['page' => 'news'])

@section('style')
<style>
    .flex-container{
        display: flex;
        justify-content: space-between;
    }


    @media(max-width: 500px){
        .flex-container{
            display: flex;
            flex-wrap: wrap-reverse;
        }
    }
</style>
@endsection

@section('body')
<div class="lg:mx-20 p-2 mt-8">
    <main class="w-full">
        
        <div class="grid sm:grid-cols-4 gap-4">

            <div class="w-full sm:col-span-3 col-start-1">
                <div class="judul w-full border border-green-400 bg-green-400 p-1 mb-4">
                    <h1 class="font-medium text-xl capitalize">berita</h1>
                </div>

                <div class="form mb-4">    
                    <form method="GET" action="{{ route('newsPublicSearch') }}">
                        <div class="relative w-full">
                            <input type="search" name="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="search..." required>
                            <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </button>
                        </div>
                    </form>

                </div>

                <div class="flex w-full flex-wrap gap-4">
                    @forelse ($news as $item)
                    <a href="{{ route('newsPublic', ['slug' => $item->slug]) }}" class="max-w-[31rem] w-full border border-gray-300 rounded-sm p-2 flex">
                        <div class="pr-3">
                            <img src="{{ asset('image/news/thumbnail/' . $item->img) }}" alt="content" class="max-w-[10rem]">
                        </div>
                        <div class="detail">
                            <h2 class="font-medium text-base md:text-xl capitalize">{{ $item->title }}</h2>
                            <p class="text-sm font-light">{{ date("F d, Y", strtotime($item->created_at)) }}</p>
                        </div>
                    </a>
                    @empty
                    <div class="w-full border border-r-gray-200 p-4 text-center capitalize">
                        no news data
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="w-full col-span-1 border border-gray-300">
                <h1 class="text-xl font-medium capitalize border border-green-400 rounded-sm bg-green-400 text-center">Berita Terbaru</h1>
                <div class="content p-2">
                    @forelse ($newsPanel as $key => $value)
                    <a href="{{ route('newsPublic', ['slug' => $value->slug]) }}" class="container w-full mb-2 hover:text-blue-500">
                        <p class="text-xs font-light">{{ date('d M Y', strtotime($value->created_at)) }}</p>
                        <h2 class="text-base capitalize">{{ $value->title }}</h2>
                        @if (count($newsPanel) == $key + 1)
                        <hr>
                        @endif
                    </a>
                    @empty
                    <p>no news data</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>
@endsection