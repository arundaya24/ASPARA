<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        $defaults = [
            'app_name' => 'ASPARA - Aspal Nusantara',
            'app_logo' => null,
            'app_favicon' => null,
            'contact_email' => 'info@aspara.id',
            'contact_phone' => '(0251) 1234-5678',
            'contact_address' => 'Jl. Raya Pajajaran No. 45, Bogor Tengah, Kabupaten Bogor',
            'map_lat' => '-6.55',
            'map_lng' => '106.8',
            'map_zoom' => '11',
            'max_report_per_day' => '5',
            'maintenance_mode' => '0',
        ];

        foreach ($defaults as $key => $value) {
            if (!isset($settings[$key])) {
                $settings[$key] = $value;
            }
        }

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'nullable|string|max:255',
            'app_logo' => 'nullable|image|max:2048',
            'app_favicon' => 'nullable|image|max:1024',
            'contact_email' => 'nullable|email|max:100',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string|max:500',
            'map_lat' => 'nullable|numeric',
            'map_lng' => 'nullable|numeric',
            'map_zoom' => 'nullable|integer|min:1|max:20',
            'max_report_per_day' => 'nullable|integer|min:1',
            'maintenance_mode' => 'nullable|in:0,1',
        ]);

        if ($request->hasFile('app_logo')) {
            $oldLogo = Setting::get('app_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $validated['app_logo'] = $request->file('app_logo')->store('settings', 'public');
        } else {
            unset($validated['app_logo']);
        }

        if ($request->hasFile('app_favicon')) {
            $oldFavicon = Setting::get('app_favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $validated['app_favicon'] = $request->file('app_favicon')->store('settings', 'public');
        } else {
            unset($validated['app_favicon']);
        }

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function reset()
    {
        $logo = Setting::get('app_logo');
        if ($logo && Storage::disk('public')->exists($logo)) {
            Storage::disk('public')->delete($logo);
        }

        $favicon = Setting::get('app_favicon');
        if ($favicon && Storage::disk('public')->exists($favicon)) {
            Storage::disk('public')->delete($favicon);
        }

        Setting::truncate();

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

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil di-reset ke default!');
    }
}
