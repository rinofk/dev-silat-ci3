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

    /* Service Queue Cards Grid */
    .service-status-card {
        border-radius: 18px !important;
        border: none !important;
        box-shadow: var(--card-shadow) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        background: #ffffff;
        overflow: hidden;
        position: relative;
        height: 100%;
    }

    .service-status-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--card-hover-shadow) !important;
    }

    .service-status-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
    }

    .service-status-card.primary::before { background: var(--primary); }
    .service-status-card.success::before { background: var(--success); }
    .service-status-card.warning::before { background: var(--warning); }
    .service-status-card.info::before { background: var(--info); }

    .service-card-body {
        padding: 22px;
    }

    .service-card-tag {
        font-family: var(--font-title);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
    }

    .service-card-icon-box {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .service-card-icon-box.bg-light-primary { background-color: #e0f2fe !important; color: #0284c7 !important; }
    .service-card-icon-box.bg-light-success { background-color: #d1fae5 !important; color: #10b981 !important; }
    .service-card-icon-box.bg-light-warning { background-color: #fef3c7 !important; color: #f59e0b !important; }
    .service-card-icon-box.bg-light-info { background-color: #ecfeff !important; color: #06b6d4 !important; }

    .badge-pill-name {
        display: inline-block;
        font-family: var(--font-body);
        font-size: 12px !important;
        font-weight: 600;
        color: #334155 !important;
        background-color: #f1f5f9 !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 6px 12px !important;
        margin-right: 4px;
        margin-bottom: 6px;
        transition: all 0.2s ease;
    }
    
    .badge-pill-name:hover {
        background-color: #e2e8f0 !important;
        transform: translateY(-1px);
        text-decoration: none;
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
</style>

<div class="container-fluid">
    <!-- Judul Header -->
    <div class="dashboard-title-bar">
        <h1 class="h3 text-gray-800 font-weight-bold mb-1" style="font-family: var(--font-title); font-weight: 800;">Dashboard Operator</h1>
        <p class="dashboard-subtitle">Selamat datang kembali, <strong><?= $user['name'] ?></strong> (NIM: <?= $user['nim'] ?>)</p>
    </div>

    <!-- Section: Antrean Berkas Terbaru -->
    <div class="dashboard-section-title">Antrean Layanan Mahasiswa</div>
    <div class="row">
        <!-- Surat Aktif Kuliah -->
        <div class="col-xl col-md-6 mb-4">
            <div class="card service-status-card primary">
                <div class="service-card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="service-card-tag m-0">Aktif Kuliah</div>
                        <div class="service-card-icon-box bg-light-primary">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                    <div class="service-card-names-wrapper text-left">
                        <?php 
                            $names = "Subiantoro Indra"; 
                            $name_array = explode(',', $names);
                            foreach ($name_array as $name) {
                                echo '<span class="badge-pill-name">' . trim($name) . '</span>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bebas Perpustakaan -->
        <div class="col-xl col-md-6 mb-4">
            <div class="card service-status-card success">
                <div class="service-card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="service-card-tag m-0">Bebas Perpustakaan</div>
                        <div class="service-card-icon-box bg-light-success">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <div class="service-card-names-wrapper text-left">
                        <?php 
                            $names = "Suryani"; 
                            $name_array = explode(',', $names);
                            foreach ($name_array as $name) {
                                echo '<span class="badge-pill-name">' . trim($name) . '</span>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bebas Laboratorium -->
        <div class="col-xl col-md-6 mb-4">
            <div class="card service-status-card warning">
                <div class="service-card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="service-card-tag m-0">Bebas Lab</div>
                        <div class="service-card-icon-box bg-light-warning">
                            <i class="fas fa-flask"></i>
                        </div>
                    </div>
                    <div class="service-card-names-wrapper text-left">
                        <?php 
                            $names = "Sumo Lestari, Nurul Hamsiah, Hazwani"; 
                            $name_array = explode(',', $names);
                            foreach ($name_array as $name) {
                                echo '<span class="badge-pill-name">' . trim($name) . '</span>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barcode Publikasi -->
        <div class="col-xl col-md-6 mb-4">
            <div class="card service-status-card warning">
                <div class="service-card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="service-card-tag m-0">Barcode Publikasi</div>
                        <div class="service-card-icon-box bg-light-warning">
                            <i class="fas fa-qrcode"></i>
                        </div>
                    </div>
                    <div class="service-card-names-wrapper text-left">
                        <?php 
                            $names = "Andeff, Rino"; 
                            $name_array = explode(',', $names);
                            foreach ($name_array as $name) {
                                echo '<span class="badge-pill-name">' . trim($name) . '</span>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- SKL -->
        <div class="col-xl col-md-6 mb-4">
            <div class="card service-status-card info">
                <div class="service-card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="service-card-tag m-0">Keterangan Lulus</div>
                        <div class="service-card-icon-box bg-light-info">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </div>
                    <div class="service-card-names-wrapper text-left">
                        <?php 
                            $names = "Yasinta Pagi"; 
                            $name_array = explode(',', $names);
                            foreach ($name_array as $name) {
                                echo '<span class="badge-pill-name">' . trim($name) . '</span>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Statistik Pengunjung -->
    <div class="dashboard-section-title">Statistik Kunjungan Sistem (Visitor)</div>
    <div class="row">
        <!-- Total Visitors -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card stat-card-gradient blue">
                <div class="stat-card-body">
                    <div class="stat-card-label">Total Kunjungan</div>
                    <div class="stat-card-value"><?= number_format($total_visitors); ?></div>
                </div>
            </div>
        </div>

        <!-- Today Visitors -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card stat-card-gradient teal">
                <div class="stat-card-body">
                    <div class="stat-card-label">Kunjungan Hari Ini</div>
                    <div class="stat-card-value"><?= number_format($today_visitors); ?></div>
                </div>
            </div>
        </div>

        <!-- Unique Visitors -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card stat-card-gradient purple">
                <div class="stat-card-body">
                    <div class="stat-card-label">Pengunjung Unik (NIM)</div>
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
        $bebas_lab_kedokteran_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_kedokteran')));
        $bebas_lab_keperawatan_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_keperawatan')));
        $bebas_lab_farmasi_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_farmasi')));
        $bebas_lab_ners_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_ners')));
        $bebas_lab_dokter_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_lab_dokter')));
        $skl_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'skl')));
        $skl_yudisium_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'skl_yudisium')));
        $bebas_perpus_data = json_encode(array_map('intval', array_column($statistik_layanan_reversed, 'bebas_perpus')));
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
                            <th>Bebas Lab Kedokteran</th>
                            <th>Bebas Lab Keperawatan</th>
                            <th>Bebas Lab Farmasi</th>
                            <th>Bebas Lab Ners</th>
                            <th>Bebas Lab Dokter</th>
                            <th>SKL</th>
                            <th>SKL Yudisium</th>
                            <th>Bebas Perpus</th>
                            <th class="bg-primary text-white">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($statistik_layanan as $row): 
                            $row_total = $row['aktif_kuliah'] + $row['bebas_lab_kedokteran'] + $row['bebas_lab_keperawatan'] + $row['bebas_lab_farmasi'] + $row['bebas_lab_ners'] + $row['bebas_lab_dokter'] + $row['skl'] + $row['skl_yudisium'] + $row['bebas_perpus'];
                        ?>
                            <tr>
                                <td class="font-weight-bold text-center"><?= $row['tahun']; ?></td>
                                <td class="text-center"><?= number_format($row['aktif_kuliah']); ?></td>
                                <td class="text-center"><?= number_format($row['bebas_lab_kedokteran']); ?></td>
                                <td class="text-center"><?= number_format($row['bebas_lab_keperawatan']); ?></td>
                                <td class="text-center"><?= number_format($row['bebas_lab_farmasi']); ?></td>
                                <td class="text-center"><?= number_format($row['bebas_lab_ners']); ?></td>
                                <td class="text-center"><?= number_format($row['bebas_lab_dokter']); ?></td>
                                <td class="text-center"><?= number_format($row['skl']); ?></td>
                                <td class="text-center"><?= number_format($row['skl_yudisium']); ?></td>
                                <td class="text-center"><?= number_format($row['bebas_perpus']); ?></td>
                                <td class="font-weight-bold text-center text-primary"><?= number_format($row_total); ?></td>
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

<!-- Modal Detail Pengunjung -->
<div class="modal fade" id="visitorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" id="modalContent" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
            <!-- konten dari AJAX -->
        </div>
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
                        label: 'Bebas Lab Kedokteran',
                        data: <?= $bebas_lab_kedokteran_data; ?>,
                        backgroundColor: '#10b981'
                    },
                    {
                        label: 'Bebas Lab Keperawatan',
                        data: <?= $bebas_lab_keperawatan_data; ?>,
                        backgroundColor: '#0d9488'
                    },
                    {
                        label: 'Bebas Lab Farmasi',
                        data: <?= $bebas_lab_farmasi_data; ?>,
                        backgroundColor: '#f59e0b'
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
                        label: 'SKL',
                        data: <?= $skl_data; ?>,
                        backgroundColor: '#06b6d4'
                    },
                    {
                        label: 'SKL Yudisium',
                        data: <?= $skl_yudisium_data; ?>,
                        backgroundColor: '#6366f1'
                    },
                    {
                        label: 'Bebas Perpus',
                        data: <?= $bebas_perpus_data; ?>,
                        backgroundColor: '#a8a29e'
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

        // Modal AJAX Visitor Detail
        $(document).on('click', '.show-visitors', function(){
            var date = $(this).data('date');
            $.ajax({
                url: "<?= base_url('operator/get_visitors_by_date/'); ?>" + date,
                type: "GET",
                success: function(res){
                    $('#modalContent').html(res);
                    $('#visitorModal').modal('show');
                }
            });
        });

    });
</script>
