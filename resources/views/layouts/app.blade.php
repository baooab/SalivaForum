<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', '首页') - 乱炖社区</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>

        <div id="app" class="{{ route_class() }}-page">

            @include('layouts._header')

            <div class="container">

                @include('layouts._message')

                @yield('content')

            </div>

            @include('layouts._footer')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
