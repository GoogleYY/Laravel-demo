<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <!-- <link href="/css/app.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body style="padding-top:70px">
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Community') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">登入</a></li>
                            <li><a href="{{ url('/register') }}">注册</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/user/info') }}">个人中心</a>
                                    </li>
                                    <li style="margin-top: 10px">
                                        <a href="{{ url('/password/reset').'/'.Auth::user()->remember_token }}">修改密码</a>
                                    </li>
                                    <li style="margin-top: 10px">
                                        <a href="{{ url('/logout') }}">退出</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('user/affairs') }}">代办事务</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('resources/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        @if(!empty($isArticleDetail))
            $(function(){
                // 收藏 
                var state = parseInt('{{ $isCollected }}');

                if($('#collect') != undefined) {
                    $('#collect').on('click', function () {
                        var _this = $(this)
                        if (state) {
                            $.post("{{ url('api/article/collect') }}", {
                                article_id: '{{ $article->article_id }}',
                                _token: '{{ csrf_token() }}'
                            }, function (res) {
                                if (res.code === 0) {
                                    _this.html('收藏')
                                }
                            })
                        } else {
                            $.post("{{ url('api/article/collect') }}", {
                                article_id: '{{ $article->article_id }}',
                                _method: 'delete',
                                _token: '{{ csrf_token() }}'
                            }, function (res) {
                                if (res.code === 0) {
                                    _this.html('已收藏')
                                }
                            })
                        }
                        state = !state
                    })
                }

                commentList();
                
                // 发表评论
                $('#comment').on('click', function () {
                    if ($('#comment_text').val().length > 5) {
                        $.post("{{ url('article/comment') }}", {
                            article_id: "{{ $article->article_id }}",
                            comment_text: $('#comment_text').val(),
                            _token: "{{ csrf_token() }}"
                        }, function (res) {
                            console.log(res)
                            $('#comment_container').html('')
                            commentList()
                        })
                    } else {
                        alert('字数太少')
                        return false;
                    }
                });
            })

            // 评论列表
            function commentList() {
                $.get("{{ url('article/comments').'/'.$article->article_id }}", function (res) {
                    console.log(res)
                    var html = ''
                    for(var i = 0; i < res.length; i++) {
                        html += `
                            <li>
                                <div class="form-group">
                                    <p class="lead"> ${ res[i].comment_text } </p>
                                    <div class="form-group clearfix">
                                        <small class="pull-left"> ${ res[i].name } </small>
                                        <small class="pull-right"> ${ res[i].comment_created_at } </small>
                                    </div>
                                    <input class="form-control" type="text"/>
                                </div>
                                <div class="form-group clearfix">
                                    @if(Auth::check())
                                        <input type="hidden" value="${ res[i].comment_id }">
                                        <button class="btn btn-default pull-right" onclick="commentForward($(this))">回复</button>
                                    @else
                                        <span class="pull-right">
                                            请先 <a href="{{ url('/article/comment').'/'.$article->article_id }}">登入</a>
                                        </span>
                                    @endif
                                </div>
                            `
                        for (var j = 0, forwards = res[i].forwards; j < forwards.length; j++) {
                            html += `<hr>
                                <div class="form-group">
                                    <p class="lead"> ${ forwards[j].forward_text } </p>
                                    <div class="form-group clearfix">
                                        <small class="pull-left"> ${ forwards[j].name } </small>
                                        <small class="pull-right"> ${ forwards[j].forward_created_at } </small>
                                    </div>
                                </div>
                            `
                        }

                        html += `</li><hr>`
                    }
                    $('#comment_container').append(html)
                })
            }

            // 评论回复
            function commentForward(_this) {
                var forward_text = _this.parent('div').prev('.form-group').children('input').val();
                if (forward_text.length > 5) {
                    $.post("{{ url('article/comment/forward') }}", {
                        comment_id: _this.prev().val(),
                        forward_text: forward_text,
                        _token: "{{ csrf_token() }}"
                    }, function (res) {
                        console.log(res)
                        $('#comment_container').html('')
                        commentList()
                    })
                } else {
                    alert('字数太少')
                    return false;
                }
            }
        @endif

        @if(!empty($isAffairCreateView) || !empty($isAffairDetailView) || !empty($isAffairEditView))
            // 保存事务
            var affair_id = null
            @if(!empty($isAffairEditView) || !empty($isAffairDetailView))
                // 事务编辑/详情页
                affair_id = '{{ $affair->affair_id }}'
            @endif
            
            $('#affair_save').on('click', function () {
                var affair_title = $('#affair_title').val()
                var affair_text = $('#affair_text').val()

                if ((affair_title.length > 5) && (affair_text.length > 10)) {
                    $.post("{{ url('user/affair/save') }}", {
                        affair_id: affair_id,
                        affair_title: affair_title,
                        affair_text: affair_text,
                        _token: '{{ csrf_token() }}'
                    }, function (res) {
                        console.log(res)
                        if(res.code === 0) {
                            window.location.href = "{{ url('user/affairs') }}"
                        }
                    })

                } else {
                    alert('字数太少')
                    return false
                }
            })

            // 提交事务
            $('#affair_submit').on('click', function () {
                var affair_title = $('#affair_title').val()
                var affair_text = $('#affair_text').val()
                if (affair_title.length > 5 && affair_text.length > 10) {
                    $.post("{{ url('user/affair/create') }}", {
                        affair_title: affair_title,
                        affair_text: affair_text,
                        _token: '{{ csrf_token() }}'
                    }, function (res) {
                        console.log(res)
                        if(res.code === 0) {
                            window.location.href = "{{ url('user/affairs') }}"
                        }
                    })

                } else {
                    alert('字数太少')
                    return false
                }
            })

        @endif

        // 取消事务
        function affairCancel(affair_id) {
            if(confirm('确定取消？')) {
                $.post("{{ url('user/affair/cancel') }}", {
                    affair_id: affair_id,
                    _token: '{{ csrf_token() }}'
                }, function (res) {
                    console.log(res)
                    if(res.code === 0) {
                        window.location.href = "{{ url('user/affairs') }}"
                    }
                })
            } else {
                return false;
            }
        }

        // 删除事务
        function affairDelete(affair_id) {
            if(confirm('确定删除？')) {
                $.post("{{ url('user/affair/delete') }}", {
                    affair_id: affair_id,
                    _token: '{{ csrf_token() }}'
                }, function (res) {
                    console.log(res)
                    if(res.code === 0) {
                        window.location.href = "{{ url('user/affairs') }}"
                    }
                })
            } else {
                return false;
            }
        }

    </script>
</body>
</html>
