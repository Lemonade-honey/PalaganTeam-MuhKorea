@extends('layout.dashboard', ['title' => 'My Form'])

@section('body')

<div class="p-4">
    <div class="mb-5">
        <h1 class="font-bold text-blue-800 text-2xl mb-1">My Form</h1>
        <hr>
    </div>
    <div class="flex flex-wrap xl:gap-10 gap-5 lg:justify-center justify-start">
        
        @forelse($forms as $item)
        <div class="max-w-xs w-full bg-white border border-gray-200 rounded-lg shadow">
            <div class="p-4">
                <a href="{{ route('form.mainForm', ['slug' => $item->slug]) }}">
                    <div class="h-44 rounded-lg" style="background-image: {{ $item->img }}"></div>
                    <p class="font-medium text-gray-400 mb-2">{{ $item->created_by }}</p>
                    <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 hover:text-blue-800
                    ">{{ $item->title }}</h5>
                </a>
            </div>
        </div>
        
        @empty
        <div class="w-full p-4 py-10 border border-gray-200 shadow rounded-lg font-medium capitalize text-center">
            no form joined
        </div>

        @endforelse

    </div>
</div>

@endsection