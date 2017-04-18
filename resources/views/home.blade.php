@extends('layouts.common')

@section('title', '最新文章')

@section('content')

<main class="mastwrap">

    <div class="container">

        <div>
            <article class="col-md-9 pic-block big-block">
                <a class="shodow-box" href="{{ url('article').'/'.$articles[2]->article_id }}">
                    <img class="img-responsive" src="{{ $articles[2]->article_cover_url }}">
                    <div class="pic-header">
                        <h2>{{ $articles[2]->article_title }}</h2>
                        <p style="width:100%;overflow:hidden;text-overflow:ellipsis;white-space: nowrap">
                            {{ strip_tags($articles[2]->article_content) }}
                        </p>
                    </div>
                </a>
            </article>
            <article class="col-md-3 pic-block side-banner">
                <a class="shodow-box" href="{{ url('article').'/'.$articles[1]->article_id }}">
                    <img class="img-responsive" src="{{ $articles[1]->article_cover_url }}">
                    <h4>{{ $articles[1]->article_title }}</h4>
                </a>
            </article>
            <article class="col-md-3 pic-block side-banner">
                <a class="shodow-box" href="{{ url('article').'/'.$articles[0]->article_id }}">
                    <img class="img-responsive" src="{{ $articles[0]->article_cover_url }}">
                    <h4>{{ $articles[0]->article_title }}</h4>
                </a>
            </article>
            <article class="col-md-3 pic-block side-banner">
                <a class="shodow-box" href="{{ url('article').'/'.$articles[3]->article_id }}">
                    <img class="img-responsive" src="{{ $articles[3]->article_cover_url }}">
                    <h4>{{ $articles[3]->article_title }}</h4>
                </a>
            </article>
        </div>

        <div class="add-subscribe clearfix">
            <div class="col-md-6 pic-block">
                <div class="shodow-box">
                    <div class="subscribe-box">
                        <div class="subscribe-header">
                            <h2>
                                {{ $categorys[6]->category_name }}
                                <i class="fa fa-newspaper-o pull-right" aria-hidden="true"></i>
                            </h2>
                        </div>
                        <div class="subscribe-content">
                            <p>每周</p>
                            @foreach($articles->where('category_id', 7)->take(3) as $article)
                            <div class="lead">
                                <a href="{{ url('article').'/'.$article->article_id }}">
                                    {{ $article->article_title }}
                                </a>
                            </div>
                            @endforeach
                            <p>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>

            <article class="col-md-3 pic-block qrcode-pic-block">
                <div class="shodow-box" style="padding: 8px;">
                    <div class="grid-wrap">
                            <p class="lead">{{ $categorys[7]->category_name }}</p>
                        @foreach($articles->where('category_id', 8) as $article)
                            <a href="{{ url('article').'/'.$article->article_id }}" class="btn btn-default btn-block">
                                {{ $article->article_title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </article>

            @foreach($articles->where('category_id', 10)->take(1) as $article)
                <article class="col-md-3 pic-block">
                    <a class="shodow-box" href="{{ url('article').'/'.$article->article_id }}">
                        <img class="img-responsive" src="{{ asset($article->article_cover_url) }}">
                    </a>
                </article>
            @endforeach
        </div>

        <div class="add-top-half  home-list">

            <div class="block-header">
                <h2>
                    {{ $categorys[8]->category_name }}
                    <span class="pull-right read-more">
                        <a href="{{ url('article?category_id=9') }}">
                            <i class="fa fa-plus" aria-hidden="true"></i> 更多
                        </a>
                    </span>
                </h2>
            </div>

            @foreach($articles->where('category_id', 9)->take(3) as $article)
                <article class="col-md-4 pic-block">
                    <a class="shodow-box" href="{{ url('article').'/'.$article->article_id }}">
                        <img class="img-responsive" src="{{ $article->article_cover_url }}">
                        <h4>{{ $article->article_title }}</h4>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</main>
@endsection
