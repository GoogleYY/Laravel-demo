@extends('admin.common')

@section('title', '编辑分类')

@section('search_none', 'display:none')

@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="header clearfix">
    	@if(count($errors)>0)
        <h4 class="title pull-left" style="color:#FF4201">
        	@if(is_object($errors))
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
            @else
                {{$errors}}
            @endif
        </h4>
        @else
          <h4 class="title pull-left">分类编辑</h4>
        @endif
        <button onclick="window.history.go(-1)" class="btn btn-default pull-right">
            返回
        </button>
    </div>
    <div class="content">
       	<form action="" method="POST">
       		{{ csrf_field() }}
       		<div class="form-group">
       			<label>分类名</label>
       			<input type="text" class="form-control" value="{{ $category->category_name }}" name="category_name">
       		</div>

       		<div class="form-group">
       			<button type="submit" class="btn btn-info">提交</button>
       		</div>
       	</form>
    </div>
    </div>
</div>
@endsection