@extends('layout.home', ['title' => 'Email Verified'])

@section('body')
<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen md:h-screen lg:py-0">
        <div class="w-full  bg-white rounded-lg shadow-md md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-2 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold text-gray-900 md:text-2xl">
                    Email Has Been Verified
                </h1>
                <p class="text-xs text-center text-gray-400 font-light">
                    Your E-Mail Has Been Verified, Click <a href="/login" class="text-blue-700">Login</a> If You Want
                    To Login
                </p>
            </div>
        </div>
    </div>
</section>
@endsection