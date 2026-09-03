<?php
// application/views/bebaslab/baru/index.php
// Controller mengirimkan: $title, $daftar_prodi, $daftar_tahun, $filter_prodi, $filter_tahun
// serta $pengajuan, $proses, $selesai, $reject, $blacklist, dan total_* variables.
?>

<style>
    /* Styling Container & Header */
    .page-title-badge {
        background: #e0e7ff;
        color: #3730a3;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
    }

    /* Filter Card */
    .card-filter {
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        background: #ffffff;
    }
    .filter-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    .form-control-filter {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        font-size: 0.88rem;
        height: calc(1.5em + 0.9rem + 2px);
    }
    .form-control-filter:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.15);
    }
    .btn-filter-action {
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.88rem;
        height: calc(1.5em + 0.9rem + 2px);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    /* Horizontal Scrollable Nav Pills */
    .bebaslab-nav-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none; /* Firefox */
        padding-bottom: 6px;
        margin-bottom: 1rem;
    }
    .bebaslab-nav-wrapper::-webkit-scrollbar {
        display: none; /* Chrome, Safari */
    }
    .bebaslab-nav-pills {
        display: flex;
        flex-wrap: nowrap;
        gap: 8px;
        border-bottom: none;
        padding-left: 2px;
        padding-right: 2px;
    }
    .bebaslab-nav-pills .nav-item {
        margin-bottom: 0;
    }
    .bebaslab-nav-pills .nav-link {
        border-radius: 30px !important;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 0.85rem;
        color: #64748b;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: all 0.25s ease;
    }
    .bebaslab-nav-pills .nav-link:hover {
        background: #f8fafc;
        color: #334155;
        border-color: #cbd5e1;
    }
    .bebaslab-nav-pills .nav-link.active {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
        color: #ffffff !important;
        border-color: #4e73df !important;
        box-shadow: 0 4px 12px rgba(78, 115, 223, 0.35);
    }
    .bebaslab-nav-pills .nav-link .badge-count {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 12px;
    }
    .bebaslab-nav-pills .nav-link.active .badge-count {
        background: rgba(255, 255, 255, 0.25) !important;
        color: #ffffff !important;
    }

    /* Mobile Search Input */
    .mobile-search-box {
        position: relative;
    }
    .mobile-search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.9rem;
    }
    .mobile-search-box input {
        padding-left: 38px;
        border-radius: 25px;
        border: 1px solid #cbd5e1;
        font-size: 0.85rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
    }
    .mobile-search-box input:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.15);
    }

    /* Mobile Card Items */
    .mobile-card {
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        margin-bottom: 12px;
        overflow: hidden;
        transition: all 0.2s ease;
    }
    .mobile-card:active {
        transform: scale(0.99);
    }
    .mobile-card.border-left-diajukan {
        border-left: 5px solid #f59e0b !important;
    }
    .mobile-card.border-left-proses {
        border-left: 5px solid #0ea5e9 !important;
    }
    .mobile-card.border-left-selesai {
        border-left: 5px solid #10b981 !important;
    }
    .mobile-card.border-left-reject {
        border-left: 5px solid #ef4444 !important;
    }
    .mobile-card.border-left-blacklist {
        border-left: 5px solid #64748b !important;
    }
    .mobile-card-header {
        padding: 12px 14px;
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .mobile-card-body {
        padding: 12px 14px;
    }
    .mobile-card-footer {
        padding: 10px 14px;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
    }
    .mobile-nim-badge {
        font-size: 0.82rem;
        font-weight: 700;
        color: #1e293b;
        background: #f1f5f9;
        padding: 3px 8px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .mobile-mahasiswa-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.3;
    }
    .mobile-prodi-tag {
        font-size: 0.76rem;
        color: #4e73df;
        font-weight: 600;
        display: inline-block;
        margin-top: 2px;
    }
    .mobile-meta-item {
        font-size: 0.78rem;
        color: #64748b;
        display: flex;
        align-items: center;
        margin-top: 4px;
    }
    .mobile-meta-item i {
        width: 16px;
        text-align: center;
        margin-right: 6px;
        color: #94a3b8;
    }

    /* Desktop Table Custom Styling */
    .card-custom-main {
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .table-custom thead th {
        background-color: #f8fafc;
        color: #4e73df;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        padding: 12px 10px;
        vertical-align: middle;
    }
    .table-custom tbody td {
        vertical-align: middle !important;
        color: #334155;
        font-size: 0.86rem;
        padding: 12px 10px;
        border-bottom: 1px solid #f1f5f9;
    }
    .table-custom tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Badges */
    .badge-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .badge-status-diajukan {
        background-color: #fef3c7;
        color: #b45309;
    }
    .badge-status-proses {
        background-color: #e0f2fe;
        color: #0369a1;
    }
    .badge-status-selesai {
        background-color: #dcfce7;
        color: #15803d;
    }
    .badge-status-reject {
        background-color: #fee2e2;
        color: #b91c1c;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid px-3 px-md-4">

    <!-- Header & Title -->
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-3 gap-2">
        <div>
            <h1 class="h4 mb-0 text-gray-800 font-weight-bold d-flex align-items-center">
                <i class="fas fa-microscope text-primary mr-2"></i> <?= isset($title) ? $title : 'Bebas Laboratorium' ?>
            </h1>
            <small class="text-muted">Kelola dan verifikasi pengajuan bebas laboratorium mahasiswa</small>
        </div>
        <div class="mt-2 mt-sm-0">
            <button class="btn btn-sm btn-outline-primary shadow-sm font-weight-bold"
                type="button"
                data-toggle="collapse"
                data-target="#informasiBebasLab"
                aria-expanded="false"
                aria-controls="informasiBebasLab"
                style="border-radius: 20px; font-size: 0.8rem;">
                <i class="fas fa-info-circle mr-1"></i> Informasi Sistem
            </button>
        </div>
    </div>

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="mb-3">
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>

    <!-- CARD INFORMASI SISTEM (COLLAPSIBLE) -->
    <div id="informasiBebasLab" class="collapse mb-3">
        <div class="alert alert-info shadow-sm border-left-primary mb-0 p-3" style="border-radius: 12px; font-size: 0.85rem;">
            <h6 class="text-primary font-weight-bold mb-2"><i class="fas fa-info-circle mr-2"></i> Ketentuan Pengajuan Bebas Lab</h6>
            <ul class="mb-0 pl-3" style="line-height: 1.5;">
                <li><strong>Masa berlaku Surat Bebas Lab adalah 90 hari</strong> sejak tanggal surat diterbitkan.</li>
                <li><strong>Mahasiswa dapat mengajukan kembali setelah 60 hari</strong> sejak pengajuan terakhir.</li>
                <li>Pastikan kelengkapan berkas KTM dan validasi lab telah sesuai sebelum menyetujui pengajuan.</li>
            </ul>
        </div>
    </div>

    <!-- CARD FILTER & FILTER CONTROLS -->
    <div class="card card-filter mb-3">
        <div class="card-body p-3">
            <div class="row align-items-end">
                <!-- Filter Prodi -->
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <label class="filter-label"><i class="fas fa-graduation-cap mr-1"></i> Program Studi</label>
                    <select id="filterProdi" class="form-control form-control-filter">
                        <option value="">Semua Program Studi</option>
                        <?php if (!empty($daftar_prodi)): ?>
                            <?php foreach ($daftar_prodi as $pr): ?>
                                <option value="<?= htmlspecialchars($pr->slug) ?>"
                                    <?= (isset($filter_prodi) && $filter_prodi == $pr->slug ? 'selected' : '') ?>>
                                    <?= htmlspecialchars($pr->nama_prodi) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Filter Tahun -->
                <div class="col-6 col-md-3 mb-2 mb-md-0">
                    <label class="filter-label"><i class="far fa-calendar-alt mr-1"></i> Tahun</label>
                    <select id="filterTahun" class="form-control form-control-filter">
                        <option value="">Semua Tahun</option>
                        <?php if (!empty($daftar_tahun)): ?>
                            <?php foreach ($daftar_tahun as $th): ?>
                                <option value="<?= htmlspecialchars($th) ?>"
                                    <?= (isset($filter_tahun) && $filter_tahun == $th ? 'selected' : '') ?>>
                                    <?= htmlspecialchars($th) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="<?= date('Y') ?>" <?= (!isset($filter_tahun) ? 'selected' : '') ?>>
                                <?= date('Y') ?>
                            </option>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="col-6 col-md-5">
                    <div class="d-flex" style="gap: 8px;">
                        <button class="btn btn-primary btn-filter-action flex-fill shadow-sm" id="btnFilter">
                            <i class="fas fa-filter"></i> <span class="d-none d-sm-inline">Terapkan</span> Filter
                        </button>
                        <a href="<?= base_url('bebaslab') ?>" class="btn btn-secondary btn-filter-action flex-fill" title="Reset Filter">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HORIZONTAL SCROLLABLE NAV PILLS -->
    <div class="bebaslab-nav-wrapper">
        <ul class="nav bebaslab-nav-pills" id="bebaslabTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#pengajuan">
                    <i class="fas fa-paper-plane"></i> Pengajuan
                    <span class="badge badge-warning badge-count"><?= (int)$total_pengajuan ?></span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#proses">
                    <i class="fas fa-sync-alt"></i> Proses
                    <span class="badge badge-info badge-count"><?= (int)$total_proses ?></span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#selesai">
                    <i class="fas fa-check-circle"></i> Selesai
                    <span class="badge badge-success badge-count"><?= (int)$total_selesai ?></span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reject">
                    <i class="fas fa-times-circle"></i> Reject
                    <span class="badge badge-danger badge-count"><?= (int)$total_ditolak ?></span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#blacklist">
                    <i class="fas fa-ban"></i> Blacklist
                </a>
            </li>
        </ul>
    </div>


    <!-- TAB CONTENT -->
    <div class="tab-content mb-4">

        <!-- ==================== 1. TAB PENGAJUAN ==================== -->
        <div class="tab-pane fade show active" id="pengajuan">
            
            <!-- MOBILE VIEW: Card List -->
            <div class="d-block d-md-none">
                <!-- Search Box Mobile -->
                <div class="mobile-search-box mb-3">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control search-mobile-cards" data-target="#listCardsPengajuan" placeholder="Cari NIM atau Nama pengajuan...">
                </div>

                <div id="listCardsPengajuan">
                    <?php if (empty($pengajuan)): ?>
                        <div class="text-center py-5 text-muted bg-white rounded shadow-sm p-4">
                            <i class="fas fa-inbox fa-3x mb-2 text-gray-300"></i>
                            <p class="mb-0 small font-weight-bold">Tidak ada pengajuan yang menunggu validasi.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($pengajuan as $p): ?>
                            <div class="mobile-card border-left-diajukan item-card" data-search="<?= strtolower($p->nim_mahasiswa . ' ' . $p->nama_lengkap . ' ' . $p->nama_prodi); ?>">
                                <div class="mobile-card-header">
                                    <span class="mobile-nim-badge">
                                        <i class="fas fa-id-badge text-primary"></i> <?= htmlspecialchars($p->nim_mahasiswa); ?>
                                    </span>
                                    <span class="badge-status-pill badge-status-diajukan">
                                        <i class="fas fa-clock"></i> Diajukan
                                    </span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-mahasiswa-name"><?= htmlspecialchars($p->nama_lengkap); ?></div>
                                    <div class="mobile-prodi-tag"><?= htmlspecialchars($p->nama_prodi); ?></div>
                                    <div class="mobile-meta-item mt-2">
                                        <i class="far fa-calendar-alt"></i>
                                        <span>Tgl Ajukan: <strong><?= date('d-m-Y', strtotime($p->date_created)); ?></strong></span>
                                    </div>
                                </div>
                                <div class="mobile-card-footer">
                                    <a href="<?= base_url('bebaslab/detail/' . $p->id_bebaslab); ?>" class="btn btn-sm btn-primary btn-block font-weight-bold shadow-sm py-2" style="border-radius: 8px;">
                                        <i class="fas fa-clipboard-check mr-1"></i> Detail & Verifikasi
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- DESKTOP VIEW: DataTable -->
            <div class="d-none d-md-block">
                <div class="card card-custom-main shadow-sm">
                    <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-inbox mr-2"></i>Daftar Pengajuan (Status: Diajukan)</h6>
                        <span class="badge badge-warning font-weight-bold px-2 py-1"><?= count($pengajuan); ?> Data</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover" id="tablePengajuan" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No.</th>
                                        <th>NIM</th>
                                        <th>Nama Lengkap</th>
                                        <th>Program Studi</th>
                                        <th>Tanggal Ajukan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width: 100px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pengajuan)): $no = 1; ?>
                                        <?php foreach ($pengajuan as $p): ?>
                                            <tr>
                                                <td class="text-center align-middle font-weight-bold"><?= $no++ ?></td>
                                                <td class="align-middle font-weight-bold text-primary">
                                                    <?= htmlspecialchars($p->nim_mahasiswa) ?>
                                                </td>
                                                <td class="align-middle font-weight-bold text-dark"><?= htmlspecialchars($p->nama_lengkap) ?></td>
                                                <td class="align-middle"><?= htmlspecialchars($p->nama_prodi) ?></td>
                                                <td class="align-middle"><?= date('d-m-Y', strtotime($p->date_created)) ?></td>
                                                <td class="text-center align-middle">
                                                    <span class="badge-status-pill badge-status-diajukan">Diajukan</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="<?= base_url('bebaslab/detail/' . $p->id_bebaslab) ?>" class="btn btn-sm btn-primary shadow-sm font-weight-bold px-3 py-1" style="border-radius: 20px;">
                                                        <i class="fas fa-eye mr-1"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- ==================== 2. TAB PROSES ==================== -->
        <div class="tab-pane fade" id="proses">
            
            <!-- MOBILE VIEW: Card List -->
            <div class="d-block d-md-none">
                <!-- Search Box Mobile -->
                <div class="mobile-search-box mb-3">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control search-mobile-cards" data-target="#listCardsProses" placeholder="Cari NIM atau Nama dalam proses...">
                </div>

                <div id="listCardsProses">
                    <?php if (empty($proses)): ?>
                        <div class="text-center py-5 text-muted bg-white rounded shadow-sm p-4">
                            <i class="fas fa-tasks fa-3x mb-2 text-gray-300"></i>
                            <p class="mb-0 small font-weight-bold">Tidak ada pengajuan yang sedang diproses.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($proses as $pr): ?>
                            <div class="mobile-card border-left-proses item-card" data-search="<?= strtolower($pr->nim_mahasiswa . ' ' . $pr->nama_lengkap . ' ' . $pr->nama_prodi); ?>">
                                <div class="mobile-card-header">
                                    <span class="mobile-nim-badge">
                                        <i class="fas fa-id-badge text-info"></i> <?= htmlspecialchars($pr->nim_mahasiswa); ?>
                                    </span>
                                    <span class="badge-status-pill badge-status-proses">
                                        <i class="fas fa-spinner fa-spin"></i> Proses
                                    </span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-mahasiswa-name"><?= htmlspecialchars($pr->nama_lengkap); ?></div>
                                    <div class="mobile-prodi-tag"><?= htmlspecialchars($pr->nama_prodi); ?></div>
                                    <div class="mobile-meta-item mt-2">
                                        <i class="far fa-calendar-alt"></i>
                                        <span>Tgl Update: <strong><?= !empty($pr->date_updated) ? date('d-m-Y', strtotime($pr->date_updated)) : '-' ?></strong></span>
                                    </div>
                                </div>
                                <div class="mobile-card-footer">
                                    <a href="<?= base_url('bebaslab/detail/' . $pr->id_bebaslab); ?>" class="btn btn-sm btn-info btn-block font-weight-bold shadow-sm py-2" style="border-radius: 8px;">
                                        <i class="fas fa-edit mr-1"></i> Detail & Lanjutkan
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- DESKTOP VIEW: DataTable -->
            <div class="d-none d-md-block">
                <div class="card card-custom-main shadow-sm">
                    <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-sync-alt mr-2"></i>Pengajuan dalam Proses</h6>
                        <span class="badge badge-info font-weight-bold px-2 py-1"><?= count($proses); ?> Data</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover" id="tableProses" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No.</th>
                                        <th>NIM</th>
                                        <th>Nama Lengkap</th>
                                        <th>Program Studi</th>
                                        <th>Tanggal Update</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width: 100px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($proses)): $no = 1; ?>
                                        <?php foreach ($proses as $pr): ?>
                                            <tr>
                                                <td class="text-center align-middle font-weight-bold"><?= $no++ ?></td>
                                                <td class="align-middle font-weight-bold text-info">
                                                    <?= htmlspecialchars($pr->nim_mahasiswa) ?>
                                                </td>
                                                <td class="align-middle font-weight-bold text-dark"><?= htmlspecialchars($pr->nama_lengkap) ?></td>
                                                <td class="align-middle"><?= htmlspecialchars($pr->nama_prodi) ?></td>
                                                <td class="align-middle">
                                                    <?= !empty($pr->date_updated) ? date('d-m-Y', strtotime($pr->date_updated)) : '-' ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <span class="badge-status-pill badge-status-proses">Proses</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="<?= base_url('bebaslab/detail/' . $pr->id_bebaslab) ?>" class="btn btn-sm btn-info shadow-sm font-weight-bold px-3 py-1" style="border-radius: 20px;">
                                                        <i class="fas fa-eye mr-1"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- ==================== 3. TAB SELESAI ==================== -->
        <div class="tab-pane fade" id="selesai">
            
            <!-- MOBILE VIEW: Card List -->
            <div class="d-block d-md-none">
                <!-- Search Box Mobile -->
                <div class="mobile-search-box mb-3">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control search-mobile-cards" data-target="#listCardsSelesai" placeholder="Cari NIM atau Nama pengajuan selesai...">
                </div>

                <div id="listCardsSelesai">
                    <?php if (empty($selesai)): ?>
                        <div class="text-center py-5 text-muted bg-white rounded shadow-sm p-4">
                            <i class="fas fa-check-circle fa-3x mb-2 text-gray-300"></i>
                            <p class="mb-0 small font-weight-bold">Belum ada pengajuan yang disetujui (selesai).</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($selesai as $s): ?>
                            <div class="mobile-card border-left-selesai item-card" data-search="<?= strtolower($s->nim_mahasiswa . ' ' . $s->nama_lengkap . ' ' . $s->nama_prodi); ?>">
                                <div class="mobile-card-header">
                                    <span class="mobile-nim-badge">
                                        <i class="fas fa-id-badge text-success"></i> <?= htmlspecialchars($s->nim_mahasiswa); ?>
                                    </span>
                                    <span class="badge-status-pill badge-status-selesai">
                                        <i class="fas fa-check-circle"></i> Selesai
                                    </span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-mahasiswa-name"><?= htmlspecialchars($s->nama_lengkap); ?></div>
                                    <div class="mobile-prodi-tag"><?= htmlspecialchars($s->nama_prodi); ?></div>
                                    
                                    <div class="row no-gutters mt-2 pt-2 border-top">
                                        <div class="col-6 pr-1">
                                            <div class="mobile-meta-item">
                                                <i class="fas fa-certificate text-primary"></i>
                                                <span>Tgl Surat:</span>
                                            </div>
                                            <div class="font-weight-bold text-dark small pl-3">
                                                <?= !empty($s->date_finished) ? date('d-m-Y', strtotime($s->date_finished)) : '-' ?>
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="mobile-meta-item">
                                                <i class="fas fa-clock text-success"></i>
                                                <span>Berlaku s.d:</span>
                                            </div>
                                            <div class="font-weight-bold text-success small pl-3">
                                                <?= !empty($s->berlaku_sampai) ? date('d-m-Y', strtotime($s->berlaku_sampai)) : '-' ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mobile-card-footer">
                                    <div class="d-flex" style="gap: 6px;">
                                        <a href="<?= base_url('bebaslab/detail/' . $s->id_bebaslab); ?>" class="btn btn-sm btn-outline-primary flex-fill font-weight-bold py-2" style="border-radius: 8px;">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                        <a href="<?= base_url('bebaslab/cetak/' . $s->id_bebaslab); ?>" target="_blank" class="btn btn-sm btn-success flex-fill font-weight-bold shadow-sm py-2" style="border-radius: 8px;">
                                            <i class="fas fa-print mr-1"></i> Cetak Surat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- DESKTOP VIEW: DataTable -->
            <div class="d-none d-md-block">
                <div class="card card-custom-main shadow-sm">
                    <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-check-double mr-2"></i>Pengajuan Selesai (Diterima)</h6>
                        <span class="badge badge-success font-weight-bold px-2 py-1"><?= count($selesai); ?> Data</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover" id="tableSelesai" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No.</th>
                                        <th>NIM</th>
                                        <th>Nama Lengkap</th>
                                        <th>Program Studi</th>
                                        <th>Tanggal Surat</th>
                                        <th>Berlaku Sampai</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($selesai)): $no = 1; ?>
                                        <?php foreach ($selesai as $s): ?>
                                            <tr>
                                                <td class="text-center align-middle font-weight-bold"><?= $no++ ?></td>
                                                <td class="align-middle font-weight-bold text-success">
                                                    <?= htmlspecialchars($s->nim_mahasiswa) ?>
                                                </td>
                                                <td class="align-middle font-weight-bold text-dark"><?= htmlspecialchars($s->nama_lengkap) ?></td>
                                                <td class="align-middle"><?= htmlspecialchars($s->nama_prodi) ?></td>
                                                <td class="align-middle font-weight-bold text-dark">
                                                    <?= !empty($s->date_finished) ? date('d-m-Y', strtotime($s->date_finished)) : '-' ?>
                                                </td>
                                                <td class="align-middle font-weight-bold text-success">
                                                    <?= !empty($s->berlaku_sampai) ? date('d-m-Y', strtotime($s->berlaku_sampai)) : '-' ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <span class="badge-status-pill badge-status-selesai">Diterima</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="d-inline-flex align-items-center" style="gap: 5px;">
                                                        <a href="<?= base_url('bebaslab/detail/' . $s->id_bebaslab) ?>" class="btn btn-sm btn-outline-primary font-weight-bold px-2 py-1" style="border-radius: 20px;">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                        <a href="<?= base_url('bebaslab/cetak/' . $s->id_bebaslab) ?>" target="_blank" class="btn btn-sm btn-success shadow-sm font-weight-bold px-2 py-1" style="border-radius: 20px;">
                                                            <i class="fas fa-print"></i> Cetak
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- ==================== 4. TAB REJECT ==================== -->
        <div class="tab-pane fade" id="reject">
            
            <!-- MOBILE VIEW: Card List -->
            <div class="d-block d-md-none">
                <!-- Search Box Mobile -->
                <div class="mobile-search-box mb-3">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control search-mobile-cards" data-target="#listCardsReject" placeholder="Cari NIM atau Nama yang ditolak...">
                </div>

                <div id="listCardsReject">
                    <?php if (empty($reject)): ?>
                        <div class="text-center py-5 text-muted bg-white rounded shadow-sm p-4">
                            <i class="fas fa-thumbs-up fa-3x mb-2 text-gray-300"></i>
                            <p class="mb-0 small font-weight-bold">Tidak ada pengajuan yang ditolak.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($reject as $r): ?>
                            <div class="mobile-card border-left-reject item-card" data-search="<?= strtolower($r->nim_mahasiswa . ' ' . $r->nama_lengkap . ' ' . $r->nama_prodi . ' ' . $r->keterangan); ?>">
                                <div class="mobile-card-header">
                                    <span class="mobile-nim-badge">
                                        <i class="fas fa-id-badge text-danger"></i> <?= htmlspecialchars($r->nim_mahasiswa); ?>
                                    </span>
                                    <span class="badge-status-pill badge-status-reject">
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    </span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-mahasiswa-name"><?= htmlspecialchars($r->nama_lengkap); ?></div>
                                    <div class="mobile-prodi-tag"><?= htmlspecialchars($r->nama_prodi); ?></div>
                                    
                                    <?php if (!empty($r->keterangan)): ?>
                                        <div class="alert alert-danger py-2 px-3 my-2 small" style="border-radius: 8px; font-size: 0.8rem; background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b;">
                                            <i class="fas fa-exclamation-circle mr-1"></i> <strong>Alasan:</strong> <?= htmlspecialchars($r->keterangan); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mobile-meta-item">
                                        <i class="far fa-calendar-alt"></i>
                                        <span>Tgl Ditolak: <strong><?= !empty($r->date_updated) ? date('d-m-Y', strtotime($r->date_updated)) : '-' ?></strong></span>
                                    </div>
                                </div>
                                <div class="mobile-card-footer">
                                    <a href="<?= base_url('bebaslab/detail/' . $r->id_bebaslab); ?>" class="btn btn-sm btn-outline-danger btn-block font-weight-bold py-2" style="border-radius: 8px;">
                                        <i class="fas fa-eye mr-1"></i> Detail & Catatan
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- DESKTOP VIEW: DataTable -->
            <div class="d-none d-md-block">
                <div class="card card-custom-main shadow-sm">
                    <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-times-circle mr-2"></i>Pengajuan Ditolak (Reject)</h6>
                        <span class="badge badge-danger font-weight-bold px-2 py-1"><?= count($reject); ?> Data</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover" id="tableReject" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No.</th>
                                        <th>NIM</th>
                                        <th>Nama Lengkap</th>
                                        <th>Program Studi</th>
                                        <th>Alasan Penolakan</th>
                                        <th>Tanggal Ditolak</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width: 100px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($reject)): $no = 1; ?>
                                        <?php foreach ($reject as $r): ?>
                                            <tr>
                                                <td class="text-center align-middle font-weight-bold"><?= $no++ ?></td>
                                                <td class="align-middle font-weight-bold text-danger">
                                                    <?= htmlspecialchars($r->nim_mahasiswa) ?>
                                                </td>
                                                <td class="align-middle font-weight-bold text-dark"><?= htmlspecialchars($r->nama_lengkap) ?></td>
                                                <td class="align-middle"><?= htmlspecialchars($r->nama_prodi) ?></td>
                                                <td class="align-middle">
                                                    <span class="text-danger small font-italic font-weight-bold"><?= htmlspecialchars($r->keterangan) ?></span>
                                                </td>
                                                <td class="align-middle">
                                                    <?= !empty($r->date_updated) ? date('d-m-Y', strtotime($r->date_updated)) : '-' ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <span class="badge-status-pill badge-status-reject">Reject</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="<?= base_url('bebaslab/detail/' . $r->id_bebaslab) ?>" class="btn btn-sm btn-outline-danger font-weight-bold px-3 py-1" style="border-radius: 20px;">
                                                        <i class="fas fa-eye mr-1"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- ==================== 5. TAB BLACKLIST ==================== -->
        <div class="tab-pane fade" id="blacklist">
            
            <!-- MOBILE VIEW: Card List -->
            <div class="d-block d-md-none">
                <div class="mobile-search-box mb-3">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control search-mobile-cards" data-target="#listCardsBlacklist" placeholder="Cari mahasiswa blacklist...">
                </div>

                <div id="listCardsBlacklist">
                    <?php if (empty($blacklist)): ?>
                        <div class="text-center py-5 text-muted bg-white rounded shadow-sm p-4">
                            <i class="fas fa-user-shield fa-3x mb-2 text-gray-300"></i>
                            <p class="mb-0 small font-weight-bold">Tidak ada daftar mahasiswa yang diblacklist.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($blacklist as $b): ?>
                            <div class="mobile-card border-left-blacklist item-card" data-search="<?= strtolower($b->nim_mahasiswa . ' ' . $b->nama_lengkap . ' ' . $b->keterangan); ?>">
                                <div class="mobile-card-header">
                                    <span class="mobile-nim-badge">
                                        <i class="fas fa-id-badge text-dark"></i> <?= htmlspecialchars($b->nim_mahasiswa); ?>
                                    </span>
                                    <span class="badge badge-dark px-2 py-1 font-weight-bold small">
                                        Blacklist
                                    </span>
                                </div>
                                <div class="mobile-card-body">
                                    <div class="mobile-mahasiswa-name"><?= htmlspecialchars($b->nama_lengkap); ?></div>
                                    <div class="small text-muted mt-2">
                                        <strong>Keterangan:</strong> <?= htmlspecialchars($b->keterangan); ?>
                                    </div>
                                    <div class="mobile-meta-item mt-2">
                                        <i class="far fa-calendar-alt"></i>
                                        <span>Tgl Input: <strong><?= date('d-m-Y', strtotime($b->date_created)); ?></strong></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- DESKTOP VIEW: DataTable -->
            <div class="d-none d-md-block">
                <div class="card card-custom-main shadow-sm">
                    <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-ban mr-2"></i>Daftar Blacklist</h6>
                        <span class="badge badge-dark font-weight-bold px-2 py-1"><?= count($blacklist); ?> Data</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover" id="tableBlacklist" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">No.</th>
                                        <th>NIM</th>
                                        <th>Nama Lengkap</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal Input</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($blacklist)): $no = 1; ?>
                                        <?php foreach ($blacklist as $b): ?>
                                            <tr>
                                                <td class="text-center align-middle font-weight-bold"><?= $no++ ?></td>
                                                <td class="align-middle font-weight-bold text-dark"><?= htmlspecialchars($b->nim_mahasiswa) ?></td>
                                                <td class="align-middle font-weight-bold text-dark"><?= htmlspecialchars($b->nama_lengkap) ?></td>
                                                <td class="align-middle"><?= htmlspecialchars($b->keterangan) ?></td>
                                                <td class="align-middle"><?= date('d-m-Y', strtotime($b->date_created)) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div> <!-- end tab-content -->

