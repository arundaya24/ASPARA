@extends('layouts.app')

@section('title', 'Ganti Password - ASPARA')

@section('content')
<style>
    .form-container { max-width: 600px; margin: 0 auto; }
    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        padding: 32px;
        border: 1px solid #f1f5f9;
    }
    .form-card .form-group { margin-bottom: 20px; }
    .form-card .form-group label { display: block; font-weight: 600; font-size: 0.9rem; color: #334155; margin-bottom: 6px; }
    .form-card .form-group input { width: 100%; padding: 11px 16px; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 0.95rem; font-family: inherit; transition: all 0.2s; background: #f8fafc; box-sizing: border-box; }
    .form-card .form-group input:focus { outline: none; border-color: #10b981; background: #fff; box-shadow: 0 0 0 4px rgba(16,185,129,0.08); }
    .form-card .form-group .help-text { font-size: 0.8rem; color: #94a3b8; margin-top: 4px; }
    .form-card .form-actions { display: flex; gap: 12px; margin-top: 24px; padding-top: 20px; border-top: 1px solid #f1f5f9; }
    .form-card .form-actions .btn-primary { background: #10b981; color: #fff; border: none; padding: 11px 28px; border-radius: 40px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(16,185,129,0.25); text-decoration: none; }
    .form-card .form-actions .btn-primary:hover { background: #059669; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(16,185,129,0.35); }
    .form-card .form-actions .btn-secondary { background: #e2e8f0; color: #334155; border: none; padding: 11px 28px; border-radius: 40px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
    .form-card .form-actions .btn-secondary:hover { background: #cbd5e1; transform: translateY(-2px); }
    .alert-error { padding: 12px 16px; border-radius: 12px; background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    .alert-error i { color: #dc2626; font-size: 1.1rem; }
</style>

<div class="form-container">
    <div class="page-header">
        <h1>Ganti Password <small>Perbarui password akun</small></h1>
        <a href="{{ route('admin.profile.index') }}" class="btn-secondary" style="padding:8px 20px;border-radius:40px;background:#e2e8f0;color:#334155;text-decoration:none;font-weight:600;font-size:0.9rem;display:inline-flex;align-items:center;gap:6px; margin-bottom: 20px;">
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
        <form method="POST" action="{{ route('admin.profile.update-password') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="current_password">Password Saat Ini <span style="color:#ef4444;">*</span></label>
                <input type="password" name="current_password" id="current_password" required placeholder="Masukkan password saat ini">
            </div>

            <div class="form-group">
                <label for="password">Password Baru <span style="color:#ef4444;">*</span></label>
                <input type="password" name="password" id="password" required placeholder="Minimal 8 karakter">
                <div class="help-text">Password minimal 8 karakter.</div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru <span style="color:#ef4444;">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi password baru">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Ganti Password</button>
                <a href="{{ route('admin.profile.index') }}" class="btn-secondary"><i class="fas fa-times"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
