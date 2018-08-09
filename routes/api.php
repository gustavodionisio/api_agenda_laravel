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


Route::group(['prefix' => 'user'], function () {

    Route::get('', ['uses' => 'UserController@allUsers']);

    Route::get('{id}', ['uses' => 'UserController@getUser']);

    Route::post('', ['uses' => 'UserController@saveUser']);

    Route::put('{id}', ['uses' => 'UserController@updateUser']);

    Route::delete('{id}', ['uses' => 'UserController@deleteUser']);

});

Route::group(['prefix' => 'message'], function () {

    Route::get('{id}', ['uses' => 'MessageController@getUserMessages']);

    Route::post('', ['uses' => 'MessageController@saveMessage']);

    Route::put('{id}', ['uses' => 'MessageController@updateMessage']);

    Route::delete('{id}', ['uses' => 'MessageController@deleteMessage']);

});