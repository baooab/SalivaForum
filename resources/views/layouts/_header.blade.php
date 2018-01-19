<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
      <a class="navbar-brand" href="{{ route('root') }}">乱炖社区</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-navbar-collapse" aria-controls="app-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
          </li>
        </ul>
        <ul class="navbar-nav flex-row ml-md-auto d-md-flex">
            @guest
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">登录</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">注册</a>
                </li>
            @else

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/images/default-avatar.png" style="width: 28px; height: 28px; border-radius: 50%; margin-right: 4px;">{{ Auth::user()->username }}
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">编辑资料</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">退出登录</a>
                </li>
            @endguest
        </ul>
      </div>
  </div>
</nav>
