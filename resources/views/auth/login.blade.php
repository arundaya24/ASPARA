@extends('layouts.app')

@section('title', 'Login - ASPARA')

@section('content')
<style>
    .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        padding: 20px;
        margin: 0;
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        background: #ffffff;
        border-radius: 24px;
        padding: 40px 32px 32px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
        border: 1px solid #f1f5f9;
        transition: box-shadow 0.2s;
    }

    .login-card:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.06);
    }

    .login-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .login-header .logo-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        background: #10b981;
        border-radius: 20px;
        color: #fff;
        font-size: 1.8rem;
        margin-bottom: 12px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .login-header h2 {
        font-weight: 700;
        font-size: 1.7rem;
        color: #0f172a;
        letter-spacing: -0.3px;
        margin: 0 0 2px;
    }

    .login-header h2 span {
        color: #10b981;
    }

    .login-header p {
        color: #64748b;
        font-size: 0.9rem;
        margin: 0;
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 20px 0;
        color: #94a3b8;
        font-size: 0.85rem;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }

    .divider::before {
        margin-right: 16px;
    }

    .divider::after {
        margin-left: 16px;
    }

    .login-form .form-group {
        margin-bottom: 20px;
    }

    .login-form label {
        display: block;
        font-weight: 600;
        font-size: 0.85rem;
        color: #334155;
        margin-bottom: 6px;
    }

    .login-form .input-wrap {
        position: relative;
    }

    .login-form .input-wrap .icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1rem;
        pointer-events: none;
        transition: color 0.2s;
    }

    .login-form .input-wrap input {
        width: 100%;
        padding: 14px 16px 14px 48px;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        font-family: inherit;
        background: #f8fafc;
        transition: all 0.2s;
        color: #0f172a;
        box-sizing: border-box;
    }

    .login-form .input-wrap input:focus {
        outline: none;
        border-color: #10b981;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.08);
    }

    .login-form .input-wrap input:focus ~ .icon,
    .login-form .input-wrap input:focus + .icon {
        color: #10b981;
    }

    .login-form .input-wrap input::placeholder {
        color: #94a3b8;
        font-size: 0.9rem;
    }

    .btn-login {
        width: 100%;
        padding: 14px;
        background: #10b981;
        border: none;
        border-radius: 12px;
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 4px;
    }

    .btn-login:hover {
        background: #059669;
        box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
    }

    .btn-login:active {
        transform: scale(0.98);
    }

    .btn-login i {
        font-size: 1.1rem;
    }

    .btn-register {
        width: 100%;
        padding: 14px;
        background: transparent;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        color: #334155;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
    }

    .btn-register:hover {
        background: #f8fafc;
        border-color: #10b981;
        color: #10b981;
    }

    .btn-register i {
        font-size: 1.1rem;
    }

    .alert-box {
        margin-top: 20px;
        padding: 12px 16px;
        border-radius: 12px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
    }

    .alert-box i {
        color: #dc2626;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .alert-box span {
        flex: 1;
    }

    .login-footer {
        text-align: center;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
        font-size: 0.8rem;
        color: #94a3b8;
    }

    .login-footer a {
        color: #10b981;
        text-decoration: none;
        font-weight: 600;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 28px 20px 24px;
        }
        .login-header .logo-icon {
            width: 56px;
            height: 56px;
            font-size: 1.5rem;
        }
        .login-header h2 {
            font-size: 1.4rem;
        }
        .login-form .input-wrap input {
            padding: 12px 14px 12px 44px;
            font-size: 0.9rem;
        }
        .btn-login,
        .btn-register {
            padding: 12px;
            font-size: 0.95rem;
        }
    }
</style>

<div class="login-page">
    <div class="login-card">

        <div class="login-header">
            <div class="logo-icon">
                <i class="fas fa-road"></i>
            </div>
            <h2>aspara<span>.</span></h2>
            <p>Administrator Panel</p>
        </div>

        <form method="POST" action="{{ route('login.post') }}" class="login-form">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope icon"></i>
                    <input type="email" name="email" id="email" placeholder="Masukkan email" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock icon"></i>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </button>
        </form>

        @if ($errors->any())
            <div class="alert-box">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert-box">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="login-footer">
            &copy; {{ date('Y') }} <a href="{{ route('home') }}">ASPARA</a> — All rights reserved.
        </div>

    </div>
</div>
@endsection
