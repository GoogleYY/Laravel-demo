<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('resources/assets/img/favicon.ico') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>@yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="{{ asset('resources/assets/css/animate.min.css') }}" rel="stylesheet"/>
    <!-- wangEditor -->
    <link href="{{ asset('resources/assets/css/wangEditor.min.css') }}" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('resources/assets/css/light-bootstrap-dashboard.css') }}" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('resources/assets/css/demo.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="{{ asset('resources/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
	 @include('admin.style')
</head>
<body>

    <main class="wrapper">
        <div class="sidebar" data-color="purple">
            <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="{{ url('/') }}" class="simple-text">
                        xxx社区后台管理系统
                    </a>
                </div>

                <ul class="nav">
                    <li>
                        <a href="{{ url('admin/dash') }}">
                            <i class="pe-7s-graph"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/article/list') }}">
                            <i class="pe-7s-note2"></i>
                            <p>文章列表</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/article/create') }}">
                            <i class="pe-7s-graph"></i>
                            <p>添加文章</p>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('admin/affair/list') }}">
                            <i class="pe-7s-note2"></i>
                            <p>事务列表</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/category/list') }}">
                            <i class="pe-7s-note2"></i>
                            <p>分类列表</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/category/create') }}">
                            <i class="pe-7s-graph"></i>
                            <p>分类添加</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <main class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <header class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">@yield('title')</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left" style="@yield('search_none')">
                            <li style="@yield('search_none')">
                                <a style="padding:0">
                                    <input type="text" class="form-control" placeholder="搜索文章">
                                </a>
                            </li>
                            <li style="@yield('search_none')">
                                <a onclick="Search($(this))">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                             <a href="">
                                 <i class="pe-7s-piggy"></i>
                             </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    菜单
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('admin/passmodify') }}">修改密码</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('admin/logout') }}">
                                    退出
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </mian>
    </main>

</body>
<!-- javascript -->
@include('admin.script')

</html>
