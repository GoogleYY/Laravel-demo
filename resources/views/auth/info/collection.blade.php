@extends('auth.user')

@section('info')
  <div class="panel panel-warning corner-radius">
      <div class="panel-heading text-center">
          <h4 style="margin:0">A Life-long learner.</h4>
      </div>
  </div>
  <div class="panel panel-default">
      <div class="panel-heading">
          收藏列表
      </div>
        <section class="panel-body">
            @foreach($collections as $article)
                <div class="form-group">
                    <h4>
                        <a href="{{ url('article').'/'.$article->article_id }}">
                          {{ $article->article_title }}
                          <small class="pull-right">
                              最近更新
                              @if(($dur = time() - strtotime($article->article_updated_at)) >= 0)
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
        </section>
    </div>

@endsection
