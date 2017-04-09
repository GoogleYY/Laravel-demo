@extends('layouts.app')

@section('title', '最新文章')

@section('content')
<div class="container">
    @foreach($articles as $article)
    <a href="{{ url('article').'/'.$article->article_id }}" class="panel panel-default">
        <div class="panel-heading">{{ $article->article_title }}</div>
        <div class="panel-body">
            @if($article->article_cover_url)
                <img src="{{ asset($article->article_cover_url) }}" class="pull-left" 
                     style="max-height:100px;margin-right:10px">
            @endif
            {{ $article->article_content }}
        </div>
    </a><hr>
    @endforeach
</div>
@endsection
