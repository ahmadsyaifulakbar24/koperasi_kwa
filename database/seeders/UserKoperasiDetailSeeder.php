<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserKoperasiDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_koperasi_details')->insert([
            'user_id' => 2,
            'status_keluarga_id' => 12,
            'nama_ahliwaris' => 'juminto',
            'besar_simpanan_wajib' => 20000,
            'upload_ktp' => 'ktp.jpg',
            'saldo_simpanan' => 0,
        ]);
    }
}
