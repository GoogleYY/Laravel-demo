@extends('admin.common')

@section('title', '分类列表')

@section('search_none', 'visibility:hidden')

@section('delete_url', url('admin/category/delete'))

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">                   
            <div class="col-md-12">
                <div class="card">
                    <div class="header clearfix">
                        <h4 class="title pull-left">分类列表</h4>
                    </div>
	                <div class="content table-responsive table-full-width">
	                    <table class="table table-hover table-striped">
	                        <thead>
	                            <th>ID</th>
	                            <th>分类名称</th>
	                            <th>操作</th>
	                        </thead>
	                        <tbody>
	                            @foreach($categorys as $category)
	                            <tr>
	                               <td>{{ $category->category_id }}</td>
	                               <td>{{ $category->category_name }}</td>
	                               <td>
	                                   <a href="{{ url('admin/category/modify') }}" class="btn btn-info">
	                                       编辑
	                                   </a>
	                                   <a onclick="Delete('{{ $category->category_id }}')" class="btn btn-danger">
	                                       删除
	                                   </a>
	                               </td>
	                           </tr>
	                           @endforeach
	                       </tbody>
	                   </table>
	                   <div class="page_list">
	                    {{ $categorys->links() }}
	                </div>
            	</div>
        	</div>
    	</div>  
	</div>
</div>
@endsection