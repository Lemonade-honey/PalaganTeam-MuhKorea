@extends('layout.home', ['title' => 'Reset Password'])

@section('body')
<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center h-screen px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-blue-700">
            Hidayah
        </a>
        <div
            class="w-1/2 lg:w-full md:w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl font-bold leading-tight tracking-tight text-center text-gray-900 md:text-2xl mb-5">
                    Reset Password
                </h1>
                {{-- Error Massage --}}
                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form class="space-y-4 md:space-y-6" method="POST">
                    @csrf
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            placeholder="••••••••" value="{{ old('password') }}" required>
                    </div>
                    <div>
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            required>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reset Password</button>
                    <p class="text-sm font-light text-gray-500">
                        Remember Your Password? <a href="/login" class="font-medium text-blue-600 hover:underline">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection