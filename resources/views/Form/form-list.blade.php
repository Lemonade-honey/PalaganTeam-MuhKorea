@extends('layout.dashboard', ['title' => 'My Form'])

@section('body')

<div class="p-4">
    <div class="mb-5">
        <h1 class="font-bold text-emerald-700 text-2xl mb-1">List Form</h1>
        <hr>

        <form action="{{ route('form.listSearch') }}" method="GET">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" name="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
    </div>
    <div class="flex flex-wrap xl:gap-10 gap-5 justify-start">
        
        @forelse($forms as $item)
        <div class="max-w-xs w-full bg-white border border-gray-200 rounded-lg shadow">
            <div class="p-4">
                <a href="{{ route('form.mainForm', ['slug' => $item->slug]) }}">
                    <div class="h-44 rounded-lg" style="background-image: {{ $item->img }}"></div>
                    <p class="font-medium text-gray-400 mb-2">{{ $item->created_by }}</p>
                    <h5 class="mb-1 text-2xl font-bold tracking-tight text-emerald-800 hover:text-emerald-400
                    ">{{ $item->title }}</h5>
                </a>
            </div>
        </div>
        
        @empty
        <div class="w-full p-4 py-10 border border-gray-200 shadow rounded-lg font-medium capitalize text-center">
            no form found
        </div>  
        @endforelse
    </div>
    <div class="pt-8">
        {{ $forms->links() }}
    </div>
</div>

@endsection