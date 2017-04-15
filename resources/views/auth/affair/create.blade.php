@extends('auth.user')

@section('info')

<div class="panel panel-default">
	<div class="panel-heading">
		申请事务
	</div>
	<section class="panel-body">
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
	</section>
</div>

@endsection
