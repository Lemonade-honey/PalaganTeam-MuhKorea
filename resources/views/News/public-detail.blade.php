@extends('layout.app', ['title' => ucwords($news->title), 'page' => 'news'])

@section('style')

<style>
    #ck-content ul, #ck-content ol{
        margin-left: 2rem;
    }
</style>

@endsection

@section('body')

<main class="pb-16 lg:pb-24 bg-white">
    <div class="flex justify-center px-4 mx-auto max-w-screen-lg mt-10 md-40 border-x border-gray-200">
        <article class="mx-auto w-full text-justify">
            <header class="mb-4 lg:mb-6 not-format max">
                <img src="{{ asset('/image/news/thumbnail/' . $news->img) }}" alt="" class="object-cover w-full max-w-screen-lg max-h-screen mb-5 lg:mb-10">
                <address class="flex items-center mb-6 not-italic">
                    <div class="inline-flex items-center mr-3 text-sm text-gray-900">
                        <div class="relative inline-flex items-center justify-center w-14 h-14 overflow-hidden bg-gray-100 rounded-full border border-gray-300">
                            <span class="font-medium text-gray-600 uppercase">an</span>
                        </div>
                        <div class="ml-2">
                            <p rel="author" class="text-xl font-bold text-gray-900">{{ $news->created_by }}</p>
                            <p class="text-base font-light text-gray-500"><time pubdate title="February 8th, 2022">{{ date('H:i F, d, Y') }}</time></p>
                        </div>
                    </div>
                </address>
                <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">{{ ucwords($news->title) }}</h1>
                <hr>
            </header>
            {{-- details --}}
            <div class="ck-content" id="ck-content">
                <?= $news->details?>
            </div>
        </article>
    </div>
</main>

{{-- Comment --}}
<div class="px-4">
    @include('Includes.Comment2', ['comment' => $news])
</div>

@endsection