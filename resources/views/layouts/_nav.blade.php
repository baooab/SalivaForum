<style type="text/css">
    .navbar-form .search {
        border: none;
    }

    .navbar-form .search:hover, .navbar-form .search:focus {
        width: 150%;
    }
</style>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('overview') }}">{{ config('app.name', '乱炖社区') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('collection.overview') }}">采集</a></li>
                <li><a href="{{ route('search.enter') }}">搜索</a></li>
            </ul>
            <form class="navbar-form" style="
                display: none;
                margin-top: 16px;">
                <input type="text" class="form-control search" placeholder="搜帖子">
            </form>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">登录</a></li>
                    <li><a href="{{ route('register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle img-responsive"
                                 style="display:inline-block; width: 32px; height: 32px;" alt="{{ Auth::user()->name }}">
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('dashboard') }}">控制面板</a></li>
                            <li><a href="{{ route('settings.profile') }}">设置</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}">退出登录</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>