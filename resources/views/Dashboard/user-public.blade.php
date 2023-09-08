@extends('layout.dashboard')

@section('body')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-2 w-full">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
        <div class="flex items-center gap-2">
            <div class="relative inline-flex items-center justify-center w-14 h-14 overflow-hidden bg-gray-100 rounded-full">
                <span class="font-medium text-gray-600 uppercase">{{ substr($user->name, 0, 2) }}</span>
            </div>
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 capitalize">{{ $user->name }}</h5>
        </div>
        <hr class="mt-2">

        <div class="data-profile">
            <div class="my-2">
                <label for="email" class="text-sm font-extralight">Email Address</label>
                <p>{{ $user->email }}</p>
            </div>
            <div class="my-2">
                <label for="hp" class="text-sm font-extralight">Handphone</label>
                <p>{{ $user->handphone ?? '-' }}</p>
            </div>
            <div class="my-2">
                <label for="Address" class="text-sm font-extralight">Home Address</label>
                <p>{{ $user->address ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
        <div class="skills">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 capitalize">Skills</h5>
            <div class="flex flex-wrap gap-1">
                @forelse ($data['skill'] as $item)
                <p class="p-2 bg-green-200 rounded-md capitalize">{{ $item }}</p>
                @empty
                <p>none</p>
                @endforelse
            </div>
        </div>

        <div class="hobbys mt-4">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 capitalize">Hobbies</h5>
            <div class="flex flex-wrap gap-1">
                @forelse ($data['hobby'] as $item)
                <p class="p-2 bg-blue-200 rounded-md capitalize">{{ $item }}</p>
                @empty
                <p>none</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
<div class="flex justify-end mt-2">
    <a href="{{ route('profile.edit') }}" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Edit</a>
</div>
@endsection