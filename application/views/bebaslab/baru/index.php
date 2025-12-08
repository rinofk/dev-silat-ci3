<?php
// application/views/bebaslab/index.php
// Pastikan header & footer (templates/header, templates/footer) memuat:
// - Bootstrap CSS/JS
// - jQuery
// - DataTables CSS/JS
// - FontAwesome (opsional)
// Controller mengirimkan: $title, $daftar_prodi, $daftar_tahun, $filter_prodi, $filter_tahun
// serta $pengajuan, $proses, $selesai, $reject, $blacklist, dan total_* variables.
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= isset($title) ? $title : 'Dashboard Bebas Lab' ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <!-- FILTER -->
    <div class="row mb-4">
        <!-- Filter Prodi -->
        <div class="col-md-3">
            <label><b>Filter Prodi</b></label>
            <select id="filterProdi" class="form-control">
                <option value="">Semua Prodi</option>
                <?php if (!empty($daftar_prodi)): ?>
                    <?php foreach ($daftar_prodi as $pr): ?>
                        <option value="<?= htmlspecialchars($pr->nama_prodi) ?>"
                            <?= (isset($filter_prodi) && $filter_prodi == $pr->nama_prodi ? 'selected' : '') ?>>
                            <?= htmlspecialchars($pr->nama_prodi) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <!-- Filter Tahun -->
        <div class="col-md-3">
            <label><b>Filter Tahun</b></label>
            <select id="filterTahun" class="form-control">
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

        <!-- Tombol Filter -->
        <div class="col-md-2">
            <label>&nbsp;</label>
            <button class="btn btn-primary btn-block" id="btnFilter">
                Terapkan Filter
            </button>
        </div>

        <!-- Tombol Reset -->
        <div class="col-md-2">
            <label>&nbsp;</label>
            <a href="<?= base_url('bebaslab') ?>" class="btn btn-secondary btn-block">
                Reset
            </a>
        </div>
    </div>

    <!-- ROW CARD STATISTIK -->
    <div class="row mb-4">

        <!-- TOTAL DIAJUKAN -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card shadow border-0" style="background:#007bff; color:white;">
                <div class="card-body text-center">
                    <h6 class="card-title mb-2">Diajukan</h6>
                    <p class="card-text" style="font-size: 26px; font-weight: 700;">
                        <?= isset($total_pengajuan) ? (int)$total_pengajuan : 0 ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- TOTAL PROSES -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card shadow border-0" style="background:#17a2b8; color:white;">
                <div class="card-body text-center">
                    <h6 class="card-title mb-2">Proses</h6>
                    <p class="card-text" style="font-size: 26px; font-weight: 700;">
                        <?= isset($total_proses) ? (int)$total_proses : 0 ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- TOTAL SELESAI -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card shadow border-0" style="background:#28a745; color:white;">
                <div class="card-body text-center">
                    <h6 class="card-title mb-2">Selesai</h6>
                    <p class="card-text" style="font-size: 26px; font-weight: 700;">
                        <?= isset($total_selesai) ? (int)$total_selesai : 0 ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- TOTAL REJECT -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card shadow border-0" style="background:#dc3545; color:white;">
                <div class="card-body text-center">
                    <h6 class="card-title mb-2">Reject</h6>
                    <p class="card-text" style="font-size: 26px; font-weight: 700;">
                        <?= isset($total_reject) ? (int)$total_reject : 0 ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- TOTAL SEMUA -->
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card shadow border-0" style="background:#343a40; color:white;">
                <div class="card-body text-center">
                    <h6 class="card-title mb-2">Semua</h6>
                    <p class="card-text" style="font-size: 26px; font-weight: 700;">
                        <?= isset($total_semua) ? (int)$total_semua : 0 ?>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="bebaslabTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#pengajuan">Pengajuan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#proses">Proses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#selesai">Selesai</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#reject">Reject</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blacklist">Blacklist</a>
        </li>
    </ul>

    <div class="tab-content">

        <!-- TAB PENGAJUAN -->
        <div class="tab-pane fade show active" id="pengajuan">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan (Status: Diajukan)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="tablePengajuan" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Tanggal Ajukan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($pengajuan)): ?>
                                    <?php foreach ($pengajuan as $p): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($p->nim_mahasiswa) ?></td>
                                            <td><?= htmlspecialchars($p->nama_lengkap) ?></td>
                                            <td><?= htmlspecialchars($p->nama_prodi) ?></td>
                                            <td><?= date('d-m-Y', strtotime($p->date_created)) ?></td>
                                            <td><span class="badge badge-warning">Diajukan</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB PROSES -->
        <div class="tab-pane fade" id="proses">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Pengajuan dalam Proses</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="tableProses" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Tanggal Update</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($proses)): ?>
                                    <?php foreach ($proses as $pr): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($pr->nim_mahasiswa) ?></td>
                                            <td><?= htmlspecialchars($pr->nama_lengkap) ?></td>
                                            <td><?= htmlspecialchars($pr->nama_prodi) ?></td>
                                            <td>
                                                <?= !empty($pr->updated_at) ? date('d-m-Y', strtotime($pr->updated_at)) : '-' ?>
                                            </td>
                                            <td><span class="badge badge-info">Proses</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB SELESAI -->
        <div class="tab-pane fade" id="selesai">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Pengajuan Selesai</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="tableSelesai" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Tanggal Surat</th>
                                    <th>Berlaku Sampai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($selesai)): ?>
                                    <?php foreach ($selesai as $s): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($s->nim_mahasiswa) ?></td>
                                            <td><?= htmlspecialchars($s->nama_lengkap) ?></td>
                                            <td><?= htmlspecialchars($s->nama_prodi) ?></td>
                                            <td><?= !empty($s->date_finished) ? date('d-m-Y', strtotime($s->date_finished)) : '-' ?></td>
                                            <td><?= !empty($s->berlaku_sampai) ? date('d-m-Y', strtotime($s->berlaku_sampai)) : '-' ?></td>
                                            <td><span class="badge badge-success">Diterima</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB REJECT -->
        <div class="tab-pane fade" id="reject">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Pengajuan Ditolak</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="tableReject" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Alasan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reject)): ?>
                                    <?php foreach ($reject as $r): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($r->nim_mahasiswa) ?></td>
                                            <td><?= htmlspecialchars($r->nama_lengkap) ?></td>
                                            <td><?= htmlspecialchars($r->nama_prodi) ?></td>
                                            <td><?= htmlspecialchars($r->keterangan) ?></td>
                                            <td><?= !empty($r->date_reject) ? date('d-m-Y', strtotime($r->date_reject)) : '-' ?></td>
                                            <td><span class="badge badge-danger">Reject</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB BLACKLIST -->
        <div class="tab-pane fade" id="blacklist">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Daftar Blacklist</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="tableBlacklist" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Input</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($blacklist)): ?>
                                    <?php foreach ($blacklist as $b): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($b->nim_mahasiswa) ?></td>
                                            <td><?= htmlspecialchars($b->nama_lengkap) ?></td>
                                            <td><?= htmlspecialchars($b->keterangan) ?></td>
                                            <td><?= date('d-m-Y', strtotime($b->date_created)) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end tab-content -->

