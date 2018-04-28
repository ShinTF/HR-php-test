<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('css-src')

        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        @yield('css-usr')


    </head>
    <body>
        <div class="content">

            @yield('content')

        </div>

        <footer class="col-xs-12">

        </footer>
    </body>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js-src')

    <script src="{{ asset('js/script.js') }}"></script>
    @yield('js-usr')



</html>
