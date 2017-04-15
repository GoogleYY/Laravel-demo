<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// test

Route::get('/index', function () {
	return view('index');
});


/////////// 前台 /////////////

Route::get('/', 'HomeController@articleList');

Route::get('/weng', function () {
    $weng = \DB::table('categorys')->get();

    $articles = \DB::table('articles')->get();

    return view('weng.index', compact('weng', 'articles'));
});

// 登入
// 注册
// 找回密码
Auth::routes();

// 文章
Route::group(['prefix' => 'article'], function ($router) {
	// 列表
	$router->get('/', 'HomeController@articleList');
	// 详情
	$router->get('/{id}', 'HomeController@articleDetail');

	// 评论列表
	$router->get('/comments/{id}', 'HomeController@commentList');
	// 提交
	$router->post('/comment', 'HomeController@commentPost');
	// 回复
	$router->post('/comment/forward', 'HomeController@commentForwardPost');
});

// 已登入路由组
Route::group(['middleware' => ['auth']], function ($router) {
	// $router->get('/home', 'HomeController@index');
	// 未读消息

	Route::group(['prefix' => 'user'], function ($router) {
		// 未读消息
		$router->get('unread/comments', 'UserController@unreadComments');
		// 用户个人中心
		$router->get('personal', 'UserController@collectionList');
		// 修改个人资料
		$router->get('modify', 'UserController@modifyMyInfo');
		$router->post('modify', 'UserController@modifyMyInfoPost');
		// 未读评论
		$router->get('comments', 'UserController@unreadComments');
		// 回复
		$router->get('forwards', 'UserController@forwardList');
		// 收藏
		$router->get('collections', 'UserController@collectionList');
		// 事务列表
		$router->get('affairs', 'UserController@affairList');
		// 事务添加
		$router->get('affair/create', 'UserController@affairCreateView');
		// 事务编辑
		$router->get('affair/edit/{id}', 'UserController@affairEditView');
		// 事务详情
		$router->get('affair/{id}', 'UserController@affairDetailView');
		// 取消
		$router->post('affair/cancel', 'UserController@affairCancel');
		// 保存草稿
		$router->post('affair/save', 'UserController@affairCreateSave');
		// 提交
		$router->post('affair/create', 'UserController@affairCreatePost');
		// 删除
		$router->post('affair/delete', 'UserController@affairDelete');

	});

	// 文章收藏
	$router->match(['post', 'delete'], 'api/article/collect', 'HomeController@articleCollect');

	// 文章评论跳转
	$router->get('article/comment/{id}', 'HomeController@commentRedirect');

});


// 上传图片
Route::any('upload', 'HomeController@imageUpload');

/////////// 后台 ////////////////

Route::group(['prefix' => 'admin','namespace' => 'Admin'], function ($router) {

	// 登入
	Route::get('login', 'LoginController@loginView');
	Route::post('login', 'LoginController@loginPost');

	// 已登入路由组
	Route::group(['middleware' => ['logined']], function ($router) {
		// 退出
		Route::get('logout', 'LoginController@logout');
		// 修改密码
		Route::get('passmodify', 'LoginController@passModifyView');
		Route::post('passmodify', 'LoginController@passmodifyPost');

		// 后台首页
	    $router->get('dash', 'DashboardController@index');

	    // 文章管理
		Route::group(['prefix' => 'article'], function ($router) {
			// 列表
			$router->get('list', 'DashboardController@articleList');
			// 评论
			$router->get('comments/{id}', 'DashboardController@articleComments');
			// 创建
			$router->get('create', 'DashboardController@articleCreateView');
			// 提交
			$router->post('create', 'DashboardController@articleCreatePost');
			// 修改
			$router->get('modify/{id}', 'DashboardController@articleModifyView');
			// 提交
			$router->post('modify/{id}', 'DashboardController@articleModifyPost');
			// 删除
			$router->post('delete', 'DashboardController@articleDelete');
		});

		// 评论管理
		// 删除
		$router->delete('comment/delete', 'DashboardController@commentDelete');

		// 事务管理
		Route::group(['prefix' => 'affair'], function ($router) {
			// 列表
			Route::get('list', 'DashboardController@affairList');
			// 处理
			Route::post('handle', 'DashboardController@affairHandlePost');
		});

		// 分类管理
		Route::group(['prefix' => 'category'], function ($router) {
			// 分类列表
			Route::get('list', 'DashboardController@categoryList');
			// 分类添加
			Route::get('create', 'DashboardController@categoryCreateView');
			// 提交
			Route::post('create', 'DashboardController@categoryCreatePost');
			// 分类修改
			Route::get('modify/{id}', 'DashboardController@categoryModifyView');
			// 提交
			Route::put('modify/{id}', 'DashboardController@categoryModifyPut');
			// 分类删除
			Route::delete('delete', 'DashboardController@categoryDelete');
		});

	});

});
