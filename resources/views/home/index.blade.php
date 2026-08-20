@extends('layouts.app')
@section('title', 'Beranda - ASPARA')
@section('content')

    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛣️</text></svg>" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            font-family: "Poppins", sans-serif;
            background: #f8fafc;
            color: #1e293b;
            line-height: 1.7;
            scroll-behavior: smooth;
        }

        body>main {
            flex: 1;
        }

        footer {
            margin-top: auto;
            flex-shrink: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        :root {
            --primary: #16a34a;
            --primary-dark: #15803d;
            --primary-light: #dcfce7;
            --secondary: #f97316;
            --secondary-light: #ffedd5;
            --accent: #ef4444;
            --accent-light: #fee2e2;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-600: #475569;
            --gray-800: #1e293b;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            --shadow-hover: 0 20px 30px -10px rgba(0, 0, 0, 0.12);
            --radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        header {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            flex-wrap: wrap;
            gap: 10px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 24px;
            font-weight: 800;
            box-shadow: 0 4px 8px rgba(22, 163, 74, 0.3);
            transition: var(--transition);
        }

        .logo-icon:hover {
            transform: rotate(-5deg) scale(1.05);
        }

        .logo-text {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        .logo-text span {
            color: var(--primary);
        }

        .logo-text small {
            font-weight: 400;
            font-size: 0.7rem;
            color: var(--gray-600);
            display: block;
            margin-top: -4px;
            letter-spacing: 0.3px;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 8px;
            font-weight: 500;
            font-size: 0.85rem;
            align-items: center;
            flex-wrap: wrap;
        }

        nav ul li a {
            color: var(--gray-600);
            transition: var(--transition);
            padding: 6px 12px;
            border-radius: 30px;
            white-space: nowrap;
        }

        nav ul li a:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

        nav ul li a.active {
            background: var(--primary);
            color: #fff;
        }

        .btn-report-nav {
            background: var(--secondary);
            color: #fff !important;
            padding: 6px 18px !important;
            border-radius: 40px !important;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(249, 115, 22, 0.25);
        }

        .btn-report-nav:hover {
            background: #ea580c !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(249, 115, 22, 0.35);
        }

        .hero {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
            padding: 60px 0 50px;
            border-radius: 0 0 40px 40px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .hero .container {
            position: relative;
            z-index: 1;
        }

        .hero-grid {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 40px;
        }

        .hero-content {
            flex: 1 1 400px;
        }

        .hero-content .badge {
            display: inline-block;
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 6px 18px;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .hero-content h1 {
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .hero-content h1 span {
            color: var(--primary);
        }

        .hero-content p {
            font-size: 1.1rem;
            color: var(--gray-600);
            max-width: 500px;
            margin-bottom: 28px;
        }

        .hero-stats {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            background: #fff;
            padding: 20px 28px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .hero-stats .stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hero-stats .stat-item i {
            font-size: 1.8rem;
            color: var(--primary);
        }

        .hero-stats .stat-item .num {
            font-weight: 700;
            font-size: 1.6rem;
            line-height: 1.2;
        }

        .hero-stats .stat-item .label {
            font-size: 0.85rem;
            color: var(--gray-600);
        }

        .hero-image {
            flex: 1 1 300px;
            display: flex;
            justify-content: center;
        }

        .hero-image .illustration {
            background: linear-gradient(135deg, #16a34a22, #f9731622);
            padding: 40px;
            border-radius: 30px;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .hero-image .illustration i {
            font-size: 120px;
            color: var(--primary);
            opacity: 0.8;
        }

        .hero-image .illustration p {
            font-weight: 600;
            margin-top: 8px;
            color: var(--gray-600);
        }

        .section-padding {
            padding: 60px 0;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .section-title span {
            color: var(--primary);
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--gray-600);
            max-width: 700px;
            margin-bottom: 32px;
        }

        .text-center {
            text-align: center;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .tentang-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            align-items: center;
        }

        .tentang-grid .text {
            flex: 1 1 350px;
        }

        .tentang-grid .image {
            flex: 1 1 300px;
            display: flex;
            justify-content: center;
        }

        .tentang-grid .image .box {
            background: var(--primary-light);
            padding: 40px;
            border-radius: var(--radius);
            text-align: center;
            width: 100%;
            max-width: 350px;
        }

        .tentang-grid .image .box i {
            font-size: 80px;
            color: var(--primary);
        }

        .problem-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }

        .problem-card {
            background: #fff;
            padding: 28px 24px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
            border-top: 4px solid var(--accent);
        }

        .problem-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }

        .problem-card i {
            font-size: 2.4rem;
            color: var(--accent);
            margin-bottom: 12px;
        }

        .problem-card h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .problem-card p {
            color: var(--gray-600);
            font-size: 0.95rem;
        }

        .manfaat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 24px;
        }

        .manfaat-card {
            background: #fff;
            padding: 28px 20px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
        }

        .manfaat-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }

        .manfaat-card .icon-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 12px;
        }

        .manfaat-card h4 {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .manfaat-card p {
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .cara-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
        }

        .cara-item {
            background: #fff;
            padding: 24px 20px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
            position: relative;
        }

        .cara-item:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }

        .cara-item .step-num {
            display: inline-block;
            background: var(--primary);
            color: #fff;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            line-height: 44px;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .cara-item h4 {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .cara-item p {
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .fitur-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
        }

        .fitur-card {
            background: #fff;
            padding: 28px 20px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
            border-bottom: 4px solid var(--primary);
        }

        .fitur-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }

        .fitur-card i {
            font-size: 2.6rem;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .fitur-card h4 {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .fitur-card p {
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .visi-misi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        @media (max-width:768px) {
            .visi-misi-grid {
                grid-template-columns: 1fr;
            }
        }

        .visi-box,
        .misi-box {
            background: #fff;
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .visi-box h3,
        .misi-box h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .visi-box h3 i {
            color: var(--primary);
        }

        .misi-box h3 i {
            color: var(--secondary);
        }

        .misi-box ul {
            list-style: none;
            padding: 0;
        }

        .misi-box ul li {
            padding: 8px 0;
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .misi-box ul li:last-child {
            border-bottom: none;
        }

        .misi-box ul li i {
            color: var(--secondary);
            margin-top: 4px;
        }

        .faq-list {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 16px;
            overflow: hidden;
        }

        .faq-question {
            padding: 18px 24px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
        }

        .faq-question:hover {
            background: var(--gray-50);
        }

        .faq-question i {
            transition: var(--transition);
            color: var(--primary);
        }

        .faq-answer {
            padding: 0 24px 18px;
            color: var(--gray-600);
            display: none;
        }

        .faq-answer.open {
            display: block;
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: #fff;
            border-radius: var(--radius);
            padding: 50px 40px;
            text-align: center;
            margin: 20px 0 40px;
        }

        .cta-section h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .cta-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 24px;
        }

        .cta-section .btn-cta {
            display: inline-block;
            background: #fff;
            color: var(--primary-dark);
            padding: 14px 40px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: var(--transition);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .cta-section .btn-cta:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        footer {
            background: #0f172a;
            color: #cbd5e1;
            padding: 50px 0 20px;
            margin-top: 40px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-col h4 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 16px;
            font-size: 1.05rem;
        }

        .footer-col p,
        .footer-col li {
            font-size: 0.9rem;
            line-height: 2;
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
        }

        .footer-col ul li a {
            color: #cbd5e1;
            transition: var(--transition);
        }

        .footer-col ul li a:hover {
            color: var(--primary);
        }

        .footer-col .social-icons {
            display: flex;
            gap: 14px;
            margin-top: 8px;
        }

        .footer-col .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            transition: var(--transition);
            font-size: 1.1rem;
        }

        .footer-col .social-icons a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 20px;
            text-align: center;
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .footer-bottom i {
            color: var(--accent);
        }

        @media (max-width:768px) {
            .header-inner {
                flex-direction: column;
                gap: 12px;
            }

            nav ul {
                justify-content: center;
                gap: 6px;
            }

            nav ul li a {
                font-size: 0.75rem;
                padding: 4px 10px;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-stats {
                padding: 16px;
                gap: 16px;
            }

            .hero-stats .stat-item .num {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 1.6rem;
            }

            .cta-section {
                padding: 30px 20px;
            }

            .cta-section h2 {
                font-size: 1.6rem;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width:480px) {
            .hero-content h1 {
                font-size: 1.6rem;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .visi-misi-grid {
                grid-template-columns: 1fr;
            }
        }

        .page {
            display: none;
            padding: 40px 0;
            min-height: 300px;
        }

        .page.active {
            display: block;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--gray-600);
            margin-bottom: 28px;
            font-size: 1.05rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 24px 20px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border-left: 5px solid var(--primary);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }

        .stat-card .icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: #fff;
            flex-shrink: 0;
        }

        .stat-card .icon.green {
            background: var(--primary);
        }

        .stat-card .icon.orange {
            background: var(--secondary);
        }

        .stat-card .icon.red {
            background: var(--accent);
        }

        .stat-card .icon.blue {
            background: #3b82f6;
        }

        .stat-card .info .number {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .stat-card .info .label {
            font-size: 0.9rem;
            color: var(--gray-600);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
            background: #fff;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        th {
            text-align: left;
            padding: 14px 16px;
            background: var(--gray-100);
            font-weight: 600;
            color: var(--gray-600);
        }

        td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--gray-200);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-badge.selesai {
            background: var(--primary-light);
            color: var(--primary-dark);
        }

        .status-badge.proses {
            background: var(--secondary-light);
            color: #c2410c;
        }

        .status-badge.ditolak {
            background: var(--accent-light);
            color: #b91c1c;
        }

        .status-badge.baru {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-badge.Menunggu-Verifikasi {
            background: #dbeafe;
            color: #1d4ed8;
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

        #mapFull {
            height: 500px;
            border-radius: 12px;
            border: 2px solid var(--gray-200);
            z-index: 1;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-family: inherit;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 12px 32px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(22, 163, 74, 0.3);
        }

        .btn-secondary {
            background: var(--secondary);
            color: #fff;
            border: none;
            padding: 12px 32px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-secondary:hover {
            background: #ea580c;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(249, 115, 22, 0.3);
        }

        .chart-container {
            background: #fff;
            padding: 24px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            max-width: 700px;
        }

        .chart-container canvas {
            max-height: 300px;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #16a34a;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    </head>

    <body>

        <header>
            <div class="container header-inner">
                <div class="logo" onclick="navigateTo('beranda')">
                    <div class="logo-icon"><i class="fas fa-road"></i></div>
                    <div class="logo-text">aspara <span>.</span> <small>Aspal Nusantara</small></div>
                </div>
                <nav>
                    <ul>
                        <li><a href="#" class="active" data-page="beranda">Beranda</a></li>
                        <li><a href="#" data-page="lapor">Lapor Jalan</a></li>
                        <li><a href="#" data-page="peta">Peta</a></li>
                        <li><a href="#" data-page="status">Status</a></li>
                        <li><a href="#" data-page="statistik">Statistik</a></li>
                        <li><a href="#" data-page="riwayat">Riwayat</a></li>
                        <li><a href="#" data-page="kontak">Kontak</a></li>
                        <li><a href="#" class="btn-report-nav" data-page="lapor"><i class="fas fa-plus-circle"></i>
                                Laporkan</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <section class="page active" id="page-beranda">
                <div class="hero">
                    <div class="container">
                        <div class="hero-grid">
                            <div class="hero-content">
                                <div class="badge"><i class="fas fa-road"></i> Sistem Informasi Jalan Rusak Kabupaten Bogor
                                </div>
                                <h1>Pantau & Laporkan <br /><span>Jalan Rusak</span> Secara Real-time</h1>
                                <p>aspara menghubungkan masyarakat dengan pemerintah untuk perbaikan jalan yang lebih cepat
                                    dan transparan. Laporkan kerusakan, pantau progress, dan lihat dampaknya.</p>
                                <div class="hero-stats" id="heroStats">
                                    <div class="stat-item"><i class="fas fa-clipboard-list"></i>
                                        <div>
                                            <div class="num" id="heroTotal">0</div>
                                            <div class="label">Total Laporan</div>
                                        </div>
                                    </div>
                                    <div class="stat-item"><i class="fas fa-check-circle" style="color:var(--primary)"></i>
                                        <div>
                                            <div class="num" id="heroSelesai">0</div>
                                            <div class="label">Selesai</div>
                                        </div>
                                    </div>
                                    <div class="stat-item"><i class="fas fa-spinner" style="color:var(--secondary)"></i>
                                        <div>
                                            <div class="num" id="heroProses">0</div>
                                            <div class="label">Proses</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hero-image">
                                <div class="illustration">
                                    <i class="fas fa-road"></i>
                                    <p>Kabupaten Bogor</p>
                                    <span style="font-size:0.85rem;color:var(--gray-600)">12 titik terlaporkan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <section class="section-padding" id="tentang">
                        <div class="tentang-grid">
                            <div class="text">
                                <span
                                    style="color:var(--primary);font-weight:600;text-transform:uppercase;letter-spacing:1px;font-size:0.85rem;">Tentang
                                    Kami</span>
                                <h2 class="section-title">Apa Itu <span>aspara</span>?</h2>
                                <p style="color:var(--gray-600);margin-bottom:16px;"><strong>aspara (Aspal
                                        Nusantara)</strong> adalah platform partisipasi publik yang menghubungkan masyarakat
                                    Kabupaten Bogor dengan pemerintah daerah dalam penanganan jalan rusak.</p>
                                <p style="color:var(--gray-600);margin-bottom:16px;">Kami hadir untuk menjawab kebutuhan
                                    akan infrastruktur jalan yang aman dan nyaman, dengan mengedepankan transparansi,
                                    kecepatan respon, dan akuntabilitas.</p>
                                <p style="color:var(--gray-600);">Dengan aspara, setiap warga dapat menjadi bagian dari
                                    solusi — melaporkan kerusakan, memantau progress perbaikan, dan memastikan jalan kembali
                                    mulus.</p>
                            </div>
                            <div class="image">
                                <div class="box">
                                    <i class="fas fa-handshake"></i>
                                    <h4 style="margin-top:12px;font-weight:700;">Kolaborasi Masyarakat & Pemerintah</h4>
                                    <p style="color:var(--gray-600);font-size:0.9rem;">Transparan, cepat, dan akuntabel.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section-padding" style="padding-top:0" id="mengapa">
                        <h2 class="section-title text-center">Mengapa <span>aspara</span> Dibuat?</h2>
                        <p class="section-subtitle text-center mx-auto">Latar belakang hadirnya aspara untuk menjawab
                            kebutuhan mendesak akan infrastruang jalan yang layak.</p>
                        <div class="problem-grid" style="margin-top:20px">
                            <div class="problem-card"><i class="fas fa-clock"></i>
                                <h4>Respon Lambat</h4>
                                <p>Laporan kerusakan jalan seringkali membutuhkan waktu lama untuk ditindaklanjuti.</p>
                            </div>
                            <div class="problem-card" style="border-top-color:var(--secondary)"><i
                                    class="fas fa-question-circle"></i>
                                <h4>Kurang Transparan</h4>
                                <p>Masyarakat tidak memiliki akses untuk memantau progress perbaikan yang sedang
                                    berlangsung.</p>
                            </div>
                            <div class="problem-card" style="border-top-color:var(--primary)"><i class="fas fa-users"></i>
                                <h4>Partisipasi Rendah</h4>
                                <p>Belum ada wadah yang memudahkan masyarakat untuk melaporkan kerusakan secara langsung.
                                </p>
                            </div>
                        </div>
                    </section>

                    <section class="section-padding" style="padding-top:0" id="masalah">
                        <h2 class="section-title text-center">Permasalahan Jalan Rusak di <span>Kabupaten Bogor</span></h2>
                        <p class="section-subtitle text-center mx-auto">Data dan fakta menunjukkan bahwa kondisi jalan di
                            Kabupaten Bogor membutuhkan perhatian serius.</p>
                        <div style="display:flex;flex-wrap:wrap;gap:24px;justify-content:center;margin-top:10px;">
                            <div
                                style="background:#fff;padding:24px 30px;border-radius:var(--radius);box-shadow:var(--shadow);flex:1 1 200px;text-align:center;">
                                <div style="font-size:2.8rem;font-weight:800;color:var(--accent);">70%</div>
                                <p style="color:var(--gray-600);">Jalan rusak akibat curah hujan tinggi</p>
                            </div>
                            <div
                                style="background:#fff;padding:24px 30px;border-radius:var(--radius);box-shadow:var(--shadow);flex:1 1 200px;text-align:center;">
                                <div style="font-size:2.8rem;font-weight:800;color:var(--secondary);">45%</div>
                                <p style="color:var(--gray-600);">Laporan tidak tertangani dengan cepat</p>
                            </div>
                            <div
                                style="background:#fff;padding:24px 30px;border-radius:var(--radius);box-shadow:var(--shadow);flex:1 1 200px;text-align:center;">
                                <div style="font-size:2.8rem;font-weight:800;color:var(--primary);">12+</div>
                                <p style="color:var(--gray-600);">Kecamatan terdampak kerusakan jalan</p>
                            </div>
                        </div>
                        <p style="text-align:center;color:var(--gray-600);margin-top:20px;font-size:0.95rem;"><i
                                class="fas fa-info-circle"></i> Data berdasarkan laporan masyarakat dan survei lapangan
                            2025-2026.</p>
                    </section>

                    <section class="section-padding" style="padding-top:0" id="manfaat">
                        <h2 class="section-title text-center">Manfaat Platform bagi <span>Masyarakat & Pemerintah</span>
                        </h2>
                        <p class="section-subtitle text-center mx-auto">aspara memberikan keuntungan bagi semua pihak yang
                            terlibat dalam penanganan jalan rusak.</p>
                        <div class="manfaat-grid" style="margin-top:10px">
                            <div class="manfaat-card">
                                <div class="icon-circle"><i class="fas fa-user-check"></i></div>
                                <h4>Masyarakat</h4>
                                <p>Mudah melaporkan kerusakan dan memantau progress perbaikan secara real-time.</p>
                            </div>
                            <div class="manfaat-card">
                                <div class="icon-circle"
                                    style="background:var(--secondary-light);color:var(--secondary);"><i
                                        class="fas fa-building"></i></div>
                                <h4>Pemerintah</h4>
                                <p>Mendapatkan data akurat untuk prioritas perbaikan dan alokasi anggaran yang tepat
                                    sasaran.</p>
                            </div>
                            <div class="manfaat-card">
                                <div class="icon-circle" style="background:#dbeafe;color:#2563eb;"><i
                                        class="fas fa-hand-holding-heart"></i></div>
                                <h4>Transparansi</h4>
                                <p>Setiap laporan dan progress perbaikan dapat diakses publik, menciptakan kepercayaan.</p>
                            </div>
                            <div class="manfaat-card">
                                <div class="icon-circle" style="background:#fce4ec;color:#e53935;"><i
                                        class="fas fa-tachometer-alt"></i></div>
                                <h4>Efisiensi</h4>
                                <p>Mempercepat respon dan penanganan kerusakan jalan dengan sistem yang terintegrasi.</p>
                            </div>
                        </div>
                    </section>

                    <section class="section-padding" style="padding-top:0" id="cara-kerja">
                        <h2 class="section-title text-center">Cara Kerja <span>aspara</span></h2>
                        <p class="section-subtitle text-center mx-auto">Empat langkah sederhana untuk melaporkan dan
                            memantau perbaikan jalan.</p>
                        <div class="cara-grid" style="margin-top:10px">
                            <div class="cara-item">
                                <div class="step-num">1</div>
                                <h4>Laporkan</h4>
                                <p>Masyarakat melaporkan lokasi dan kondisi jalan rusak melalui formulir atau aplikasi.</p>
                            </div>
                            <div class="cara-item">
                                <div class="step-num" style="background:var(--secondary)">2</div>
                                <h4>Verifikasi</h4>
                                <p>Tim aspara memverifikasi laporan, memvalidasi data, dan menentukan prioritas.</p>
                            </div>
                            <div class="cara-item">
                                <div class="step-num" style="background:var(--accent)">3</div>
                                <h4>Perbaikan</h4>
                                <p>Dinas terkait melakukan perbaikan sesuai jadwal yang telah ditentukan.</p>
                            </div>
                            <div class="cara-item">
                                <div class="step-num" style="background:#3b82f6">4</div>
                                <h4>Selesai</h4>
                                <p>Laporan ditutup setelah perbaikan selesai dan dikonfirmasi oleh masyarakat.</p>
                            </div>
                        </div>
                    </section>

                    <section class="section-padding" style="padding-top:0" id="fitur">
                        <h2 class="section-title text-center">Fitur <span>Unggulan</span></h2>
                        <p class="section-subtitle text-center mx-auto">Berbagai fitur yang membuat aspara menjadi platform
                            andalan untuk pelaporan jalan rusak.</p>
                        <div class="fitur-grid" style="margin-top:10px">
                            <div class="fitur-card"><i class="fas fa-map-marked-alt"></i>
                                <h4>Peta Interaktif</h4>
                                <p>Titik lokasi jalan rusak ditampilkan secara visual dengan status penanganan.</p>
                            </div>
                            <div class="fitur-card" style="border-bottom-color:var(--secondary)"><i
                                    class="fas fa-search"></i>
                                <h4>Cek Status</h4>
                                <p>Masukkan ID laporan untuk mengetahui perkembangan perbaikan secara real-time.</p>
                            </div>
                            <div class="fitur-card" style="border-bottom-color:var(--accent)"><i
                                    class="fas fa-chart-bar"></i>
                                <h4>Statistik Lengkap</h4>
                                <p>Data dan grafik pelaporan per kecamatan serta status penanganan.</p>
                            </div>
                            <div class="fitur-card" style="border-bottom-color:#3b82f6"><i class="fas fa-history"></i>
                                <h4>Riwayat Perbaikan</h4>
                                <p>Daftar jalan yang sudah selesai diperbaiki sebagai bentuk akuntabilitas.</p>
                            </div>
                        </div>
                    </section>

                    <section class="section-padding" style="padding-top:0" id="visi-misi">
                        <h2 class="section-title text-center">Visi & <span>Misi</span></h2>
                        <p class="section-subtitle text-center mx-auto">Landasan filosofis aspara dalam mewujudkan
                            infrastruktur jalan yang lebih baik.</p>
                        <div class="visi-misi-grid" style="margin-top:10px">
                            <div class="visi-box">
                                <h3><i class="fas fa-eye"></i> Visi</h3>
                                <p style="font-size:1.05rem;color:var(--gray-600);">Mewujudkan infrastruktur jalan yang
                                    aman, nyaman, dan berkeadilan bagi seluruh masyarakat Kabupaten Bogor melalui
                                    partisipasi aktif dan transparansi penuh.</p>
                            </div>
                            <div class="misi-box">
                                <h3><i class="fas fa-bullseye"></i> Misi</h3>
                                <ul>
                                    <li><i class="fas fa-check-circle"></i> Memfasilitasi masyarakat untuk melaporkan
                                        kerusakan jalan secara mudah dan cepat.</li>
                                    <li><i class="fas fa-check-circle"></i> Menyediakan informasi real-time tentang status
                                        penanganan setiap laporan.</li>
                                    <li><i class="fas fa-check-circle"></i> Mendorong kolaborasi antara masyarakat,
                                        pemerintah, dan pihak terkait.</li>
                                    <li><i class="fas fa-check-circle"></i> Menjadi platform transparan yang dapat
                                        dipertanggungjawabkan publik.</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <section class="section-padding" style="padding-top:0" id="faq">
                        <h2 class="section-title text-center">Pertanyaan <span>Umum</span></h2>
                        <p class="section-subtitle text-center mx-auto">Jawaban atas pertanyaan yang sering diajukan
                            tentang aspara.</p>
                        <div class="faq-list" style="margin-top:10px">
                            <div class="faq-item active">
                                <div class="faq-question" onclick="toggleFaq(this)">Apa itu aspara? <i
                                        class="fas fa-chevron-down"></i></div>
                                <div class="faq-answer open">aspara (Aspal Nusantara) adalah platform partisipasi publik
                                    untuk melaporkan dan memantau penanganan jalan rusak di Kabupaten Bogor.</div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">Bagaimana cara melaporkan jalan rusak?
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="faq-answer">Klik menu "Lapor Jalan" di navbar, isi formulir dengan data lokasi,
                                    deskripsi kerusakan, dan unggah foto jika ada. Laporan akan diverifikasi oleh tim
                                    aspara.</div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">Apakah saya bisa melihat progress
                                    laporan saya? <i class="fas fa-chevron-down"></i></div>
                                <div class="faq-answer">Ya, Anda bisa menggunakan menu "Status Laporan" dan memasukkan ID
                                    laporan yang diberikan setelah pengiriman. Status akan diperbarui secara berkala.</div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">Siapa yang menangani perbaikan jalan?
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="faq-answer">Perbaikan dilakukan oleh dinas terkait di Kabupaten Bogor
                                    berdasarkan prioritas yang telah ditentukan. aspara berperan sebagai jembatan informasi
                                    antara masyarakat dan pemerintah.</div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">Apakah data laporan saya aman? <i
                                        class="fas fa-chevron-down"></i></div>
                                <div class="faq-answer">Kami berkomitmen melindungi data pribadi Anda. Semua data laporan
                                    hanya digunakan untuk keperluan penanganan jalan dan tidak akan disebarluaskan tanpa
                                    izin.</div>
                            </div>
                        </div>
                    </section>

                    <section class="section-padding" style="padding-top:0" id="cta">
                        <div class="cta-section">
                            <h2>Siap Menjadi Bagian dari Solusi?</h2>
                            <p>Laporkan jalan rusak di sekitar Anda dan bantu kami mewujudkan infrastruktur yang lebih baik
                                untuk Kabupaten Bogor.</p>
                            <a href="#" class="btn-cta" onclick="navigateTo('lapor'); return false;"><i
                                    class="fas fa-plus-circle"></i> Mulai Laporkan Sekarang</a>
                        </div>
                    </section>
                </div>
            </section>

            <section class="page" id="page-lapor">
                <div class="container">
                    <h1 class="page-title"><i class="fas fa-plus-circle" style="color:var(--secondary)"></i> Lapor Jalan
                        Rusak</h1>
                    <p class="page-subtitle">Isi formulir di bawah ini untuk melaporkan kondisi jalan yang rusak di
                        Kabupaten Bogor.</p>
                    <div
                        style="background:#fff;padding:30px;border-radius:var(--radius);box-shadow:var(--shadow);max-width:700px;">
                        <form id="formLapor">
                            <div class="form-group"><label>Nama Pelapor</label><input type="text" id="namaPelapor"
                                    placeholder="Nama lengkap" required /></div>
                            <div class="form-group"><label>Kontak (HP/WA)</label><input type="text" id="kontakPelapor"
                                    placeholder="Nomor telepon" required /></div>
                            <div class="form-group"><label>Lokasi Jalan</label><input type="text" id="lokasiJalan"
                                    placeholder="Nama jalan / titik koordinat" required /></div>
                            <div class="form-group"><label>Kecamatan</label>
                                <select id="kecamatanLapor">
                                    <option>Bogor Timur</option>
                                    <option>Bogor Selatan</option>
                                    <option>Bogor Tengah</option>
                                    <option>Bogor Utara</option>
                                    <option>Citeureup</option>
                                    <option>Cibinong</option>
                                    <option>Gunung Putri</option>
                                    <option>Cileungsi</option>
                                    <option>Jonggol</option>
                                    <option>Leuwiliang</option>
                                </select>
                            </div>
                            <div class="form-group"><label>Deskripsi Kerusakan</label>
                                <textarea id="deskripsiLapor" rows="4" placeholder="Jelaskan kondisi jalan, ukuran lubang, dll." required></textarea>
                            </div>
                            <div class="form-group"><label>Foto (opsional)</label><input type="file" accept="image/*"
                                    id="fotoLapor" /></div>
                            <button type="submit" class="btn-secondary"><i class="fas fa-paper-plane"></i> Kirim
                                Laporan</button>
                        </form>
                        <div id="laporFeedback" style="margin-top:16px;font-weight:600;"></div>
                    </div>
                </div>
            </section>

            <section class="page" id="page-peta">
                <div class="container">
                    <h1 class="page-title"><i class="fas fa-map-marked-alt" style="color:var(--accent)"></i> Peta
                        Kerusakan Jalan</h1>
                    <p class="page-subtitle">Semua titik laporan kerusakan jalan di Kabupaten Bogor.</p>
                    <div style="background:#fff;padding:20px;border-radius:var(--radius);box-shadow:var(--shadow);">
                        <div id="mapFull"
                            style="height:500px;border-radius:12px;border:2px solid var(--gray-200);z-index:1;"></div>
                        <p style="margin-top:12px;font-size:0.85rem;color:var(--gray-600);"><i
                                class="fas fa-info-circle"></i> Klik marker untuk melihat detail laporan. Warna: Hijau
                            (Selesai), Oranye (Proses), Merah (Ditolak), Biru (Baru).</p>
                    </div>
                </div>
            </section>

            <section class="page" id="page-status">
                <div class="container">
                    <h1 class="page-title"><i class="fas fa-search" style="color:var(--primary)"></i> Cek Status Laporan
                    </h1>
                    <p class="page-subtitle">Masukkan ID laporan untuk mengetahui perkembangan penanganan.</p>
                    <div
                        style="background:#fff;padding:30px;border-radius:var(--radius);box-shadow:var(--shadow);max-width:600px;">
                        <div class="form-group"><label>ID Laporan</label><input type="text" id="statusId"
                                placeholder="Contoh: ASP-2026-001" /></div>
                        <button class="btn-primary" onclick="cekStatus()"><i class="fas fa-search"></i> Cek
                            Status</button>
                        <div id="statusResult"
                            style="margin-top:20px;padding:16px;background:var(--gray-50);border-radius:12px;display:none;">
                        </div>
                    </div>
                    <div
                        style="margin-top:20px;background:#fff;padding:20px;border-radius:var(--radius);box-shadow:var(--shadow);">
                        <h3>Contoh ID Laporan</h3>
                        <ul style="list-style:none;display:flex;gap:16px;flex-wrap:wrap;margin-top:8px;">
                            <li style="background:var(--gray-100);padding:6px 16px;border-radius:20px;">ASP-2026-001</li>
                            <li style="background:var(--gray-100);padding:6px 16px;border-radius:20px;">ASP-2026-002</li>
                            <li style="background:var(--gray-100);padding:6px 16px;border-radius:20px;">ASP-2026-003</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="page" id="page-statistik">
                <div class="container">
                    <h1 class="page-title"><i class="fas fa-chart-bar" style="color:var(--primary)"></i> Statistik
                        Laporan</h1>
                    <p class="page-subtitle">Grafik dan data lengkap pelaporan jalan rusak.</p>
                    <div class="stats-grid" id="statsGridStat">
                        <div class="stat-card">
                            <div class="icon green"><i class="fas fa-clipboard-list"></i></div>
                            <div class="info">
                                <div class="number" id="statTotal">0</div>
                                <div class="label">Total Laporan</div>
                            </div>
                        </div>
                        <div class="stat-card" style="border-left-color:var(--secondary)">
                            <div class="icon orange"><i class="fas fa-clock"></i></div>
                            <div class="info">
                                <div class="number" id="statProses">0</div>
                                <div class="label">Dalam Proses</div>
                            </div>
                        </div>
                        <div class="stat-card" style="border-left-color:var(--primary)">
                            <div class="icon blue"><i class="fas fa-check-circle"></i></div>
                            <div class="info">
                                <div class="number" id="statSelesai">0</div>
                                <div class="label">Selesai</div>
                            </div>
                        </div>
                        <div class="stat-card" style="border-left-color:var(--accent)">
                            <div class="icon red"><i class="fas fa-times-circle"></i></div>
                            <div class="info">
                                <div class="number" id="statDitolak">0</div>
                                <div class="label">Ditolak</div>
                            </div>
                        </div>
                    </div>
                    <div style="display:flex;flex-wrap:wrap;gap:30px;">
                        <div class="chart-container">
                            <h3 style="margin-bottom:12px;">Status Laporan</h3><canvas id="statusChart"></canvas>
                        </div>
                        <div class="chart-container">
                            <h3 style="margin-bottom:12px;">Laporan per Kecamatan</h3><canvas
                                id="kecamatanChart"></canvas>
                        </div>
                    </div>
                    <div style="background:#fff;padding:24px;border-radius:var(--radius);box-shadow:var(--shadow);">
                        <h3 style="margin-bottom:12px;">Rincian Data per Kecamatan</h3>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <th>Total</th>
                                        <th>Selesai</th>
                                        <th>Proses</th>
                                        <th>Ditolak</th>
                                    </tr>
                                </thead>
                                <tbody id="statTableBody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="page" id="page-riwayat">
                <div class="container">
                    <h1 class="page-title"><i class="fas fa-history" style="color:var(--secondary)"></i> Riwayat
                        Perbaikan</h1>
                    <p class="page-subtitle">Daftar jalan yang sudah selesai diperbaiki.</p>
                    <div style="background:#fff;padding:20px;border-radius:var(--radius);box-shadow:var(--shadow);">
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lokasi</th>
                                        <th>Kecamatan</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="riwayatBody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="page" id="page-kontak">
                <div class="container">
                    <h1 class="page-title"><i class="fas fa-envelope" style="color:var(--secondary)"></i> Kontak &
                        Bantuan</h1>
                    <p class="page-subtitle">Hubungi kami jika ada pertanyaan atau kendala.</p>
                    <div style="display:flex;flex-wrap:wrap;gap:30px;">
                        <div
                            style="flex:1;min-width:280px;background:#fff;padding:30px;border-radius:var(--radius);box-shadow:var(--shadow);">
                            <h3><i class="fas fa-phone-alt" style="color:var(--primary)"></i> Telepon</h3>
                            <p style="margin:8px 0 16px;">(0251) 1234-5678</p>
                            <h3><i class="fas fa-envelope" style="color:var(--primary)"></i> Email</h3>
                            <p style="margin:8px 0 16px;">info@aspara.id</p>
                            <h3><i class="fas fa-map-marker-alt" style="color:var(--primary)"></i> Alamat</h3>
                            <p>Jl. Raya Pajajaran No. 45, Bogor Tengah, Kabupaten Bogor</p>
                        </div>
                        <div
                            style="flex:1.5;min-width:300px;background:#fff;padding:30px;border-radius:var(--radius);box-shadow:var(--shadow);">
                            <h3 style="margin-bottom:16px;">Kirim Pesan</h3>
                            <form id="formKontak">
                                <div class="form-group">
                                    <label>Nama <span style="color:#ef4444;">*</span></label>
                                    <input type="text" id="kontakNama" placeholder="Nama lengkap" required />
                                </div>
                                <div class="form-group">
                                    <label>Email <span style="color:#ef4444;">*</span></label>
                                    <input type="email" id="kontakEmail" placeholder="email@contoh.com" required />
                                </div>
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input type="text" id="kontakTelepon" placeholder="Nomor telepon (opsional)" />
                                </div>
                                <div class="form-group">
                                    <label>Pesan <span style="color:#ef4444;">*</span></label>
                                    <textarea id="kontakPesan" rows="4" placeholder="Tulis pesan Anda..." required></textarea>
                                </div>
                                <button type="submit" class="btn-primary"><i class="fas fa-paper-plane"></i> Kirim
                                    Pesan</button>
                            </form>
                            <div id="kontakFeedback" style="margin-top:16px;font-weight:600;"></div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-col">
                        <h4>Tentang aspara</h4>
                        <p>aspara (Aspal Nusantara) adalah platform partisipasi publik untuk melaporkan dan memantau
                            penanganan jalan rusak di Kabupaten Bogor.</p>
                    </div>
                    <div class="footer-col">
                        <h4>Navigasi Cepat</h4>
                        <ul>
                            <li><a href="#" onclick="navigateTo('beranda'); return false;">Beranda</a></li>
                            <li><a href="#" onclick="navigateTo('lapor'); return false;">Lapor Jalan</a></li>
                            <li><a href="#" onclick="navigateTo('peta'); return false;">Peta Kerusakan</a></li>
                            <li><a href="#" onclick="navigateTo('status'); return false;">Status Laporan</a></li>
                            <li><a href="#" onclick="navigateTo('statistik'); return false;">Statistik</a></li>
                            <li><a href="#" onclick="navigateTo('riwayat'); return false;">Riwayat Perbaikan</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Kontak</h4>
                        <p><i class="fas fa-phone" style="width:20px;"></i> (0251) 1234-5678</p>
                        <p><i class="fas fa-envelope" style="width:20px;"></i> info@aspara.id</p>
                        <p><i class="fas fa-map-marker-alt" style="width:20px;"></i> Jl. Raya Pajajaran No. 45, Bogor
                            Tengah</p>
                    </div>
                    <div class="footer-col">
                        <h4>Instansi Terkait</h4>
                        <p>Dinas Pekerjaan Umum<br />Kabupaten Bogor</p>
                        <p style="margin-top:8px;">Badan Perencanaan<br />Pembangunan Daerah</p>
                    </div>
                    <div class="footer-col">
                        <h4>Ikuti Kami</h4>
                        <div class="social-icons"><a href="#"><i class="fab fa-instagram"></i></a><a
                                href="#"><i class="fab fa-twitter"></i></a><a href="#"><i
                                    class="fab fa-youtube"></i></a><a href="#"><i class="fab fa-github"></i></a><a
                                href="#"><i class="fab fa-facebook"></i></a></div>
                        <p style="margin-top:16px;font-size:0.85rem;">#aspara #AspalNusantara #Bogor</p>
                    </div>
                </div>
                <div class="footer-bottom">&copy; 2026 <strong>aspara — Aspal Nusantara</strong> &bull; Kabupaten Bogor
                    &bull; Hak Cipta Dilindungi</div>
            </div>
        </footer>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

        <script>
            const defaultLaporan = [{
                    id: 1,
                    lokasi: "Jl. Pahlawan No. 12",
                    kecamatan: "Bogor Timur",
                    tanggal: "2026-06-15",
                    status: "Selesai",
                    lat: -6.595,
                    lng: 106.805,
                    detail: "Amblas sedang, sudah diperbaiki.",
                    namaPelapor: "Budi",
                    kontak: "08123456789",
                    verifikasi: true,
                    petugas: "Petugas A",
                    progress: 100,
                    dokumentasi: []
                },
                {
                    id: 2,
                    lokasi: "Jl. Merdeka Km 3",
                    kecamatan: "Bogor Selatan",
                    tanggal: "2026-06-14",
                    status: "Proses",
                    lat: -6.62,
                    lng: 106.795,
                    detail: "Retak memanjang, sedang dalam penanganan.",
                    namaPelapor: "Siti",
                    kontak: "08123456780",
                    verifikasi: true,
                    petugas: "Petugas B",
                    progress: 45,
                    dokumentasi: []
                },
                {
                    id: 3,
                    lokasi: "Jl. Raya Tajur",
                    kecamatan: "Bogor Timur",
                    tanggal: "2026-06-13",
                    status: "Baru",
                    lat: -6.61,
                    lng: 106.82,
                    detail: "Lubang besar, berbahaya bagi pengendara.",
                    namaPelapor: "Agus",
                    kontak: "08123456781",
                    verifikasi: false,
                    petugas: null,
                    progress: 0,
                    dokumentasi: []
                },
                {
                    id: 4,
                    lokasi: "Jl. Ir. H. Juanda",
                    kecamatan: "Bogor Tengah",
                    tanggal: "2026-06-12",
                    status: "Ditolak",
                    lat: -6.598,
                    lng: 106.79,
                    detail: "Duplikat laporan nomor 7.",
                    namaPelapor: "Rina",
                    kontak: "08123456782",
                    verifikasi: true,
                    petugas: null,
                    progress: 0,
                    dokumentasi: []
                },
                {
                    id: 5,
                    lokasi: "Jl. Raya Pajajaran",
                    kecamatan: "Bogor Utara",
                    tanggal: "2026-06-11",
                    status: "Selesai",
                    lat: -6.58,
                    lng: 106.8,
                    detail: "Tambalan aspal baru.",
                    namaPelapor: "Dedi",
                    kontak: "08123456783",
                    verifikasi: true,
                    petugas: "Petugas C",
                    progress: 100,
                    dokumentasi: []
                },
                {
                    id: 6,
                    lokasi: "Jl. Sholeh Iskandar",
                    kecamatan: "Bogor Selatan",
                    tanggal: "2026-06-10",
                    status: "Proses",
                    lat: -6.625,
                    lng: 106.81,
                    detail: "Bergerak, perlu penanganan struktural.",
                    namaPelapor: "Tuti",
                    kontak: "08123456784",
                    verifikasi: true,
                    petugas: "Petugas A",
                    progress: 60,
                    dokumentasi: []
                },
                {
                    id: 7,
                    lokasi: "Jl. Raya Citeureup",
                    kecamatan: "Citeureup",
                    tanggal: "2026-06-09",
                    status: "Baru",
                    lat: -6.49,
                    lng: 106.89,
                    detail: "Jalan berlubang di tikungan.",
                    namaPelapor: "Eko",
                    kontak: "08123456785",
                    verifikasi: false,
                    petugas: null,
                    progress: 0,
                    dokumentasi: []
                },
                {
                    id: 8,
                    lokasi: "Jl. Raya Cibinong",
                    kecamatan: "Cibinong",
                    tanggal: "2026-06-08",
                    status: "Selesai",
                    lat: -6.481,
                    lng: 106.854,
                    detail: "Perbaikan total.",
                    namaPelapor: "Nina",
                    kontak: "08123456786",
                    verifikasi: true,
                    petugas: "Petugas B",
                    progress: 100,
                    dokumentasi: []
                },
                {
                    id: 9,
                    lokasi: "Jl. Raya Gunung Putri",
                    kecamatan: "Gunung Putri",
                    tanggal: "2026-06-07",
                    status: "Proses",
                    lat: -6.446,
                    lng: 106.92,
                    detail: "Retak lebar, sedang dijadwalkan.",
                    namaPelapor: "Yudi",
                    kontak: "08123456787",
                    verifikasi: true,
                    petugas: "Petugas C",
                    progress: 30,
                    dokumentasi: []
                },
                {
                    id: 10,
                    lokasi: "Jl. Raya Cileungsi",
                    kecamatan: "Cileungsi",
                    tanggal: "2026-06-06",
                    status: "Ditolak",
                    lat: -6.395,
                    lng: 106.96,
                    detail: "Bukan wewenang aspara.",
                    namaPelapor: "Dewi",
                    kontak: "08123456788",
                    verifikasi: true,
                    petugas: null,
                    progress: 0,
                    dokumentasi: []
                },
                {
                    id: 11,
                    lokasi: "Jl. Raya Jonggol",
                    kecamatan: "Jonggol",
                    tanggal: "2026-06-05",
                    status: "Baru",
                    lat: -6.468,
                    lng: 107.04,
                    detail: "Amblas parah akibat hujan.",
                    namaPelapor: "Rizki",
                    kontak: "08123456789",
                    verifikasi: false,
                    petugas: null,
                    progress: 0,
                    dokumentasi: []
                },
                {
                    id: 12,
                    lokasi: "Jl. Raya Leuwiliang",
                    kecamatan: "Leuwiliang",
                    tanggal: "2026-06-04",
                    status: "Proses",
                    lat: -6.575,
                    lng: 106.62,
                    detail: "Tambalan lepas, perlu perbaikan ulang.",
                    namaPelapor: "Sari",
                    kontak: "08123456790",
                    verifikasi: true,
                    petugas: "Petugas A",
                    progress: 75,
                    dokumentasi: []
                },
            ];

            function getDB() {
                let db = localStorage.getItem("aspara_db");
                if (!db) {
                    const initial = {
                        users: [{
                                id: 1,
                                username: "admin",
                                password: "password",
                                role: "admin",
                                name: "Admin ASPARA"
                            },
                            {
                                id: 2,
                                username: "petugas",
                                password: "password",
                                role: "petugas",
                                name: "Petugas Lapangan"
                            }
                        ],
                        reports: defaultLaporan,
                        logs: [{
                            time: new Date().toISOString(),
                            message: "Sistem ASPARA siap digunakan."
                        }]
                    };
                    localStorage.setItem("aspara_db", JSON.stringify(initial));
                    return initial;
                }
                return JSON.parse(db);
            }

            function saveDB(db) {
                localStorage.setItem("aspara_db", JSON.stringify(db));
            }

            function addLog(message) {
                const db = getDB();
                db.logs.push({
                    time: new Date().toISOString(),
                    message
                });
                if (db.logs.length > 500) db.logs.shift();
                saveDB(db);
            }

            function navigateTo(page) {
                document.querySelectorAll('.page').forEach(el => el.classList.remove('active'));
                const target = document.getElementById('page-' + page);
                if (target) target.classList.add('active');

                document.querySelectorAll('nav ul li a').forEach(el => el.classList.remove('active'));
                const navLink = document.querySelector(`nav ul li a[data-page="${page}"]`);
                if (navLink) navLink.classList.add('active');

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

                if (page === 'peta') {
                    setTimeout(() => {
                        if (typeof mapFull !== 'undefined' && mapFull) {
                            mapFull.invalidateSize();
                        } else {
                            initMaps();
                        }
                    }, 300);
                }

                if (page === 'statistik') {
                    setTimeout(() => {
                        if (typeof statusChart !== 'undefined' && statusChart) statusChart.update();
                        if (typeof kecamatanChart !== 'undefined' && kecamatanChart) kecamatanChart.update();
                    }, 300);
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('nav ul li a[data-page]').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        navigateTo(this.dataset.page);
                    });
                });
            });

            function updateAllStats() {
                const db = getDB();
                const reports = db.reports || [];
                const total = reports.length;
                const selesai = reports.filter(d => d.status === 'Selesai').length;
                const proses = reports.filter(d => d.status === 'Proses').length;
                const ditolak = reports.filter(d => d.status === 'Ditolak').length;

                const elTotal = document.getElementById('heroTotal');
                const elSelesai = document.getElementById('heroSelesai');
                const elProses = document.getElementById('heroProses');
                const statTotal = document.getElementById('statTotal');
                const statProses = document.getElementById('statProses');
                const statSelesai = document.getElementById('statSelesai');
                const statDitolak = document.getElementById('statDitolak');

                if (elTotal) elTotal.textContent = total;
                if (elSelesai) elSelesai.textContent = selesai;
                if (elProses) elProses.textContent = proses;
                if (statTotal) statTotal.textContent = total;
                if (statProses) statProses.textContent = proses;
                if (statSelesai) statSelesai.textContent = selesai;
                if (statDitolak) statDitolak.textContent = ditolak;
            }

            function renderRiwayat() {
                const db = getDB();
                const reports = db.reports || [];
                const data = reports.filter(d => d.status === 'Selesai');
                const tbody = document.getElementById('riwayatBody');
                if (!tbody) return;
                tbody.innerHTML = '';
                data.forEach((item, idx) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML =
                        `<td>${idx + 1}</td><td><strong>${item.lokasi}</strong></td><td>${item.kecamatan}</td><td>${item.tanggal}</td><td><span class="status-badge selesai">Selesai</span></td>`;
                    tbody.appendChild(tr);
                });
            }

            function renderStatTable() {
                const db = getDB();
                const reports = db.reports || [];
                const tbody = document.getElementById('statTableBody');
                if (!tbody) return;
                const map = {};
                reports.forEach(d => {
                    if (!map[d.kecamatan]) map[d.kecamatan] = {
                        total: 0,
                        selesai: 0,
                        proses: 0,
                        ditolak: 0
                    };
                    map[d.kecamatan].total++;
                    if (d.status === 'Selesai') map[d.kecamatan].selesai++;
                    else if (d.status === 'Proses') map[d.kecamatan].proses++;
                    else if (d.status === 'Ditolak') map[d.kecamatan].ditolak++;
                });
                tbody.innerHTML = '';
                Object.entries(map).forEach(([kec, v]) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML =
                        `<td>${kec}</td><td>${v.total}</td><td>${v.selesai}</td><td>${v.proses}</td><td>${v.ditolak}</td>`;
                    tbody.appendChild(tr);
                });
            }

            let statusChart = null;
            let kecamatanChart = null;

            function initCharts() {
                const db = getDB();
                const reports = db.reports || [];
                const selesai = reports.filter(d => d.status === 'Selesai').length;
                const proses = reports.filter(d => d.status === 'Proses').length;
                const ditolak = reports.filter(d => d.status === 'Ditolak').length;
                const baru = reports.filter(d => d.status === 'Baru').length;

                const ctx1 = document.getElementById('statusChart');
                if (ctx1) {
                    if (statusChart) statusChart.destroy();
                    statusChart = new Chart(ctx1.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: ['Selesai', 'Proses', 'Ditolak', 'Baru'],
                            datasets: [{
                                data: [selesai, proses, ditolak, baru],
                                backgroundColor: ['#16A34A', '#F97316', '#EF4444', '#3b82f6'],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                }

                const map = {};
                reports.forEach(d => {
                    if (!map[d.kecamatan]) map[d.kecamatan] = 0;
                    map[d.kecamatan]++;
                });
                const labels = Object.keys(map);
                const data = Object.values(map);
                const ctx2 = document.getElementById('kecamatanChart');
                if (ctx2) {
                    if (kecamatanChart) kecamatanChart.destroy();
                    kecamatanChart = new Chart(ctx2.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Laporan',
                                data: data,
                                backgroundColor: '#16A34A88',
                                borderColor: '#16A34A',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                }
            }

            let mapFull = null;

            function initMaps() {
                const db = getDB();
                const reports = db.reports || [];
                const center = [-6.55, 106.8];
                const container = document.getElementById('mapFull');
                if (!container) return;

                if (mapFull) {
                    mapFull.remove();
                    mapFull = null;
                }

                mapFull = L.map('mapFull').setView(center, 11);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap'
                }).addTo(mapFull);

                const iconGreen = L.divIcon({
                    className: 'custom-marker',
                    html: '<i class="fas fa-map-pin" style="color:#16A34A; font-size:32px; text-shadow:0 2px 6px rgba(0,0,0,0.3);"></i>',
                    iconSize: [32, 42],
                    iconAnchor: [16, 42],
                    popupAnchor: [0, -38]
                });
                const iconOrange = L.divIcon({
                    className: 'custom-marker',
                    html: '<i class="fas fa-map-pin" style="color:#F97316; font-size:32px; text-shadow:0 2px 6px rgba(0,0,0,0.3);"></i>',
                    iconSize: [32, 42],
                    iconAnchor: [16, 42],
                    popupAnchor: [0, -38]
                });
                const iconRed = L.divIcon({
                    className: 'custom-marker',
                    html: '<i class="fas fa-map-pin" style="color:#EF4444; font-size:32px; text-shadow:0 2px 6px rgba(0,0,0,0.3);"></i>',
                    iconSize: [32, 42],
                    iconAnchor: [16, 42],
                    popupAnchor: [0, -38]
                });
                const iconBlue = L.divIcon({
                    className: 'custom-marker',
                    html: '<i class="fas fa-map-pin" style="color:#3b82f6; font-size:32px; text-shadow:0 2px 6px rgba(0,0,0,0.3);"></i>',
                    iconSize: [32, 42],
                    iconAnchor: [16, 42],
                    popupAnchor: [0, -38]
                });

                function getIcon(status) {
                    switch (status) {
                        case 'Selesai':
                            return iconGreen;
                        case 'Proses':
                            return iconOrange;
                        case 'Ditolak':
                            return iconRed;
                        default:
                            return iconBlue;
                    }
                }

                reports.forEach(item => {
                    if (item.lat && item.lng) {
                        L.marker([item.lat, item.lng], {
                                icon: getIcon(item.status)
                            })
                            .addTo(mapFull)
                            .bindPopup(
                                `<strong>${item.lokasi}</strong><br>Kecamatan: ${item.kecamatan}<br>Status: <span style="font-weight:600;">${item.status}</span><br><span style="font-size:0.85rem;">${item.detail}</span><br><small>${item.tanggal}</small>`
                            );
                    }
                });

                const legend = L.control({
                    position: 'bottomright'
                });
                legend.onAdd = function() {
                    const div = L.DomUtil.create('div', 'info legend');
                    div.style.background = 'white';
                    div.style.padding = '10px 14px';
                    div.style.borderRadius = '8px';
                    div.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                    div.style.fontSize = '0.85rem';
                    div.innerHTML =
                        `<div><i class="fas fa-circle" style="color:#16A34A;"></i> Selesai</div><div><i class="fas fa-circle" style="color:#F97316;"></i> Proses</div><div><i class="fas fa-circle" style="color:#EF4444;"></i> Ditolak</div><div><i class="fas fa-circle" style="color:#3b82f6;"></i> Baru</div>`;
                    return div;
                };
                legend.addTo(mapFull);
            }

            async function cekStatus() {
                const idInput = document.getElementById('statusId');
                const resultDiv = document.getElementById('statusResult');
                if (!idInput || !resultDiv) return;

                const kode = idInput.value.trim();
                if (!kode) {
                    resultDiv.style.display = 'block';
                    resultDiv.innerHTML = '<span style="color:var(--accent);">⚠️ Silakan masukkan ID laporan.</span>';
                    return;
                }

                try {
                    resultDiv.style.display = 'block';
                    resultDiv.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari laporan...';

                    const response = await fetch(`/api/reports?kode=${encodeURIComponent(kode)}`);
                    const reports = await response.json();

                    const data = reports.find(r => r.kode_laporan === kode);

                    if (data) {
                        const statusClass = data.status.replace(/ /g, '-');
                        resultDiv.innerHTML = `
                            <p><strong>ID Tiket:</strong> ${data.kode_laporan}</p>
                            <p><strong>Lokasi:</strong> ${data.alamat_lokasi}</p>
                            <p><strong>Kecamatan:</strong> ${data.kecamatan}</p>
                            <p><strong>Status:</strong> <span class="status-badge ${statusClass}">${data.status}</span></p>
                            <p><strong>Detail:</strong> ${data.deskripsi}</p>
                            <p><strong>Tanggal Lapor:</strong> ${new Date(data.created_at).toLocaleDateString('id-ID')}</p>
                            ${data.foto ? `<p><strong>Foto:</strong> <img src="/storage/${data.foto}" style="max-width:200px;border-radius:8px;margin-top:4px;"></p>` : ''}
                        `;
                    } else {
                        resultDiv.innerHTML =
                            '<span style="color:var(--accent);">❌ ID tidak ditemukan. Periksa kembali.</span>';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    resultDiv.innerHTML = '<span style="color:var(--accent);">❌ Gagal memuat data. Coba lagi.</span>';
                }
            }

            function toggleFaq(el) {
                const item = el.closest('.faq-item');
                if (!item) return;
                const answer = item.querySelector('.faq-answer');
                const isOpen = answer && answer.classList.contains('open');
                document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
                document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));
                if (!isOpen && answer) {
                    answer.classList.add('open');
                    item.classList.add('active');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const formLapor = document.getElementById('formLapor');
                if (formLapor) {
                    formLapor.addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const namaPelapor = document.getElementById('namaPelapor').value.trim();
                        const kontak = document.getElementById('kontakPelapor').value.trim();
                        const lokasi = document.getElementById('lokasiJalan').value.trim();
                        const kecamatan = document.getElementById('kecamatanLapor').value;
                        const deskripsi = document.getElementById('deskripsiLapor').value.trim();
                        const fotoInput = document.getElementById('fotoLapor');
                        const feedback = document.getElementById('laporFeedback');

                        if (!namaPelapor || !kontak || !lokasi || !deskripsi) {
                            if (feedback) {
                                feedback.innerHTML =
                                    '<span style="color:#ef4444;">⚠️ Semua field wajib diisi!</span>';
                            }
                            return;
                        }

                        const formData = new FormData();
                        formData.append('nama_pelapor', namaPelapor);
                        formData.append('kontak', kontak);
                        formData.append('lokasi', lokasi);
                        formData.append('kecamatan', kecamatan);
                        formData.append('deskripsi', deskripsi);
                        if (fotoInput && fotoInput.files[0]) {
                            formData.append('foto', fotoInput.files[0]);
                        }

                        try {
                            if (feedback) {
                                feedback.innerHTML =
                                    '<i class="fas fa-spinner fa-spin"></i> Mengirim laporan...';
                                feedback.style.color = '#3b82f6';
                            }

                            const response = await fetch('/api/reports', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]')
                                        ?.content || '',
                                    'Accept': 'application/json',
                                },
                                body: formData
                            });

                            const result = await response.json();

                            if (result.success) {
                                if (feedback) {
                                    feedback.innerHTML = `
                                        ✅ Laporan berhasil dikirim!<br>
                                        <strong>ID Tiket:</strong> ${result.ticket}<br>
                                        <small>Simpan ID ini untuk cek status laporan Anda.</small>
                                    `;
                                    feedback.style.color = '#16a34a';
                                }
                                formLapor.reset();

                                const db = getDB();
                                const newReport = {
                                    id: result.data.id || db.reports.length + 1,
                                    lokasi: lokasi,
                                    kecamatan: kecamatan,
                                    tanggal: new Date().toISOString().slice(0, 10),
                                    status: 'Menunggu Verifikasi',
                                    lat: null,
                                    lng: null,
                                    detail: deskripsi,
                                    namaPelapor: namaPelapor,
                                    kontak: kontak,
                                    verifikasi: false,
                                    petugas: null,
                                    progress: 0,
                                    dokumentasi: []
                                };
                                db.reports.push(newReport);
                                saveDB(db);

                                updateAllStats();
                                renderRiwayat();
                                renderStatTable();
                                initCharts();

                            } else {
                                if (feedback) {
                                    feedback.innerHTML = `❌ Gagal: ${result.message}`;
                                    feedback.style.color = '#ef4444';
                                }
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            if (feedback) {
                                feedback.innerHTML = '❌ Terjadi kesalahan jaringan. Silakan coba lagi.';
                                feedback.style.color = '#ef4444';
                            }
                        }
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                if (!localStorage.getItem('aspara_db')) {
                    const initial = {
                        users: [{
                                id: 1,
                                username: 'admin',
                                password: 'password',
                                role: 'admin',
                                name: 'Admin ASPARA'
                            },
                            {
                                id: 2,
                                username: 'petugas',
                                password: 'password',
                                role: 'petugas',
                                name: 'Petugas Lapangan'
                            }
                        ],
                        reports: defaultLaporan,
                        logs: [{
                            time: new Date().toISOString(),
                            message: 'Sistem ASPARA siap digunakan.'
                        }]
                    };
                    localStorage.setItem('aspara_db', JSON.stringify(initial));
                }

                updateAllStats();
                renderRiwayat();
                renderStatTable();
                initCharts();
                initMaps();
                navigateTo('beranda');
            });

            document.addEventListener('DOMContentLoaded', function() {
                const formKontak = document.getElementById('formKontak');
                if (formKontak) {
                    formKontak.addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const name = document.getElementById('kontakNama').value.trim();
                        const email = document.getElementById('kontakEmail').value.trim();
                        const phone = document.getElementById('kontakTelepon').value.trim();
                        const message = document.getElementById('kontakPesan').value.trim();
                        const feedback = document.getElementById('kontakFeedback');

                        if (!name || !email || !message) {
                            if (feedback) {
                                feedback.innerHTML =
                                    '<span style="color:#ef4444;">⚠️ Nama, Email, dan Pesan wajib diisi!</span>';
                            }
                            return;
                        }

                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(email)) {
                            if (feedback) {
                                feedback.innerHTML =
                                    '<span style="color:#ef4444;">⚠️ Email tidak valid!</span>';
                            }
                            return;
                        }

                        try {
                            if (feedback) {
                                feedback.innerHTML =
                                    '<i class="fas fa-spinner fa-spin"></i> Mengirim pesan...';
                                feedback.style.color = '#3b82f6';
                            }

                            const response = await fetch('/api/messages', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]')?.content || '',
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    name: name,
                                    email: email,
                                    phone: phone,
                                    message: message
                                })
                            });

                            const result = await response.json();

                            if (result.success) {
                                if (feedback) {
                                    feedback.innerHTML = `
                                        ✅ ${result.message}<br>
                                        <small style="color:#64748b;">Kami akan merespons secepatnya.</small>
                                    `;
                                    feedback.style.color = '#16a34a';
                                }
                                formKontak.reset();
                            } else {
                                if (feedback) {
                                    feedback.innerHTML = `❌ Gagal: ${result.message}`;
                                    feedback.style.color = '#ef4444';
                                }
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            if (feedback) {
                                feedback.innerHTML = '❌ Terjadi kesalahan jaringan. Silakan coba lagi.';
                                feedback.style.color = '#ef4444';
                            }
                        }
                    });
                }
            });
        </script>
    @endsection
