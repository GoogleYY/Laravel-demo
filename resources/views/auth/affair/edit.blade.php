@extends('layouts.app')

@section('title', '编辑事务')

@section('content')

<main class="container">
	<div class="form-group text-center">
		<h2>编辑事务</h2>
	</div>
	<p class="text-center">
		上次编辑 {{ $affair->affair_updated_at }}
	</p><hr>
	<section>
		<div class="form-group">
			<label>标题</label>
			<input type="text" id="affair_title" value="{{ $affair->affair_title }}" class="form-control">
		</div>
		<div class="form-group">
			<label>详情</label>
			<textarea id="affair_text" class="form-control" rows="8">
				{{ $affair->affair_text }}
			</textarea> 
		</div>
		<div class="form-group clearfix">
			<div class="pull-right" style="word-spacing:15px">
				<a href="{{ url('user/affairs') }}" class="btn btn-default">回到列表</a>
				<button class="btn btn-warning" id="affair_cancel">取消</button>
				<button class="btn btn-info" id="affair_save">保存草稿</button>
				<button class="btn btn-success" id="affair_submit">提交</button>
			</div>
		</div>
	</section>
	
</main>

@endsection