<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteExNameRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropColumn(['major_id']);
            $table->dropForeign(['group_id']);
            $table->dropColumn(['group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->integer('major_id')->unsigned()->after('name');
            $table->foreign('major_id')->references('id')->on('majors');
            $table->integer('group_id')->unsigned()->after('major_id');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }
}
