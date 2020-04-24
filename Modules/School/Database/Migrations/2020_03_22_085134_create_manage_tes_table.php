<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageTesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_tes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('school_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->integer('major_id')->unsigned();
            $table->unsignedBigInteger('subject_id');
            $table->integer('duration_work');
            $table->time('hours_implementation');
            $table->date('sync_date');
            $table->date('date_implementation');
            $table->string('token', 16);
            $table->integer('day');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_tes');
    }
}
