@extends('layouts.app')

@section('title', '事务详情')

@section('content')

<main class="container">
	<div class="form-group text-center">
		<h2>事务详情</h2>
	</div>
	<section class="form-group" style="margin-top: 40px">
		<h4 class="text-center">
			{{ $affair->affair_title }}
		</h4>
		<h5 class="text-center"><small>{{ $affair->affair_updated_at }}</small></h5>
		<hr>

		<p class="lead">
			{{ $affair->affair_text }}
		</p>
	</section>
	<hr>
	<footer class="text-center" style="word-spacing: 15px">
		@if($affair->affair_status == 1)
			<a class="btn btn-info" href="{{ url('user/affairs') }}">返回列表</a>
			<a class="btn btn-primary" href="{{ url('user/affair/edit').'/'.$affair->affair_id }}">编辑</a>
		@elseif($affair->affair_status == 2)
			<a class="btn btn-info" href="{{ url('user/affairs') }}">返回列表</a>
			<a class="btn btn-default" disabled>审核中</a>
		@elseif($affair->affair_status == 3)
			<a class="btn btn-info" href="{{ url('user/affairs') }}">返回列表</a>
			<a class="btn btn-success" disabled>已处理</a>
		@else
			<a class="btn btn-info" href="{{ url('user/affairs') }}">返回列表</a>
			<a class="btn btn-default" disabled>已取消</a>
		@endif
	</footer>
</main>

@endsection