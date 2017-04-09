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
    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('resources/assets/css/light-bootstrap-dashboard.css') }}" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('resources/assets/css/demo.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="{{ asset('resources/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
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
                            <li>
                                <a style="padding:0">
                                    <input type="text" class="form-control" placeholder="搜索文章">
                                </a>
                            </li>
                            <li>
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

<!--   Core JS Files   -->
<script src="{{ asset('resources/assets/js/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('resources/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="{{ asset('resources/assets/js/bootstrap-checkbox-radio-switch.js') }}"></script>

<!--  Charts Plugin -->
<script src="{{ asset('resources/assets/js/chartist.min.js') }}"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('resources/assets/js/bootstrap-notify.js') }}"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{ asset('resources/assets/js/light-bootstrap-dashboard.js') }}"></script>

<!-- uploadify -->
<script src="{{ asset('resources/assets/uploadify/jquery.uploadify.min.js') }}"></script>

<!-- echats -->
<!-- <script src="{{ asset('resources/assets/js/echarts.simple.min.js') }}"></script> -->
<script src="https://cdn.bootcss.com/echarts/3.5.0/echarts.common.min.js"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="{{ asset('resources/assets/js/demo.js') }}"></script>

<script type="text/javascript">
    $(function(){
        // dashboard 
        @if(!empty($isHome))
            var myChart = echarts.init(document.getElementById('main'));

            var article_title = [];
            var view_counts = [];

            @foreach($articles as $article)
                article_title.push('{{ $article->article_title }}')
                view_counts.push('{{ $article->article_view_counts }}')
            @endforeach

            console.log(view_counts)
            // 指定图表的配置项和数据
            var option = {
                color: ['#3398D3'],
                tooltip: {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis : [{
                    type : 'category',
                    data : article_title,
                    axisTick: {
                        alignWithLabel: true
                    }
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: [{
                    name: '浏览量',
                    type: 'bar',
                    data: view_counts
                }]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        @endif

        if ($('#file_upload') != undefined) {
            // 地区
            $.get('http://community.cm/api/areas', {}, function (res) {
                console.log(res);
            })

            // 图片上传
            $('#file_upload').uploadify({
                'formData': {
                    'timestamp': "{{ time() }}",
                    '_token': "{{csrf_token()}}"
                },
                'buttonText': '选择文件',
                'swf': "{{ asset('resources/assets/uploadify/uploadify.swf') }}",
                'uploader': "{{ url('admin/article/upload') }}",
                'onUploadSuccess': function (file, data, responce) {
                    $('#image_url').val(data);
                    $('#image_view').attr('src', '/' + data);
                }
            });
        }
    })

    // 删除
    function Delete(id) {
        if(confirm('确定')) {
            $.post({
                url: '@yield("delete_url")',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function (data) {
                    alert(data.msg);
                    if(data.code === 0) {
                        window.reload();
                    }
                }
            })
        }
    }

    // 搜索文章
    function Search(_this) {
        var search_text = _this.parent('li').prev('li').find('input').val()
        window.location.href = "{{ url('admin/article/list') }}?search_text=" + search_text;
    }
</script>
</html>