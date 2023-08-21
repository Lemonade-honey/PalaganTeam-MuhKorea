<!-- comment -->
@if ($comment->id_massage != null && $comment->status_massage == 'aktif')
<section class="bg-white py-8 lg:py-16">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900">{{ $title ?? 'Comment' }} ({{ $comment->massage_box ? count($comment->massage_box) : '0' }})</h2>
        </div>
        <form class="mb-6" method="POST" action="{{ route('massage.store', ['id' => $comment->id_massage, 'slug' => $comment->slug]) }}">
            @csrf
            <div class="mb-4">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea id="comment" name="massage" rows="4" class="py-2 px-2 w-full bg-white rounded-lg rounded-t-lg border border-gray-200 hover:border-blue-600 text-sm " placeholder="Write a comment..." required></textarea>
            </div>
            <button type="submit"
                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">
                Post Comment
            </button>
        </form>
        @if ($comment->massage_box != null)
            @forelse ($comment->massage_box as $first => $value)
                <article class="py-4 mb-6 text-base bg-white rounded-lg">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <div class="inline-flex items-center justify-center w-7 h-7 overflow-hidden bg-gray-500 rounded-full ">
                                <p class="text-sm text-white uppercase">{{ substr($value['by'], 0, 2) }}</p>
                            </div>
                            <p class="inline-flex items-center ml-2 text-sm text-gray-900">{{ $value['by'] }}</p>
                            
                        </div>
                        @auth
                            @if ($value['email'] == Auth::user()->email || Auth::user()->role == 'admin' || Auth::user()->role == 'staf')
                            <button data-dropdown-toggle="dropdownComment{{$first}}"
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                            type="button">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                </path>
                            </svg>
                            <span class="sr-only">Comment settings</span>
                        </button>
                            @endif
                        @endauth
                        <!-- Dropdown menu -->
                        <div id="dropdownComment{{$first}}"
                            class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow">
                            <ul class="py-1 text-sm text-gray-700"
                                aria-labelledby="dropdownMenuIconHorizontalButton">
                                <li>
                                    <a href="{{ route('massage.delete', ['id' => $comment->id_massage, 'slug' => $comment->slug, 'kode' => $value['code']]) }}" 
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                </li>
                            </ul>
                        </div>
                    </footer>
                    {{-- Massage --}}
                    <p class="ml-3">{{ $value['massage'] }}</p>
                    <p class="text-sm text-gray-600 my-2 float-right" title="{{ date('F. d, Y', strtotime($value['time'])) }}">{{ date('F. d, Y H:i', strtotime($value['time'])) }}</p>
                    <div class="mt-8">
                        <form action="{{ route('massage.storeReply', ['id' => $comment->id_massage, 'slug' => $comment->slug, 'kode' => $value['code']]) }}" method="post">
                            <button type="button" id="reply"
                                class="flex items-center text-sm  hover:underline">
                                <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Reply
                            </button>
                        </form>
                    </div>
                </article>
                @if ($value['reply'] == null)
                    <hr>
                @endif
                <!-- reply -->
                @if ($value['reply'] != null)
                    @foreach ($value['reply'] as $reply => $valueReply)
                    <article class="p-6 mb-6 ml-8 lg:ml-16 text-base bg-white rounded-lg">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <div class="inline-flex items-center justify-center w-7 h-7 overflow-hidden bg-gray-500 rounded-full ">
                                    <p class="text-sm text-white uppercase">{{ substr($valueReply['by'], 0, 2) }}</p>
                                </div>
                                <p class="inline-flex items-center ml-2 text-sm text-gray-900">{{ $valueReply['by'] }}</p>
                            </div>
                            @auth
                                @if ($value['email'] == Auth::user()->email || Auth::user()->role == 'admin' || Auth::user()->role == 'staf')
                                <button data-dropdown-toggle="dropdownReply{{ $reply }}"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                                type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                        </path>
                                    </svg>
                                </button>
                                @endif
                            @endauth
                            <!-- Dropdown menu -->
                            <div id="dropdownReply{{ $reply }}"
                                class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="py-1 text-sm text-gray-700"
                                    aria-labelledby="dropdownMenuIconHorizontalButton">
                                    <li>
                                        <a href="{{ route('massage.deleteReply', ['id' => $comment->id_massage, 'slug' => $comment->slug, 'kode' => $value['code'], 'replyKode' => $valueReply['code']]) }}" 
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                    </li>
                                </ul>
                            </div>
                        </footer>
                        <p>{{ $valueReply['massage'] }}</p>
                        <p class="text-sm text-gray-600 my-2 float-right" title="{{ date('F. d, Y', strtotime($valueReply['time'])) }}">{{ date('F. d, Y H:i', strtotime($valueReply['time'])) }}</p>
                    </article>
                    @if (count($value['reply']) == $reply + 1)
                        <hr>
                    @endif
                    @endforeach
                @endif
            @empty
                <p>Jadi yang pertama berkomentar !</p>
            @endforelse
        @endif
    </div>
</section>
@else
<p class="font-medium text-lg text-center mt-10">Komentar Di Nonaktifkan</p>
@endif