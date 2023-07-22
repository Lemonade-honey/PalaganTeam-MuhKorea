<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('public/assets/css/app.css')
    <link href="{{ asset('public/assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
</head>

<body>
    @include('layout.navbar')

    <div class="w-full max-h-screen">
        @yield('body')
    </div>

    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script>
        $('.news-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false
                }
            }
        })
    </script>

</body>

</html>
