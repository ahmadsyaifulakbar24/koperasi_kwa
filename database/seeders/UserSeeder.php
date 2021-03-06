<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'code' => 2020010000,
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'no_id' => '1111111111111111',
            'jenis_kelamin' => 'laki-laki',
            'tempat_lahir' => 'jakarta',
            'tanggal_lahir' => '2000-03-24',
            'alamat' => '-',
            'no_telp' => 89657341120,
            'pendidikan_id' => 4,
            'jabatan_id' => 9,
            'user_level_id' => 1,
            'profile' => NULL,
            'active' => true,
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
    }
}
