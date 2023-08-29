@extends('layout.dashboard', ['title' => 'Form Private'])

@section('body')

<div class="p-4">
    @if (session()->has('errors'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
            {{ session()->get('errors') }}
        </div>
    @endif
    <form action="{{ route('form.formPassword', ['slug' => $slug]) }}" method="post" class="flex justify-center text-center">
        @csrf
        <div class="max-w-xs">
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password Form</label>
                <input type="password" id="password" name="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Join Form</button>
        </div>
    </form>
</div>

@endsection