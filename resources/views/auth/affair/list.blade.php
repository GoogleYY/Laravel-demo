@extends('layouts.app')

@section('title', '事务列表')

@section('content')

<main class="container">
	<div class="form-group text-center">
		<h2>事务列表</h2>
	</div>
	<section class="form-group" style="margin-top: 40px">
		@foreach($affairs as $affair)
		<div class="form-group">
			<h4>
				<a href="{{ url('user/affair').'/'.$affair->affair_id }}">
					{{ $affair->affair_title }} 
					<small class="pull-right">{{ $affair->affair_updated_at }}</small>
				</a>
			</h4>
			<p class="lead clearfix">
				@if($affair->affair_status == 1)
					<span class="pull-left">草稿 </span>
					<button class="btn btn-success pull-right" onclick="affairCancel('{{ $affair->affair_id }}')" style="margin-left:15px">取消</button>
					<button class="btn btn-warning pull-right" onclick="affairDelete('{{ $affair->affair_id }}')">删除</button>
				@elseif($affair->affair_status == 2)
					<span class="pull-left">审核中</span>
				@elseif($affair->affair_status == 3)
					<span class="pull-left">已处理</span>
					<button class="btn btn-warning pull-right" onclick="affairDelete('{{ $affair->affair_id }}')">删除</button>
				@else
					<span class="pull-left">已取消</span>
					<button class="btn btn-warning pull-right" onclick="affairDelete('{{ $affair->affair_id }}')">删除</button>
				@endif
			</p>
		</div><hr>
		@endforeach
	</section>
</main>

@endsection