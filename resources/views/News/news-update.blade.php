@extends('layout.dashboard', ['title' => 'Update News'])

@section('body')

<div class="p-4">
    @if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400" role="alert">
        {{ $errors->first() }}
    </div>
    @endif

    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label for="title"  class="block mb-2 text-md font-medium text-gray-900 dark:text-white">News Title <span class="text-red" data-tooltip-target="max-title">(Max 200)</span></label>
            <div id="max-title" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                max word is 200
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('title') ?? $news->title}}">
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-md font-medium text-gray-900 dark:text-white" for="file_input">News Thumbnail</label>
            <p>Old Thumbnail</p>
            <img src="{{asset('image/news/thumbnail/' . $news->img)}}" alt="old thumb" class="h-48 w-96 mb-4">
            <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50" aria-describedby="file_input_help" name="img-thumbnail" accept="image/png, image/jpeg" id="file_input" type="file">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG and JPEG (MAX 2 MB).</p>
            <div id="display-img"></div>
        </div>
        
        <div class="mb-6">
            <label for="editor" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">News Description</label>
            <textarea name="details" id="editor" cols="30" rows="10">{{ old('details') ?? $news->details }}</textarea>
        </div>

        <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 float-right mb-6">Update Activity</button>
    </form>
    @include('Includes.CKEditor')
</div>

@endsection

@section('script')

<script>
    file_input.onchange = evt => {
        const [file] = file_input.files
        const target = document.getElementById("display-img")
        target.firstChild?.remove()

        if (file) {
            const img = document.createElement('img')
            img.setAttribute("class", "h-48 w-96");
            img.setAttribute("src", URL.createObjectURL(file))

            target.append(img)
        }
    }
</script>

@endsection