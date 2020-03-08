<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleSmarteduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smartedus', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->after('password');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smartedus', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
			$table->dropColumn('role_id');

        });
    }
}
