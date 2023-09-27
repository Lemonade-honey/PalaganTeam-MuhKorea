@extends('layout.app', ['title' => 'Gallerys', 'page' => 'gallery'])

@section('body')
<div class="mx-4 lg:mx-20 grid grid-cols-2 md:grid-cols-3 gap-4 mt-10">
    @forelse ($gallery as $key => $value)
    <div class="border border-gray-50 hover:border-gray-300 rounded-lg" data-modal-target="{{ $key }}" data-modal-toggle="{{ $key }}">
        <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/gallery/' . $value->img) }}" alt="">
    </div>
    <!-- modal -->
    <div id="{{ $key }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-3xl max-h-full">
            <div class="relative bg-white rounded-lg shadow w-full">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="{{ $key }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-2 md:flex md:gap-3">
                <img class="h-auto max-w-sm w-full rounded-lg" id="imgTarget" src="{{ asset('storage/gallery/' . $value->img) }}" alt="">
                    <p id="target" class="md:pr-4"><?= $value->desc ?></p>
                </div>
            </div>
        </div>
    </div>
    @empty
        <p>empty</p>
    @endforelse

</div>
@endsection