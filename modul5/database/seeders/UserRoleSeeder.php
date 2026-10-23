<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama_lengkap' => 'Admin Utama',
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        User::create([
            'nama_lengkap' => 'Staff Toko',
            'username' => 'staff',
            'password' => Hash::make('password123'),
            'role' => 'staff'
        ]);

        User::create([
            'nama_lengkap' => 'Budi',
            'username' => 'budi',
            'password' => Hash::make('password123'),
            'role' => 'customer'
        ]);
    }
}
