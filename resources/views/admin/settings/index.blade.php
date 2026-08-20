@extends('layouts.app')

@section('title', 'Pengaturan Sistem - ASPARA')

@section('content')
<div style="padding: 40px; max-width: 800px; margin: 0 auto;">
    <h1 style="margin-bottom: 20px;">Pengaturan Sistem</h1>

    @if (session('success'))
        <div style="padding: 12px 16px; background: #dcfce7; border: 1px solid #bbf7d0; border-radius: 8px; color: #166534; margin-bottom: 16px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" style="background: #fff; padding: 24px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; margin-bottom: 4px;">Nama Aplikasi</label>
            <input type="text" name="app_name" value="{{ old('app_name', $settings['app_name'] ?? 'ASPARA - Aspal Nusantara') }}" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; margin-bottom: 4px;">Email Kontak</label>
            <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? 'info@aspara.id') }}" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; margin-bottom: 4px;">Telepon</label>
            <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '(0251) 1234-5678') }}" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; margin-bottom: 4px;">Alamat</label>
            <textarea name="contact_address" rows="3" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">{{ old('contact_address', $settings['contact_address'] ?? 'Jl. Raya Pajajaran No. 45, Bogor Tengah, Kabupaten Bogor') }}</textarea>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 20px; padding-top: 16px; border-top: 1px solid #e5e7eb;">
            <button type="submit" style="background: #10b981; color: #fff; border: none; padding: 10px 28px; border-radius: 40px; font-weight: 600; cursor: pointer;">Simpan</button>
            <a href="{{ route('admin.dashboard') }}" style="background: #e5e7eb; color: #374151; padding: 10px 28px; border-radius: 40px; text-decoration: none; font-weight: 600;">Kembali</a>
        </div>
    </form>
</div>
@endsection
