@extends('auth.user')

@section('info')

    <div class="panel panel-default">
        <div class="panel-heading">
            我的回复
        </div>
        <section class="panel-body">
            @foreach($forwards as $forward)
                <div class="form-group">
                    <h4>
                        <a href="{{ url('article').'/'.$forward->article_id.'?redirect=comments' }}"
                           class="btn-link btn-block">
                            {{ $forward->comment_text }}
                            <small class="pull-right">
                                @if(($dur = time() - strtotime($forward->forward_updated_at)) >= 0)
			              		 	@if ($dur < 60)
						                {{ $dur }} 秒前
						            @elseif ($dur >= 60 && $dur < 3600)
						                {{ floor($dur / 60) }} 分钟前
						            @elseif ($dur >= 3600 && $dur < 86400)
						                {{ floor($dur / 3600) }} 小时前
						            @elseif ($dur >= 86400 && $dur < 2592000)
						                {{ floor($dur / 86400) }} 天前
                                    @else
                                        {{ $forward->forward_updated_at }}
						            @endif
			              		@endif
                            </small>
                        </a>
                    </h4>
                </div><hr>
            @endforeach
            <nav class="page-list">
                {{ $forwards->links() }}
            </nav>
        </section>
    </div>
@endsection
