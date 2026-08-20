@extends('layouts.app')

@section('title', 'Dashboard Admin - ASPARA')

@section('content')
<style>
    .admin-content > section {
        display: none;
    }
    .admin-content > section#section-dashboard {
        display: block;
    }

    :root {
        --primary: #10b981;
        --primary-dark: #047857;
        --primary-light: #d1fae5;
        --secondary: #f59e0b;
        --secondary-light: #fef3c7;
        --accent: #ef4444;
        --accent-light: #fee2e2;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --radius: 16px;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        --shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
        --transition: all 0.25s ease;
    }

    .admin-wrapper {
        display: flex;
        min-height: calc(100vh - 140px);
        background: #f1f5f9;
        gap: 0;
    }

    .admin-sidebar {
        width: 270px;
        background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        color: #cbd5e1;
        padding: 0 0 24px 0;
        flex-shrink: 0;
        position: sticky;
        top: 80px;
        height: fit-content;
        border-radius: 0 24px 24px 0;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        backdrop-filter: blur(4px);
        border-right: 1px solid rgba(255, 255, 255, 0.03);
    }

    .admin-sidebar .sidebar-brand {
        padding: 28px 24px 24px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        margin-bottom: 20px;
        background: rgba(16, 185, 129, 0.04);
    }

    .admin-sidebar .sidebar-brand h3 {
        color: #fff;
        font-weight: 800;
        font-size: 1.5rem;
        letter-spacing: -0.5px;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .admin-sidebar .sidebar-brand h3 span {
        color: var(--primary);
        background: rgba(16, 185, 129, 0.2);
        padding: 0 4px;
        border-radius: 4px;
    }

    .admin-sidebar .sidebar-brand small {
        font-size: 0.7rem;
        color: #94a3b8;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-weight: 500;
        margin-top: 2px;
        display: block;
    }

    .admin-sidebar ul {
        list-style: none;
        padding: 0 12px;
        margin: 0;
    }

    .admin-sidebar ul li {
        margin-bottom: 2px;
    }

    .admin-sidebar ul li a {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        color: #94a3b8;
        transition: var(--transition);
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.9rem;
        text-decoration: none;
        position: relative;
    }

    .admin-sidebar ul li a i {
        width: 24px;
        text-align: center;
        font-size: 1.1rem;
        flex-shrink: 0;
        color: #64748b;
        transition: var(--transition);
    }

    .admin-sidebar ul li a:hover {
        background: rgba(255, 255, 255, 0.06);
        color: #f1f5f9;
    }

    .admin-sidebar ul li a:hover i {
        color: var(--primary);
    }

    .admin-sidebar ul li a.active {
        background: rgba(16, 185, 129, 0.12);
        color: #fff;
        box-shadow: 0 0 0 1px rgba(16, 185, 129, 0.15);
    }

    .admin-sidebar ul li a.active i {
        color: var(--primary);
    }

    .admin-sidebar ul li a.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 28px;
        background: var(--primary);
        border-radius: 0 4px 4px 0;
    }

    .admin-sidebar ul li a .badge-side {
        margin-left: auto;
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        font-size: 0.7rem;
        padding: 2px 10px;
        border-radius: 40px;
        font-weight: 600;
    }

    .admin-content {
        flex: 1;
        padding: 32px 40px;
        background: #f8fafc;
        min-width: 0;
    }

    .admin-content .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .admin-content .page-header h1 {
        font-size: 1.9rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .admin-content .page-header h1 small {
        font-size: 0.9rem;
        font-weight: 400;
        color: var(--gray-500);
        margin-left: 8px;
    }

    .admin-content .page-header .date-badge {
        font-size: 0.85rem;
        color: var(--gray-500);
        background: #fff;
        padding: 6px 16px;
        border-radius: 40px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .admin-card {
        background: #ffffff;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 24px 28px;
        margin-bottom: 28px;
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    .admin-card:hover {
        box-shadow: var(--shadow-hover);
        border-color: rgba(16, 185, 129, 0.05);
    }

    .admin-card .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--gray-100);
    }

    .admin-card .card-header h3 {
        font-weight: 600;
        font-size: 1.1rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--gray-800);
    }

    .admin-card .card-header h3 i {
        color: var(--primary);
        font-size: 1.2rem;
    }

    .admin-card .card-header .badge-status {
        background: var(--primary-light);
        color: var(--primary-dark);
        padding: 5px 16px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .admin-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .admin-stat-card {
        background: #fff;
        padding: 20px 22px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 18px;
        transition: var(--transition);
        border-left: 6px solid var(--primary);
        position: relative;
        overflow: hidden;
    }

    .admin-stat-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 140px;
        height: 140px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.04) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .admin-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-hover);
    }

    .admin-stat-card .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #fff;
        flex-shrink: 0;
        z-index: 1;
    }

    .admin-stat-card .stat-icon.green {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .admin-stat-card .stat-icon.orange {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .admin-stat-card .stat-icon.blue {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }

    .admin-stat-card .stat-icon.red {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .admin-stat-card .stat-info {
        z-index: 1;
    }

    .admin-stat-card .stat-info .number {
        font-size: 1.9rem;
        font-weight: 800;
        line-height: 1.2;
        color: var(--gray-800);
    }

    .admin-stat-card .stat-info .label {
        font-size: 0.85rem;
        color: var(--gray-500);
        font-weight: 500;
    }

    .table-wrapper {
        overflow-x: auto;
        margin: 0 -4px;
    }

    .admin-table {
        width: 100%;
        font-size: 0.9rem;
        border-collapse: separate;
        border-spacing: 0;
    }

    .admin-table th {
        background: var(--gray-50);
        color: var(--gray-600);
        font-weight: 600;
        padding: 14px 16px;
        text-align: left;
        border-bottom: 2px solid var(--gray-200);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        white-space: nowrap;
    }

    .admin-table td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
        background: #fff;
        transition: background 0.15s;
    }

    .admin-table tbody tr:hover td {
        background: var(--gray-50);
    }

    .admin-table .action-btns {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .btn-sm {
        padding: 5px 14px;
        font-size: 0.75rem;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        letter-spacing: 0.2px;
    }

    .btn-sm i {
        font-size: 0.7rem;
    }

    .btn-sm.btn-edit {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .btn-sm.btn-edit:hover {
        background: #bfdbfe;
    }

    .btn-sm.btn-delete {
        background: #fee2e2;
        color: #b91c1c;
    }

    .btn-sm.btn-delete:hover {
        background: #fecaca;
    }

    .btn-sm.btn-status {
        background: var(--secondary-light);
        color: #c2410c;
    }

    .btn-sm.btn-status:hover {
        background: #fed7aa;
    }

    .btn-sm.btn-view {
        background: var(--primary-light);
        color: var(--primary-dark);
    }

    .btn-sm.btn-view:hover {
        background: #bbf7d0;
    }

    .btn-primary {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);
        text-decoration: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #334155;
        border: none;
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: var(--transition);
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

    .status-badge {
        display: inline-block;
        padding: 4px 16px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.2px;
        text-transform: capitalize;
    }

    .status-badge.Menunggu-Verifikasi {
        background: #fef3c7;
        color: #92400e;
    }

    .status-badge.Diproses {
        background: var(--secondary-light);
        color: #c2410c;
    }

    .status-badge.Selesai {
        background: var(--primary-light);
        color: var(--primary-dark);
    }

    .status-badge.Ditolak {
        background: var(--accent-light);
        color: #b91c1c;
    }

    .status-unread {
        background: #fee2e2;
        color: #991b1b;
    }
    .status-read {
        background: #dbeafe;
        color: #1d4ed8;
    }
    .status-replied {
        background: #dcfce7;
        color: #166534;
    }
    .badge-unread {
        background: #ef4444;
        color: #fff;
        padding: 2px 10px;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 600;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .pagination-wrapper {
        margin-top: 24px;
        display: flex;
        justify-content: center;
        opacity: 0;
        /* TANDA */
    }

    .admin-form .form-group {
        margin-bottom: 20px;
    }

    .admin-form .form-group label {
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        font-size: 0.9rem;
        color: var(--gray-700);
    }

    .admin-form .form-group input,
    .admin-form .form-group select,
    .admin-form .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.95rem;
        transition: var(--transition);
        background: #fff;
    }

    .admin-form .form-group input:focus,
    .admin-form .form-group select:focus,
    .admin-form .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: flex-end;
    }

    .filter-form .form-group {
        margin-bottom: 0;
        flex: 1 1 180px;
        min-width: 140px;
    }

    .filter-form .form-group label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 4px;
    }

    .filter-form .btn-group {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    /* ===== MODAL ===== */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(6px);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .modal-overlay.active {
        display: flex;
        animation: fadeIn 0.25s ease;
    }

    .modal-box {
        background: #fff;
        max-width: 640px;
        width: 100%;
        max-height: 85vh;
        overflow-y: auto;
        border-radius: 24px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        padding: 32px 36px;
        position: relative;
        animation: slideUp 0.3s ease;
    }

    .modal-box .close-modal {
        position: absolute;
        top: 18px;
        right: 22px;
        font-size: 2rem;
        cursor: pointer;
        color: var(--gray-400);
        background: none;
        border: none;
        transition: var(--transition);
        line-height: 1;
    }

    .modal-box .close-modal:hover {
        color: var(--gray-600);
        transform: rotate(90deg);
    }

    .modal-box .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        padding-right: 40px;
        color: var(--gray-800);
    }

    .modal-box .detail-item {
        display: flex;
        padding: 10px 0;
        border-bottom: 1px solid var(--gray-100);
        gap: 12px;
    }

    .modal-box .detail-item:last-child {
        border-bottom: none;
    }

    .modal-box .detail-item .label {
        font-weight: 600;
        width: 130px;
        flex-shrink: 0;
        color: var(--gray-500);
        font-size: 0.9rem;
    }

    .modal-box .detail-item .value {
        flex: 1;
        color: var(--gray-800);
    }

    .modal-box .detail-item .value img {
        max-width: 100%;
        max-height: 300px;
        border-radius: 12px;
        margin-top: 6px;
        box-shadow: var(--shadow);
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @media (max-width: 1024px) {
        .admin-content { padding: 24px 20px; }
    }

    @media (max-width: 992px) {
        .admin-wrapper { flex-direction: column; }
        .admin-sidebar {
            width: 100%;
            position: relative;
            top: 0;
            border-radius: 0 0 24px 24px;
            padding: 0 0 12px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border-right: none;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .admin-sidebar .sidebar-brand {
            padding: 20px 24px 16px;
            margin-bottom: 8px;
        }
        .admin-sidebar ul {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2px;
            padding: 0 8px;
        }
        .admin-sidebar ul li { margin-bottom: 0; }
        .admin-sidebar ul li a {
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            gap: 8px;
        }
        .admin-sidebar ul li a.active::before { display: none; }
        .admin-sidebar ul li a.active { background: rgba(16,185,129,0.15); }
        .admin-sidebar ul li a i { font-size: 1rem; }
        .admin-content { padding: 20px; }
        .admin-stats-grid { grid-template-columns: repeat(2, 1fr); }
        .admin-card { padding: 18px 16px; }
        .modal-box { padding: 24px 20px; }
    }

    @media (max-width: 576px) {
        .admin-stats-grid { grid-template-columns: 1fr; }
        .admin-content .page-header {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }
        .admin-content .page-header h1 { font-size: 1.5rem; }
        .admin-content .page-header .date-badge { align-self: flex-start; }
        .admin-table { font-size: 0.8rem; }
        .admin-table th, .admin-table td { padding: 10px 8px; }
        .action-btns .btn-sm { font-size: 0.7rem; padding: 4px 10px; }
        .filter-form .form-group { flex: 1 1 100%; }
        .filter-form .btn-group { width: 100%; }
        .filter-form .btn-group .btn-primary,
        .filter-form .btn-group .btn-secondary {
            flex: 1;
            text-align: center;
            justify-content: center;
        }
        .modal-box { padding: 20px 16px; }
        .modal-box .detail-item {
            flex-direction: column;
            gap: 2px;
        }
        .modal-box .detail-item .label { width: auto; }
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #94a3b8;
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
    .detail-card .reply-box {
        background: #f0fdf4;
        padding: 16px 20px;
        border-radius: 12px;
        margin-top: 16px;
        border-left: 4px solid #16a34a;
    }
    .detail-card .reply-box .reply-label {
        font-weight: 600;
        color: #16a34a;
        margin-bottom: 4px;
    }

    .btn-back-dashboard {
        background: #e2e8f0;
        color: #334155;
        border: none;
        padding: 6px 16px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-back-dashboard:hover {
        background: #cbd5e1;
    }

    .profile-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 32px;
        border: 1px solid rgba(0,0,0,0.02);
        max-width: 600px;
        margin: 0 auto;
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
        transition: var(--transition);
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
        transition: var(--transition);
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
</style>

<div class="admin-wrapper">

    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <h3>aspara <div style="color:#16a34a;">.</div> </h3>
            <small>Dashboard Admin</small>
        </div>
        <ul>
                        <li><a href="#" data-section="profil"><i class="fas fa-user-circle"></i> Profil</a></li>

            <li><a href="#" class="active" data-section="dashboard"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
            <li><a href="#" data-section="laporan"><i class="fas fa-clipboard-list"></i> Laporan</a></li>
            <li>
                <a href="#" data-section="messages">
                    <i class="fas fa-envelope"></i> Pesan
                    <span class="badge-side" id="unreadBadge">{{ $unreadCount ?? 0 }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings.index') }}" data-section="pengaturan">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </li>
            <li><a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Kembali ke Depan</a></li>
        </ul>
    </aside>

    <main class="admin-content">

        <section id="section-dashboard">
            <div class="page-header">
                <h1>Dashboard <small>Ringkasan sistem</small></h1>
                <span class="date-badge"><i class="far fa-calendar-alt"></i> {{ now()->format('d F Y') }}</span>
            </div>

            <div class="admin-stats-grid">
                <div class="admin-stat-card">
                    <div class="stat-icon green"><i class="fas fa-clipboard-list"></i></div>
                    <div class="stat-info">
                        <div class="number">{{ $totalLaporan ?? 0 }}</div>
                        <div class="label">Total Laporan</div>
                    </div>
                </div>
                <div class="admin-stat-card" style="border-left-color:#f59e0b;">
                    <div class="stat-icon orange"><i class="fas fa-clock"></i></div>
                    <div class="stat-info">
                        <div class="number">{{ $menunggu ?? 0 }}</div>
                        <div class="label">Menunggu Verifikasi</div>
                    </div>
                </div>
                <div class="admin-stat-card" style="border-left-color:#f59e0b;">
                    <div class="stat-icon orange"><i class="fas fa-spinner"></i></div>
                    <div class="stat-info">
                        <div class="number">{{ $diproses ?? 0 }}</div>
                        <div class="label">Diproses</div>
                    </div>
                </div>
                <div class="admin-stat-card" style="border-left-color:#3b82f6;">
                    <div class="stat-icon blue"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-info">
                        <div class="number">{{ $selesai ?? 0 }}</div>
                        <div class="label">Selesai</div>
                    </div>
                </div>
                <div class="admin-stat-card" style="border-left-color:#ef4444;">
                    <div class="stat-icon red"><i class="fas fa-times-circle"></i></div>
                    <div class="stat-info">
                        <div class="number">{{ $ditolak ?? 0 }}</div>
                        <div class="label">Ditolak</div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header">
                    <h3><i class="fas fa-clock"></i> Laporan Terbaru</h3>
                    <a href="#" onclick="showSection('laporan')" style="font-size:0.9rem;color:var(--primary);font-weight:600;text-decoration:none;">Lihat Semua &rarr;</a>
                </div>
                <div class="table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Pelapor</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports->take(5) as $laporan)
                                <tr>
                                    <td><strong>{{ $laporan->kode_laporan }}</strong></td>
                                    <td>{{ $laporan->nama_pelapor }}</td>
                                    <td>{{ Str::limit($laporan->alamat_lokasi, 30) }}</td>
                                    <td><span class="status-badge {{ str_replace(' ', '-', $laporan->status) }}">{{ $laporan->status }}</span></td>
                                    <td>{{ $laporan->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <button class="btn-sm btn-view" onclick="showDetail({{ $laporan->id }})"><i class="fas fa-eye"></i></button>
                                        <a href="{{ route('admin.report.edit', $laporan) }}" class="btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" style="padding:30px;text-align:center;color:var(--gray-500);">Belum ada laporan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="section-laporan" style="display:none;">
            <div class="page-header">
                <h1>Manajemen Laporan <small>Kelola semua laporan jalan rusak</small></h1>
                <a href="{{ route('admin.report.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i> Tambah Laporan
                </a>
            </div>

            <div class="admin-card" style="padding:20px 24px;">
                <form method="GET" action="{{ route('admin.dashboard') }}" class="filter-form" id="filterForm">
                    <div class="form-group" style="flex:2;">
                        <label for="search">Cari Laporan</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nama pelapor, lokasi, kecamatan..." style="width:50%;padding:10px 16px;border:1.5px solid #e2e8f0;border-radius:12px;font-size:0.95rem;">
                    </div>

                    <div class="btn-group" style="display:flex;gap:8px;align-items:center;padding-bottom:2px;">
                        <button type="submit" class="btn-primary" style="padding:10px 24px;"><i class="fas fa-search"></i> Filter</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn-secondary" style="padding:10px 24px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </form>
                @if(request('status') || request('search'))
                    <div style="margin-top:12px;padding:8px 16px;background:#f1f5f9;border-radius:8px;font-size:0.85rem;color:#475569;">
                        <i class="fas fa-filter"></i> Filter aktif:
                        @if(request('status')) <strong>{{ request('status') }}</strong> @endif
                        @if(request('search')) <strong>"{{ request('search') }}"</strong> @endif
                        <a href="{{ route('admin.dashboard') }}" style="color:#10b981;margin-left:8px;font-weight:600;">Hapus filter</a>
                    </div>
                @endif
            </div>

            <div class="admin-card">
                <div class="card-header">
                    <h3><i class="fas fa-list-ul"></i> Daftar Laporan</h3>
                    <span class="badge-status">
                        Total:
                        @if(request('status'))
                            {{ $reports->total() ?? 0 }} ({{ request('status') }})
                        @else
                            {{ $reports->total() ?? 0 }}
                        @endif
                    </span>
                </div>
                <div class="table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Pelapor</th>
                                <th>Telepon</th>
                                <th>Lokasi</th>
                                <th>Kecamatan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="reportTableBody">
                            @forelse ($reports as $laporan)
                                <tr id="report-row-{{ $laporan->id }}">
                                    <td><strong>{{ $laporan->kode_laporan }}</strong></td>
                                    <td>{{ $laporan->nama_pelapor }}</td>
                                    <td>{{ $laporan->telepon_pelapor }}</td>
                                    <td>{{ Str::limit($laporan->alamat_lokasi, 25) }}</td>
                                    <td>{{ $laporan->kecamatan }}</td>
                                    <td><span class="status-badge {{ str_replace(' ', '-', $laporan->status) }}">{{ $laporan->status }}</span></td>
                                    <td>{{ $laporan->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn-sm btn-view" onclick="showDetail({{ $laporan->id }})"><i class="fas fa-eye"></i></button>
                                            <a href="{{ route('admin.report.edit', $laporan) }}" class="btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                            <button class="btn-sm btn-status" onclick="ubahStatus({{ $laporan->id }})"><i class="fas fa-exchange-alt"></i></button>
                                            <form action="{{ route('admin.report.destroy', $laporan) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" style="padding:30px;text-align:center;color:var(--gray-500);">
                                    @if(request('status'))
                                        <i class="fas fa-search" style="font-size:2rem;display:block;margin-bottom:8px;color:#cbd5e1;"></i>
                                        Tidak ada laporan dengan status <strong>"{{ request('status') }}"</strong>.
                                    @else
                                        <i class="fas fa-inbox" style="font-size:2rem;display:block;margin-bottom:8px;color:#cbd5e1;"></i>
                                        Belum ada laporan.
                                    @endif
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    {{ $reports->appends(request()->query())->links() }}
                </div>
            </div>
        </section>

        <div class="modal-overlay" id="detailModal">
            <div class="modal-box">
                <button class="close-modal" onclick="closeDetail()">&times;</button>
                <div class="modal-title">Detail Laporan</div>
                <div id="detailContent">
                    <p style="color:var(--gray-500);">Memuat...</p>
                </div>
            </div>
        </div>

        <section id="section-profil" style="display:none;">
            <div class="page-header">
                <h1>Profil Admin <small>Informasi akun Anda</small></h1>
            </div>

            <div class="profile-card">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>

                <div class="profile-name">{{ auth()->user()->name }}</div>
                <div class="profile-role">
                    <span class="status-badge" style="background:#e0e7ff;color:#3730a3;">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>

                <div class="profile-info">
                    <div class="info-item">
                        <span class="label"><i class="fas fa-user" style="width:20px;color:#10b981;"></i> Nama</span>
                        <span class="value">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label"><i class="fas fa-envelope" style="width:20px;color:#10b981;"></i> Email</span>
                        <span class="value">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label"><i class="fas fa-user-tag" style="width:20px;color:#10b981;"></i> Role</span>
                        <span class="value">
                            <span class="badge-status" style="background:#e0e7ff;color:#3730a3;">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="label"><i class="fas fa-calendar-alt" style="width:20px;color:#10b981;"></i> Bergabung</span>
                        <span class="value">{{ auth()->user()->created_at->format('d F Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label"><i class="fas fa-check-circle" style="width:20px;color:#10b981;"></i> Status</span>
                        <span class="value">
                            <span class="status-badge" style="background:#dcfce7;color:#166534;">
                                <i class="fas fa-circle" style="font-size:0.5rem;color:#16a34a;"></i> Aktif
                            </span>
                        </span>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="{{ route('admin.profile.edit') }}" class="btn-edit">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                    <a href="{{ route('admin.profile.password') }}" class="btn-password">
                        <i class="fas fa-key"></i> Ganti Password
                    </a>
                </div>
            </div>
        </section>

        <section id="section-messages" style="display:none;">
            @if (isset($messages))
                @include('admin.messages.index')
            @else
                <div class="admin-card">
                    <p style="padding:20px;color:var(--gray-500);">Belum ada pesan.</p>
                </div>
            @endif
        </section>

        <section id="section-pengaturan" style="display:none;">
            <div class="page-header">
                <h1>Pengaturan Sistem <small>Konfigurasi aplikasi</small></h1>
            </div>

            <div class="admin-card">
                <h3 style="margin-top:0;margin-bottom:20px;font-weight:600;">Pengaturan Umum</h3>
                <form method="POST" action="{{ route('admin.settings.update') }}" class="admin-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nama Aplikasi</label>
                        <input type="text" name="app_name" value="ASPARA - Aspal Nusantara">
                    </div>
                    <div class="form-group">
                        <label>Email Kontak</label>
                        <input type="email" name="contact_email" value="info@aspara.id">
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="phone" value="(0251) 1234-5678">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="address" rows="3">Jl. Raya Pajajaran No. 45, Bogor Tengah, Kabupaten Bogor</textarea>
                    </div>
                    <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan Pengaturan</button>
                </form>
            </div>
        </section>

    </main>
</div>

<script>
    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    function updateUnreadBadge() {
        fetch('/admin/api/unread-count', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            const badge = document.getElementById('unreadBadge');
            if (badge) {
                badge.textContent = data.count || 0;
                badge.style.display = data.count > 0 ? 'inline-block' : 'none';
            }
        })
        .catch(err => console.error('Gagal update badge:', err));
    }

    function resetFilter() {
        document.getElementById('search').value = '';
        document.getElementById('statusFilter').value = '';
        document.getElementById('filterForm').submit();
    }

    function showSection(sectionId) {
        // Sembunyikan semua section
        document.querySelectorAll('.admin-content > section').forEach(el => el.style.display = 'none');

        const target = document.getElementById('section-' + sectionId);
        if (target) target.style.display = 'block';

        document.querySelectorAll('.admin-sidebar ul li a').forEach(link => link.classList.remove('active'));
        const activeLink = document.querySelector(`.admin-sidebar ul li a[data-section="${sectionId}"]`);
        if (activeLink) activeLink.classList.add('active');

        if (sectionId === 'messages') {
            updateUnreadBadge();
        }
    }

    document.querySelectorAll('.admin-sidebar ul li a[data-section]').forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.getAttribute('href') && this.getAttribute('href') !== '#') {
                return;
            }
            e.preventDefault();
            showSection(this.dataset.section);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        showSection('dashboard');
        setInterval(updateUnreadBadge, 30000);
    });

    function showDetail(id) {
        const modal = document.getElementById('detailModal');
        const content = document.getElementById('detailContent');
        modal.classList.add('active');
        content.innerHTML = '<p style="color:var(--gray-500);">Memuat...</p>';

        fetch(`/admin/laporan/${id}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            const statusClass = data.status.replace(/ /g, '-');
            let fotoHtml = '';
            if (data.foto) {
                fotoHtml = `<div class="detail-item"><span class="label">Foto</span><span class="value"><img src="${data.foto_url}" alt="Foto laporan"></span></div>`;
            }
            content.innerHTML = `
                <div class="detail-item"><span class="label">Kode</span><span class="value">${data.kode_laporan}</span></div>
                <div class="detail-item"><span class="label">Pelapor</span><span class="value">${data.nama_pelapor}</span></div>
                <div class="detail-item"><span class="label">Email</span><span class="value">${data.email_pelapor || '-'}</span></div>
                <div class="detail-item"><span class="label">Telepon</span><span class="value">${data.telepon_pelapor}</span></div>
                <div class="detail-item"><span class="label">Lokasi</span><span class="value">${data.alamat_lokasi}</span></div>
                <div class="detail-item"><span class="label">Kecamatan</span><span class="value">${data.kecamatan}</span></div>
                <div class="detail-item"><span class="label">Status</span><span class="value"><span class="status-badge ${statusClass}">${data.status}</span></span></div>
                <div class="detail-item"><span class="label">Deskripsi</span><span class="value">${data.deskripsi}</span></div>
                <div class="detail-item"><span class="label">Tanggal</span><span class="value">${new Date(data.created_at).toLocaleDateString('id-ID')}</span></div>
                ${fotoHtml}
            `;
        })
        .catch(err => {
            content.innerHTML = `<p style="color:#ef4444;">Gagal memuat detail: ${err.message}</p>`;
        });
    }

    function closeDetail() {
        document.getElementById('detailModal').classList.remove('active');
    }

    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) closeDetail();
    });

    function ubahStatus(id) {
        const statuses = ['Menunggu Verifikasi', 'Diproses', 'Selesai', 'Ditolak'];
        const input = prompt('Pilih status baru (0: Menunggu, 1: Diproses, 2: Selesai, 3: Ditolak):');
        if (input === null) return;
        const idx = parseInt(input);
        if (isNaN(idx) || idx < 0 || idx > 3) {
            alert('Pilihan tidak valid. Gunakan angka 0-3.');
            return;
        }
        const newStatus = statuses[idx];

        fetch(`/admin/laporan/${id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Status berhasil diubah!');
                location.reload();
            } else {
                alert('Gagal mengubah status: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(err => {
            alert('Terjadi kesalahan: ' + err.message);
        });
    }
</script>

@endsection
