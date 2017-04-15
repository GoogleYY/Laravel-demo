@extends('layouts.common')

@section('title', '最新文章')

@section('content')

<main class="container main-container clearfix" style="padding-bottom:30px;">

    @include('layouts.tips')

    <section class="col-md-9 topics-index main-col" style="padding-left:0">
        <header class="alert alert-info" style="padding:15px">
            如果你浏览遇到难题，请先 <a href="#" onclick="$('input[name=search_text]').focus()">搜索 </a>
        </header>
        <main class="panel panel-default">
            <nav class="panel-heading">
                <ul class="list-inline topic-filter">
                    <li class="popover-with-html" data-content="最后回复排序" data-original-title="" title="">
                        <a href="#" class="active">最新动态</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </nav>
            <article class="jscroll">
                <div class="jscroll-inner">
                    <div class="panel-body remove-padding-horizontal">
                        <ul class="list-group row topic-list">
                            @if(count($articles) > 0)
                                @foreach($articles as $k => $article)
                                    <li class="list-group-item" style="border:none">
                                        <a class="reply_count_area hidden-xs pull-right">
                                            <div class="count_set">
                                                <span class="count_of_replies" title="回复数">
                                                    0
                                                    <i class="fa fa-comment-o"></i>
                                                </span>
                                                <span class="count_seperator" style="color:#ccc">/</span>
                                                <span class="count_of_visits" title="查看数">
                                                    {{ $article->article_view_counts }}
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                                <span class="count_seperator" style="color:#ccc">/</span>
                                                <abbr title="" class="timeago popover-with-html">
                                                    @if(($dur = time() - strtotime($article->article_updated_at)) >= 0)
                                                        @if ($dur < 60)
                                                            {{ $dur }} 秒前
                                                        @elseif ($dur >= 60 && $dur < 3600)
                                                            {{ floor($dur / 60) }} 分钟前
                                                        @elseif ($dur >= 3600 && $dur < 86400)
                                                            {{ floor($dur / 3600) }} 小时前
                                                        @elseif ($dur >= 86400)
                                                            {{ floor($dur / 86400) }} 天前
                                                        @endif
                                                    @else
                                                        {{ $article->article_updated_at }}
                                                    @endif
                                                </abbr>
                                            </div>
                                        </a>
                                        <div class="avatar pull-left">
                                            <div class="media-object avatar avatar-middle"
                                                 style="width:150px;height:106px;background:url('{{ $article->article_cover_url }}')
                                                        no-repeat center center;background-size:cover;margin-right:10px">
                                            </div>
                                        </div>
                                        <div class="infos">
                                            <div class="media-heading">
                                                <span class="hidden-xs label label-default">最新</span>
                                                <a href="{{ url('article').'/'.$article->article_id }}"
                                                 title="{{ $article->article_title }}">
                                                    {{ $article->article_title }}
                                                    <p style="max-height:90px;overflow:hidden;text-overflow:ellipsis;word-break: break-all;
                                                              -webkit-box-orient: vertical;-webkit-line-clamp:3">
                                                        {{ strip_tags($article->article_content) }}
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                <hr style="margin:15px 0 5px 0">
                                @endforeach
                            @else
                                <li class="list-group-item" style="border:none">
                                    没有数据
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="panel-footer text-right remove-padding-horizontal pager-footer"
                         style="display: none;">
                         <!-- Pager -->
                         <div class="page-list">{{ $articles->links() }}</div>
                    </div>
                </div>
            </article>
        </main>
    </section>

    @include('layouts.sider')
</main>

@endsection
