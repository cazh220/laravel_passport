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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:api'])->group(function () {
	Route::get('index', 'UserController@index');
});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::post('login2', 'UserController@login2');
Route::get('test', 'UserController@test');
Route::get('test2', 'UserController@test2');

Route::middleware(['auth:admin_api'])->group(function () {
	Route::get('_index', 'AdminController@index');
});
Route::post('_register', 'AdminController@register');
Route::post('_login', 'AdminController@login');
Route::get('_test', 'AdminController@test');
