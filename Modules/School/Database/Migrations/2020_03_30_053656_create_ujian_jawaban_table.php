<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUjianJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_jawaban', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('participant_id')->unsigned();
            $table->foreign('participant_id')->references('id')->on('participants');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->text('jawaban');
            $table->text('koreksi');
            $table->integer('durasi_ujian');
            $table->double('skor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujian_jawaban');
    }
}
