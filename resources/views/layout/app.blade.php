<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @yield('desc')
    <title>{{ $title ?? config('app.name') }}</title>
    @vite('public/assets/css/app.css')
    <link rel="stylesheet" href="{{asset('assets/css/CK.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/CK.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @yield('style')
    <style>
        .image-style{
            width: 50rem;
            height: 29rem;
        }#details a{
            color: blue;
        }
    </style>
</head>

<body>
    @include('Includes.navbar')

    <div class="navbar-height">
        <div class="pt-11"></div>
        @yield('body')
    </div>
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
        function ml(tagName, props, nest) {
            var el = document.createElement(tagName);
            if(props) {
                for(var name in props) {
                    if(name.indexOf("on") === 0) {
                        el.addEventListener(name.substr(2).toLowerCase(), props[name], false)
                    } else {
                        el.setAttribute(name, props[name]);
                    }
                }
            }
            if (!nest) {
                return el;
            }
            return nester(el, nest)
        }

        function nester(el, n) {
            if (typeof n === "string") {
                var t = document.createTextNode(n);
                el.appendChild(t);
            } else if (n instanceof Array) {
                for(var i = 0; i < n.length; i++) {
                    if (typeof n[i] === "string") {
                        var t = document.createTextNode(n[i]);
                        el.appendChild(t);
                    } else if (n[i] instanceof Node){
                        el.appendChild(n[i]);
                    }
                }
            } else if (n instanceof Node){
                el.appendChild(n)
            }
            return el;
        }

        const btnReply = document.querySelectorAll('#reply')
        const reply = ml('div', {class: 'mt-2'}, [
            ml('textarea', {class: "p-2.5 w-full text-sm text-gray-900 rounded-lg bg-white border border-gray-300", rows: "1", placeholder: "write reply..", name: "reply"}, []),
            ml('input', {type: "hidden", name: "_token", value: "{{ csrf_token() }}"}),
            ml('button', { type: "submit", class: "inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800"}, "Post Reply")
        ])
        btnReply.forEach(element => {
            element.addEventListener('click', () => {
                if (element.parentNode.children.length < 2) {
                    element.parentNode.appendChild(reply)
                } else {
                    element.parentElement.lastChild.remove()
                }
            })
        });
    </script>
</body>
</html>
