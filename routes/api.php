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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->name('api.admin.')->namespace('Admin\Api')->group(function(){
  Route::prefix('admin')->group(function () {
    Route::get('/users', 'UserController@list')->name('userlist');
    Route::apiResource('pages','PageController');
    Route::apiResource('posts','PostController');
  });
});
