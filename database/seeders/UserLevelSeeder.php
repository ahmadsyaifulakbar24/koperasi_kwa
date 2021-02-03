<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_levels')->insert([
            'id' => 1,
            'level' => 'super admin',
        ]);

        DB::table('user_levels')->insert([
            'id' => 100,
            'level' => 'admin',
        ]);

        DB::table('user_levels')->insert([
            'id' => 101,
            'level' => 'member',
        ]);
    }
}
