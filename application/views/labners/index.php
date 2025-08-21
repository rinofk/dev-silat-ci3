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

    <!-- Summary Cards -->
    <div class="row">
        <div class="col-md mb-2">
            <a href="?tahun=<?= $this->input->get('tahun'); ?>&status=">
                <div class="card border-primary shadow h-100 py-2">
                    <div class="card-body text-center">
                        <h6 class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total</h6>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total ?? 0 ?></div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md mb-2">
            <a href="?tahun=<?= $this->input->get('tahun'); ?>&status=di ajukan">
                <div class="card border-info shadow h-100 py-2">
                    <div class="card-body text-center">
                        <h6 class="text-xs font-weight-bold text-info text-uppercase mb-1">Diajukan</h6>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_diajukan ?? 0 ?></div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md mb-2">
            <a href="?tahun=<?= $this->input->get('tahun'); ?>&status=proses">
                <div class="card border-warning shadow h-100 py-2">
                    <div class="card-body text-center">
                        <h6 class="text-xs font-weight-bold text-warning text-uppercase mb-1">Proses</h6>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_proses ?? 0 ?></div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md mb-2">
            <a href="?tahun=<?= $this->input->get('tahun'); ?>&status=reject">
                <div class="card border-danger shadow h-100 py-2">
                    <div class="card-body text-center">
                        <h6 class="text-xs font-weight-bold text-danger text-uppercase mb-1">Reject</h6>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_reject ?? 0 ?></div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md mb-2">
            <a href="?tahun=<?= $this->input->get('tahun'); ?>&status=accept">
                <div class="card border-success shadow h-100 py-2">
                    <div class="card-body text-center">
                        <h6 class="text-xs font-weight-bold text-success text-uppercase mb-1">Accept</h6>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_selesai ?? 0 ?></div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Table: Belum Valid -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Berkas Bebas Lab Prodi S1 Keperawatan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Prodi</th>
                            <th>Create At</th>
                            <th>Status</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($bl as $s): ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td>
                                    <a href="<?= base_url("Laboran/nersdetail/{$s['id_bebaslab']}"); ?>">
                                        <?= $s['nim_mahasiswa']; ?> [-<?= $s['id_bebaslab']; ?>-]
                                    </a>
                                </td>
                                <td><?= $s['nama_lengkap']; ?></td>
                                <td><?= $s['nama_prodi']; ?></td>
                                <td><?= $s['date_created']; ?></td>
                                <td><?= $s['status']; ?></td>
                                <td>
                                    <?= $s['date_updated']; ?><br>
                                    <?= $s['lab1_admin']; ?><br>

                                    <?php if (strtolower($s['status']) !== 'accept'): ?>
                                        <a href="<?= base_url("laboran/hapus_ners/{$s['id_bebaslab']}"); ?>" 
                                        class="btn btn-sm btn-danger mt-1"
                                        onclick="return confirm('Yakin ingin menghapus data ini? <?= $s['nama_lengkap']; ?>');">
                                            Delete
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>


</div>
<!-- End of Container Fluid -->
