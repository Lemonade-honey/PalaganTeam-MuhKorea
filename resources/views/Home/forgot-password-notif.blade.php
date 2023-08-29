@extends('layout.home', ['title' => 'Forget Password'])

@section('body')
<section class="bg-gray-5 mt-5">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen md:h-screen lg:py-0">
        <div
            class="w-full bg-white rounded-lg shadow-md dark:border md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-2 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold text-gray-900 md:text-2xl">
                    Password Reset Has Been Sent
                    <p class="text-xs text-gray-400 font-light">
                        please check your email for <span class="italic">Reset Password</span>
                    </p>
                </h1>
            </div>
        </div>
    </div>
</section>
@endsection