@extends('layout.dashboard', ['title' => 'Activity'])

@section('body')
<div class="p-4">
    <div class="flex items-center justify-between py-5">
        <h1 class="font-bold text-blue-800 text-2xl mb-0">Activity List</h1>
        <a href="{{ route('activity.create') }}">
            <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Add
                Activity</button>
        </a>
    </div>
    <hr />

    <form action="{{ route('activity.search') }}" method="GET">   
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
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Author
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
                @forelse ($activity as $key => $value)
                <tr class="bg-white border-b hover:bg-gray-200">
                    <td class="px-6 py-4">
                        {{ ($activity->currentPage() - 1) * $activity->perPage() + $key + 1 }}
                    </td>
                    <td class="px-6 py-4 capitalize">
                        {{ $value->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ date('d F Y', strtotime($value->tanggal)) }}
                    </td>
                    <td class="px-6 py-4">
                        Author
                    </td>
                    <td class="px-6 py-4">
                        {{ $value->created_at }}
                    </td>
                    <td>
                        <div class="flex flex-row space-x-2 float-right">
                            <a href="{{ route('activity.update', ['id' => $value->id]) }}"
                                class="bg-yellow-500  hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <a href="{{ route('activity.delete', ['id' => $value->id]) }}"
                                onclick="return confirm('Apakah anda yakin menghapus data ini?')" type="button"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3.5 rounded">
                                Delete
                            </a>
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
            {{ $activity->links() }}
        </div>
    </div>
</div>

@endsection


