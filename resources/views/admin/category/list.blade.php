@extends('admin.common')

@section('title', '分类列表')

@section('search_none', 'display:none')

@section('delete_url', url('admin/category/delete'))

@section('content')              
    <div class="col-md-12">
        <div class="card">
            <div class="header clearfix">
                <h4 class="title pull-left">分类列表</h4>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped text-center">
                    <thead>
                        <th style="text-align:center">ID</th>
                        <th style="text-align:center">分类名称</th>
                        <th style="text-align:center">文章数量</th>
                        <th style="text-align:center">操作</th>
                    </thead>
                    <tbody>
                        @foreach($categorys as $category)
                        <tr>
                           <td>{{ $category->category_id }}</td>
                           <td>{{ $category->category_name }}</td>
                           <td>{{ $category->article_count }}</td>
                           <td>
                               <a href="{{ url('admin/category/modify').'/'.$category->category_id }}" class="btn btn-info">
                                   编辑
                               </a>
                               <a onclick="Delete('{{ url("admin/category/delete") }}', '{{ $category->category_id }}', 'delete')" 
                               	  class="btn btn-danger">
                                   删除
                               </a>
                           </td>
                       </tr>
                       @endforeach
                   </tbody>
               	</table>
    		</div>
		</div>
	</div>
@endsection