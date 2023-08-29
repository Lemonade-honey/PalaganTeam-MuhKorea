@extends('layout.dashboard', ['title' => 'Update Form'])

@section('body')

<div class="p-4">
    @if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200" role="alert">
        {{ $errors->first() }}
    </div>
    @endif

    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label for="title"  class="block mb-2 text-md font-medium text-gray-90">Form Title <span class="text-red" data-tooltip-target="max-title">(Max 200)</span></label>
            <div id="max-title" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 toolti">
                max word is 200
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('title') ?? ucwords($form->title) }}">
        </div>

        <div class="mb-6">            
            <label for="editor" class="block mb-2 text-md font-medium text-gray-900">Form Description</label>
            <textarea name="desc" id="editor" cols="30" rows="10">{{ old('desc') ?? $form->desc }}</textarea>
        </div>

        <div class="mb-6">
            <label for="categori" class="block mb-2 text-md font-medium text-gray-900">Form Categori (Optional)</label>
            <input type="text" name="categori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('categori') ?? $form->categori }}">
        </div>
        
        <div class="mb-6">
            <label for="massage" class="block mb-2 text-md font-medium text-gray-900">Form set to</label>
            <select id="massage" name="status_form"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="{{ $form->status }}" selected>{{ ucwords($form->status) }}</option>
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
            <div class="mt-2">
                <label for="massage" class="block mb-2 text-md font-medium text-gray-900">Password Form</label>
                <input type="text" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $form->password }}">
            </div>
        </div>

        <div class="mb-6">
            <label for="massage" class="block mb-2 text-md font-medium text-gray-900">Commentar Massage</label>
            <select id="massage" name="massage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @if ($form->id_massage && $form->massage_status == "aktif")
                <option value="yes">Yes</option>
                @endif
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
        </div>

        <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 float-right mb-6">Update Form</button>
    </form>
    @include('Includes.MinCKEditor')
</div>

@endsection