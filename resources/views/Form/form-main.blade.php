@extends('layout.dashboard', ['title' => 'Main Forms'])

@section('body')

<div class="p-4 sm:mr-64">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="mb-5">
        <div class="flex justify-between">
            <h1 class="font-bold text-blue-800 text-2xl mb-1 capitalize">{{ $form->title }}</h1>
            <div class="">
                @if (Auth::user()->role == "admin" || Auth::user()->role == "staf")
                <a href="{{ route('form.subForm.create', ['slug' => $form->slug]) }}">
                    <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 mb-4">Add Sub From</button>
                </a>
                @endif
                <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900bg-transparent rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none" type="button"> 
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                </button>
            </div>
            <!-- Dropdown menu -->
            <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconButton">
                    <li>
                        <a href="{{ route('form.memberReg', ['slug' => $form->slug]) }}" class="block px-4 py-2 hover:bg-gray-100">User Join</a>
                    </li>
                </ul>
                @if (!$btn && Auth::user()->role != 'admin')
                    <div class="py-2">
                        <a href="{{ route('form.leaveUserForm', ['slug' => $form->slug]) }}" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Leave</a>
                    </div>
                @endif
            </div>

        </div>
        <hr>

    </div>

    <div class="mb-6">
        <div class="h-20 rounded-t-lg" style="background-image: {{ $form->img }}">
        </div>
        <div class="p-5 border border-gray-200">
            <div class="desc">
                <?= $form->desc ?>
            </div>
            @if ($btn)
                <div class="join mt-3">
                    <a href="{{ route('form.registerUserForm', ['slug' => $form->slug]) }}" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Join this form</a>
                </div>
            @endif
        </div>
    </div>

    <div class="sub-form">
        
        @forelse ($sub_form as $key => $value)
        <div class="flex justify-end">
            <button id="dropdownMenuIconButton" data-dropdown-toggle="drop{{ $key }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900bg-transparent rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none" type="button"> 
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="drop{{ $key }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconButton">
                    <li>
                        <a href="{{ route('subForm.deleteSubForm', ['id' => $value->id, 'slug' => $form->slug]) }}" class="block px-4 py-2 text-red-500 hover:bg-gray-100">Delete</a>
                    </li>
                </ul>
            </div>
        </div>
        <a href="{{ route('form.subForm', ['slug' => $form->slug, 'sub_slug' => $value->slug]) }}">
            <div class="w-full p-5 font-medium text-left text-gray-500 border rounded-lg border-gray-300 hover:bg-gray-100 mb-4">
                <p class="text-xs">{{ date("H:i, d M Y", strtotime($value->created_at)) }}</p>
                <p>{{ $value->title }}</p>
            </div>
        </a>

        @empty

        <div class="p-5 font-medium text-center text-gray-500 border rounded-lg border-gray-300">No sub form added</div>
        @endforelse
        
    </div>

    @include('Includes.Comment2', ['comment' => $form, 'title' => 'Discussion'])
</div>
  
@endsection