@extends('layouts.app')

@section('title', 'Profil Admin - ASPARA')

@section('content')
<style>
    .profile-container {
        max-width: 600px;
        margin: 0 auto;
    }
    .profile-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        padding: 32px;
        border: 1px solid #f1f5f9;
    }
    .profile-card .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #10b981, #059669);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        color: #fff;
        margin: 0 auto 20px;
        box-shadow: 0 8px 24px rgba(16,185,129,0.2);
    }
    .profile-card .profile-name {
        font-size: 1.5rem;
        font-weight: 700;
        text-align: center;
        color: #0f172a;
        margin-bottom: 4px;
    }
    .profile-card .profile-role {
        text-align: center;
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 24px;
    }
    .profile-card .profile-info {
        border-top: 1px solid #f1f5f9;
        padding-top: 20px;
    }
    .profile-card .profile-info .info-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .profile-card .profile-info .info-item:last-child {
        border-bottom: none;
    }
    .profile-card .profile-info .info-item .label {
        font-weight: 600;
        color: #64748b;
    }
    .profile-card .profile-info .info-item .value {
        color: #1e293b;
        font-weight: 500;
    }
    .profile-card .profile-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
        flex-wrap: wrap;
    }
    .profile-card .profile-actions .btn-edit {
        flex: 1;
        text-align: center;
        padding: 10px 20px;
        border-radius: 40px;
        background: #10b981;
        color: #fff;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(16,185,129,0.2);
    }
    .profile-card .profile-actions .btn-edit:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16,185,129,0.3);
    }
    .profile-card .profile-actions .btn-password {
        flex: 1;
        text-align: center;
        padding: 10px 20px;
        border-radius: 40px;
        background: #e2e8f0;
        color: #334155;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .profile-card .profile-actions .btn-password:hover {
        background: #cbd5e1;
        transform: translateY(-2px);
    }
    .profile-card .status-badge {
        display: inline-block;
        padding: 3px 14px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
        background: #dcfce7;
        color: #166534;
    }
    .badge-status {
        background: #e0e7ff;
        color: #3730a3;
        padding: 4px 14px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .btn-secondary {
        background: #e2e8f0;
        color: #334155;
        border: none;
        padding: 10px 22px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-secondary:hover {
        background: #cbd5e1;
        transform: translateY(-2px);
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
</style>

<div class="profile-container">
    <div class="page-header">
        <h1>Profil Admin <small>Informasi akun Anda</small></h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-secondary" style="margin-bottom: 20px;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="profile-card">
        <!-- Avatar -->
        <div class="profile-avatar">
            <i class="fas fa-user"></i>
        </div>

        <!-- Nama & Role -->
        <div class="profile-name">{{ $user->name }}</div>
        <div class="profile-role">
            <span class="badge-status">{{ ucfirst($user->role) }}</span>
        </div>

        <!-- Informasi -->
        <div class="profile-info">
            <div class="info-item">
                <span class="label"><i class="fas fa-user" style="width:20px;color:#10b981;"></i> Nama</span>
                <span class="value">{{ $user->name }}</span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-envelope" style="width:20px;color:#10b981;"></i> Email</span>
                <span class="value">{{ $user->email }}</span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-user-tag" style="width:20px;color:#10b981;"></i> Role</span>
                <span class="value">
                    <span class="badge-status">{{ ucfirst($user->role) }}</span>
                </span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-calendar-alt" style="width:20px;color:#10b981;"></i> Bergabung</span>
                <span class="value">{{ $user->created_at->format('d F Y') }}</span>
            </div>
            <div class="info-item">
                <span class="label"><i class="fas fa-check-circle" style="width:20px;color:#10b981;"></i> Status</span>
                <span class="value">
                    <span class="status-badge">
                        <i class="fas fa-circle" style="font-size:0.5rem;color:#16a34a;"></i> Aktif
                    </span>
                </span>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="profile-actions">
            <a href="{{ route('admin.profile.edit') }}" class="btn-edit">
                <i class="fas fa-edit"></i> Edit Profil
            </a>
            <a href="{{ route('admin.profile.password') }}" class="btn-password">
                <i class="fas fa-key"></i> Ganti Password
            </a>
        </div>
    </div>
</div>
@endsection
