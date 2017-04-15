<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title>登入</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
	<script type="text/javascript" src="{{ asset('resources/assets/js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
</head>
<body>
	<header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">主页</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">登入</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>

	<main class="container text-center">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
	            @if(count($errors) > 0)
					<div class="panel panel-warning">
						<div class="panel-heading">
							@if(is_object($errors))
		                        @foreach($errors->all() as $error)
		                            {{$error}}
		                        @endforeach
		                    @else
		                        {{$errors}}
		                    @endif
						</div>
		            @else
				<div class="panel panel-default">
                	<div class="panel-heading">修改密码</div>
	            @endif
					<div class="panel-body">
						<form class="form-horizontal text-center" role="form" method="POST" 
						action="">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<input type="password" class="form-control" name="password_old" placeholder="旧密码">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<input type="password" class="form-control" name="password" placeholder="新密码">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<input type="text" class="form-control" name="password_confirmation" placeholder="确认密码">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<button type="submit" class="btn btn-info">确认</button>
									<a type="button" class="btn btn-default" href="{{ url('admin/index') }}">取消</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
</body>
</html>