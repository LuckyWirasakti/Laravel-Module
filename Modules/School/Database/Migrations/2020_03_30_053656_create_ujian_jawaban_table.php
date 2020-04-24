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
            $table->unsignedBigInteger('subject_id');
            $table->text('jawaban')->nullable();
            $table->text('koreksi')->nullable();
            $table->integer('durasi_ujian')->nullable();
            $table->double('skor')->nullable();
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
