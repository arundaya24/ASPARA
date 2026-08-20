@extends('layouts.app')

@section('title', 'Manajemen Pengguna - ASPARA')

@section('content')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .page-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .page-header h1 small {
        font-size: 0.9rem;
        font-weight: 400;
        color: #64748b;
        margin-left: 8px;
    }
    .admin-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        padding: 22px 26px;
        border: 1px solid #f1f5f9;
    }
    .table-wrapper {
        overflow-x: auto;
    }
    .admin-table {
        width: 100%;
        font-size: 0.9rem;
        border-collapse: collapse;
    }
    .admin-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        white-space: nowrap;
    }
    .admin-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        background: #fff;
    }
    .admin-table tbody tr:hover td {
        background: #f8fafc;
    }
    .btn-sm {
        padding: 4px 12px;
        font-size: 0.75rem;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        text-decoration: none;
    }
    .btn-sm.btn-edit { background: #dbeafe; color: #1d4ed8; }
    .btn-sm.btn-edit:hover { background: #bfdbfe; }
    .btn-sm.btn-delete { background: #fee2e2; color: #b91c1c; }
    .btn-sm.btn-delete:hover { background: #fecaca; }
    .btn-primary {
        background: #10b981;
        color: #fff;
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
        box-shadow: 0 4px 12px rgba(16,185,129,0.25);
    }
    .btn-primary:hover {
        background: #047857;
        transform: translateY(-2px);
    }
    .badge-status {
        background: #d1fae5;
        color: #047857;
        padding: 4px 14px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
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
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #94a3b8;
    }
</style>

<div>
    <div class="page-header">
        <h1>Manajemen Pengguna <small>Kelola akun admin dan petugas</small></h1>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <i class="fas fa-user-plus"></i> Tambah Pengguna
        </a>
    </div>

    @if (session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="admin-card">
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge-status" style="background:#e0e7ff;color:#3730a3;">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-sm btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus pengguna ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="fas fa-users fa-2x" style="display:block;margin-bottom:8px;color:#cbd5e1;"></i>
                            Belum ada pengguna.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
