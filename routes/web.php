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

// 接口路由
Route::group(['prefix' => 'api'], function () {
	// 地区
	Route::get('areas', function () {

		$provinces 	= \DB::table('dict_provinces')->get();
		$cities 	= \DB::table('dict_cities')->get();
		$areas 		= \DB::table('dict_areas')->get();

		return [
			'provinces' => $provinces,
			'cities' => $cities,
			'areas' => $areas
		];
	});
});

// 已登入路由组
Route::group(['middleware' => ['auth']], function ($router) {
	$router->get('/home', 'HomeController@index');

	// 
	$router->get('/index', function (){
		return view('abc');
	});

});

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