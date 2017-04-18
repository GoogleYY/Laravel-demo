<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title')</title>
    {{-- <link rel="stylesheet" href="{{ asset('resources/assets/css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/wangEditor.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap-switch.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('resources/assets/css/font-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('resources/assets/css/prism.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('resources/assets/css/share.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('resources/assets/css/main.css') }}">
    @include('layouts.style')
</head>
<body>

    <header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('article') }}">
                    <span class="main-color text-bold">Community</span>
                </a>
            </div>

            <div class="navbar-collapse collapse text-center" id="app-navbar-collapse">
                <!-- Left nav -->
                <ul class="nav navbar-nav">
                    @foreach($categorys->take(6) as $category)
                        <li><a href="{{ url('article?category_id=').$category->category_id }}">
                            {{ $category->category_name }}
                        </a></li>
                    @endforeach
                </ul>
                <!-- Right nav -->
                <div class="navbar-right">
                    <form method="GET" action="{{ url('article') }}" accept-charset="UTF-8"
                          class="navbar-form navbar-left">
                        <input class="form-control search-input mac-style" name="search_text" placeholder="搜索动态" type="text" style="display:inline-block">
                        &nbsp;&nbsp;
                        <button type="submit" class="search-btn"
                                onclick="window.location.href = {{ url('article?search_text=') }} + $('input[name=search_text]').val().trim()">
                            <i class="fa fa-search" style="color:#fff" aria-hidden="true"></i>
                        </button>
                    </form>
                    <ul class="nav navbar-nav">
                        @if(Auth::check())
                            <li title="个人中心">
                                <a href="{{ url('user/personal') }}" style="padding:10px">
                                    <img style="max-width:40px;border-radius:50%" src="{{ asset(Auth::user()->avatar) }}" alt="个人中心">
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-sort-desc" style="color:#fff;font-size:18px"></i>
                                </a>
                                <ul class="dropdown-menu text-center">
                                    <li><a href="{{ url('logout') }}">退出</a></li>
                                </ul>
                            </li>
                        @else
                            <li title="登入">
                                <a href="{{ url('login') }}" style="padding:12px">
                                    登入
                                </a>
                            </li>
                            <li title="注册">
                                <a href="{{ url('register') }}" style="padding:12px">
                                    注册
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

            </div><!--/.nav-collapse -->
        </div>
    </header>

    @yield('content')

    <footer class="footer" style="background-color:#fff;padding:20px">
        <div class="container">
            <div class="row footer-top">
                <div class="col-sm-5 col-lg-5">
                    <p class="padding-top-xsm">欢迎来到我的社区</p>
                    <div class="text-md ">
                        <a class="popover-with-html" target="_blank" style="padding-right:8px"
                           href="mailto:summer@estgroupe.com">
                            <i class="fa fa-envelope"></i>
                        </a>
                        <a class="popover-with-html" target="_blank" style="padding-right:8px"
                           href="mailto:summer@estgroupe.com">
                           <i class="fa fa-github-alt" aria-hidden="true"></i>
                        </a>
                        <a class="popover-with-html" target="_blank" style="padding-right:8px"
                           href="mailto:summer@estgroupe.com">
                           <i class="fa fa-weibo" aria-hidden="true"></i>
                        </a>
                        <a class="popover-with-html" target="_blank" style="padding-right:8px"
                           href="mailto:summer@estgroupe.com">
                           <i class="fa fa-weixin" aria-hidden="true"></i>
                        </a>
                        <a class="popover-with-html" target="_blank" style="padding-right:8px"
                           href="mailto:summer@estgroupe.com">
                           <i class="fa fa-chrome" aria-hidden="true"></i>
                        </a>
                    </div>
                    <br>
                    <span style="font-size:0.9em">
                        Powered by
                        <a href="https://github.com/summerblue/phphub5" target="_blank" style="color:inherit">
                            PHPHub
                        </a>
                    </span>
                    <br>
                    <span style="font-size:0.9em">
                        Designed by
                        <span style="color: #e27575;font-size: 14px;">❤</span>
                        <a href="https://github.com/summerblue" target="_blank" style="color:inherit">Summer</a>
                    </span>
                </div>
                <div class="col-sm-6 col-lg-6 col-lg-offset-1">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>赞助商</h4>
                            <ul class="list-unstyled">
                                <a href="{{ url('/') }}" target="_blank">
                                    <img style="max-width:60px" src="{{ asset('resources/assets/img/favicon.png') }}"  class="popover-with-html footer-sponsor-link" width="98" >
                                </a>
                                <br>
                                <a href="" target="_blank">
                                    <img style="max-width:60px" src="{{ asset('resources/assets/img/20170407152917.gif') }}"
                                         class="popover-with-html footer-sponsor-link" width="98">
                                </a>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <h4>统计信息</h4>
                            <ul class="list-unstyled">
                                <li>社区会员: {{ DB::table('users')->get()->count() }}</li>
                                <li>话题数: {{ DB::table('articles')->get()->count() }}</li>
                                <li>评论数: {{ DB::table('comments')->get()->count() }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <h4>其他信息</h4>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="https://laravel-china.org/sites">
                                        <i class="fa fa-globe text-md"></i> 推荐网站
                                    </a>
                                </li>
                                <li>
                                    <a href="https://laravel-china.org/about">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> 关于我们
                                    </a>
                                </li>
                                <li>
                                    <a href="https://laravel-china.org/hall_of_fames">
                                        <i class="fa fa-star" aria-hidden="true"></i> 名人堂
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </footer>

    @include('layouts.script')

</body>
</html>
