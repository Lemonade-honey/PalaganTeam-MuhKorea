@extends('layout.dashboard', ['title' => 'List member'])

@section('body')
<div class="relative overflow-x-auto">
    <h1 class="text-2xl text-emerald-700 font-medium mb-4">List Member</h1>
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 capitalize" role="alert">
            {{ session()->get('success') }}
        </div>
    @elseif(session()->has('errors'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 capitalize" role="alert">
            {{ session()->get('errors') }}
        </div>
    @endif
    
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staf')
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($member as $key => $value)
            <tr class="bg-white border-b">
                <td class="px-6 py-4">
                    {{ $key + 1 }}
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $value }}
                </th>
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staf')
                <td class="px-6 py-4">
                    <a href="{{ route('form.member.delete', ['slug' => $slug, 'email' => $value]) }}" class="px-3 py-2 text-xs font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">Delete</a>
                </td>
                @endif
            </tr>
            @empty
                
            <tr class="bg-white border-b">
                <td colspan="3" class="text-center p-5 font-medium text-lg">Tidak ada Member</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection