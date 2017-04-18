@extends('layouts.common')

@section('title', $article->article_title)

@section('content')

<link rel="stylesheet" href="{{ asset('resources/assets/css/markdown.css') }}">

<main class="container">

	@include('layouts.tips')

	<section class="col-md-9 topics-show main-col" style="padding-left:0">
        <div class="topic panel panel-default">
          	<div class="infos panel-heading" style="padding:15px">
            	<div class="meta inline-block clearfix">
	            	<h1 class="panel-title topic-title pull-left article-title" style="font-size:24px">
						{{ $article->article_title }}
						<small>
							<a href="{{ url('article?category_id=').$article->category_id }}">
								&nbsp;<i class="fa fa-folder text-md" aria-hidden="true"></i>
								{{ $article->category_name }}
							</a>
						</small>
					</h1>
					<div class="pull-right article-info">
		              	<span>
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>:
							<code>{{ $article->article_author }}</code> |
						</span>
						<span style="margin-left:15px">
							<i class="fa fa-eye"></i>
							<code>{{ $article->article_view_counts }}</code> |
						</span>
		              	<abbr class="timeago popover-with-html" style="margin-left:15px">
							<i class="fa fa-clock-o"></i>
		              		@if(($dur = time() - strtotime($article->article_updated_at)) >= 0)
		              		 	@if ($dur < 60)
					                <code>{{ $dur }}</code> 秒前 |
					            @elseif ($dur >= 60 && $dur < 3600)
					                <code>{{ floor($dur / 60) }}</code> 分钟前 |
					            @elseif ($dur >= 3600 && $dur < 86400)
					                <code>{{ floor($dur / 3600) }}</code> 小时前 |
					            @elseif ($dur >= 86400)
					                <code>{{ floor($dur / 86400) }}</code> 天前 |
					            @endif
		              		@endif
		              	</abbr>
						@if(Auth::check())
			              	<a class="btn btn-xs btn-warning" id="collect" style="margin-left:15px">
								{!! $isCollected ?
									'<i class="fa fa-heart"></i> 已收藏' :
									'<i class="fa fa-heart-o"></i> 收藏'
								!!}
							</a>
						@else
							<a class="btn btn-xs btn-warning"
							   href="{{ url('/article/comment').'/'.$article->article_id }}"
							   style="margin-left:15px">
								<i class="fa fa-heart-o"></i> 收藏
							</a>
						@endif
					</div>
            	</div>
          	</div>

          	<div class="content-body entry-content panel-body ">
            	<div class="markdown-body lead" id="emojify">
            		@if($article->article_cover_url)
            			<img src="{{ asset($article->article_cover_url) }}">
            		@endif
              		{!! $article->article_content !!}
                </div>
          	</div>
          	<div class="panel-footer operate">
                <div class="form-group clearfix" style="padding:0 30px">
					@if($prev_id)
						<a href="{{ url('article').'/'.$prev_id }}" class="btn btn-info pull-left">上一页</a>
					@else
						<a class="btn btn-default pull-left" disabled>没有了</a>
					@endif

					@if($next_id)
						<a href="{{ url('article').'/'.$next_id }}" class="btn btn-info pull-right">下一页</a>
					@else
						<a class="btn btn-default pull-right" disabled>没有了</a>
					@endif
				</div>
            </div>
        </div>

        <div class="replies panel panel-default list-panel replies-index" id="replies">

		    <div class="panel-heading clearfix">
		        <div class="total pull-left">
		        	总共<code id="forword_counts"></code>条评论
	        	</div>
		        <div class="order-links pull-right">
		            <a class="btn btn-default btn-sm active popover-with-html"
		               onclick="$(this).addClass('active').next('a').removeClass('active');commentList()">
		               	最新
	               	</a>
		            <a class="btn btn-default btn-sm popover-with-html"
		               onclick="$(this).addClass('active').prev('a').removeClass('active');commentList('comment_updated_at')">
		               	最热
	               	</a>
		        </div>
		    </div>

		    <div class="panel-body">
		    	<div class="form-group">
		    		<textarea id="comment_text" class="form-control" rows="2"></textarea>
		    	</div>

				<div class="form-group clearfix">
					<h4 class="pull-left">评论一下喽</h4>
					@if(Auth::check())
						<button class="btn btn-info pull-right" id="comment">评论</button>
					@else
						<h4 class="pull-right">
							请先 <a href="{{ url('/article/comment').'/'.$article->article_id }}">登入</a>
						</h4>
					@endif
				</div>
				<div class="form-group">
					<div id="comment_container" class="list-group"></div>
				</div>

				<div id="comment_empty_block" class="empty-block">暂无评论~~</div>
		    </div>
	  	</div>

    </section>

    @include('layouts.sider')
</main>

@endsection
