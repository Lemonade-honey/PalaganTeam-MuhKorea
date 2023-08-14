{{-- <p>Nama Lengkap</p>
<input type="text" name="name" id="" value="{{ $user->name }}">
<p>Email</p>
<input type="email" id="" value="{{ $user->email }}" disabled>
<p>Verified</p>
<input type="text" name="" id="" value="{{ $user->email_verified_at ?? 'null' }}" disabled>
<p>Role Access</p>
<select name="role" id="">
    <option value="{{ $user->role }}" selected>{{ $user->role }}</option>
    <option value="user">user</option>
    <option value="staf">staf</option>
    <option value="admin">admin</option>
</select>
<p>Created At</p>
<input type="text" id="" value="{{ $user->created_at }}" disabled> --}}


@extends('layout.dashboard', ['title' => 'User Update'])

@section('body')
<div class="p-4">
    @if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400" role="alert">
        {{ $errors->first() }}
    </div>
    @endif
    {{-- <div class="image-profile">
        <img src="https://img.freepik.com/premium-vector/young-smiling-man-avatar-man-with-brown-beard-mustache-hair-wearing-yellow-sweater-sweatshirt-3d-vector-people-character-illustration-cartoon-minimal-style_365941-860.jpg" alt="profile pic" class="w-40 h-40">
    </div> --}}
    <div class="details">
        <form action="{{ route('users.postUpdate', ['id' => $user->id]) }}" method="post">
            @csrf
            <div class="mb-6">
                <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize" name="name" value="{{ $user->name }}">
                </div>
            </div>
    
            <div class="mb-6">
                <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="text" id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" value="{{ $user->email }}" disabled readonly>
                </div>
            </div>
    
            <div class="mb-6">
                {{-- <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        <i class="fa-solid fa-universal-access"></i>
                    </span>
                    <input type="text" id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize" placeholder="{{ $user->role }}" disabled readonly>
                </div> --}}
                
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        <i class="fa-solid fa-universal-access"></i>
                    </span>
                    <select id="countries" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize" name="role">
                        <option value="{{$user->role}}" selected>{{$user->role}}</option>
                        <option value="user">user</option>
                        <option value="staf">staf</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
            </div>
    
            <div class="mb-6">
                <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Created At</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="text" id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" placeholder="{{ date('d-m-Y, H:i', strtotime($user->created_at)) }}" disabled readonly>
                </div>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 float-right">Update</button>
        </form>
    </div>
</div>
@endsection