@extends('layouts.app')

@section('title', 'Tambah Pengguna - ASPARA')

@section('content')
<style>
    .form-container { max-width: 600px; margin: 0 auto; }
    .form-container .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px; }
    .form-container .page-header h1 { font-size: 1.8rem; font-weight: 700; color: #0f172a; margin: 0; }
    .form-container .page-header h1 small { font-size: 0.9rem; font-weight: 400; color: #64748b; margin-left: 8px; }
    .form-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.04); padding: 32px; border: 1px solid #f1f5f9; }
    .form-card .form-group { margin-bottom: 20px; }
    .form-card .form-group label { display: block; font-weight: 600; font-size: 0.9rem; color: #334155; margin-bottom: 6px; }
    .form-card .form-group label .required { color: #ef4444; margin-left: 2px; }
    .form-card .form-group input, .form-card .form-group select { width: 100%; padding: 11px 16px; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 0.95rem; font-family: inherit; transition: all 0.2s; background: #f8fafc; box-sizing: border-box; }
    .form-card .form-group input:focus, .form-card .form-group select:focus { outline: none; border-color: #10b981; background: #fff; box-shadow: 0 0 0 4px rgba(16,185,129,0.08); }
    .form-card .form-group .help-text { font-size: 0.8rem; color: #94a3b8; margin-top: 4px; }
    .form-card .form-actions { display: flex; gap: 12px; margin-top: 24px; padding-top: 20px; border-top: 1px solid #f1f5f9; }
    .form-card .form-actions .btn-primary { background: linear-gradient(135deg, #10b981, #059669); color: #fff; border: none; padding: 11px 28px; border-radius: 40px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(16,185,129,0.25); text-decoration: none; }
    .form-card .form-actions .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(16,185,129,0.35); }
    .form-card .form-actions .btn-secondary { background: #e2e8f0; color: #334155; border: none; padding: 11px 28px; border-radius: 40px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
    .form-card .form-actions .btn-secondary:hover { background: #cbd5e1; transform: translateY(-2px); }
    .alert-error { padding: 12px 16px; border-radius: 12px; background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    .alert-error i { color: #dc2626; font-size: 1.1rem; }
</style>

<div class="form-container">
    <div class="page-header">
        <h1>Tambah Pengguna <small>Buat akun baru</small></h1>
        <a href="{{ route('admin.users.index') }}" class="btn-secondary" style="padding:8px 20px;border-radius:40px;background:#e2e8f0;color:#334155;text-decoration:none;font-weight:600;font-size:0.9rem;display:inline-flex;align-items:center;gap:6px;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="form-card">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap">
            </div>

            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="contoh@email.com">
                <div class="help-text">Email harus unik dan digunakan untuk login.</div>
            </div>

            <div class="form-group">
                <label for="password">Password <span class="required">*</span></label>
                <input type="password" name="password" id="password" required placeholder="Minimal 8 karakter">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password <span class="required">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi password">
            </div>

            <div class="form-group">
                <label for="role">Role <span class="required">*</span></label>
                <select name="role" id="role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                </select>
                <div class="help-text">Admin memiliki akses penuh, Petugas hanya dapat melihat laporan.</div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary"><i class="fas fa-user-plus"></i> Tambah Pengguna</button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary"><i class="fas fa-times"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
