<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'pendidikan',
            'param' => 'SD',
            'order' => 1,
            'active' => 1,
        ]);
        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'pendidikan',
            'param' => 'SMP',
            'order' => 2,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'pendidikan',
            'param' => 'SLTA',
            'order' => 3,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'pendidikan',
            'param' => 'D3',
            'order' => 4,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'pendidikan',
            'param' => 'S1',
            'order' => 5,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'pendidikan',
            'param' => 'S2',
            'order' => 6,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'pendidikan',
            'param' => 'S3',
            'order' => 7,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'jabatan',
            'param' => 'JAJARAN DIREKSI',
            'order' => 1,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'jabatan',
            'param' => 'ADMIN HD (MANAGER OPS.)',
            'order' => 2,
            'active' => 1,
        ]);
        
        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'jabatan',
            'param' => 'TEKNISI',
            'order' => 3,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'jabatan',
            'param' => 'SALES / MARKETING',
            'order' => 4,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'status_keluarga',
            'param' => 'Kepala Rumah Tangga',
            'order' => 1,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'status_keluarga',
            'param' => 'Istri',
            'order' => 2,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'status_keluarga',
            'param' => 'Anak',
            'order' => 1,
            'active' => 1,
        ]);

        DB::table('params')->insert([
            'param_id' => null,
            'category_param' => 'status_keluarga',
            'param' => 'Orang Tua',
            'order' => 1,
            'active' => 1,
        ]);
    }
}
