<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Super Admin
        User::create([
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('superadmin'),
            'username' => 'superadmin',
            'nama_lengkap' => 'Super Admin',
            'no_handphone' => '00000000000',
            'gender' => 'Pria',
            'alamat_lengkap' => 'Jl. Pahlawan',
            'status' => 'Aktif',
            'role_id' => 1,
        ]);
    }
}
