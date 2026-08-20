<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {

        $query = Report::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama_pelapor', 'like', '%' . $search . '%')
              ->orWhere('alamat_lokasi', 'like', '%' . $search . '%')
              ->orWhere('kecamatan', 'like', '%' . $search . '%')
              ->orWhere('kode_laporan', 'like', '%' . $search . '%');
        });
    }

    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    $reports = $query->latest()->paginate(10);
    $reports->appends($request->all());

        $totalLaporan = Report::count();
        $menunggu = Report::where('status', 'Menunggu Verifikasi')->count();
        $diproses = Report::where('status', 'Diproses')->count();
        $selesai = Report::where('status', 'Selesai')->count();
        $ditolak = Report::where('status', 'Ditolak')->count();

        $users = User::all();

        $messages = Message::latest()->paginate(20);
        $unreadCount = Message::where('status', 'unread')->count();

        return view('admin.dashboard', compact(
            'reports',
            'totalLaporan',
            'menunggu',
            'diproses',
            'selesai',
            'ditolak',
            'users',
            'messages',
            'unreadCount'
        ));
    }

    public function verifikasi($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'Diproses']);

        return redirect()->back()->with('success', 'Laporan berhasil diverifikasi dan sedang diproses.');
    }

    public function tolak($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'Ditolak']);

        return redirect()->back()->with('success', 'Laporan berhasil ditolak.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Verifikasi,Diproses,Selesai,Ditolak'
        ]);

        $report = Report::findOrFail($id);
        $report->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status laporan berhasil diperbarui.'
        ]);
    }

    public function stats()
    {
        $totalLaporan = Report::count();
        $menunggu = Report::where('status', 'Menunggu Verifikasi')->count();
        $diproses = Report::where('status', 'Diproses')->count();
        $selesai = Report::where('status', 'Selesai')->count();
        $ditolak = Report::where('status', 'Ditolak')->count();

        $kecamatanStats = Report::select('kecamatan', \DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->get();

        return response()->json([
            'total' => $totalLaporan,
            'menunggu' => $menunggu,
            'diproses' => $diproses,
            'selesai' => $selesai,
            'ditolak' => $ditolak,
            'per_kecamatan' => $kecamatanStats
        ]);
    }

    public function getAllReports()
    {
        $reports = Report::latest()->get();
        return response()->json($reports);
    }

    public function getReport($id)
    {
        $report = Report::findOrFail($id);
        return response()->json($report);
    }

    public function unreadCount()
    {
        $count = Message::where('status', 'unread')->count();
        return response()->json(['count' => $count]);
    }
}
