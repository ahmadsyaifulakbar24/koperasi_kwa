<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_settings')->insert([
            'name_setting' => 'bunga',
            'value' => 2
        ]);

        DB::table('main_settings')->insert([
            'name_setting' => 'simpanan_pokok',
            'value' => 20000
        ]);
    }
}
