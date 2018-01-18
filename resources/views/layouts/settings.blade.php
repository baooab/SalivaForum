<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '首页') | 乱炖社区</title></title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('layouts._nav')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">设置</div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <a href="{{ route('settings.profile') }}">个人信息</a>
                            </li>
                            <li>
                                <a href="{{ route('settings.avatar') }}">更改头像</a>
                            </li>
                            <li>
                                <a href="{{ route('settings.password') }}">密码</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @include('layouts._alerts')

                @yield('content')
            </div>
        </div>
    </div>

    @include('layouts._footer')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
        $('.alert').delay(4000).fadeOut(350);
    </script>

    @stack('scripts')
</body>
</html>
