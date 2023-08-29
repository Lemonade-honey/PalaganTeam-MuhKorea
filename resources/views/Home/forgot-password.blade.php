@extends('layout.home', ['title' => 'Forget Password'])

@section('body')
<section class="bg-cover" style="background-image: url('/image/login.png');">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen md:h-screen lg:py-0">
        <div
            class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold text-gray-900 md:text-2xl">
                    Forgot Password
                    <p class="text-xs text-gray-400 font-light">
                        Please input your Email
                    </p>
                </h1>

                <form class="space-y-4 md:space-y-6" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your
                            email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            placeholder="Email" required="">
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Forgot
                        Password</button>
                    <p class="text-sm font-light text-gray-500">
                        Already have an account? <a href="/login" class="font-medium text-blue-600 hover:underline">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection