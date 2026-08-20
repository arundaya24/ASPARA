<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
    'kode_laporan', 'nama_pelapor', 'email_pelapor', 'telepon_pelapor',
    'alamat_lokasi', 'kecamatan', 'deskripsi', 'foto', 'status'
];

    public function getFotoUrlAttribute()
    {
        return $this->foto ? Storage::url($this->foto) : null;
    }
}
