@extends('layouts.app')

@section('title', 'Tambah Laporan - ASPARA')

@section('content')
<style>
    /* reuse dari dashboard */
    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .form-container .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .form-container .page-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .form-container .page-header h1 small {
        font-size: 0.9rem;
        font-weight: 400;
        color: #64748b;
        margin-left: 8px;
    }
    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        padding: 32px;
        border: 1px solid #f1f5f9;
        margin-bottom: 24px;
    }
    .form-card .form-group {
        margin-bottom: 20px;
    }
    .form-card .form-group label {
        display: block;
        font-weight: 600;
        font-size: 0.9rem;
        color: #334155;
        margin-bottom: 6px;
    }
    .form-card .form-group label .required {
        color: #ef4444;
        margin-left: 2px;
    }
    .form-card .form-group input,
    .form-card .form-group select,
    .form-card .form-group textarea {
        width: 100%;
        padding: 11px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        font-family: inherit;
        transition: all 0.2s;
        background: #f8fafc;
        color: #0f172a;
        box-sizing: border-box;
    }
    .form-card .form-group input:focus,
    .form-card .form-group select:focus,
    .form-card .form-group textarea:focus {
        outline: none;
        border-color: #10b981;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(16,185,129,0.08);
    }
    .form-card .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }
    .form-card .form-group .help-text {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: 4px;
    }
    .form-card .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
    }
    .form-card .form-actions .btn-primary {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        border: none;
        padding: 11px 28px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(16,185,129,0.25);
        text-decoration: none;
    }
    .form-card .form-actions .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(16,185,129,0.35);
    }
    .form-card .form-actions .btn-secondary {
        background: #e2e8f0;
        color: #334155;
        border: none;
        padding: 11px 28px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .form-card .form-actions .btn-secondary:hover {
        background: #cbd5e1;
        transform: translateY(-2px);
    }
    .alert-error {
        padding: 12px 16px;
        border-radius: 12px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .alert-error i {
        color: #dc2626;
        font-size: 1.1rem;
    }
    .alert-success {
        padding: 12px 16px;
        border-radius: 12px;
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #166534;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .alert-success i {
        color: #16a34a;
        font-size: 1.1rem;
    }
    @media (max-width: 576px) {
        .form-card {
            padding: 20px;
        }
        .form-card .form-actions {
            flex-direction: column;
        }
        .form-card .form-actions .btn-primary,
        .form-card .form-actions .btn-secondary {
            justify-content: center;
            width: 100%;
        }
    }
</style>

<div class="form-container">
    <div class="page-header">
        <h1>Tambah Laporan <small>Isi data laporan jalan rusak</small></h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-secondary" style="padding:8px 20px;border-radius:40px;background:#e2e8f0;color:#334155;text-decoration:none;display:inline-flex;align-items:center;gap:6px;font-weight:600;font-size:0.9rem;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    @if (session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="form-card">
        <form method="POST" action="{{ route('admin.report.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama_pelapor">Nama Pelapor <span class="required">*</span></label>
                <input type="text" name="nama_pelapor" id="nama_pelapor" value="{{ old('nama_pelapor') }}" required placeholder="Masukkan nama lengkap">
            </div>

            <div class="form-group">
                <label for="email_pelapor">Email Pelapor</label>
                <input type="email" name="email_pelapor" id="email_pelapor" value="{{ old('email_pelapor') }}" placeholder="contoh@email.com">
                <div class="help-text">Opsional, untuk keperluan notifikasi.</div>
            </div>

            <div class="form-group">
                <label for="telepon_pelapor">Telepon <span class="required">*</span></label>
                <input type="text" name="telepon_pelapor" id="telepon_pelapor" value="{{ old('telepon_pelapor') }}" required placeholder="08xx-xxxx-xxxx">
            </div>

            <div class="form-group">
                <label for="alamat_lokasi">Alamat Lokasi <span class="required">*</span></label>
                <input type="text" name="alamat_lokasi" id="alamat_lokasi" value="{{ old('alamat_lokasi') }}" required placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan">
            </div>

            <div class="form-group">
                <label for="kecamatan">Kecamatan <span class="required">*</span></label>
                <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan') }}" required placeholder="Nama kecamatan">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi <span class="required">*</span></label>
                <textarea name="deskripsi" id="deskripsi" rows="4" required placeholder="Jelaskan kondisi jalan secara detail...">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" accept="image/*">
                <div class="help-text">Format: JPG, PNG, GIF. Maksimal 2MB.</div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan Laporan</button>
                <a href="{{ route('admin.dashboard') }}" class="btn-secondary"><i class="fas fa-times"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
