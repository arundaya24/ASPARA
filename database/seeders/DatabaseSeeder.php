<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Report;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin dan petugas
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'name' => 'Admin ASPARA'
        ]);

        User::create([
            'username' => 'petugas',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'name' => 'Petugas Lapangan'
        ]);

        // Buat 50 laporan dummy
        $kecamatan = ['Bogor Timur', 'Bogor Selatan', 'Bogor Tengah', 'Bogor Utara', 'Citeureup', 'Cibinong', 'Gunung Putri', 'Cileungsi', 'Jonggol', 'Leuwiliang'];
        $statuses = ['Menunggu Verifikasi', 'Diproses', 'Selesai', 'Ditolak'];
        $lokasi = ['Pahlawan', 'Merdeka', 'Raya Tajur', 'Juanda', 'Pajajaran', 'Sholeh Iskandar', 'Raya Citeureup', 'Raya Cibinong'];
        $details = ['Lubang besar', 'Retak memanjang', 'Amblas sedang', 'Tambalan lepas', 'Bergerak struktural', 'Genangan air', 'Aspal mengelupas'];

        for ($i = 1; $i <= 50; $i++) {
            $status = $statuses[array_rand($statuses)];
            Report::create([
                'ticket' => 'ASP-' . date('Y') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama_pelapor' => 'Warga ' . $kecamatan[array_rand($kecamatan)],
                'kontak' => '08' . rand(100000000, 999999999),
                'lokasi' => 'Jl. ' . $lokasi[array_rand($lokasi)] . ' No. ' . rand(1, 30),
                'kecamatan' => $kecamatan[array_rand($kecamatan)],
                'deskripsi' => $details[array_rand($details)] . ' (' . rand(10, 80) . ' cm)',
                'status' => $status,
                'verified' => $status !== 'Menunggu Verifikasi',
                'progress' => $status === 'Selesai' ? 100 : ($status === 'Diproses' ? rand(20, 80) : 0),
                'lat' => -6.3 - (rand(0, 50) / 100),
                'lng' => 106.6 + (rand(0, 50) / 100),
            ]);
        }
    }
}
