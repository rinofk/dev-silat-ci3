<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Filter -->
    <form method="get" action="<?= base_url('pustakawan'); ?>" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <select name="tahun" class="form-control">
                    <option value="">-- Semua Tahun --</option>
                    <?php foreach($filter_tahun as $t): ?>
                        <option value="<?= $t['tahun']; ?>" <?= ($t['tahun'] == $this->input->get('tahun')) ? 'selected' : ''; ?>>
                            <?= $t['tahun']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- Semua Status --</option>
                    <?php foreach($filter_status as $s): ?>
                        <option value="<?= $s; ?>" <?= ($s == $this->input->get('status')) ? 'selected' : ''; ?>>
                            <?= ($s == 'di ajukan') ? 'Di Ajukan' : ucfirst($s); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
            Data mahasiswa <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <!-- Dashboard Cards -->
    <div class="row">
        <?php 
            $cards = [
                ['title' => 'Di Ajukan', 'count' => $count_diajukan, 'icon' => 'fa-paper-plane', 'color' => 'primary', 'status' => 'di ajukan'],
                ['title' => 'Reject',    'count' => $count_reject,   'icon' => 'fa-times-circle', 'color' => 'danger', 'status' => 'reject'],
                ['title' => 'Accept',    'count' => $count_accept,   'icon' => 'fa-check-circle', 'color' => 'success', 'status' => 'accept'],
                ['title' => 'Total',     'count' => $count_total,    'icon' => 'fa-list', 'color' => 'info', 'status' => '']
            ]; 
            $currentTahun = $this->input->get('tahun') ?? '';
        ?>

        <?php foreach ($cards as $card) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= base_url('pustakawan?tahun=' . $currentTahun . '&status=' . $card['status']); ?>" style="text-decoration: none;">
                    <div class="card border-left-<?= $card['color'] ?> shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-<?= $card['color'] ?> text-uppercase mb-1"><?= $card['title'] ?></div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $card['count'] ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas <?= $card['icon'] ?> fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Berkas Bebas Perpustakaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="datatable" width="100%" cellspacing="0">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th style="width: 4%">#</th>
                            <th style="width: 10%">NIM</th>
                            <th style="width: 18%">Nama Lengkap</th>
                            <th style="width: 14%">Prodi</th>
                            <th style="width: 12%">Create At</th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 15%">Update</th>
                            <th style="width: 17%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($perpus as $s) : ?>
                            <tr>
                                <td class="text-center"><?= $i; ?></td>
                                <td>
                                    <a href="<?= base_url('pustakawan/detail/' . $s['id_bp']); ?>" class="text-primary font-weight-bold">
                                        <?= $s['nim_mahasiswa']; ?><br><small>[<?= $s['id_bp']; ?>]</small>
                                    </a>
                                </td>
                                <td><?= $s['nama_lengkap']; ?></td>
                                <td><?= $s['nama_prodi']; ?></td>
                                <td class="text-center"><?= date('d-m-Y', strtotime($s['date_created'])); ?></td>
                                <td class="text-center">
                                    <?php 
                                        if ($s['status'] == 'accept') {
                                            $label = 'Selesai';
                                            $badge = 'success';
                                        } elseif ($s['status'] == 'di ajukan') {
                                            $label = 'Di Ajukan';
                                            $badge = 'warning';
                                        } elseif ($s['status'] == 'reject') {
                                            $label = 'Reject';
                                            $badge = 'danger';
                                        } else {
                                            $label = $s['status'];
                                        }
                                    ?>
                                    <span class="badge badge-<?= $badge ?>"><?= $label ?></span>
                                </td>
                                <td class="text-center">
                                    <?= date('d-m-Y', strtotime($s['date_updated'])); ?><br>
                                    <small class="text-muted"><?= $s['admin']; ?></small>
                                </td>
                                <td class="text-center">
                                    <?php if ($s['status'] != 'accept') : ?>
                                        <a href="<?= base_url('pustakawan/hapus/' . $s['id_bp']); ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus <?= $s['nama_lengkap']; ?> [<?= $s['id_bp']; ?>]?')">Delete
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
