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

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    Route::group(['namespace' => 'V1', 'prefix' => 'v1', 'as' => 'v1.'], function () {

        // For demo
        Route::middleware('auth:api')->get('/user', 'UserController@get');

//        Route::post('register', 'AuthController@register')->name('register');
//        Route::post('login', 'AuthController@login')->name('login');


        // TODO: Поставить проверку middleware('auth:api'), после чего проверить админку
        Route::resource('users', 'UserController',
            ['except' => ['create', 'edit']]);

    });
});

