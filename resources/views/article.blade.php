@extends('layouts.app')

@section('title', $article->article_title)

@section('content')

<main class="container">
	<h1 class="h1">
		{{ $article->article_title }}
		<small>{{ $article->category_name }}</small>
		<a class="btn btn-success pull-right" id="collect">
			{{ $isCollected ? '已收藏' : '收藏' }}
		</a>
	</h1>
	<div>
		作者<span>{{ $article->article_author }}</span>
		<span>{{ $article->province_name.' '.$article->city_name.' '.$article->area_name }}</span>
		浏览次数<mark>{{ $article->article_view_counts }}</mark><br>
		发布时间<span>{{ $article->article_created_at }}</span>
	</div>
	<hr>
	<img src="{{ asset($article->article_cover_url) }}" class="pull-left" style="max-width:100%;margin-right:10px;margin-bottom:2px">
	<p class="lead">{{ $article->article_content }}</p>

	<div class="form-group clearfix">
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
	</div><hr>

	<div class="form-group">
		<input type="text" id="comment_text" class="form-control">
	</div>
	<div class="form-group clearfix">
		<h5 class="pull-left">评论一下喽</h5>
		@if(Auth::check())
			<button class="btn btn-info pull-right" id="comment">评论</button>
		@else
			<span class="pull-right">
				请先 <a href="{{ url('/article/comment').'/'.$article->article_id }}">登入</a>
			</span>
		@endif
	</div>
	<div class="form-group">
		<ul id="comment_container"></ul>
	</div>
</main>

@endsection