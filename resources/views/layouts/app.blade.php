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
    <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap-switch.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/markdown.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/share.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/main.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app" style="padding-top:70px">
        <nav class="navbar navbar-inverse navbar-fixed-top">
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
                            <li>
                                <a href="{{ url('user/personal') }}" id="hasUnreadMsg" 
                                   class="glyphicon glyphicon-comment" style="display:none;color:#428BCA">
                                    你有新的评论回复
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('/user/personal') }}">个人中心</a>
                                    </li>
                                    <li style="margin-top: 10px">
                                        <a href="{{ url('user/affairs') }}">代办事项</a>
                                    </li>
                                    <li style="margin-top: 10px">
                                        <a href="{{ url('/logout') }}">退出</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        </div>

        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('resources/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap-switch.js') }}"></script>
    <script src="{{ asset('resources/assets/js/simplemde.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/masonry.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/prism.js') }}"></script>
    <script src="{{ asset('resources/assets/js/layer.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            @if(!empty($isArticleDetail))
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
                                layer.msg(res.msg, {offset: '200px'})
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
                                layer.msg(res.msg, {offset: '200px'})
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
                            layer.msg(res.msg, {offset: '200px'})
                            if(res.code === 0) {
                                $('#comment_text').val('')
                                var lis = $('#comment_container > .media')
                                var comment = res.comment
                                var html = `
                                    <div class="media">
                                        <div class="media-left">
                                            <img class="media-object" src="{{ url('${comment.avatar}') }}"
                                                 style="width:50px"/>
                                        </div>
                                        <div class="media-body" style="width:100%">
                                            <h4 style="display:flex;align-items:center;justify-content:space-between">
                                                #${lis.length + 1}楼 &nbsp; ${ comment.name }
                                                <small>${ comment.comment_created_at }</small>
                                            </h4>
                                            <p class="lead"> ${ comment.comment_text } </p>
                                        </div>
                                        <div class="input-group">
                                            <input type="hidden" value="${ comment.comment_id }">
                                            <input type="text" class="form-control" placeholder="回复评论">
                                            <span class="input-group-btn">
                                                @if(Auth::check())
                                                    <button class="btn btn-default pull-right" onclick="commentForward($(this))">回复</button>
                                                @else
                                                    请先 <a href="{{ url('/article/comment').'/'.$article->article_id }}">登入</a>
                                                @endif
                                            </span>
                                        </div>
                                    </div>`
                                $('#comment_container').prepend(html);
                            }
                        })
                    } else {
                        layer.msg('字数太少', {icon: 5, offset: '200px'})
                        return false;
                    }
                });

                // 评论列表
                function commentList() {
                    $.get("{{ url('article/comments').'/'.$article->article_id }}", function (res) {
                        console.log(res)
                        var html = ''
                        for(var i = 0; i < res.length; i++) {
                            html += `<div class="media">
                                <div class="media-left">
                                    <img class="media-object" src="{{ url('${res[i].avatar}') }}"
                                         style="width:50px"/>
                                </div>
                                <div class="media-body" style="width:100%">
                                    <h4 style="display:flex;align-items:center;justify-content:space-between">
                                        #${res.length - i}楼 &nbsp; ${ res[i].name }
                                        <small>${ res[i].comment_created_at }</small>
                                    </h4>
                                    <p class="lead"> ${ res[i].comment_text } </p>
                                </div>
                                <div class="input-group">
                                    @if(Auth::check())
                                        <input type="text" class="form-control" placeholder="回复评论">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default pull-right" onclick="commentForward($(this), ${res[i].comment_id})">
                                                回复
                                            </button>
                                        </span>
                                    @else
                                        <input type="text" class="form-control" placeholder="登入后才能回复" disabled>
                                        <span class="input-group-btn">
                                            <a class="btn btn-default pull-right" href="{{ url('/article/comment').'/'.$article->article_id }}">
                                                登入
                                            </a>
                                        </span>
                                    @endif
                                </div>
                                <div class="forward-list clearfix">`
                            for (var j = 0, forwards = res[i].forwards; j < forwards.length; j++) {
                                html += `<hr>
                                    <blockquote class="lead" style="margin:0;font-size:14px"> ${ forwards[j].forward_text } </blockquote>
                                    <h4 class="pull-right" style="margin:0">
                                        <small style="margin-right:10px"> ${ forwards[j].name } </small>
                                        <small> ${ forwards[j].forward_created_at } </small>
                                    </h4>`
                            }

                            html += `</div></div><hr>`
                        }
                        $('#comment_container').append(html)
                    })
                }

                // 评论回复
                function commentForward(_this, comment_id) {
                    var forward_text = _this.parent('span').prev('input');
                    if (forward_text.val().length > 5) {
                        $.post("{{ url('article/comment/forward') }}", {
                            comment_id: comment_id,
                            forward_text: forward_text.val(),
                            _token: "{{ csrf_token() }}"
                        }, function (res) {
                            console.log(res)
                            layer.msg(res.msg, {offset: '200px'})
                            if (res.code === 0) {
                                forward_text.val('')
                                var forwards = res.forward
                                var html = `<hr>
                                    <blockquote class="lead" style="margin:0;font-size:14px"> ${ forwards.forward_text } </blockquote>
                                    <h4 class="pull-right" style="margin:0">
                                        <small style="margin-right:10px"> ${ forwards.name } </small>
                                        <small> ${ forwards.forward_created_at } </small>
                                    </h4>`
                                _this.parent('span').parent('div').next('.forward-list').prepend(html)
                            }
                        })
                    } else {
                        layer.msg('字数太少', {icon: 5, offset: '200px'})
                        return false;
                    }
                }
            @endif

            // 未读消息
            @if(Auth::check())
                $.get("{{ url('user/unread/comments') }}", function (res) {
                    console.log(res)
                    if (res && res.length > 0) {
                        $('#hasUnreadMsg').show();
                    }
                })
            @endif
        })

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
                        layer.msg(res.msg, {offset: '200px'})
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
                        layer.msg(res.msg, {offset: '200px'})
                        if(res.code === 0) {
                            setTimeout(function(){
                                window.location.href = "{{ url('user/affairs') }}"
                            }, 300)
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
            layer.confirm('确定取消？', function(index){
                $.post("{{ url('user/affair/cancel') }}", {
                    affair_id: affair_id,
                    _token: '{{ csrf_token() }}'
                }, function (res) {
                    console.log(res)
                    layer.msg(res.msg, {offset: '200px'})
                    if(res.code === 0) {
                        setTimeout(function(){
                            window.location.href = "{{ url('user/affairs') }}"
                        }, 300)
                    }
                })
                layer.close(index);
            });
        }

        // 删除事务
        function affairDelete(affair_id) {
            layer.confirm('确定删除？', function (index){
                $.post("{{ url('user/affair/delete') }}", {
                    affair_id: affair_id,
                    _token: '{{ csrf_token() }}'
                }, function (res) {
                    console.log(res)
                    layer.msg(res.msg, {offset: '200px'})
                    if(res.code === 0) {
                        setTimeout(function(){
                            window.location.href = "{{ url('user/affairs') }}"
                        }, 300)
                    }
                })
                layer.close(index);
            })
        }

    </script>
</body>
</html>
