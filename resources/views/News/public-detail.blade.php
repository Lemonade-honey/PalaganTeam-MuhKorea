@extends('layout.app', ['title' => ucwords($news->title), 'page' => 'news'])

@section('body')

<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
    <div class="flex justify-center px-4 mx-auto max-w-screen-xl mt-10 md-40 ">
        <article
            class="mx-auto w-full text-justify md:w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
            <header class="mb-4 lg:mb-6 not-format">
                <address class="flex items-center mb-6 not-italic">
                    <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                        <img class="mr-4 w-16 h-16 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese Leos">
                        <div>
                            <p rel="author" class="text-xl font-bold text-gray-900 dark:text-white  capitalize">{{ $news->created_by }}</p>
                            <p class="text-base font-light text-gray-500 dark:text-gray-400"><time pubdate title="February 8th, 2022">{{ date('H:i F, d, Y') }}</time></p>
                        </div>
                    </div>
                </address>
                <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ ucwords($news->title) }}</h1>
            </header>
            {{-- details --}}
            <div class="details">
                <?= $news->details?>
            </div>
            {{-- Comment --}}
        </article>
    </div>
</main>
@endsection