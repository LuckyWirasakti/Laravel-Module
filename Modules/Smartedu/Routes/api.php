<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'smartedu'], function () {
    Route::post('login', 'SmarteduController@login');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'level'], function () {
            Route::get('','LevelController@index');
            Route::put('{id}','LevelController@update');
        });
        Route::group(['prefix' => 'province'], function () {
            Route::get('','ProvinceController@index');
            Route::put('{id}','ProvinceController@update');
        });
        Route::group(['prefix' => 'regency'], function () {
            Route::get('{province_id}','RegencyController@index');
            Route::put('{id}','RegencyController@update');
        });
        Route::group(['prefix' => 'school'], function () {
            Route::get('','SchoolController@index');
            Route::post('','SchoolController@store');
        });
    });
});
