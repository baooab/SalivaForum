<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>乱炖社区</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
          .btn {
            box-shadow: 0 2px 3px 0 rgba(0, 0, 0, .16);
          }

          .py-6 {
            padding-top: 5rem;
            padding-bottom: 5rem;
          }

          .btn-white {
            background-color: #fff;
          }

          @media (max-width: 768px) {
            .btn-lg {
              width: 100%;
              display: block;
            }
          }

          .bg-faded {
            background: #ebebeb;
          }

          .text-blue {
            color: #007bff;
          }

          .text-dark-grey {
            color: #8a8a8a;
          }

          .bt-blue {
            border-top: 4px solid #007bff;
          }

          .navbar-brand-text,
          .hero-banner {
            font-family: "Microsoft JhengHei UI", "Microsoft Yahei";
          }

          .navbar {
             margin-bottom: 0 !important;
             box-shadow: none;
          }

          .footer-links li {
            display: inline-block;
            margin: 0 10px;
            color: #8a8a8a;
          }

          .footer-links a {
            color: #8a8a8a;
          }
        </style>
    </head>
    <body>

        <div id="app" class="{{ route_class() }}-page">

            <nav class="navbar navbar-expand-md navbar-light bg-faded bt-blue">
              <div class="container">
                <a href="{{ route('overview') }}" class="navbar-brand navbar-brand-text">乱炖社区</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarText" aria-expanded="false">
                  <span class="navbar-text d-none d-md-block">一个小众的知识社区</span>
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="https://github.com/baooab/SalivaForum" target="_blank">源码</a>
                    </li>
                    <li class="nav-item ml-md-2">
                      <a href="{{ route('login') }}">
                        <button class="btn btn-white text-blue" type="button">登录</button>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>

            <!-- Banner -->
            <div class="hero-banner bg-faded">
              <div class="container py-6 text-center">
                <h1>为<strong>不拘一格</strong>者</h1>
                <p class="lead text-dark-grey">有思想的年轻人到哪里都不太合群，但这不是为了不一样而不一样。</p>
                <a href="{{ route('register') }}" class="btn btn-lg btn-primary mx-md-3 my-3">现在注册</a>
                <a href="{{ route('overview') }}" class="btn btn-lg btn-white text-blue mx-md-3 my-3">我先看看</a>
              </div>
            </div>

            <div class="bg-white">
              <div class="container py-6">
                <div class="w-620px text-center mb-5">
                  <h2 class="text-blue cherrs-title">好处</h2>
                </div>
                <div class="row text-center">
                  <div class="col-md-4 col-sm-12 mb-4 mb-md-0 d-flex flex-column justify-content-between">
                    <p class="lead">文章使用 Markdown 格式书写，畅快</p>
                  </div>
                  <div class="col-md-4 col-sm-12 mb-4 mb-md-0 d-flex flex-column justify-content-between">
                    <p class="lead">自动生成文章结构目录，一目了然</p>
                  </div>
                  <div class="col-md-4 col-sm-12 mb-4 mb-md-0 d-flex flex-column justify-content-between">
                    <p class="lead">提供全站搜索，查漏补缺、温故知新</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="bg-white">
              <div class="container text-center py-4">
                <p class="text-dark-grey">Copyright © <a href="https://laravel-china.org/users/17319" target="_blank" class="text-muted">zhangbao</a>.</p>
                <ul class="footer-links list-unstyled">
                    <li>
                        <a href="http://m.beidian.com/shop/shopkeeper.html?shop_id=240193&utm_source=bd_dpfxhy
" target="_blank">（广告）手机打开「金鱼的店」，看看有没有您想要的 :)</a>
                    </li>
                </ul>
              </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
