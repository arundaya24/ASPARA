<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan')->unique();
            $table->string('nama_pelapor');
            $table->string('email_pelapor')->nullable();
            $table->string('telepon_pelapor');
            $table->text('alamat_lokasi');
            $table->string('kecamatan');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->enum('status', ['Menunggu Verifikasi', 'Diproses', 'Selesai', 'Ditolak'])->default('Menunggu Verifikasi');
            $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
