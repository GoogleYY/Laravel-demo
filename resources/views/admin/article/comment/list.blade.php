@extends('admin.common')

@section('title', '评论列表')

@section('content')
<div class="col-md-12">
        <div class="card">
  <div class="header clearfix">
      <h4 class="title pull-left">评论列表</h4>
  </div>
  <div class="content table-responsive table-full-width">
      <table class="table table-hover table-striped">
          <thead>
              <th>ID</th>
              <th>内容</th>
              <th>评论时间</th>
              <th>操作</th>
          </thead>
          <tbody>
              @foreach($comments as $comment)
              <tr>
                 <td>{{ $comment->comment_id }}</td>
                 <td>{{ $comment->comment_text }}</td>
                 <td>{{ $comment->comment_created_at }}</td>
                 <td>
                     <a href="{{ url('admin/article/delete') }}" class="btn btn-danger">
                         删除
                     </a>
                 </td>
             </tr>
             @endforeach
         </tbody>
      </table>
      <div class="page_list">{{ $comments->links() }}</div>
  </div>
  </div>
  </div>
@endsection   