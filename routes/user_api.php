<?php
/**
 * User 路由
 */
Route::prefix('v1')->namespace('v1')->group(function () {

	Route::post('user', 'UserController@register');
	Route::post('login', 'UserController@login');
	
});
