@extends('layout.dashboard', ['title' => 'Form'])

@section('body')

<div class="p-4">
    <div class="flex items-center justify-between py-5">
        <h1 class="font-bold text-emerald-700 text-2xl mb-0">Form List</h1>
        <a href="{{ route('form.create') }}">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Add
                New Form</button>
        </a>
    </div>
    <hr />

    <form action="{{ route('news.searchDas') }}" method="GET">   
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

    <div class="pt-3 relative overflow-x-auto">
        @if (session()->has('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session()->get('success') }}
            </div>
        @elseif(session()->has('errors'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400" role="alert">
                {{ session()->get('errors') }}
            </div>
        @endif

        <table class="w-full text-xs md:text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Categori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Author
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Set to
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3 float-right">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($form as $key => $value)
                <tr class="bg-white border-b hover:bg-gray-200">
                    <td class="px-6 py-4">
                        {{ ($form->currentPage() - 1) * $form->perPage() + $key + 1 }}
                    </td>
                    <td class="px-6 py-4 capitalize">
                        {{ $value->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value->categori ?? "none" }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value->created_by }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $value->status }}
                    </td>
                    <td class="px-6 py-4">
                        {{ date("d-m-Y, H:i:s", strtotime($value->created_at)) }}
                    </td>
                    <td>
                        <div class="flex flex-row space-x-2 float-right">
                            <a href="{{ route('form.mainForm', ['slug' => $value->slug]) }}"
                                class="bg-blue-500  hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                View
                            </a>
                            @if ($value->created_by == Auth::user()->email || Auth::user()->role == 'admin')
                            <a href="{{ route('form.update', ['slug' => $value->slug]) }}"
                                class="bg-yellow-500  hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <button
                                type="button" id="delete" dataGet="{{ $value->id }}"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3.5 rounded">
                                Delete
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center font-medium p-4">Empty Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pt-8">
            {{ $form->links() }}
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    const deleletBtn = document.querySelectorAll('#delete');
    deleletBtn.forEach(element => {
        element.addEventListener('click', () => {
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
                window.location.href = '/dashboard/form/delete/' + element.getAttribute('dataGet')
            }
        })
    })
    });
</script>
@endsection