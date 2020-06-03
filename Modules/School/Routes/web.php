<?php
use Modules\School\Entities\Participant;
use Modules\School\Entities\UjianJawaban;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('school')->group(function() {
    Route::get('/', 'SchoolController@index');
});

Route::get('reset-ujian/{nisn}', function($nisn) {
    $participant = Participant::where('nisn', $nisn)->first();
    $jawaban = \DB::table('ujian_jawaban')
                ->select('subjects.name as mapel', 'participants.name as name', 'ujian_jawaban.participant_id as id_participant', 'ujian_jawaban.subject_id')
                ->join('subjects', 'subjects.id', '=', 'ujian_jawaban.subject_id')
                ->join('participants', 'participants.id', '=', 'ujian_jawaban.participant_id')
                ->where('ujian_jawaban.participant_id', '=', $participant->id)
                ->get();
                return view('reset_jawaban', compact('jawaban'));
});

Route::get('resetdelete/{id}/{id_subject}', function($id, $subject_id){
    $ujian = UjianJawaban::where('participant_id', $id)->where('subject_id', $subject_id)->delete();
    return back();
})->name('resetdelete');