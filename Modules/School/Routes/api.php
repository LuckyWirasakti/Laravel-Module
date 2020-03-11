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
        });
        Route::group(['prefix' => 'major'], function () {
            Route::get('','MajorController@index');
        });
        Route::group(['prefix' => 'room'], function () {
            Route::get('','RoomController@index');
        });
        Route::group(['prefix' => 'master'], function () {
            Route::get('','MasterController@index');
            Route::post('','MasterController@store');
        });
    });
});
