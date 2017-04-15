@extends('auth.user')

@section('info')

@if(count($errors) > 0)
    <div class="panel panel-warning">
        <div class="panel-heading panel-warning">
            @if(is_object($errors))
                @foreach($errors->all() as $error)
                    {{$error}} !
                @endforeach
            @else
                {{$errors}}
            @endif
        </div>
@else
    <div class="panel panel-default">
    	<div class="panel-heading">
    		编辑个人资料
    	</div>
@endif
	<form class="panel-body" style="padding:15px 100px" action="" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group text-center">
			<h4>用户名</h4>
			<input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
		</div>
        <hr style="border-color:transparent">
        <div class="form-group text-center">
            <h4>性别</h4>
            <label class="checkbox-inline">
                <input type="radio" name="sex" id="optionsRadios3" value="0" checked>
                <i class="fa fa-mars" style="font-size:14px;font-weight:700;color:#47A4FF"></i>
            </label>
            <label class="checkbox-inline">
                <input type="radio" name="sex" id="optionsRadios4" value="1">
                <i class="fa fa-venus" style="font-size:16px;font-weight:700;color:pink"></i>
            </label>
        </div>
        <hr style="border-color:transparent">
		<div class="form-group text-center">
            <span class="btn btn-default" id="file_upload" style="cursor:pointer;">
                选择文件
            </span>
            <input type="hidden" class="form-control" name="avatar" value="{{ Auth::user()->avatar }}"
                   id="image_url" placeholder="图片路径">
            <div class="text-center">
                <img src="{{ asset(Auth::user()->avatar) }}" id="image_view"
                     style="width:150px" alt="头像">
            </div>
		</div>
        <hr>
		<div class="form-group clearfix">
			<div class="text-center" style="word-spacing:15px">
				<a href="{{ url('user/affairs') }}" class="btn btn-default">取消</a>
				<button type="submit" class="btn btn-success" id="affair_submit">提交</button>
			</div>
		</div>
	</section>
</div>

@endsection
