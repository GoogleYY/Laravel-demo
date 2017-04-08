<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// 地区
Route::get('/areas', function () {

	$provinces 	= \DB::table('dict_provinces')->get();
	$cities 	= \DB::table('dict_cities')->get();
	$areas 		= \DB::table('dict_areas')->get();

	return [
		'provinces' => $provinces,
		'cities' => $cities,
		'areas' => $areas
	];
});

Route::group(['middleware' => 'auth'], function () {
	
});
