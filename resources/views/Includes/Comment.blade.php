<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
    <div class="flex justify-center px-4 mx-auto max-w-screen-xl mt-10 md-40 ">
        <article class="mx-auto w-full text-justify md:w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
            <section class="not-format">
                {{-- Fix --}}
                @if ($comment->id_massage != null)
                    <div class="flex justify-between items-center mb-6 my-5">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments ({{ $comment->massage_box ? count($comment->massage_box) : '0' }})</h2>
                    </div>
                    <form class="mb-6" method="POST" action="{{ route('massage.store', ['id' => $comment->id_massage, 'slug' => $comment->slug]) }}">
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
                    @if ($comment->massage_box != null)
                        @foreach ($comment->massage_box as $item)
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
                                <form action="{{ route('massage.storeReply', ['id' => $comment->id_massage, 'slug' => $comment->slug, 'kode' => $item['code']]) }}" method="post">
                                    @csrf
                                    <input type="text" name="reply" id="" placeholder="teplay this massage">
                                    <button type="submit">Reply</button>
                                </form>
                                @if ($item['by'] == Auth::user()->email)
                                    <a href="{{ route('massage.delete', ['id' => $comment->id_massage, 'slug' => $comment->slug, 'kode' => $item['code']]) }}">Delete</a>
                                @endif
                            </div>
                        </article>
                        {{-- Reply --}}
                        @if ($item['reply'] != null)
                            @foreach ($item['reply'] as $reply)
                            <article class="p-6 mb-6 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900">
                                <footer class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img class="mr-2 w-6 h-6 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Michael Gough">{{ $reply['by'] }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-06-23" title="June 23rd, 2022">{{ date('F. d, Y', strtotime($reply['time'])) }}</time></p>
                                    </div>
                                </footer>
                                <p>{{ $reply['massage'] }}</p>
                                <div class="flex items-center mt-4 space-x-4">
                                    @if ($reply['by'] == Auth::user()->email)
                                    <a href="{{ route('massage.deleteReply', ['id' => $comment->id_massage, 'slug' => $comment->slug, 'kode' => $item['code'], 'replyKode' => $reply['code']]) }}">Delete</a>
                                    @endif
                                </div>
                            </article>
                            @endforeach
                        @endif
                        @endforeach
                    @else
                        <p>Jadi yang pertama berkomentar !</p>
                    @endif
                @else
                    <p>Komentar Di Nonaktifkan</p>
                @endif                
                
            </section>
        </article>
    </div>
</main>