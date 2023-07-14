<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
    @vite('resources/css/app.css')
</head>
<body>
    <section class="bg-gray-50 dark:bg-gray-900 mt-5">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen md:h-screen lg:py-0">
            <div class="w-full  bg-white rounded-lg shadow-md dark:border md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-2 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl text-center font-bold text-gray-900 md:text-2xl dark:text-white">
                        Password Has Been Reset
                    </h1>
                    <h3 class="text-lg font-semibold text-center md:text-2xl text-blue-700">
                        Email Pemohon
                    </h3>
                    <p class="text-xs text-center text-gray-400 font-light">
                        Your Password Has Been Reset, Click <a href="/login" class="text-blue-700">Login</a> If You Want
                        To Login
                    </p>
                </div>
            </div>
        </div>
    </section>    
</body>
</html>