<!-- Begin Page Content -->
<div class="container-fluid px-3">

    <!-- Custom Compact Style -->
    <style>
        .table-compact th, .table-compact td {
            padding: 0.4rem 0.5rem !important;
            vertical-align: middle !important;
            font-size: 0.825rem;
        }
        .table-compact thead th {
            font-size: 0.775rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            background-color: #f8fafc;
            color: #475569;
            border-bottom: 2px solid #e2e8f0;
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
        }
        .card-compact .card-body {
            padding: 0.75rem 1rem !important;
        }
        .btn-compact {
            padding: 0.2rem 0.5rem !important;
            font-size: 0.75rem !important;
            border-radius: 4px !important;
        }
        .badge-compact {
            font-size: 10.5px !important;
            padding: 2px 6px !important;
            border-radius: 4px !important;
            font-weight: 600;
        }
    </style>

    <!-- Page Heading & Active Badges -->
    <div class="d-flex align-items-center justify-content-between mb-2">
        <h1 class="h5 mb-0 text-gray-800 font-weight-bold">
            <i class="fas fa-book-reader mr-1 text-primary"></i> Bebas Perpustakaan
        </h1>
        <div>
            <?php if (!empty($selected_tahun)): ?>
                <span class="badge badge-primary badge-compact shadow-sm">
                    <i class="fas fa-calendar-alt mr-1"></i> <?= $selected_tahun; ?>
                </span>
            <?php else: ?>
                <span class="badge badge-secondary badge-compact shadow-sm">
                    <i class="fas fa-calendar mr-1"></i> Semua Tahun
                </span>
            <?php endif; ?>
            <?php if (!empty($selected_status)): ?>
                <span class="badge badge-warning text-white badge-compact shadow-sm ml-1">
                    <i class="fas fa-filter mr-1"></i> <?= ($selected_status == 'di ajukan') ? 'Di Ajukan' : ucfirst($selected_status); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Filter Card (Compact) -->
    <div class="card shadow-sm mb-3 border-0" style="border-radius: 8px; background: #ffffff;">
        <div class="card-body py-2 px-3">
            <form method="get" action="<?= base_url('pustakawan'); ?>">
                <div class="form-row align-items-center">
                    <div class="col-md-3 col-sm-6 mb-1 mb-md-0">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0 py-0"><i class="fas fa-calendar-alt text-muted small"></i></span>
                            </div>
                            <select name="tahun" class="form-control form-control-sm custom-select">
                                <option value="">-- Semua Tahun --</option>
                                <?php foreach($filter_tahun as $t): ?>
                                    <option value="<?= $t['tahun']; ?>" <?= ($selected_tahun !== '' && $t['tahun'] == $selected_tahun) ? 'selected' : ''; ?>>
                                        Tahun <?= $t['tahun']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-1 mb-md-0">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0 py-0"><i class="fas fa-tag text-muted small"></i></span>
                            </div>
                            <select name="status" class="form-control form-control-sm custom-select">
                                <option value="">-- Semua Status --</option>
                                <?php foreach($filter_status as $s): ?>
                                    <option value="<?= $s; ?>" <?= ($selected_status !== '' && $s == $selected_status) ? 'selected' : ''; ?>>
                                        <?= ($s == 'di ajukan') ? 'Di Ajukan' : ucfirst($s); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-1 mb-md-0">
                        <button type="submit" class="btn btn-sm btn-primary px-3 font-weight-bold shadow-sm">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button>
                        <a href="<?= base_url('pustakawan'); ?>" class="btn btn-sm btn-outline-secondary px-2 ml-1" title="Reset filter default">
                            <i class="fas fa-redo-alt mr-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm py-2 px-3 col-md-6 mb-2 small" role="alert" style="border-radius: 6px;">
            <i class="fas fa-check-circle mr-1"></i> Data mahasiswa <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
            <button type="button" class="close py-2" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Dashboard Summary Cards (Compact) -->
    <div class="row mb-2">
        <?php 
            $cards = [
                ['title' => 'Di Ajukan', 'count' => $count_diajukan, 'icon' => 'fa-paper-plane', 'color' => 'warning', 'status' => 'di ajukan'],
                ['title' => 'Reject',    'count' => $count_reject,   'icon' => 'fa-times-circle', 'color' => 'danger',  'status' => 'reject'],
                ['title' => 'Accept',    'count' => $count_accept,   'icon' => 'fa-check-circle', 'color' => 'success', 'status' => 'accept'],
                ['title' => 'Total',     'count' => $count_total,    'icon' => 'fa-list-ul',      'color' => 'info',    'status' => '']
            ]; 
        ?>

        <?php foreach ($cards as $card) : 
            $isActive = ($selected_status === $card['status']);
        ?>
            <div class="col-xl-3 col-md-6 mb-2">
                <a href="<?= base_url('pustakawan?tahun=' . $selected_tahun . '&status=' . $card['status']); ?>" class="text-decoration-none">
                    <div class="card card-compact border-left-<?= $card['color'] ?> shadow-sm h-100 <?= $isActive ? 'border-primary' : '' ?>" style="border-radius: 8px; <?= $isActive ? 'background-color: #f8fafc; border-width: 2px !important;' : '' ?>">
                        <div class="card-body py-2 px-3">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-<?= $card['color'] ?> text-uppercase mb-0 d-flex align-items-center justify-content-between">
                                        <span><?= $card['title'] ?></span>
                                        <?php if ($isActive): ?>
                                            <span class="badge badge-<?= $card['color'] ?> text-white" style="font-size: 8px; padding: 1px 4px; border-radius: 3px;">Aktif</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($card['count'], 0, ',', '.'); ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas <?= $card['icon'] ?> fa-lg text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?> 
    </div>

    <!-- Data Table Card (Compact) -->
    <div class="card shadow-sm mb-4 border-0" style="border-radius: 10px; overflow: hidden;">
        <div class="card-header py-2 px-3 bg-white d-flex justify-content-between align-items-center border-bottom">
            <h6 class="m-0 font-weight-bold text-primary small d-flex align-items-center">
                <i class="fas fa-table mr-1"></i> Daftar Berkas Bebas Perpustakaan
            </h6>
            <span class="badge badge-light border text-muted badge-compact font-weight-normal">
                Total: <?= count($perpus); ?> Berkas
            </span>
        </div>
        <div class="card-body p-2 p-md-3">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover table-compact mb-0" id="datatable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 3%;">#</th>
                            <th style="width: 13%;">NIM / ID</th>
                            <th style="width: 22%;">Nama Lengkap</th>
                            <th style="width: 15%;">Prodi</th>
                            <th style="width: 11%;">Tgl Buat</th>
                            <th style="width: 16%;">Status</th>
                            <th style="width: 12%;">Update</th>
                            <th style="width: 8%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($perpus as $s) : ?>
                            <tr>
                                <td class="text-center text-muted font-weight-bold"><?= $i++; ?></td>
                                <td>
                                    <a href="<?= base_url('pustakawan/detail/' . $s['id_bp']); ?>" class="font-weight-bold text-primary" title="Lihat detail">
                                        <?= $s['nim_mahasiswa']; ?>
                                    </a>
                                    <span class="badge badge-light border text-muted ml-1" style="font-size: 10px;">#<?= $s['id_bp']; ?></span>
                                </td>
                                <td class="font-weight-bold text-gray-800">
                                    <?= $s['nama_lengkap']; ?>
                                </td>
                                <td>
                                    <span class="text-dark small"><?= $s['nama_prodi'] ?: '-'; ?></span>
                                </td>
                                <td class="text-center small text-muted">
                                    <?= (!empty($s['date_created']) && $s['date_created'] != '0000-00-00 00:00:00') ? date('d-m-Y', strtotime($s['date_created'])) : '-'; ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        if ($s['status'] == 'accept') {
                                            $label = 'Selesai';
                                            $badge = 'success';
                                            $icon = 'fa-check-circle';
                                        } elseif ($s['status'] == 'di ajukan' || empty($s['status'])) {
                                            $label = 'Di Ajukan';
                                            $badge = 'warning text-white';
                                            $icon = 'fa-clock';
                                        } elseif ($s['status'] == 'reject') {
                                            $label = 'Reject';
                                            $badge = 'danger';
                                            $icon = 'fa-times-circle';
                                        } else {
                                            $label = ucfirst($s['status']);
                                            $badge = 'secondary';
                                            $icon = 'fa-info-circle';
                                        }
                                    ?>
                                    <span class="badge badge-<?= $badge ?> badge-compact">
                                        <i class="fas <?= $icon ?> mr-1"></i><?= $label ?>
                                    </span>
                                    <?php 
                                        $keterangan = !empty($s['keterangan']) ? $s['keterangan'] : (($s['status'] == 'di ajukan' || empty($s['status'])) ? 'menunggu validasi' : '');
                                        if (!empty($keterangan)):
                                    ?>
                                        <div class="text-muted font-italic" style="font-size: 10.5px; line-height: 1.1; margin-top: 2px;">
                                            <?= $keterangan; ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center small">
                                    <?php if (!empty($s['date_updated']) && $s['date_updated'] != '0000-00-00 00:00:00'): ?>
                                        <span class="text-gray-700 font-weight-bold"><?= date('d-m-Y', strtotime($s['date_updated'])); ?></span>
                                        <?php if (!empty($s['admin'])): ?>
                                            <div class="text-muted" style="font-size: 10px;">
                                                <i class="fas fa-user-check text-success mr-1"></i><?= $s['admin']; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('pustakawan/detail/' . $s['id_bp']); ?>" class="btn btn-primary btn-compact shadow-sm" title="Periksa / Detail">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <?php if ($s['status'] != 'accept') : ?>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-outline-danger btn-compact dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 0 4px 4px 0 !important; margin-left: 1px;" title="Aksi Lain">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 py-1" style="border-radius: 6px;">
                                                    <a class="dropdown-item text-danger small py-1" href="<?= base_url('pustakawan/hapus/' . $s['id_bp']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus berkas pengajuan dari <?= addslashes($s['nama_lengkap']); ?> [<?= $s['id_bp']; ?>]?')">
                                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
