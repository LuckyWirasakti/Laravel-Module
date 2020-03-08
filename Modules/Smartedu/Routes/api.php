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
        Route::get('level','LevelController@index');
        Route::get('province','ProvinceController@index');
        Route::get('regency','RegencyController@index');
        Route::group(['prefix' => 'school'], function () {
            Route::get('','SchoolController@index');
            Route::post('','SchoolController@store');
        });
    });
});
