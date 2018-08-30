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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\RegisterController@login');
	Route::post('signup', 'Api\RegisterController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\RegisterController@logout');
        Route::get('user', 'Api\RegisterController@user');
    });
});

Route::middleware('auth:api')->group( function () {
	Route::resource('article', 'Api\ArticleController');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
