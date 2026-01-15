<div class="container-fluid mt-4">

    <h4 class="mb-4">📊 Statistik Reset Akun Mahasiswa</h4>
    <form method="get" class="card mb-4">
        <div class="card-body row">
            <div class="col-md-4">
                <label>Tanggal Mulai</label>
                <input type="date" name="start_date"
                    value="<?= $start_date; ?>"
                    class="form-control" required>
            </div>

            <div class="col-md-4">
                <label>Tanggal Akhir</label>
                <input type="date" name="end_date"
                    value="<?= $end_date; ?>"
                    class="form-control" required>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary btn-block">
                    <i class="fas fa-filter"></i> Tampilkan
                </button>
            </div>
        </div>
    </form>

    <!-- INFO BOX -->
    <div class="row">
        <div class="col-md-4">
            <div class="card border-left-primary">
                <div class="card-body">
                    <h6>Total Reset</h6>
                    <h3><?= $total; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-left-success">
                <div class="card-body">
                    <h6>Berhasil</h6>
                    <h3><?= $success; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-left-danger">
                <div class="card-body">
                    <h6>Gagal</h6>
                    <h3><?= $failed; ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header font-weight-bold">
            📊 Grafik Aktivitas Reset Akun
        </div>
        <div class="card-body">
            <canvas id="resetChart" height="100"></canvas>
        </div>
    </div>

    <!-- TOP NIM -->
    <div class="card mb-4">
        <div class="card-header font-weight-bold">
            🔝 NIM Paling Sering Reset
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-sm mb-0">
                <tr>
                    <th>NIM</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($top_nim as $row): ?>
                    <tr>
                        <td><?= $row->nim ?></td>
                        <td><?= $row->total ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>

    <!-- RESET MENCURIGAKAN -->
    <div class="card mb-4 border-danger">
        <div class="card-header bg-danger text-white">
            🚨 Aktivitas Mencurigakan
        </div>
        <div class="card-body p-0">
            <table class="table table-sm mb-0">
                <tr>
                    <th>NIM</th>
                    <th>IP Address</th>
                    <th>Gagal</th>
                </tr>
                <?php if (!empty($suspicious)) : ?>
                    <?php foreach ($suspicious as $row) : ?>
                        <tr>
                            <td><?= $row->nim; ?></td>
                            <td><?= $row->ip_address; ?></td>
                            <td><?= $row->total; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Tidak ada aktivitas mencurigakan
                        </td>
                    </tr>
                <?php endif; ?>

            </table>
        </div>
    </div>

    <!-- LOG TERBARU -->
    <div class="card">
        <div class="card-header font-weight-bold">
            🕒 Log Reset Terbaru
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <tr>
                    <th>Waktu</th>
                    <th>NIM</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th>IP</th>
                </tr>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= $log->created_at ?></td>
                        <td><?= $log->nim ?></td>
                        <td>
                            <span class="badge badge-<?= $log->status == 'success' ? 'success' : 'danger' ?>">
                                <?= strtoupper($log->status) ?>
                            </span>
                        </td>
                        <td><?= $log->reason ?></td>
                        <td><?= $log->ip_address ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>

</div>