</div>
<!-- End Page Content -->

<!-- Datatables + Filter Logic -->
<script>
    $(document).ready(function() {

        // Init DataTables
        var dtOptions = {
            "pageLength": 25,
            "lengthChange": false,
            "ordering": true,
            "autoWidth": false,
            "order": []
        };

        if ($.fn.DataTable) {
            $('#tablePengajuan').DataTable(dtOptions);
            $('#tableProses').DataTable(dtOptions);
            $('#tableSelesai').DataTable(dtOptions);
            $('#tableReject').DataTable(dtOptions);
            $('#tableBlacklist').DataTable(dtOptions);
        } else {
            console.warn('DataTables plugin not loaded.');
        }

        // Filter logic: build URL with params
        $("#btnFilter").click(function() {
            var prodi = $("#filterProdi").val();
            var tahun = $("#filterTahun").val();
            var base = "<?= base_url('bebaslab') ?>";
            var params = [];

            if (prodi) params.push("prodi=" + encodeURIComponent(prodi));
            if (tahun) params.push("tahun=" + encodeURIComponent(tahun));

            var finalUrl = base;
            if (params.length > 0) finalUrl += "?" + params.join("&");
            window.location.href = finalUrl;
        });

        // Optional: maintain active tab on page reload using hash
        // Update hash on tab change
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var href = $(e.target).attr('href');
            history.replaceState(null, null, href);
        });

        // On load: if URL contains hash, activate that tab
        var hash = window.location.hash;
        if (hash) {
            var target = $('a[href="' + hash + '"]');
            if (target.length) {
                target.tab('show');
            }
        }

    });
</script>