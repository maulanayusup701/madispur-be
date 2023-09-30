<?php

namespace Database\Seeders;


use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'nama' => 'Super Admin',
            'deskripsi' => 'Super Admin',
            'jumlah_user' => '1',
            'created_date' => now(),
            'created_by' => now(),
            'modified_date' => now(),
            'modified_by' => now(),
        ]);

        Role::create([
            'nama' => 'Admin',
            'deskripsi' => 'Admin',
            'jumlah_user' => '1',
            'created_date' => now(),
            'created_by' => now(),
            'modified_date' => now(),
            'modified_by' => now(),
        ]);

        Role::create([
            'nama' => 'Mahasiswa',
            'deskripsi' => 'Mahasiswa',
            'jumlah_user' => '1',
            'created_date' => now(),
            'created_by' => now(),
            'modified_date' => now(),
            'modified_by' => now(),
        ]);

        Role::create([
            'nama' => 'Siswa',
            'deskripsi' => 'Siswa',
            'jumlah_user' => '1',
            'created_date' => now(),
            'created_by' => now(),
            'modified_date' => now(),
            'modified_by' => now(),
        ]);
    }
}
