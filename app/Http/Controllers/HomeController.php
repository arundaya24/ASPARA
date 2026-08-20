<?php

namespace App\Http\Controllers;

use App\Models\Report;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Report::count(),
            'selesai' => Report::where('status', 'Selesai')->count(),
            'proses' => Report::where('status', 'Diproses')->count(),
            'ditolak' => Report::where('status', 'Ditolak')->count(),
        ];
        return view('home.index', compact('stats'));
    }

    public function lapor()
    {
        return view('home.lapor');
    }

    public function status()
    {
        return view('home.status');
    }

    public function peta()
    {
        return view('home.peta');
    }

    public function statistik()
    {
        $stats = [
            'total' => Report::count(),
            'selesai' => Report::where('status', 'Selesai')->count(),
            'proses' => Report::where('status', 'Diproses')->count(),
            'ditolak' => Report::where('status', 'Ditolak')->count(),
        ];
        $kecamatanData = Report::selectRaw('kecamatan, count(*) as total')
            ->groupBy('kecamatan')
            ->get();
        return view('home.statistik', compact('stats', 'kecamatanData'));
    }

    public function riwayat()
    {
        $reports = Report::where('status', 'Selesai')->get();
        return view('home.riwayat', compact('reports'));
    }

    public function kontak()
    {
        return view('home.kontak');
    }
}
