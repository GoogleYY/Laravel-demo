@extends('layouts.app')

@section('title', '申请事务')

@section('content')

<main class="container">
	<div class="form-group text-center">
		<h2>申请事务</h2>
	</div>
	<div class="form-group">
		<label>标题</label>
		<input type="text" id="affair_title" class="form-control">
	</div>
	<div class="form-group">
		<label>内容</label>
		<textarea id="affair_text" class="form-control" rows="8"></textarea> 
	</div>
	<div class="form-group clearfix">
		<div class="pull-right" style="word-spacing:15px">
			<a href="{{ url('user/affairs') }}" class="btn btn-default">取消</a>
			<button class="btn btn-info" id="affair_save">保存草稿</button>
			<button class="btn btn-success" id="affair_submit">提交</button>
		</div>
	</div>
</main>

@endsection