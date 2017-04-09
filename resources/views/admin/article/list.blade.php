@extends('admin.common')

@section('title', '文章列表')

@section('content')
  
  <div class="col-md-12">
      <div class="card">
          <div class="header clearfix">
              <h4 class="title pull-left">文章列表</h4>
              <div class="pull-right">
                  <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      分类 <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-right ">
                          @foreach($categorys as $category)
                              <li>
                                  <a href="{{ url('admin/article/list').'?category_id='.$category->category_id }}">
                                      {{ $category->category_name }}
                                  </a>
                              </li>
                          @endforeach
                      </ul>
                  </div>
              </div>
          </div>
          <div class="content table-responsive table-full-width">
              <table class="table table-hover table-striped">
                  <thead>
                      <th>ID</th>
                      <th>Title</th>
                      <th>查看次数</th>
                      <th>状态</th>
                      <th>分类</th>
                      <th>创建时间</th>
                      <th>操作</th>
                  </thead>
                  <tbody>
                      @foreach($articles as $article)
                      <tr>
                         <td>{{ $article->article_id }}</td>
                         <td>{{ $article->article_title }}</td>
                         <td>{{ $article->article_view_counts }}</td>
                         <td>{{ $article->article_status == 0 ? '正常' : '已删除' }}</td>
                         <td>{{ $article->category_name }}</td>
                         <td>{{ $article->article_created_at }}</td>
                         <td>
                              <a href="{{ url('admin/article/comments').'/'.$article->article_id }}" class="btn btn-success">
                                 查看评论
                             </a>
                             <a href="{{ url('admin/article/modify').'/'.$article->article_id }}" class="btn btn-info">
                                 编辑
                             </a>
                             <a href="{{ url('admin/article/delete') }}" class="btn btn-danger">
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
  <div class="page_list clearfix">{{ $articles->links() }}</div>
  
@endsection