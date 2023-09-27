@extends('layout/dashboard')

@section('body')
@if (session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200" role="alert">
        {{ session()->get('success') }}
    </div>
@elseif(session()->has('errors'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200" role="alert">
        {{ session()->get('errors') }}
    </div>
@endif
<div class="container grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div class="max-w-sm">
            <img src="{{ asset('storage/gallery/' . $gallery->img) }}" alt="">
        </div>
        <div class="col-span-1 border border-gray-200 rounded-sm p-4">
            <form method="POST" class="desc">
                @csrf
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desc</label>
                <textarea name="desc" id="editor" cols="30" rows="10">{{ old('details') ?? $gallery->desc }}</textarea>

                <div class="flex justify-end mt-5">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Update</button>
                    <button type="button" id="btnHapus" dataGet="{{ $gallery->id }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Delete</button>
                </div>
            </form>
        </div>
    </div>
    @include('Includes.MinCKEditor')
@endsection

@section('script')
    <script>
        const btnHps = document.getElementById('btnHapus')
        btnHps.addEventListener('click', () => {
            Swal.fire({
                title: 'Are you sure to delete it?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/dashboard/gallery/delete/' + btnHps.getAttribute('dataGet')
                }
            })
        })
    </script>
@endsection