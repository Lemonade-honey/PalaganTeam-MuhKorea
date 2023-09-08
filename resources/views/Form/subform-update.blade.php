@extends('layout.dashboard', ['title' => 'Update Sub Form'])

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
            <label for="title"  class="block mb-2 text-md font-medium text-gray-900">Sub Form Title <span class="text-red" data-tooltip-target="max-title">(Max 200)</span></label>
            <div id="max-title" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                max word is 200
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('title') ?? $subForm->title }}">
        </div>

        <div class="mb-6">
            <label for="massage" class="block mb-2 text-md font-medium text-gray-900">Commentar Massage</label>
            <select id="massage" name="massage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @if ($subForm->id_massage && $subForm->massage_status == "aktif")
                <option value="yes">Yes</option>
                @endif
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
        </div>

        <div class="mb-6">            
            <label for="editor" class="block mb-2 text-md font-medium text-gray-900">Form Details</label>
            <textarea name="details" id="editor" cols="30" rows="10">{{ old('details') ?? $subForm->details }}</textarea>
        </div>

        <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 float-right mb-6">Create Form</button>
    </form>
    @include('Includes.CKEditor')
</div>

@endsection
