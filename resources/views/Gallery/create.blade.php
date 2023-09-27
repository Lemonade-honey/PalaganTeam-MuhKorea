@extends('layout.dashboard', ['title' => 'Create Gallery'])

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
            <label class="block mb-2 text-md font-medium text-gray-900" for="file_input">Img Gallery</label>
            <input class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50" aria-describedby="file_input_help" name="img" accept="image/png, image/jpeg" id="file_input" type="file">
            <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG, JPEG and Webp (MAX 2 MB).</p>
            <div id="display-img"></div>
        </div>

        <div class="mb-6">
            <label for="editor" class="block mb-2 text-md font-medium text-gray-900">Description</label>
            <textarea name="desc" id="editor" cols="30" rows="10">{{ old('details') }}</textarea>
        </div>

        <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 float-right mb-6">Post Gallery</button>
    </form>
    @include('Includes.MinCKEditor')
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