@extends('admin.common')

@section('title', '首页')

@section('search_none', 'display:none')

@section('content')
	<div class="col-md-12">
        <div class="card">
            <div class="header clearfix">
                <h4 class="title pull-left">文章浏览量</h4>
	            <div class="pull-right">
	                  <div class="btn-group">
	                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                      分类 <span class="caret"></span>
	                      </button>
	                      <ul class="dropdown-menu dropdown-menu-right ">
	                      	   <li>
	                      	   		<a href="{{ url('admin/dash') }}">全部</a>
	                      	   </li>
	                          @foreach($categorys as $category)
	                              <li>
	                                  <a href="{{ url('admin/dash').'?category_id='.$category->category_id }}">
	                                      {{ $category->category_name }}
	                                  </a>
	                              </li>
	                          @endforeach
	                      </ul>
	                  </div>
	              </div>
            </div>
			<div id="main" style="min-height:500px;width:100%"></div>
		</div>
	</div>

@endsection
