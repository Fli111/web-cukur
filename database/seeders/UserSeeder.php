<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun untuk Admin
        User::create([
            'nama' => 'Admin Hartono',
            'email' => 'admin@hartono.com',
            'password' => Hash::make('admin123'), // Ganti password ini di production
            'role' => 'admin',
        ]);

        // Akun untuk Pelanggan biasa
        User::create([
            'nama' => 'Budi Pelanggan',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('pelanggan123'),
            'role' => 'member',
        ]);

        // Anda bisa menambahkan lebih banyak user di sini jika perlu
    }
}