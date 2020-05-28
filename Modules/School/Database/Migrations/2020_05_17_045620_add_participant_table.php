<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->string('email')->nullable()->after('school_id');
            $table->string('phone')->nullable()->after('email');
            $table->string('tempat_lahir')->nullable()->after('phone');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('nama_orang_tua')->nullable()->after('tanggal_lahir');
            $table->string('phone_orang_tua')->nullable()->after('nama_orang_tua');
            $table->string('foto')->nullable()->after('phone_orang_tua');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participants', function($table) {
            $table->dropColumn([
                'email',
                'phone',
                'tempat_lahir',
                'tanggal_lahir',
                'nama_orang_tua',
                'phone_orang_tua',
                'foto'
            ]);
        });
    }
}
