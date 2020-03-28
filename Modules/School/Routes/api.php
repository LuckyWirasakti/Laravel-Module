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
    Route::post('login/siswa', 'ParticipantController@login');
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
        Route::group(['prefix' => 'subject'], function () {
            Route::get('','SubjectController@index');
            Route::post('','SubjectController@store');
        });
        Route::group(['prefix' => 'participant'], function () {
            Route::get('','ParticipantController@index');
            Route::delete('/{id}/deleteAll', 'ParticipantController@deleteAllBysekolah');
            Route::delete('/{id}','ParticipantController@deleteParticipant');
            Route::put('/{id}','ParticipantController@update');
        });
        // Soal
        Route::group(['prefix' => 'soal'], function () {
            // Admin
            Route::post('','SoalController@store');
            Route::get('/show','SoalController@getSoal');

        });

        Route::group(['prefix' => 'manage/tes'], function () {
            Route::get('', 'ManageTesController@index');
            Route::post('', 'ManageTesController@store');
        });
    });
});

Route::group(['prefix' => 'participant'], function () {
    Route::group(['middleware' => 'auth:participant'], function () {
        Route::get('getmapel','DashboardParticipantController@getMapel');
        Route::post('validateToken','DashboardParticipantController@verifTokenMapel');
        Route::get('detail_informasi','DashboardParticipantController@detailInformasi');

        Route::group(['prefix' => 'soal'], function () {
            // Ujian
            // get Soal
            Route::get('/ujian/subject/','SoalController@getSubjectSoal');
        });
    });
});


// file upload
Route::post('/soal/file/upload','SoalController@fileUpload');;
