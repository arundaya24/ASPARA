<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Models\Documentation;
use App\Models\LogActivity;

class PetugasController extends Controller
{
    public function dashboard()
    {
        $tugas = Report::where('verified', true)
            ->whereIn('status', ['Diproses', 'Menunggu Verifikasi'])
            ->get();
        $selesai = Report::where('status', 'Selesai')->count();
        $target = Report::count() * 0.3;
        return view('petugas.dashboard', compact('tugas', 'selesai', 'target'));
    }

    public function updateProgress(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $progress = $request->progress;

        if ($progress >= 100 && $report->status !== 'Selesai') {
            $report->status = 'Selesai';
            $report->progress = 100;
            LogActivity::create(['message' => "Laporan {$report->ticket} selesai (100%) oleh petugas"]);
        } else {
            $report->progress = $progress;
            LogActivity::create(['message' => "Petugas update progress {$report->ticket} ke {$progress}%"]);
        }
        $report->save();
        return back()->with('success', 'Progress diperbarui.');
    }

    public function selesai($id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'Selesai';
        $report->progress = 100;
        $report->save();
        LogActivity::create(['message' => "Petugas menandai {$report->ticket} selesai"]);
        return back()->with('success', 'Tugas selesai.');
    }

    public function uploadDokumentasi(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:reports,id',
            'description' => 'required|string|max:255',
            'file' => 'nullable|file|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('dokumentasi', 'public');
        }

        Documentation::create([
            'report_id' => $request->report_id,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        LogActivity::create(['message' => "Dokumentasi diunggah untuk laporan ID {$request->report_id}"]);
        return back()->with('success', 'Dokumentasi berhasil diunggah.');
    }
}
