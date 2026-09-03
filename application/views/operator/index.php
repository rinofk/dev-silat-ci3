<!-- DataTables CSS (bisa dipindah ke template header) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

<!-- Custom styling for Operator Dashboard -->
<style>
    :root {
        --primary: #0284c7;
        --primary-dark: #0369a1;
        --secondary: #0d9488;
        --success: #10b981;
        --info: #06b6d4;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #1e293b;
        --light: #f8fafc;
        --border: #e2e8f0;
        
        --card-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
        --card-hover-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.08), 0 10px 10px -5px rgba(15, 23, 42, 0.04);
        --font-title: 'Plus Jakarta Sans', sans-serif;
        --font-body: 'Inter', sans-serif;
    }

    /* Page Headings */
    .dashboard-title-bar {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border);
    }

    .dashboard-subtitle {
        font-family: var(--font-body);
        font-size: 14px;
        color: #64748b;
        margin: 0;
    }

    .dashboard-section-title {
        font-family: var(--font-title);
        font-size: 18px;
        font-weight: 800;
        color: #1e293b;
        margin-top: 36px;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dashboard-section-title::before {
        content: '';
        display: inline-block;
        width: 4px;
        height: 18px;
        background: var(--primary);
        border-radius: 2px;
    }

    /* ========================================== */
    /* APP SERVICE LAUNCHER ICONS (MODERN APPS)   */
    /* ========================================== */
    .app-service-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .app-service-link {
        text-decoration: none !important;
        display: block;
        height: 100%;
        color: inherit;
    }

    .app-service-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 20px 12px 16px 12px;
        text-align: center;
        border: 1px solid #eef2f6;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02);
        transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        height: 100%;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .app-service-link:hover .app-service-card {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px -4px rgba(15, 23, 42, 0.12), 0 6px 10px -2px rgba(15, 23, 42, 0.04);
        border-color: #cbd5e1;
    }

    .app-service-link:active .app-service-card {
        transform: scale(0.96);
    }

    .app-icon-squircle {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #ffffff;
        margin-bottom: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .app-service-link:hover .app-icon-squircle {
        transform: scale(1.1) rotate(4deg);
        box-shadow: 0 12px 22px rgba(0, 0, 0, 0.2);
    }

    /* Vibrant Gradients for App Icons */
    .bg-gradient-blue {
        background: linear-gradient(135deg, #0284c7, #38bdf8) !important;
    }
    .bg-gradient-green {
        background: linear-gradient(135deg, #059669, #34d399) !important;
    }
    .bg-gradient-amber {
        background: linear-gradient(135deg, #d97706, #fbbf24) !important;
    }
    .bg-gradient-purple {
        background: linear-gradient(135deg, #7c3aed, #c084fc) !important;
    }
    .bg-gradient-indigo {
        background: linear-gradient(135deg, #4f46e5, #06b6d4) !important;
    }

    .app-service-title {
        font-family: var(--font-title);
        font-size: 13.5px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 4px;
        line-height: 1.3;
        transition: color 0.2s ease;
    }

    .app-service-link:hover .app-service-title {
        color: var(--primary);
    }

    .app-service-admin {
        font-family: var(--font-body);
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        background-color: #f1f5f9;
        padding: 3px 8px;
        border-radius: 6px;
        margin-top: 4px;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        border: 1px solid #e2e8f0;
    }

    .app-service-hint {
        font-family: var(--font-body);
        font-size: 10px;
        font-weight: 700;
        color: var(--primary);
        margin-top: 6px;
        opacity: 0;
        transform: translateY(4px);
        transition: all 0.2s ease;
    }

    .app-service-link:hover .app-service-hint {
        opacity: 1;
        transform: translateY(0);
    }

    /* Visitor Stats Cards */
    .stat-card-gradient {
        border-radius: 20px !important;
        border: none !important;
        color: #ffffff !important;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.05) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .stat-card-gradient:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 30px rgba(15, 23, 42, 0.12) !important;
    }

    .stat-card-gradient.blue {
        background: linear-gradient(135deg, #0284c7, #3b82f6) !important;
    }

    .stat-card-gradient.teal {
        background: linear-gradient(135deg, #0d9488, #10b981) !important;
    }

    .stat-card-gradient.purple {
        background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
    }

    .stat-card-gradient::after {
        content: '';
        position: absolute;
        width: 140px;
        height: 140px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
        right: -30px;
        bottom: -30px;
        border-radius: 50%;
    }

    .stat-card-body {
        padding: 24px;
        position: relative;
        z-index: 2;
    }

    .stat-card-label {
        font-family: var(--font-title);
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.85;
        margin-bottom: 6px;
    }

    .stat-card-value {
        font-family: var(--font-title);
        font-size: 36px;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -0.5px;
    }

    /* Chart Cards Styling */
    .chart-card {
        border-radius: 20px !important;
        border: none !important;
        box-shadow: var(--card-shadow) !important;
        background: #ffffff;
        overflow: hidden;
    }

    .chart-card-header {
        background: #ffffff !important;
        border-bottom: 1px solid var(--border) !important;
        padding: 20px 24px !important;
    }

    .chart-card-title {
        font-family: var(--font-title);
        font-size: 15px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    /* Custom Modern Table Card */
    .custom-table-card {
        border-radius: 20px !important;
        border: none !important;
        box-shadow: var(--card-shadow) !important;
        overflow: hidden;
        background: #ffffff;
    }

    .custom-table-card .card-header {
        background: #ffffff !important;
        border-bottom: 1px solid var(--border) !important;
        padding: 20px 24px !important;
    }

    .custom-table {
        border: none !important;
        margin: 0 !important;
    }

    .custom-table thead th {
        background: #f8fafc !important;
        color: #475569 !important;
        font-family: var(--font-title);
        font-weight: 800 !important;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none !important;
        padding: 16px 20px !important;
    }

    .custom-table tbody td {
        padding: 16px 20px !important;
        border-bottom: 1px solid #f1f5f9 !important;
        border-top: none !important;
        font-family: var(--font-body);
        font-size: 14px;
        color: #334155;
        vertical-align: middle !important;
    }

    .custom-table tbody tr:hover td {
        background-color: #f8fafc !important;
    }

    .custom-table tbody td a.show-visitors {
        font-weight: 700;
        color: var(--primary);
        text-decoration: none !important;
        transition: var(--transition);
    }

    .custom-table tbody td a.show-visitors:hover {
        color: var(--primary-dark);
    }

    /* DataTables Overrides */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #ffffff !important;
        border-radius: 8px;
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 6px 12px;
        font-size: 13px;
        outline: none;
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--primary);
    }

    .dataTables_wrapper .dataTables_length select {
        border: 1.5px solid var(--border);
        border-radius: 8px;
        padding: 4px 8px;
        outline: none;
    }

    /* ========================================== */
    /* LEFT SLIDING DRAWER STYLING                */
    /* ========================================== */
    .visitor-drawer {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2000;
        visibility: hidden;
        transition: visibility 0.4s ease;
    }

    .visitor-drawer.open {
        visibility: visible;
    }

    .visitor-drawer-backdrop {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(4px);
        opacity: 0;
        transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .visitor-drawer.open .visitor-drawer-backdrop {
        opacity: 1;
    }

    .visitor-drawer-content {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        box-shadow: 10px 0 40px rgba(15, 23, 42, 0.15);
        transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    @media (min-width: 768px) {
        .visitor-drawer-content {
            left: -66.666667%;
            width: 66.666667%;
        }
    }

    .visitor-drawer.open .visitor-drawer-content {
        left: 0;
    }

    /* Drawer Header */
    .visitor-drawer-header {
        padding: 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #ffffff;
    }

    .visitor-drawer-title-box {
        display: flex;
        flex-direction: column;
    }

    .visitor-drawer-title {
        font-family: var(--font-title);
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    .visitor-drawer-subtitle {
        font-family: var(--font-body);
        font-size: 13px;
        color: #64748b;
        margin-top: 4px;
    }

    .visitor-drawer-close {
        border: none;
        background: #f1f5f9;
        color: #64748b;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 16px;
        line-height: 1;
    }

    .visitor-drawer-close:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* Drawer Search Area */
    .visitor-drawer-search-container {
        padding: 16px 24px;
        background-color: #ffffff;
        border-bottom: 1px solid #f1f5f9;
    }

    .visitor-drawer-search-wrapper {
        position: relative;
    }

    .visitor-drawer-search-input {
        width: 100%;
        padding: 10px 16px 10px 38px;
        font-size: 13px;
        border: 1.5px solid var(--border);
        border-radius: 12px;
        outline: none;
        transition: all 0.2s ease;
        font-family: var(--font-body);
    }

    .visitor-drawer-search-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
    }

    .visitor-drawer-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 14px;
        pointer-events: none;
    }

    /* Drawer Body / Scrollable Area */
    .visitor-drawer-body {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
        background-color: #f8fafc;
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        align-content: start;
    }

    @media (min-width: 992px) {
        .visitor-drawer-body {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1400px) {
        .visitor-drawer-body {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Scrollbar Styling */
    .visitor-drawer-body::-webkit-scrollbar {
        width: 6px;
    }
    .visitor-drawer-body::-webkit-scrollbar-track {
        background: transparent;
    }
    .visitor-drawer-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .visitor-drawer-body::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Visitor Card styling */
    .visitor-drawer-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 18px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.01);
        display: flex;
        gap: 16px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .visitor-drawer-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        border-color: #e2e8f0;
    }

    .visitor-card-avatar {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-title);
        font-weight: 800;
        font-size: 14px;
        flex-shrink: 0;
    }

    .visitor-card-avatar.bg-student {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        color: #0284c7;
    }

    .visitor-card-avatar.bg-admin {
        background: linear-gradient(135deg, #f3e8ff, #e9d5ff);
        color: #8b5cf6;
    }

    .visitor-card-details {
        flex: 1;
        min-width: 0;
    }

    .visitor-card-name {
        font-family: var(--font-title);
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .visitor-card-sub {
        font-family: var(--font-body);
        font-size: 12px;
        color: #64748b;
        margin-bottom: 2px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .visitor-card-sub strong {
        color: #334155;
    }

    .visitor-card-time {
        font-family: var(--font-body);
        font-size: 11px;
        color: #94a3b8;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .visitor-card-badges {
        margin-top: 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .visitor-card-badges .badge {
        font-family: var(--font-body);
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 600;
    }

    .visitor-card-badges .badge-primary { background-color: #e0f2fe; color: #0369a1; }
    .visitor-card-badges .badge-warning { background-color: #fef3c7; color: #b45309; }
    .visitor-card-badges .badge-info { background-color: #ecfeff; color: #097d8e; }
    .visitor-card-badges .badge-success { background-color: #d1fae5; color: #047857; }
    .visitor-card-badges .badge-secondary { background-color: #f1f5f9; color: #475569; }
    .visitor-card-badges .badge-danger { background-color: #fee2e2; color: #b91c1c; }

    /* Group headers styling */
    .visitor-group-header {
        font-family: var(--font-title);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        color: #475569;
        margin-top: 24px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        width: 100%;
        grid-column: 1 / -1;
        border-bottom: 1.5px dashed #cbd5e1;
        padding-bottom: 8px;
        letter-spacing: 0.5px;
    }

    #noVisitorResults {
        grid-column: 1 / -1;
        width: 100%;
    }

    /* ========================================== */
    /* RESPONSIVE OPTIMIZATIONS FOR MOBILE (<768px) */
    /* ========================================== */
    @media (max-width: 991px) {
        .app-service-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
    }

    @media (max-width: 768px) {
        .dashboard-title-bar {
            margin-bottom: 18px;
            padding-bottom: 14px;
        }
        .dashboard-title-bar h1 {
            font-size: 1.35rem !important;
        }
        .dashboard-subtitle {
            font-size: 12px;
        }
        .dashboard-section-title {
            font-size: 15px;
            margin-top: 22px;
            margin-bottom: 14px;
        }
        .app-service-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }
        .app-service-card {
            padding: 14px 6px 12px 6px !important;
            border-radius: 16px !important;
        }
        .app-icon-squircle {
            width: 48px !important;
            height: 48px !important;
            border-radius: 14px !important;
            font-size: 20px !important;
            margin-bottom: 8px !important;
        }
        .app-service-title {
            font-size: 11.5px !important;
            margin-bottom: 2px !important;
        }
        .app-service-admin {
            font-size: 9.5px !important;
            padding: 2px 4px !important;
            border-radius: 5px !important;
            max-width: 98% !important;
        }
        .stat-card-gradient {
            border-radius: 12px !important;
        }
        .stat-card-body {
            padding: 12px 6px !important;
            text-align: center;
        }
        .stat-card-label {
            font-size: 8.5px !important;
            letter-spacing: 0px !important;
            margin-bottom: 3px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .stat-card-value {
            font-size: 17px !important;
            line-height: 1.2;
        }
        .chart-card-header,
        .custom-table-card .card-header {
            padding: 12px 14px !important;
        }
        .chart-card-title {
            font-size: 13px !important;
            line-height: 1.4;
        }
        .custom-table-card {
            border-radius: 14px !important;
        }
        .custom-table thead th,
        .custom-table tbody td {
            padding: 10px 8px !important;
            font-size: 12px !important;
        }
        .visitor-drawer-header {
            padding: 16px !important;
        }
        .visitor-drawer-search-container {
            padding: 12px 16px !important;
        }
        .visitor-drawer-body {
            padding: 14px !important;
            gap: 10px !important;
        }
        .visitor-drawer-card {
            padding: 12px !important;
            border-radius: 12px !important;
            gap: 12px !important;
        }
        .visitor-card-avatar {
            width: 36px !important;
            height: 36px !important;
            font-size: 12px !important;
        }
    }

    /* Mobile Accordion/Collapse for Statistics */
    .stats-mobile-toggle-btn {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 14px;
        color: #1e293b;
        padding: 12px 16px;
        font-family: var(--font-title);
        transition: all 0.25s ease;
        cursor: pointer;
    }
    .stats-mobile-toggle-btn:hover,
    .stats-mobile-toggle-btn:focus,
    .stats-mobile-toggle-btn:active {
        background: #f8fafc;
        border-color: #0284c7;
        color: #0284c7;
        box-shadow: 0 4px 12px rgba(2, 132, 199, 0.12) !important;
    }
    .stats-toggle-icon-wrap {
        width: 32px;
        height: 32px;
        background: #e0f2fe;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .toggle-chevron {
        transition: transform 0.25s ease;
    }

    @media (max-width: 767.98px) {
        /* Default: Sembunyikan seluruh section statistik di mobile sampai tombol toggle diklik */
        #sectionStatistikWrapper.collapse:not(.show) {
            display: none !important;
        }
        #sectionStatistikWrapper.collapsing {
            display: block;
        }
        #sectionStatistikWrapper.collapse.show {
            display: block !important;
            animation: fadeInStats 0.3s ease;
        }
    }

    @media (min-width: 768px) {
        /* Desktop: Selalu tampilkan statistik */
        #sectionStatistikWrapper {
            display: block !important;
            height: auto !important;
            visibility: visible !important;
        }
        .stats-mobile-toggle-btn {
            display: none !important;
        }
    }

    @keyframes fadeInStats {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 360px) {
        .app-service-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>


<div class="container-fluid px-3 px-md-4">
    <!-- Judul Header -->
    <div class="dashboard-title-bar">
        <h1 class="h3 text-gray-800 font-weight-bold mb-1" style="font-family: var(--font-title); font-weight: 800;">Dashboard Operator</h1>
        <p class="dashboard-subtitle">Selamat datang kembali, <strong><?= $user['name'] ?></strong> (NIM: <?= $user['nim'] ?>)</p>
    </div>

    <!-- Section: Menu Layanan Mahasiswa (Icon Aplikasi Interaktif) -->
    <div class="dashboard-section-title">Menu Layanan Mahasiswa</div>
    <div class="app-service-grid">
        <!-- 1. Surat Aktif Kuliah -->
        <a href="<?= base_url('transaksi/aktifkuliah'); ?>" 
           class="app-service-link service-app-item" 
           data-service="Surat Aktif Kuliah" 
           data-admins="Subiantoro Indra" 
           data-allowed-keys="subiantoro,indra"
           title="Buka Menu Surat Aktif Kuliah">
            <div class="app-service-card">
                <div class="app-icon-squircle bg-gradient-blue">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="app-service-title">Aktif Kuliah</div>
                <div class="app-service-admin" title="Admin: Subiantoro Indra">
                    <i class="fas fa-user-circle mr-1 text-primary"></i>Subiantoro
                </div>
                <div class="app-service-hint d-none d-md-block">Buka Layanan &rarr;</div>
            </div>
        </a>

        <!-- 2. Bebas Perpustakaan -->
        <a href="<?= base_url('pustakawan'); ?>" 
           class="app-service-link service-app-item" 
           data-service="Bebas Perpustakaan" 
           data-admins="Suryani" 
           data-allowed-keys="suryani"
           title="Buka Menu Bebas Perpustakaan">
            <div class="app-service-card">
                <div class="app-icon-squircle bg-gradient-green">
                    <i class="fas fa-book"></i>
                </div>
                <div class="app-service-title">Bebas Perpus</div>
                <div class="app-service-admin" title="Admin: Suryani">
                    <i class="fas fa-user-circle mr-1 text-success"></i>Suryani
                </div>
                <div class="app-service-hint d-none d-md-block">Buka Layanan &rarr;</div>
            </div>
        </a>

        <!-- 3. Bebas Laboratorium -->
        <a href="<?= base_url('bebaslab'); ?>" 
           class="app-service-link service-app-item" 
           data-service="Bebas Laboratorium" 
           data-admins="Sumo Lestari, Nurul Hamsiah, Hazwani" 
           data-allowed-keys="sumo,lestari,nurul,hamsiah,hazwani,hazwan"
           title="Buka Menu Bebas Laboratorium">
            <div class="app-service-card">
                <div class="app-icon-squircle bg-gradient-amber">
                    <i class="fas fa-flask"></i>
                </div>
                <div class="app-service-title">Bebas Lab</div>
                <div class="app-service-admin" title="Admin: Sumo Lestari, Nurul Hamsiah, Hazwani">
                    <i class="fas fa-user-circle mr-1 text-warning"></i>Laboran
                </div>
                <div class="app-service-hint d-none d-md-block">Buka Layanan &rarr;</div>
            </div>
        </a>

        <!-- 4. Barcode Publikasi -->
        <a href="<?= base_url('jurnal'); ?>" 
           class="app-service-link service-app-item" 
           data-service="Barcode Publikasi" 
           data-admins="Andeff, Rino" 
           data-allowed-keys="andeff,rino,andef"
           title="Buka Menu Barcode Publikasi">
            <div class="app-service-card">
                <div class="app-icon-squircle bg-gradient-purple">
                    <i class="fas fa-qrcode"></i>
                </div>
                <div class="app-service-title">Barcode Publikasi</div>
                <div class="app-service-admin" title="Admin: Andeff, Rino">
                    <i class="fas fa-user-circle mr-1" style="color:#7c3aed;"></i>Andeff, Rino
                </div>
                <div class="app-service-hint d-none d-md-block">Buka Layanan &rarr;</div>
            </div>
        </a>

        <!-- 5. Keterangan Lulus (SKL) -->
        <a href="<?= base_url('skl'); ?>" 
           class="app-service-link service-app-item" 
           data-service="Surat Keterangan Lulus (SKL)" 
           data-admins="Yasinta Pagi, Yuti Maisyarah" 
           data-allowed-keys="yasinta,pagi,yuti,maisyarah"
           title="Buka Menu Surat Keterangan Lulus (SKL)">
            <div class="app-service-card">
                <div class="app-icon-squircle bg-gradient-indigo">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="app-service-title">Ket. Lulus</div>
                <div class="app-service-admin" title="Admin: Yasinta Pagi">
                    <i class="fas fa-user-circle mr-1 text-info"></i>Yasinta
                </div>
                <div class="app-service-hint d-none d-md-block">Buka Layanan &rarr;</div>
            </div>
        </a>
    </div>

    <!-- Tombol Toggle Statistik Khusus Layanan Mobile (Default Hidden) -->
    <div class="d-block d-md-none mb-3">
        <button class="btn btn-block shadow-sm stats-mobile-toggle-btn d-flex align-items-center justify-content-between" 
                type="button" 
                data-toggle="collapse" 
                data-target="#sectionStatistikWrapper" 
                aria-expanded="false" 
                aria-controls="sectionStatistikWrapper"
                id="btnToggleStatistik">
            <span class="d-flex align-items-center font-weight-bold" style="font-size: 13px;">
                <span class="stats-toggle-icon-wrap mr-2">
                    <i class="fas fa-chart-pie text-primary"></i>
                </span>
                <span id="statsToggleLabel">Tampilkan Statistik & Kunjungan</span>
            </span>
            <span class="badge badge-light border text-muted px-2 py-1 small">
                <i class="fas fa-chevron-down toggle-chevron" id="statsChevron"></i>
            </span>
        </button>
    </div>

    <!-- Wrapper Statistik (Default Hidden pada Mobile < 768px, Visible di Desktop) -->
    <div id="sectionStatistikWrapper" class="collapse">

    <!-- Section: Statistik Pengunjung -->
    <div class="dashboard-section-title">Statistik Kunjungan Sistem (Visitor)</div>
    <div class="row">
        <!-- Total Visitors -->
        <div class="col-4 px-1 px-sm-3 col-md-4 mb-3 mb-md-4">
            <div class="card stat-card-gradient blue">
                <div class="stat-card-body">
                    <div class="stat-card-label">Total Kunjungan</div>
                    <div class="stat-card-value"><?= number_format($total_visitors); ?></div>
                </div>
            </div>
        </div>

        <!-- Today Visitors -->
        <div class="col-4 px-1 px-sm-3 col-md-4 mb-3 mb-md-4">
            <div class="card stat-card-gradient teal">
                <div class="stat-card-body">
                    <div class="stat-card-label">Hari Ini</div>
                    <div class="stat-card-value"><?= number_format($today_visitors); ?></div>
                </div>
            </div>
        </div>

        <!-- Unique Visitors -->
        <div class="col-4 px-1 px-sm-3 col-md-4 mb-3 mb-md-4">
            <div class="card stat-card-gradient purple">
                <div class="stat-card-body">
                    <div class="stat-card-label">Pengunjung Unik</div>
                    <div class="stat-card-value"><?= number_format($unique_visitors); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Statistik Layanan Selesai Diproses -->
    <?php
        $statistik_layanan_reversed = array_reverse($statistik_layanan);
        $tahun_labels = json_encode(array_column($statistik_layanan_reversed, 'tahun'));
        $aktif_kuliah_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'aktif_kuliah')));
        $bebas_perpus_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_perpus')));
        $skl_yudisium_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'skl_yudisium')));
        $skl_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'skl')));
        $bebas_lab_kedokteran_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_kedokteran')));
        $bebas_lab_farmasi_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_farmasi')));
        $bebas_lab_keperawatan_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_keperawatan')));
        $bebas_lab_ners_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_ners')));
        $bebas_lab_dokter_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_dokter')));
        $bebas_lab_apoteker_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_apoteker')));
    ?>
    <div class="dashboard-section-title">Statistik Layanan Selesai Diproses</div>
    <div class="card custom-table-card mb-4">
        <div class="card-header">
            <h6 class="chart-card-title">Grafik & Tabel Akumulasi Surat & Bebas Lab Selesai Diproses (Pertahun)</h6>
        </div>
        <div class="card-body">
            <!-- Chart Layanan Selesai -->
            <div class="mb-4" style="height: 350px; position: relative;">
                <canvas id="layananSelesaiChart"></canvas>
            </div>
            
            <!-- Table Layanan Selesai -->
            <div class="table-responsive">
                <table class="table custom-table table-bordered table-striped" id="layananSelesaiTable" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Aktif Kuliah</th>
                            <th>Bebas Perpustakaan</th>
                            <th>SKL Yudisium</th>
                            <th>SKL</th>
                            <th>Bebas Lab Kedokteran</th>
                            <th>Bebas Lab Farmasi</th>
                            <th>Bebas Lab Keperawatan</th>
                            <th>Bebas Lab Ners</th>
                            <th>Bebas Lab Dokter</th>
                            <th>Bebas Lab Apoteker</th>
                            <th class="bg-primary text-white">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($statistik_layanan as $row): 
                            $row_total = $row['aktif_kuliah'] + $row['bebas_perpus'] + $row['skl_yudisium'] + $row['skl'] + $row['bebas_lab_kedokteran'] + $row['bebas_lab_farmasi'] + $row['bebas_lab_keperawatan'] + $row['bebas_lab_ners'] + $row['bebas_lab_dokter'] + $row['bebas_lab_apoteker'];
                        ?>
                            <tr>
                                <td class="font-weight-bold text-center">
                                    <a href="<?= base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=all'); ?>" class="text-dark">
                                        <?= $row['tahun']; ?>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <?= $row['aktif_kuliah'] > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=aktif_kuliah') . '" class="font-weight-bold text-primary">' . number_format($row['aktif_kuliah']) . '</a>' : '0'; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['bebas_perpus'] > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=bebas_perpus') . '" class="font-weight-bold text-primary">' . number_format($row['bebas_perpus']) . '</a>' : '0'; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['skl_yudisium'] > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=skl_yudisium') . '" class="font-weight-bold text-primary">' . number_format($row['skl_yudisium']) . '</a>' : '0'; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['skl'] > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=skl') . '" class="font-weight-bold text-primary">' . number_format($row['skl']) . '</a>' : '0'; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['bebas_lab_kedokteran'] > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=bebas_lab_kedokteran') . '" class="font-weight-bold text-primary">' . number_format($row['bebas_lab_kedokteran']) . '</a>' : '0'; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['bebas_lab_farmasi'] > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=bebas_lab_farmasi') . '" class="font-weight-bold text-primary">' . number_format($row['bebas_lab_farmasi']) . '</a>' : '0'; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['bebas_lab_keperawatan'] > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=bebas_lab_keperawatan') . '" class="font-weight-bold text-primary">' . number_format($row['bebas_lab_keperawatan']) . '</a>' : '0'; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['bebas_lab_ners'] > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=bebas_lab_ners') . '" class="font-weight-bold text-primary">' . number_format($row['bebas_lab_ners']) . '</a>' : '0'; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['bebas_lab_dokter'] > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=bebas_lab_dokter') . '" class="font-weight-bold text-primary">' . number_format($row['bebas_lab_dokter']) . '</a>' : '0'; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['bebas_lab_apoteker'] > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=bebas_lab_apoteker') . '" class="font-weight-bold text-primary">' . number_format($row['bebas_lab_apoteker']) . '</a>' : '0'; ?>
                                </td>
                                <td class="font-weight-bold text-center text-primary">
                                    <?= $row_total > 0 ? '<a href="' . base_url('operator/detail_layanan?tahun=' . $row['tahun'] . '&tipe=all') . '" class="font-weight-bold text-primary">' . number_format($row_total) . '</a>' : '0'; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Section: Analitik & Rincian Kunjungan Visitor -->
    <div class="dashboard-section-title">Analitik & Rincian Kunjungan Visitor</div>
    <div class="row">
        <!-- Grafik Jumlah Visitor per Hari -->
        <div class="col-lg-8 mb-4">
            <div class="card chart-card h-100">
                <div class="chart-card-header d-flex align-items-center">
                    <h6 class="chart-card-title">Grafik Jumlah Visitor per Hari (Scrollable)</h6>
                </div>
                <div class="card-body">
                    <!-- Wadah scroll horizontal -->
                    <div style="overflow-x: auto; white-space: nowrap; padding-bottom: 8px;">
                        <div style="width: 2000px; height: 350px;">
                            <canvas id="visitorChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Rincian Visitor -->
        <div class="col-lg-4 mb-4">
            <div class="card custom-table-card h-100">
                <div class="card-header">
                    <h6 class="chart-card-title">Tabel Statistik Visitor Harian</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="padding: 20px; max-height: 380px; overflow-y: auto;">
                        <table class="table custom-table" id="visitorTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Jumlah Visitor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($visitors as $row): ?>
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0);" class="show-visitors" data-date="<?= $row->visit_date; ?>">
                                                <i class="far fa-calendar-alt mr-2"></i><?= $row->visit_date; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <strong><?= $row->total; ?></strong> pengunjung
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Visitor Per Prodi (Chart + Table) -->
    <div class="card custom-table-card mb-4">
        <div class="card-header">
            <h6 class="chart-card-title">Perbandingan & Proporsi Visitor per Program Studi</h6>
        </div>
        <div class="card-body">
            <div class="row align-items-center" style="padding: 10px;">
                <!-- Proporsi (Pie Chart) -->
                <div class="col-lg-4 mb-4 mb-lg-0 text-center">
                    <h6 class="text-xs font-weight-bold text-uppercase text-muted mb-2">Proporsi Visitor</h6>
                    <div style="max-width: 250px; margin: 0 auto;">
                        <canvas id="chartVisitorProdi" style="max-height: 250px;"></canvas>
                    </div>
                </div>
                <!-- Perbandingan (Bar Chart) -->
                <div class="col-lg-4 mb-4 mb-lg-0 text-center">
                    <h6 class="text-xs font-weight-bold text-uppercase text-muted mb-2">Jumlah Visitor</h6>
                    <div style="height: 250px; position: relative;">
                        <canvas id="visitorPerProdiChart"></canvas>
                    </div>
                </div>
                <!-- Table prodi -->
                <div class="col-lg-4">
                    <div class="table-responsive">
                        <table class="table custom-table table-sm" id="visitorProdiTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Program Studi</th>
                                    <th>Total Visitor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($statistik_prodi as $row): ?>
                                    <tr>
                                        <td><i class="fas fa-graduation-cap mr-2 text-primary"></i><?= $row->nama_prodi ?></td>
                                        <td><strong><?= $row->total ?></strong> visitor</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- /#sectionStatistikWrapper -->

<!-- Drawer Detail Pengunjung -->
<div id="visitorDrawer" class="visitor-drawer">
    <div class="visitor-drawer-backdrop" id="visitorDrawerBackdrop"></div>
    <div class="visitor-drawer-content" id="drawerContent">
        <!-- konten dari AJAX -->
    </div>
</div>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {

        // Inisialisasi DataTables untuk Tabel Statistik Visitor
        $('#visitorTable').DataTable({
            pageLength: 10,
            order: [[0, 'desc']],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
            }
        });

        // Inisialisasi DataTables untuk Tabel Statistik Layanan Selesai
        $('#layananSelesaiTable').DataTable({
            paging: false,
            searching: false,
            info: false,
            order: [[0, 'desc']],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
            }
        });

        // Inisialisasi DataTables untuk Tabel Visitor Per Prodi
        $('#visitorProdiTable').DataTable({
            paging: false,
            searching: false,
            info: false,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
            }
        });

        // Chart Layanan Selesai Diproses (Stacked Bar Chart)
        var ctxLayanan = document.getElementById("layananSelesaiChart").getContext('2d');
        new Chart(ctxLayanan, {
            type: 'bar',
            data: {
                labels: <?= $tahun_labels; ?>,
                datasets: [
                    {
                        label: 'Aktif Kuliah',
                        data: <?= $aktif_kuliah_data; ?>,
                        backgroundColor: '#0284c7'
                    },
                    {
                        label: 'Bebas Perpustakaan',
                        data: <?= $bebas_perpus_data; ?>,
                        backgroundColor: '#64748b'
                    },
                    {
                        label: 'SKL Yudisium',
                        data: <?= $skl_yudisium_data; ?>,
                        backgroundColor: '#6366f1'
                    },
                    {
                        label: 'SKL',
                        data: <?= $skl_data; ?>,
                        backgroundColor: '#06b6d4'
                    },
                    {
                        label: 'Bebas Lab Kedokteran',
                        data: <?= $bebas_lab_kedokteran_data; ?>,
                        backgroundColor: '#10b981'
                    },
                    {
                        label: 'Bebas Lab Farmasi',
                        data: <?= $bebas_lab_farmasi_data; ?>,
                        backgroundColor: '#f59e0b'
                    },
                    {
                        label: 'Bebas Lab Keperawatan',
                        data: <?= $bebas_lab_keperawatan_data; ?>,
                        backgroundColor: '#0d9488'
                    },
                    {
                        label: 'Bebas Lab Ners',
                        data: <?= $bebas_lab_ners_data; ?>,
                        backgroundColor: '#8b5cf6'
                    },
                    {
                        label: 'Bebas Lab Dokter',
                        data: <?= $bebas_lab_dokter_data; ?>,
                        backgroundColor: '#ec4899'
                    },
                    {
                        label: 'Bebas Lab Apoteker',
                        data: <?= $bebas_lab_apoteker_data; ?>,
                        backgroundColor: '#f97316'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            padding: 15,
                            font: { family: 'Inter', size: 11 }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        stacked: false,
                        grid: { display: false },
                        ticks: {
                            color: '#64748b',
                            font: { family: 'Inter', size: 11 }
                        }
                    },
                    y: {
                        stacked: false,
                        grid: { color: '#f1f5f9' },
                        beginAtZero: true,
                        ticks: {
                            color: '#64748b',
                            font: { family: 'Inter', size: 11 }
                        }
                    }
                }
            }
        });

        // Chart Bar Visitor Harian (scroll horizontal)
        var ctx1 = document.getElementById("visitorChart").getContext('2d');
        var gradientBlue = ctx1.createLinearGradient(0, 0, 0, 300);
        gradientBlue.addColorStop(0, 'rgba(2, 132, 199, 0.85)');
        gradientBlue.addColorStop(1, 'rgba(59, 130, 246, 0.3)');

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: <?= $labels; ?>,
                datasets: [{
                    label: 'Jumlah Visitor',
                    data: <?= $totals; ?>,
                    backgroundColor: gradientBlue,
                    borderColor: '#0284c7',
                    borderWidth: 1.5,
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: { 
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false } 
                },
                scales: { 
                    y: { 
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: {
                            color: '#64748b',
                            font: { family: 'Inter', size: 11 }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: '#64748b',
                            font: { family: 'Inter', size: 11 }
                        }
                    }
                }
            }
        });

        // Chart Pie Visitor per Prodi
        var ctx2 = document.getElementById("chartVisitorProdi").getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: [<?php foreach ($statistik_prodi as $row) { echo "'" . $row->nama_prodi . "',"; } ?>],
                datasets: [{
                    data: [<?php foreach ($statistik_prodi as $row) { echo $row->total . ","; } ?>],
                    backgroundColor: ['#6366f1','#0d9488','#0ea5e9','#f59e0b','#e11d48','#858796','#10b981'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: { 
                responsive: true, 
                plugins: { 
                    legend: { 
                        position: 'bottom',
                        labels: {
                            boxWidth: 10,
                            padding: 12,
                            font: { family: 'Inter', size: 10 }
                        }
                    } 
                } 
            }
        });

        // Chart Bar Visitor per Prodi
        var ctx3 = document.getElementById("visitorPerProdiChart").getContext('2d');
        var gradientTeal = ctx3.createLinearGradient(0, 0, 0, 250);
        gradientTeal.addColorStop(0, 'rgba(13, 148, 136, 0.85)');
        gradientTeal.addColorStop(1, 'rgba(20, 184, 166, 0.3)');

        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($statistik_prodi, 'nama_prodi')) ?>,
                datasets: [{
                    label: 'Total Visitor',
                    data: <?= json_encode(array_column($statistik_prodi, 'total')) ?>,
                    backgroundColor: gradientTeal,
                    borderColor: '#0d9488',
                    borderWidth: 1.5,
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: { 
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false } 
                },
                scales: { 
                    y: { 
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: { 
                            precision: 0,
                            color: '#64748b',
                            font: { family: 'Inter', size: 11 }
                        } 
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: '#64748b',
                            font: { family: 'Inter', size: 10 }
                        }
                    }
                } 
            }
        });

        // Drawer AJAX Visitor Detail
        $(document).on('click', '.show-visitors', function(){
            var date = $(this).data('date');
            $.ajax({
                url: "<?= base_url('operator/get_visitors_by_date/'); ?>" + date,
                type: "GET",
                success: function(res){
                    $('#drawerContent').html(res);
                    $('#visitorDrawer').addClass('open');
                    $('body').css('overflow', 'hidden'); // prevent background scrolling
                }
            });
        });

        // Close Drawer Function
        function closeVisitorDrawer() {
            $('#visitorDrawer').removeClass('open');
            $('body').css('overflow', '');
        }

        $(document).on('click', '#visitorDrawerBackdrop, .visitor-drawer-close', function(){
            closeVisitorDrawer();
        });

        // Handle Escape Key to close drawer
        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                closeVisitorDrawer();
            }
        });

        // Client-side search filtering inside the drawer
        $(document).on('input', '#visitorSearchInput', function(){
            var query = $(this).val().toLowerCase().trim();
            $('.visitor-drawer-card').each(function(){
                var name = $(this).find('.visitor-card-name').text().toLowerCase();
                var nim = $(this).find('.visitor-card-nim-val').text().toLowerCase();
                var prodi = $(this).find('.visitor-card-prodi-val').text().toLowerCase();
                
                if (name.indexOf(query) !== -1 || nim.indexOf(query) !== -1 || prodi.indexOf(query) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            
            // Show/hide group headers based on visible cards inside their group
            $('.visitor-group-header').each(function(){
                var groupId = $(this).data('group-id');
                var visibleInGroup = $('.visitor-drawer-card[data-group-id="' + groupId + '"]:visible').length;
                if (visibleInGroup > 0) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            
            // Show "no results found" message if all hidden
            var visibleCards = $('.visitor-drawer-card:visible').length;
            if (visibleCards === 0) {
                if ($('#noVisitorResults').length === 0) {
                    $('.visitor-drawer-body').append('<div id="noVisitorResults" class="text-center py-4 text-muted font-weight-bold" style="font-family: var(--font-body); font-size: 13px;">Tidak ada hasil pencarian yang cocok</div>');
                }
            } else {
                $('#noVisitorResults').remove();
            }
        });


        // Toggle teks dan ikon tombol statistik pada layar mobile
        $('#sectionStatistikWrapper').on('show.bs.collapse', function () {
            $('#statsToggleLabel').text('Sembunyikan Statistik & Kunjungan');
            $('#statsChevron').removeClass('fa-chevron-down').addClass('fa-chevron-up');
            $('#btnToggleStatistik').addClass('border-primary shadow');
            // Trigger chart resize after animation so charts render at full container width
            setTimeout(function() {
                if (window.Chart) {
                    if (Chart.instances) {
                        Object.keys(Chart.instances).forEach(function(key) {
                            Chart.instances[key].resize();
                        });
                    }
                }
            }, 350);
        }).on('hide.bs.collapse', function () {
            $('#statsToggleLabel').text('Tampilkan Statistik & Kunjungan');
            $('#statsChevron').removeClass('fa-chevron-up').addClass('fa-chevron-down');
            $('#btnToggleStatistik').removeClass('border-primary shadow');
        });

        // Validasi Hak Akses Admin saat Icon Aplikasi Layanan Diklik
        $(document).on('click', '.service-app-item', function(e) {
            const isSuperAdmin = <?= ($this->session->userdata('role_id') == 1) ? 'true' : 'false'; ?>;
            const currentName = "<?= strtolower(addslashes($user['name'])); ?>";
            const currentNim = "<?= strtolower(addslashes($user['nim'])); ?>";
            
            const rawAllowedKeys = $(this).data('allowed-keys') || '';
            const allowedKeys = rawAllowedKeys.toString().split(',');
            const serviceName = $(this).data('service') || 'Layanan';
            const adminNames = $(this).data('admins') || '-';

            // Cek apakah user adalah Super Admin (role 1) atau nama/NIM sesuai dengan admin yang berwenang
            let hasAccess = isSuperAdmin;
            if (!hasAccess) {
                for (let i = 0; i < allowedKeys.length; i++) {
                    const key = allowedKeys[i].trim().toLowerCase();
                    if (key && (currentName.indexOf(key) !== -1 || currentNim.indexOf(key) !== -1)) {
                        hasAccess = true;
                        break;
                    }
                }
            }

            // Jika bukan admin yang berwenang, cegah navigasi dan munculkan SweetAlert2
            if (!hasAccess) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: '<span style="font-family: var(--font-title); font-weight: 800; color: #1e293b;">Akses Tidak Diizinkan!</span>',
                    html: '<div style="font-family: var(--font-body); font-size: 13.5px; color: #475569; line-height: 1.5;">' +
                          'Maaf, Anda tidak memiliki hak akses untuk mengelola modul <b>' + serviceName + '</b>.<br>' +
                          '<div class="mt-3 p-3 text-left" style="background-color: #fef2f2; border: 1px solid #fee2e2; border-radius: 10px; font-size: 12px; color: #991b1b;">' +
                          '<i class="fas fa-user-shield mr-1"></i> <strong>Admin Pengelola:</strong> ' + adminNames +
                          '</div></div>',
                    confirmButtonColor: '#0284c7',
                    confirmButtonText: '<i class="fas fa-check mr-1"></i> Saya Mengerti',
                    customClass: {
                        popup: 'animated fadeInDown'
                    }
                });
                return false;
            }
        });

    });
</script>
