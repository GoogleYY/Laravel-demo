<script src="{{ asset('resources/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/bootstrap-switch.js') }}"></script>
<script src="{{ asset('resources/assets/uploadify/jquery.uploadify.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/simplemde.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/masonry.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/prism.js') }}"></script>
<script src="{{ asset('resources/assets/js/layer.js') }}"></script>

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
                            $('#comment_empty_block').hide()
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
        })

        // 评论列表
        function commentList(field) {
            $('#comment_container').html('')
            $.get("{{ url('article/comments').'/'.$article->article_id }}", {
                orderBy: field ? field : 'comment_created_at'
            }, function (res) {
                res.length != 0 ? $('#comment_empty_block').hide() : $('#comment_empty_block').show()
                $('#forword_counts').html(res.length)
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
                    layer.msg(res.msg, {offset: '200px'})
                    if (res.code === 0) {
                        $('#forword_counts').html(parseInt($('#forword_counts').html()) + 1)
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
    $(function() {
        @if(Auth::check())
            $.get("{{ url('user/unread/comments') }}", function (res) {
                console.log(res)
                if (res && res.length > 0) {
                    $('#hasUnreadMsg').show();
                }
            })
        @endif
        // 图片上传
        if($('#file_upload') != undefined) {
            $('#file_upload').uploadify({
                'formData': {
                    'timestamp': "{{ time() }}",
                    '_token': "{{csrf_token()}}"
                },
                'buttonText': '更改头像',
                'swf': "{{ asset('resources/assets/uploadify/uploadify.swf') }}",
                'uploader': "{{ url('upload') }}",
                'onUploadSuccess': function (file, data, responce) {
                    $('#image_url').val(data);
                    $('#image_view').attr('src', '/' + data)
                }
            })
        }
    })

    // 事物创建页 || 事物详情页 || 事务编辑页
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
                if (affair_title.length <= 5) {
                    tips($('#affair_title'))
                } else if (affair_text.length <= 10) {
                    tips($('#affair_text'))
                }
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
                if (affair_title.length <= 5) {
                    tips($('#affair_title'))
                } else if (affair_text.length <= 10) {
                    tips($('#affair_text'))
                }
                return false
            }
        })

    @endif

    // 提示
    function tips(el) {
        layer.tips('多写点吧', el, {
            tips: [4, '#3595CC'],
            time: 3000
        })
    }

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
