@extends('layout.dashboard', ['title' => 'Create News'])

@section('body')

<div class="p-4">
    @if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400" role="alert">
        {{ $errors->first() }}
    </div>
    @endif
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload file</label>
        <input id="file_input" name="img" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" aria-describedby="file_input_help" id="file_input" type="file">
        <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG or JPG</p>
        <div id="display-img"></div>

        <div class="flex justify-end">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">POST</button>
        </div>
    </form>

    <div class="control w-full mt-11 flex justify-center items-center flex-col">
        @forelse ($slider as $item)
        <div class="gambar max-w-md mb-4 p-1 border border-gray-400 rounded-md">
            <img class="w-full aspect-video mb-2" src="{{ asset('image/slider/' . $item->img) }}" alt="">
            <p>{{ $item->created_at }}</p>
            <div class="flex justify-end">
                <a href="{{ route('slider.delete', ['id' => $item->id]) }}" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-500 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                    hapus
                </a>
            </div>
        </div>
        @empty
            <p>slider empty</p>
        @endforelse
    </div>
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