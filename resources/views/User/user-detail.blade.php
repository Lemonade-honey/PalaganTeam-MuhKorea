{{-- <p>Nama Lengkap</p>
<input type="text" name="name" id="" value="{{ $user->name }}" disabled>
<p>Email</p>
<input type="email" id="" value="{{ $user->email }}" disabled>
<p>Verified</p>
<input type="text" id="" value="{{ $user->email_verified_at ?? 'null' }}" disabled>
<p>Role Access</p>
<input type="text" name="" id="" value="{{ $user->role }}" disabled>
<p>Created At</p>
<input type="text" id="" value="{{ $user->created_at }}" disabled>
<a href="{{ route('users.update', ['id' => $user->id]) }}">Edit</a> --}}

@extends('layout.dashboard', ['title' => 'User Detail'])

@section('body')
<div class="p-4">
    <div class="flex items-center justify-between py-5">
        <h1 class="font-bold text-emerald-700 text-2xl mb-0">User Detail</h1>
    </div>
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
                    <label for="email" class="text-sm font-extralight">User Role</label>
                    <p>{{ $user->role }}</p>
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
        <a href="{{ route('users.update', ['id' => $user->id]) }}" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Edit</a>
    </div>
</div>
@endsection