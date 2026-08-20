<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatan = ['Bogor Timur', 'Bogor Selatan', 'Bogor Tengah', 'Bogor Utara', 'Citeureup', 'Cibinong', 'Gunung Putri', 'Cileungsi', 'Jonggol', 'Leuwiliang'];
        $statuses = ['Menunggu Verifikasi', 'Diproses', 'Selesai', 'Ditolak'];

        for ($i = 1; $i <= 50; $i++) {
            $status = $statuses[array_rand($statuses)];
            Report::create([
                'ticket' => 'ASP-' . date('Y') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama_pelapor' => 'Warga ' . $kecamatan[array_rand($kecamatan)],
                'kontak' => '08' . rand(100000000, 999999999),
                'lokasi' => 'Jl. ' . ['Pahlawan', 'Merdeka', 'Raya Tajur', 'Juanda', 'Pajajaran'][array_rand([0,1,2,3,4])] . ' No. ' . rand(1, 30),
                'kecamatan' => $kecamatan[array_rand($kecamatan)],
                'deskripsi' => ['Lubang besar', 'Retak memanjang', 'Amblas sedang', 'Tambalan lepas'][array_rand([0,1,2,3])] . ' (' . rand(10, 80) . ' cm)',
                'status' => $status,
                'verified' => $status !== 'Menunggu Verifikasi',
                'progress' => $status === 'Selesai' ? 100 : ($status === 'Diproses' ? rand(20, 80) : 0),
            ]);
        }
    }
}
