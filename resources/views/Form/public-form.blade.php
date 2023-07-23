<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('public/assets/css/app.css')
    <title>Form Masage Test</title>
</head>
<body>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
        <div class="flex justify-center px-4 mx-auto max-w-screen-xl mt-10 md-40 ">
            <article class="mx-auto w-full text-justify md:w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <section class="not-format">
                    {{-- Fix --}}
                    @if ($form->id_massage != null)
                        <div class="flex justify-between items-center mb-6 my-5">
                            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments ({{ $form->massage_box ? count($form->massage_box) : '0' }})</h2>
                        </div>
                        <form class="mb-6" method="POST" action="{{ route('massage.store', ['id' => $form->id_massage, 'slug' => $form->slug]) }}">
                            @csrf
                            <div
                                class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <label for="comment" class="sr-only">Your comment</label>
                                <textarea id="comment" rows="3" name="massage"
                                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                    placeholder="Write a comment..." required></textarea>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Post comment
                            </button>
                        </form>
                        {{-- Comment Section --}}
                        <article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
                                            class="mr-2 w-6 h-6 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                            alt="Michael Gough">Michael Gough</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                            title="February 8th, 2022">Feb. 8, 2022</time></p>
                                </div>
                                <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                    type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                        </path>
                                    </svg>
                                    <span class="sr-only">Comment settings</span>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="dropdownComment1"
                                    class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownMenuIconHorizontalButton">
                                        <li>
                                            <a href="#"
                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                        </li>
                                    </ul>
                                </div>
                            </footer>
                            <p>Very straight-to-point article. Really worth time reading. Thank you! But tools are just the
                                instruments for the UX designers. The knowledge of the design tools are as important as the
                                creation of the design strategy.</p>
                            <div class="flex items-center mt-4 space-x-4">
                                <button type="button"
                                    class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                                    <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                    Reply
                                </button>
                            </div>
                        </article>
                        @forelse ($form->massage_box as $item)
                            <article class="p-6 text-base bg-white border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <footer class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
                                            class="mr-2 w-6 h-6 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                            alt="Michael Gough">{{ $item['by'] }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-06-23" title="June 23rd, 2022">{{ date('F. d, Y', strtotime($item['time'])) }}</time></p>
                                    </div>
                                </footer>
                                {{-- Massage --}}
                                <p>{{ $item['massage'] }}</p>
                                <div class="flex items-center mt-4 space-x-4">
                                    <button type="button"
                                        class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                                        <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg>
                                        Reply
                                    </button>
                                    @if ($item['by'] == Auth::user()->email)
                                        <a href="{{ route('massage.delete', ['id' => $form->id_massage, 'slug' => $form->slug, 'kode' => $item['code']]) }}">Delete</a>
                                    @endif
                                </div>
                            </article>
                        @empty
                        <p>Jadi yang pertama dalam berkomentar !</p>
                        @endforelse
                    @else
                        <p>Komentar Di Nonaktifkan</p>
                    @endif                
                    
                </section>
            </article>
        </div>
    </main>

</body>
</html>