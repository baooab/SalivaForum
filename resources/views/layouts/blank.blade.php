<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '首页') | 乱炖社区</title>
    <style>
        * {
            font-family: "Microsoft JhengHei UI", -apple-system, BlinkMacSystemFont,
                "Segoe UI", Helvetica, Arial, sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html>
