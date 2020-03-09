<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'school'], function () {
    Route::post('login', 'SchoolController@login');
    Route::group(['middleware' => 'auth:school'], function () {
        Route::group(['prefix' => 'group'], function () {
            Route::get('','GroupController@index');
            Route::post('','GroupController@store');
        });
        Route::group(['prefix' => 'major'], function () {
            Route::get('','MajorController@index');
            Route::post('','MajorController@store');
        });
    });
});
