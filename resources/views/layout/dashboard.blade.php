<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite('public/assets/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script> --}}
    <link rel="stylesheet" href="{{asset('assets/css/CK.css')}}">
    <style>
        body{
            min-height: 80vh;
        }
        .main{
            margin-top: 5rem;
        }
    </style>
</head>

<body>
    {{-- Sidebar --}}
    @include('layout.sidebar')

    <div class="mt-16">
        @yield('body')
    </div>
    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    
</body>
</html>
