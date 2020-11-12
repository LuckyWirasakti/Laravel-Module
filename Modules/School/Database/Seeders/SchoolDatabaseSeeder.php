<?php

namespace Modules\School\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Int;


class SchoolDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

        // $this->call("OthersTableSeeder");

        DB::table('schools')->insert([
            'id' => Int::random(1),
            'name' => Str::random(10),
            'province_id' => Int::random(1),
            'regency_id' => Int::random(1),
            'level_id' => Int::random(1),
            'province_id' => Int::random(1),
            'username' => Str::random(6),
            'visible' => Str::random(6),
            'password' => Hash::make('password'),
            'created_at' => now(),
        ]);
    }
}
