<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite('public/assets/css/app.css')
    <link rel="stylesheet" href="{{asset('assets/css/CK.css')}}">
</head>

<body>
    @include('Includes.navbar2')

    @yield('body')
    @include('Includes.footer')

    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script>
        window.addEventListener('load', function(){
        document.querySelectorAll('oembed[url]')?.forEach( element => {
            // get just the code for this youtube video from the url
            let vCode = element.attributes.url.value.split('?v=')[1];
            console.log(vCode);
            // paste some BS5 embed code in place of the Figure tag
            element.parentElement.outerHTML= `
            <div style="display: flex; justify-content: center;">
                <iframe src="https://www.youtube.com/embed/${vCode}" width="660" height="415" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>    
            </div>"`;
        });
    })
    </script>
    <script>
        const btnReply = document.querySelectorAll('#reply')
        const create = document.createElement('input');
        create.setAttribute('id', 'reply_editor')
        create.setAttribute('class', 'px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800');
        create.setAttribute('name', 'reply')
        create.setAttribute('placeholder', 'write reply...');
        btnReply?.forEach(element => {
            element.addEventListener('click', () => {
                if(element.parentNode.children.length < 2){
                    element.parentNode.appendChild(create)
                }else{
                    element.parentElement.lastChild.remove()
                }
            })
        });
    </script>
</body>
</html>