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

/////////// 前台 /////////////

Route::get('/', function () {
	// \View::addExtension('html', 'php');
    return view('welcome');
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

	$router->post('/comment', 'HomeController@commentPost');

	$router->post('/comment/forward', 'HomeController@commentForwardPost');
});

// 已登入路由组
Route::group(['middleware' => ['auth']], function ($router) {
	// $router->get('/home', 'HomeController@index');

	// 用户个人中心
	$router->get('user/info', 'HomeController@personal');

	// 文章收藏
	$router->match(['post', 'delete'], 'api/article/collect', 'HomeController@articleCollect');

	// 文章评论
	$router->get('article/comment/{id}', 'HomeController@commentRedirect');

	// 事务
	$router->get('user/affairs', 'HomeController@affairList');

	$router->get('user/affair/create', 'HomeController@affairCreateView');

	$router->get('user/affair/edit/{id}', 'HomeController@affairEditView');

	$router->get('user/affair/{id}', 'HomeController@affairDetailView');
});
// 取消
$router->post('user/affair/cancel', 'HomeController@affairCancel');
// 保存草稿
$router->post('user/affair/save', 'HomeController@affairCreateSave');
// 提交
$router->post('user/affair/create', 'HomeController@affairCreatePost');
// 删除
$router->post('user/affair/delete', 'HomeController@affairDelete');

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
			// 上传图片
			$router->any('upload', 'DashboardController@imageUpload');
			$router->post('create', 'DashboardController@articleCreatePost');

			// 修改
			$router->get('modify/{id}', 'DashboardController@articleModifyView');
			$router->put('modify/{id}', 'DashboardController@articleModifyPost');

			// 删除
			$router->post('delete/{id}', 'DashboardController@articleDelete');
		});

		// 事物管理
		Route::group(['prefix' => 'affair'], function ($router) {
			// 事务列表
			Route::get('list', 'DashboardController@affairList');

			// 处理视图
			Route::get('hiddle/{id}', 'DashboardController@affairHandleView');

			Route::post('hiddle/{id}', 'DashboardController@affairHandlePost');
		});

		// 分类管理
		Route::group(['prefix' => 'category'], function ($router) {
			// 分类列表
			Route::get('list', 'DashboardController@categoryList');

			// 分类添加
			Route::get('create', 'DashboardController@categoryCreateView');
			Route::post('create', 'DashboardController@categoryCreatePost');

			// 分类修改
			Route::get('modify/{id}', 'DashboardController@categoryModifyView');
			Route::put('modify/{id}', 'DashboardController@categoryModifyPut');

			// 分类删除
			Route::delete('delete', 'DashboardController@categoryDelete');
		});

	});

});