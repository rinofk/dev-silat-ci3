<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Heading -->
  <!--<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>-->

  <!-- FILTER DAN STATISTIK -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <!-- Filter Form -->
      <form method="get" class="mb-3">
  <div class="row">
    <div class="col-md-3">
      <label for="status">Status</label>
      <select name="status" class="form-control" id="status">
        <option value="">-- Semua Status --</option>
        <option value="diajukan" <?= ($this->input->get('status') == 'diajukan') ? 'selected' : '' ?>>Diajukan</option>
        <option value="proses" <?= ($this->input->get('status') == 'proses') ? 'selected' : '' ?>>Diproses</option>
        <option value="selesai" <?= ($this->input->get('status') == 'selesai') ? 'selected' : '' ?>>Selesai</option>
        <option value="ditolak, data tidak lengkap" <?= ($this->input->get('status') == 'ditolak, data tidak lengkap') ? 'selected' : '' ?>>Ditolak</option>
      </select>
    </div>
    <div class="col-md-3">
      <label for="tahun">Tahun</label>
      <select name="tahun" id="tahun" class="form-control">
        <?php foreach ($list_tahun as $tahun): ?>
          <option value="<?= $tahun ?>" <?= ($tahun_selected == $tahun) ? 'selected' : '' ?>><?= $tahun ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3 align-self-end">
      <button type="submit" class="btn btn-primary">Filter</button>
      <a href="<?= base_url('transaksi/aktifkuliah'); ?>" class="btn btn-secondary">Reset</a>
    </div>
  </div>
</form>

<div class="row">
  <?php 
    $warna = [
      'Diajukan' => 'primary',
      'Proses' => 'info',
      'Ditolak' => 'danger',
      'Selesai' => 'success',
      'Total' => 'dark'
    ];

    foreach ($statistik as $status => $jumlah):
      $url_status = strtolower($status);
      $url = base_url('transaksi/aktifkuliah?status=' . urlencode($url_status) . '&tahun=' . $tahun_selected);
  ?>
    <div class="col mb-3">
      <a href="<?= $url ?>" class="text-decoration-none">
        <div class="card border-left-<?= $warna[$status] ?> shadow h-100 py-2">
          <div class="card-body">
            <div class="text-xs font-weight-bold text-<?= $warna[$status] ?> text-uppercase mb-1">
              <?= $status ?>
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah ?></div>
          </div>
        </div>
      </a>
    </div>
  <?php endforeach; ?>
</div>

      

    </div>
  </div>

  <!-- Flash Message -->
  <?php if ($this->session->flashdata('flash')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Data mahasiswa <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <!-- DATA TABLE -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table" id="datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>NIM</th>
              <th>Nama Lengkap</th>
              <th>Semester</th>
              <th>Tahun Ajaran</th>
              <th>Keperluan</th>
              <th>Create At</th>
              <th>Status</th>
              <th>Admin</th>
              <th>Finish</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($surat as $s) { ?>
              <tr>
                <td><?= $i; ?></td>
                <td>
                  <a href="<?= base_url(); ?>transaksi/detail/<?= $s['id_suratpengajuan']; ?>">
                    <?= $s['nim']; ?> [-<?= $s['id_suratpengajuan']; ?>-]
                  </a>
                </td>
                <td><?= $s['nama_lengkap']; ?> <?php if (!empty($s['file_selesai'])): ?>
  <a href="<?= base_url('assets/surat_selesai/' . $s['file_selesai']); ?>" target="_blank" class="btn btn-outline-success mt-2">
    <i class="fas fa-download"></i> Surat Selesai
  </a>
<?php endif; ?>
</td>
                <td><?= $s['semester']; ?></td>
                <td><?= $s['tahun_ajaran']; ?></td>
                <td><?= $s['nama_keperluan']; ?> <?= $s['keterangan']; ?></td>
                <td><?= date('d F Y', $s['date_create']); ?></td>
                <td><?= $s['status']; ?></td>
                <td><?= $s['admin']; ?></td>
                <td><?= date('d F Y', $s['date_finish']); ?></td>
                <td>
                  <a href="<?= base_url(); ?>transaksi/hapus_ak/<?= $s['id_suratpengajuan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus <?= $s['nama_lengkap']; ?> [-<?= $s['id_suratpengajuan']; ?>-]?');">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php $i++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- End Container -->