</div>
<!-- End Page Content -->

<!-- Scripts -->
<script>
    $(document).ready(function() {

        // 1. Inisialisasi DataTables Desktop
        var dtOptions = {
            "pageLength": 25,
            "lengthChange": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
            "ordering": true,
            "autoWidth": false,
            "order": [],
            "language": {
                "search": "Cari data:",
                "lengthMenu": "Tampilkan _MENU_ baris",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 data",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "zeroRecords": "Tidak ada data yang cocok",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        };

        if ($.fn.DataTable) {
            $('#tablePengajuan').DataTable(dtOptions);
            $('#tableProses').DataTable(dtOptions);
            $('#tableSelesai').DataTable(dtOptions);
            $('#tableReject').DataTable(dtOptions);
            $('#tableBlacklist').DataTable(dtOptions);
        }

        // 2. Filter Button Action
        $("#btnFilter").click(function() {
            var prodi = $("#filterProdi").val();
            var tahun = $("#filterTahun").val();
            var base = "<?= base_url('bebaslab') ?>";
            var params = [];

            if (prodi) params.push("prodi=" + encodeURIComponent(prodi));
            if (tahun) params.push("tahun=" + encodeURIComponent(tahun));

            var finalUrl = base;
            if (params.length > 0) finalUrl += "?" + params.join("&");
            
            // Sertakan tab hash aktif saat filter
            var activeTab = $('.bebaslab-nav-pills .nav-link.active').attr('href');
            if (activeTab) finalUrl += activeTab;

            window.location.href = finalUrl;
        });

        // 3. Tab Hash Persistence
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var href = $(e.target).attr('href');
            history.replaceState(null, null, href);
        });

        var hash = window.location.hash;
        if (hash) {
            var target = $('.bebaslab-nav-pills a[href="' + hash + '"]');
            if (target.length) {
                target.tab('show');
            }
        }

        // 4. Live Search Mobile Cards
        $('.search-mobile-cards').on('keyup input', function() {
            var searchTerm = $(this).val().toLowerCase().trim();
            var targetContainer = $(this).data('target');
            
            $(targetContainer).find('.item-card').each(function() {
                var cardText = $(this).data('search') || $(this).text().toLowerCase();
                if (cardText.indexOf(searchTerm) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

    });
</script>