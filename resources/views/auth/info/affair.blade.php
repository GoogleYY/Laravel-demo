@extends('auth.user')

@section('info')

	<div class="panel panel-default">
		<div class="panel-heading">
    		事务列表
  		</div>
        <section class="panel-body">
            @foreach($affairs as $affair)
				<div class="form-group">
					<h4>
						<a href="{{ url('user/affair').'/'.$affair->affair_id }}">
							{{ $affair->affair_title }}
							<small class="pull-right">
								@if(($dur = time() - strtotime($affair->affair_updated_at)) >= 0)
			              		 	@if ($dur < 60)
						                {{ $dur }} 秒前
						            @elseif ($dur >= 60 && $dur < 3600)
						                {{ floor($dur / 60) }} 分钟前
						            @elseif ($dur >= 3600 && $dur < 86400)
						                {{ floor($dur / 3600) }} 小时前
						            @elseif ($dur >= 86400)
						                {{ floor($dur / 86400) }} 天前
						            @endif
			              		@endif
							</small>
						</a>
					</h4>
					<p class="lead clearfix">
						@if($affair->affair_status == 1)
							<span class="pull-left">草稿 </span>
							<button class="btn btn-sm btn-success pull-right" onclick="affairCancel('{{ $affair->affair_id }}')" style="margin-left:15px">取消</button>
							<button class="btn btn-sm btn-warning pull-right" onclick="affairDelete('{{ $affair->affair_id }}')">删除</button>
						@elseif($affair->affair_status == 2)
							<span class="pull-left">审核中</span>
						@elseif($affair->affair_status == 3)
							<span class="pull-left">已处理</span>
							<button class="btn btn-sm btn-warning pull-right" onclick="affairDelete('{{ $affair->affair_id }}')">删除</button>
						@else
							<span class="pull-left">已取消</span>
							<button class="btn btn-sm btn-warning pull-right" onclick="affairDelete('{{ $affair->affair_id }}')">删除</button>
						@endif
					</p>
				</div><hr>
			@endforeach
      	</section>

		<div class="panel-footer text-center" style="padding:15px">
			<div class="empty-block">
        		<a href="{{ url('user/affair/create') }}" class="btn btn-success no-pjax">
            		<i class="fa fa-paint-brush" aria-hidden="true"></i>  申请事务
          		</a>
     		</div>
		</div>
    </div>

@endsection
