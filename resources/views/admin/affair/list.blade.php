@extends('admin.common')

@section('title', '事务列表')

@section('content')
<div class="col-md-12">
        <div class="card">
  <div class="header clearfix">
      <h4 class="title pull-left">事务列表</h4>
  </div>
  <div class="content table-responsive table-full-width">
      <table class="table table-hover table-striped">
          <thead>
              <th>ID</th>
              <th>标题</th>
              <th>状态</th>
              <th>创建时间</th>
              <th>操作</th>
          </thead>
          <tbody>
              @foreach($affairs as $affair)
              <tr>
                 <td>{{ $affair->affair_id }}</td>
                 <td>{{ $affair->affair_title }}</td>
                 <td>{{ $affair->affair_status == 2 ? '待处理' : '已处理' }}</td>
                 <td>{{ $affair->affair_created_at }}</td>
                 <td>
                     <a href="{{ url('admin/affair/hiddle').'/'.$affair->affair_id }}" class="btn btn-info">
                         处理
                     </a>
                 </td>
             </tr>
             @endforeach
         </tbody>
      </table>
      <div class="page_list">{{ $affairs->links() }}</div>
  </div>
  </div>
  </div>
@endsection