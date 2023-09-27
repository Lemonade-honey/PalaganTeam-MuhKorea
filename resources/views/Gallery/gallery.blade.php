@extends('layout.dashboard', ['title' => 'Gallerys'])

@section('body')
<a href="{{  route('gallery.create')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Tambah</a>
<div class="mx-4 lg:mx-20 grid grid-cols-2 md:grid-cols-3 gap-4 mt-10">
    @forelse ($gallery as $key => $value)
    <a href="{{ route('gallery.detail', ['id' => $value->id]) }}">
        <div class="border border-gray-50 hover:border-gray-300 rounded-lg" data-modal-target="{{ $key }}" data-modal-toggle="{{ $key }}">
            <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/gallery/' . $value->img) }}" alt="">
        </div>
    </a>
    @empty
        <p>empty</p>
    @endforelse

</div>

@endsection