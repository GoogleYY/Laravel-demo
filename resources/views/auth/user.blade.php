@extends('layouts.app')

@section('title', '个人中心')

@section('content')

<main class="container">
	<section class="text-center">
		<img src="{{ asset($userInfo['avatar']) }}">
		<h1>{{ $userInfo['name'] }}</h1>
		<h3>{{ $userInfo['email'] }}</h3>
		<p>{{ $userInfo['created_at'] }}</p>
	</section>

	<hr>

	<section>
		<h3>我的收藏</h3>
		@foreach($collections as $collection)
			<div>
				<a href="{{ url('article').'/'.$collection->article_id }}">
					<h3>
						{{ $collection->article_title }}
						<small>{{ $collection->created_at }}</small>
					</h3>
					<p class="lead">
						@if($collection->article_cover_url)
							<img src="{{ asset($collection->article_cover_url) }}"
								 style="max-height: 60px">
						@endif
						{{ $collection->article_content }}
					</p>
				</a>
			</div>
		@endforeach
	</section>

	<hr>

	<section>
		<h3 class="form-group">待办事务</h3>
		<h4><a href="{{ url('user/affairs') }}">查看</a></h4>
	</section>
	
</main>

@endsection