@extends('auth.user')

@section('info')

	<div class="panel panel-default">
		<div class="panel-heading">
    		未读消息列表
  		</div>
        <section class="panel-body">
            @if(count($unreadComments) > 0)
            @foreach($unreadComments as $comment)
				<div class="form-group">
					<h4>
						<a href="{{ url('user/affair').'/'.$affair->affair_id }}">
							{{ $comment->comment_text }}
							<small class="pull-right">
								@if(($dur = time() - strtotime($comment->comment_updated_at)) >= 0)
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
				</div><hr>
			@endforeach
            @else
                <div class="form-group">
                    <p class="lead">暂无未读消息</p>
                </div>
            @endif
      	</section>
    </div>

@endsection
