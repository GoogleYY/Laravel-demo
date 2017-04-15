@extends('layouts.common')

@section('title', $article->article_title)

@section('content')

<main class="container">

	@include('layouts.tips')

	<section class="col-md-9 topics-show main-col" style="padding-left:0">
        <div class="topic panel panel-default">
          	<div class="infos panel-heading" style="padding:15px">
            	<div class="meta inline-block clearfix">
	            	<h1 class="panel-title topic-title pull-left" style="font-size:20px">
						{{ $article->article_title }}
						<small>
							<a href="{{ url('article?category_id=').$article->category_id }}">
								&nbsp;<i class="fa fa-folder text-md" aria-hidden="true"></i>
								{{ $article->category_name }}
							</a>
						</small>
					</h1>
	              	<a class="btn btn-xs btn-warning pull-right" id="collect" style="margin-left:15px">
						{{ $isCollected ? '已收藏' : '收藏' }}
					</a>
	              	<abbr class="timeago popover-with-html pull-right" style="margin-left:15px">
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
					<span class="pull-right" style="margin-left:15px">
						<i class="fa fa-eye"></i>
						<code>{{ $article->article_view_counts }}</code> |
					</span>
	              	<span class="pull-right">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>:
						<code>{{ $article->article_author }}</code> |
					</span>
            	</div>
          	</div>

          	<div class="content-body entry-content panel-body ">
            	<div class="markdown-body lead" id="emojify">
            		@if($article->article_cover_url)
            			<img src="{{ asset($article->article_cover_url) }}" style="display:block;min-width:95%">
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
            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="" aria-labelledby="exampleModalLabel">
              	<div class="modal-dialog">
                	<div class="modal-content">
                  	<div class="modal-header">
                   		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   			<span aria-hidden="true">×</span>
               			</button>
                    	<h4 class="modal-title" id="exampleModalLabel">添加附言</h4>
                  	</div>

                  	<form method="POST" action="https://laravel-china.org/topics/4407/append" accept-charset="UTF-8">
	                   	<input type="hidden" name="_token" value="XYxqvnczuYsTBbGJLo5PbAHGrXsvkgc3TCkxtU3d">
	                   	<div class="modal-body">
		                   	<div class="alert alert-warning">
		                    	附加内容, 使用此功能的话, 会给所有参加过讨论的人发送提醒.
		                  	</div>

		                  	<div class="form-group">
		                    	<textarea class="form-control" style="min-height: 20px; overflow: hidden; word-wrap: break-word; resize: horizontal; height: 284px;" placeholder="请使用 Markdown 格式书写 ;-)，代码片段黏贴时请注意使用高亮语法。" name="content" cols="50" rows="10"></textarea>
		                  	</div>
		                </div>

		                <div class="modal-footer">
		                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		                  <button type="submit" class="btn btn-primary">提交</button>
		                </div>

	              	</form>

            	</div>
          	</div> -->
        </div>

        <div class="replies panel panel-default list-panel replies-index" id="replies">

		    <div class="panel-heading clearfix">
		        <div class="total pull-left">
		        	回复数量: <span id="forword_counts"></span>
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
