<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $defaults = [
            ['key' => 'app_name', 'value' => 'ASPARA - Aspal Nusantara', 'group' => 'general', 'label' => 'Nama Aplikasi', 'type' => 'text'],
            ['key' => 'contact_email', 'value' => 'info@aspara.id', 'group' => 'contact', 'label' => 'Email Kontak', 'type' => 'email'],
            ['key' => 'contact_phone', 'value' => '(0251) 1234-5678', 'group' => 'contact', 'label' => 'Telepon', 'type' => 'text'],
            ['key' => 'contact_address', 'value' => 'Jl. Raya Pajajaran No. 45, Bogor Tengah, Kabupaten Bogor', 'group' => 'contact', 'label' => 'Alamat', 'type' => 'textarea'],
            ['key' => 'map_lat', 'value' => '-6.55', 'group' => 'map', 'label' => 'Latitude', 'type' => 'text'],
            ['key' => 'map_lng', 'value' => '106.8', 'group' => 'map', 'label' => 'Longitude', 'type' => 'text'],
            ['key' => 'map_zoom', 'value' => '11', 'group' => 'map', 'label' => 'Zoom Level', 'type' => 'number'],
            ['key' => 'max_report_per_day', 'value' => '5', 'group' => 'general', 'label' => 'Max Laporan per Hari', 'type' => 'number'],
            ['key' => 'maintenance_mode', 'value' => '0', 'group' => 'general', 'label' => 'Mode Maintenance', 'type' => 'select'],
        ];

        foreach ($defaults as $default) {
            Setting::create($default);
        }
    }
}
