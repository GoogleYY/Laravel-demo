@extends('layouts.common')

@section('title', '我有问题')

@section('content')

<main class="container main-container ">
    <div class="users-show">
        <aside class="col-md-3 side-bar">
          	<widget class="box">
          		<div class="panel panel-default corner-radius">
                    <div class="panel-heading paner-danger text-center">
                        以下类型的信息会污染我们的社区
                    </div>
		            <div class="panel-body topic-author-box">
                        <p>请传播美好的事物，这里拒绝低俗、诋毁、谩骂等相关信息</p>
                        <p>请尽量分享技术相关的话题，谢绝发布社会, 政治等相关新闻，这里绝对不讨论任何有关盗版软件、音乐、电影如何获得的问题...</p>
		            </div>
		        </div>
          	</widget>

            <widget class="box">
             	<div class="padding-sm user-basic-nav">
                    <div class="panel panel-default corner-radius">
                        <div class="panel-heading paner-danger text-center">
                            也许这些内容可以帮助到你
                        </div>
    		            <div class="panel-body topic-author-box lead">
                            @foreach([1,2,3,4,5] as $a)
                                <p style="font-size:18px">
                                    <a href="#" class="btn-link">
                                //////////
                                    </a>
                                </p>
                            @endforeach
    		            </div>
    		        </div>
            	</div>
          	</widget>
      	</aside>

      	<section class="main-col col-md-9 left-col">
            @if(count($errors) > 0)
                <div class="panel panel-warning">
                    <div class="panel-heading panel-warning">
                        @if(is_object($errors))
                            @foreach($errors->all() as $error)
                                {{$error}} !
                            @endforeach
                        @else
                            {{$errors}}
                        @endif
                    </div>
            @else
                <div class="panel panel-default">
                	<div class="panel-heading">
                		描述您的问题
                	</div>
            @endif
            	<form class="panel-body" style="padding:25px 20px">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
            		<div class="form-group text-center">
            			<input type="text" class="form-control" placeholder="简述问题(不低于6个字)"
                               name="article_title" style="box-shadow:none">
            		</div>
                    <hr style="border-color:transparent">
                    <div class="form-group text-center article_cover_upload">
                        <div class="form-group">
                            <span id="file_upload">选择封面</span>
                            <input type="hidden" class="form-control" name="article_cover_url"
                                   id="image_url">
                            <div class="form-group">
                                <img class="thumbnail" src="" alt="" id="image_view">
                            </div>
                        </div>
                    </div>
                    <hr style="border-color:transparent">
            		<div class="form-group text-center">
                        <div class="form-group row">
                            <div class="form-group col-sm-4">
                                <select class="form-control" name="province_id"
                                id="province" style="box-shadow:none"></select>
                            </div>
                            <div class="form-group col-sm-4">
                                <select class="form-control" name="city_id"
                                id="city" style="box-shadow:none"></select>
                            </div>
                            <div class="form-group col-sm-4">
                                <select class="form-control" name="area_id"
                                id="area" style="box-shadow:none"></select>
                            </div>
                        </div>
            		</div>
                    <div class="form-group text-center">
                        <textarea name="article_content" class="form-control" id="editor" rows="10" cols="80"></textarea>
                    </div>
                    <hr>
            		<div class="form-group clearfix">
            			<div class="text-center" style="word-spacing:15px">
            				<a onclick="history.go(-1)" class="btn btn-default">取消</a>
            				<button type="button" class="btn btn-success" id="quest_submit">提交</button>
            			</div>
            		</div>
            	</section>
            </div>
    	</section>
  	</div>
</main>

@endsection
