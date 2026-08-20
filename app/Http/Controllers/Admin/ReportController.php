<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        // gajadi kepake di dashboard
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'email_pelapor' => 'nullable|email|max:100',
            'telepon_pelapor' => 'required|string|max:20',
            'alamat_lokasi' => 'required|string',
            'kecamatan' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $validated['kode_laporan'] = 'LP-' . date('Y') . '-' . str_pad(Report::count() + 1, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('reports', 'public');
        }

        Report::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function edit(Report $report)
    {
        return view('admin.reports.create', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'email_pelapor' => 'nullable|email|max:100',
            'telepon_pelapor' => 'required|string|max:20',
            'alamat_lokasi' => 'required|string',
            'kecamatan' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
            'status' => 'nullable|in:Menunggu Verifikasi,Diproses,Selesai,Ditolak',
        ]);

        if ($request->hasFile('foto')) {
            if ($report->foto) {
                Storage::disk('public')->delete($report->foto);
            }
            $validated['foto'] = $request->file('foto')->store('reports', 'public');
        }

        $report->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Report $report)
    {
        if ($report->foto) {
            Storage::disk('public')->delete($report->foto);
        }
        $report->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil dihapus.');
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return response()->json($report);
    }

    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $request->validate([
            'status' => 'required|in:Menunggu Verifikasi,Diproses,Selesai,Ditolak'
        ]);
        $report->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }
}
