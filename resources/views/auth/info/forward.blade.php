@extends('auth.user')

@section('info')

    <div class="panel panel-default">
        <div class="panel-heading">
            事务列表
        </div>
        <section class="panel-body">
            @foreach($forwards as $forward)
                <div class="form-group">
                    <h4>
                        <a href="{{ url('article').'/'.$forward->article_id }}">
                            {{ $forward->comment_text }}
                            <small class="pull-right">{{ $forward->forward_updated_at }}</small>
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
