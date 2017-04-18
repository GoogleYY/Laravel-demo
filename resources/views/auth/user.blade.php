@extends('layouts.common')

@section('title', '个人中心')

@section('content')

<main class="container main-container ">
    <div class="users-show">
        <aside class="col-md-3 side-bar">
          	<widget class="box text-center">
          		<div class="panel panel-default corner-radius">
		            <div class="panel-body text-center topic-author-box">
		                <a href="#">
		                  <img src="{{ asset(Auth::user()->avatar) }}" style="width:80px; height:80px;margin:5px;" class="img-thumbnail avatar">
		                </a>
		                <div class="text-center" style="padding:3px">
                            @if(Auth::user()->sex == 1) {{-- 男 --}}
                                <i class="fa fa-mars" style="font-weight:700;color:#47A4FF"></i>
                            @elseif(Auth::user()->sex == 2) {{-- 女 --}}
                                <i class="fa fa-venus" style="font-weight:700;color:pink"></i>
                            @else {{-- 0v0 --}}
                                <i class="fa fa-transgender" style="font-weight:700;color:#666"></i>
                            @endif
		                </div>
		                <span class="text-white">
		                    <p class="lead"> {{ Auth::user()->name }} </p>
		                    <p> {{ Auth::user()->email }} </p>
		                    <hr>
		                    <p>注册于 {{ Auth::user()->created_at->diffForHumans() }} </p>
							<a class="btn btn-default btn-block" href="{{ url('user/modify') }}"
							   id="user-edit-button">
					         	<i class="fa fa-edit"></i> 编辑个人资料
					         </a>
		                </span>
		            </div>
		        </div>
          	</widget>

            <widget class="box text-center">
             	<div class="padding-sm user-basic-nav">
               		<ul class="list-group">
             			<li class="list-group-item">
                			<a href="{{ url('user/comments') }}" class="btn">
                  				<i class="text-md fa fa-volume-up"></i>
                  				未读评论回复
                			</a>
          				</li>
             			<li class="list-group-item">
                			<a href="{{ url('user/collections') }}" class="btn">
                  				<i class="text-md fa fa-headphones"></i>
                  				我收藏的文章
                			</a>
          				</li>
                 		<li class="list-group-item">
                			<a href="{{ url('user/affairs') }}" class="btn">
                  				<i class="text-md fa fa-list-ul"></i>
                  				我申请的事务
                			</a>
                  		</li>
                 		<li class="list-group-item">
            				<a href="{{ url('user/forwards') }}" class="btn">
                  				<i class="text-md fa fa-comment"></i>
                  				我发表的回复
                			</a>
                  		</li>
              		</ul>
            	</div>
          	</widget>
      	</aside>

      	<section class="main-col col-md-9 left-col">
        	@yield('info')
    	</section>
  	</div>
</main>

@endsection
