<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * API: Menyimpan laporan dari frontend publik
     */
    public function storeApi(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_pelapor' => 'required|string|max:100',
                'kontak' => 'required|string|max:20',
                'lokasi' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:50',
                'deskripsi' => 'required|string',
                'foto' => 'nullable|image|max:2048',
            ]);

            // Generate kode laporan unik
            $validated['kode_laporan'] = 'ASP-' . date('Y') . '-' . str_pad(Report::count() + 1, 4, '0', STR_PAD_LEFT);

            // Mapping field dari frontend ke database
            $data = [
                'kode_laporan' => $validated['kode_laporan'],
                'nama_pelapor' => $validated['nama_pelapor'],
                'email_pelapor' => $request->email ?? null,
                'telepon_pelapor' => $validated['kontak'],
                'alamat_lokasi' => $validated['lokasi'],
                'kecamatan' => $validated['kecamatan'],
                'deskripsi' => $validated['deskripsi'],
                'status' => 'Menunggu Verifikasi', // Default status
            ];

            // Upload foto jika ada
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('reports', 'public');
            }

            $report = Report::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil dikirim!',
                'data' => $report,
                'ticket' => $data['kode_laporan']
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim laporan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Ambil semua laporan untuk frontend
     */
    public function getAll()
    {
        $reports = Report::all();
        return response()->json($reports);
    }

    /**
     * API: Ambil detail laporan
     */
    public function getDetail($id)
    {
        $report = Report::findOrFail($id);
        return response()->json($report);
    }

    public function edit(Report $report)
{
    return view('admin.reports.edit', compact('report'));
}
}


