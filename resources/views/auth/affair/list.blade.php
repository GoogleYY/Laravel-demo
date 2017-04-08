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
			<p class="lead">
				@if($affair->affair_status == 1)
					草稿
				@elseif($affair->affair_status == 2)
					审核中
				@elseif($affair->affair_status == 3)
					已处理
				@else
					已取消
				@endif
			</p>
		</div><hr>
		@endforeach
	</section>
</main>

@endsection