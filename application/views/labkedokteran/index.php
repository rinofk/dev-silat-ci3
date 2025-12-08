<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data mahasiswa <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Filter Form -->
    <form method="get" class="form-inline mb-3">
        <div class="form-group mr-2">
            <label for="tahun">Tahun:</label>
            <select name="tahun" id="tahun" class="form-control ml-2">
                <option value="">Semua Tahun</option>
                <?php
                $selectedTahun = $this->input->get('tahun') ?? '';
                $lastTahun = end($filter_tahun)['tahun'];
                if ($selectedTahun == '') $selectedTahun = $lastTahun;
                foreach (array_reverse($filter_tahun) as $t):
                ?>
                    <option value="<?= $t['tahun']; ?>" <?= ($selectedTahun == $t['tahun']) ? 'selected' : ''; ?>>
                        <?= $t['tahun']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mr-2">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control ml-2">
                <option value="">Semua Status</option>
                <?php foreach ($filter_status as $s): ?>
                    <option value="<?= $s; ?>" <?= ($this->input->get('status') == $s) ? 'selected' : ''; ?>>
                        <?= ucfirst($s); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary ml-2">Filter</button>
    </form>


    <!-- Dashboard Cards -->
    <div class="row">
        <?php
        $cards = [
            ['title' => 'Di Ajukan', 'count' => $total_diajukan, 'icon' => 'fa-paper-plane', 'color' => 'secondary', 'status' => 'di ajukan'],
            ['title' => 'Proses',    'count' => $total_proses,   'icon' => 'fa-sync-alt',    'color' => 'warning',   'status' => 'proses'],
            ['title' => 'Selesai',   'count' => $total_terima,  'icon' => 'fa-check-circle', 'color' => 'success',  'status' => 'accept'],
            ['title' => 'Reject',    'count' => $total_reject,   'icon' => 'fa-times-circle', 'color' => 'danger',  'status' => 'reject'],
            ['title' => 'Total',     'count' => $total,    'icon' => 'fa-list',        'color' => 'info',     'status' => '']
        ];
        $currentTahun = $this->input->get('tahun') ?? '';
        ?>

        <?php foreach ($cards as $card) : ?>
            <!-- <div class="col-xl-3 col-md-6 mb-4"> -->
            <div class="col-md mb-2">
                <a href="<?= base_url('laboran/kedokteran?tahun=' . $currentTahun . '&status=' . $card['status']); ?>" class="text-decoration-none">
                    <div class="card border-left-<?= $card['color'] ?> shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-<?= $card['color'] ?> text-uppercase mb-1">
                                        <?= $card['title'] ?>
                                    </div>
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

    <!-- DataTable -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Berkas Bebas Lab Prodi Kedokteran</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Create At</th>
                            <th scope="col">Status</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($bl as $s): ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>
                                    <a href="<?= base_url(); ?>Laboran/kedokterandetail/<?= $s['id_bebaslab']; ?>">
                                        <?= $s['nim_mahasiswa']; ?> [-<?= $s['id_bebaslab']; ?>-]
                                    </a>
                                </td>
                                <td><?= $s['nama_lengkap']; ?></td>
                                <td><?= $s['nama_prodi']; ?></td>
                                <td><?= $s['date_created']; ?></td>
                                <td><?= $s['status']; ?></td>
                                <td><?= $s['date_updated']; ?><br><?= $s['lab1_admin']; ?></td>
                                <td>
                                    <?php if (strtolower($s['status']) !== 'accept'): ?>
                                        <a href="<?= base_url("laboran/hapus_dokter/{$s['id_bebaslab']}"); ?>"
                                            class="btn btn-sm btn-danger mt-1"
                                            onclick="return confirm('Yakin ingin menghapus data ini? <?= $s['nama_lengkap']; ?>');">
                                            Delete
                                        </a>
                                    <?php endif; ?>

                                </td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- End Page Content -->