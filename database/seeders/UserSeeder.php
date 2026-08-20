<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua user existing (opsional)
        // User::truncate();

        User::create([
            'password' => Hash::make('password'),
            'email' => 'admin@aspara.id',
            'role' => 'admin',
            'name' => 'Admin ASPARA'
        ]);

        User::create([
            'username' => 'petugas',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'name' => 'Petugas Lapangan'
        ]);
    }
}
