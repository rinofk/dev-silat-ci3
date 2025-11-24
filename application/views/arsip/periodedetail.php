<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <i class="fas fa-exclamation-triangle"></i>
      <?= $this->session->flashdata('error'); ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
  <?php elseif ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fas fa-check-circle"></i>
      <?= $this->session->flashdata('success'); ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
  <?php endif; ?>

  <!-- CARD INFO PERIODE -->
<div class="card shadow mb-4">
  <div class="card-header bg-info text-white py-3">
    <h6 class="m-0 font-weight-bold">
      <i class="fas fa-graduation-cap"></i> Informasi Periode Yudisium
    </h6>
  </div>

  <div class="card-body">
    <div class="row">

      <!-- Kolom 1 -->
      <div class="col-md-3 mb-3">
        <h6 class="text-secondary font-weight-bold mb-3">
          <i class="fas fa-university"></i> Program Studi
        </h6>
        <p class="mb-2"><strong>Nama Prodi:</strong><br><?= $detail['nama_prodi'] ?? '-' ?></p>
        <p class="mb-2"><strong>Periode:</strong><br><?= $detail['nama_periode'] ?? '-' ?></p>
      </div>

      <!-- Kolom 2 -->
      <div class="col-md-3 mb-3">
        <h6 class="text-secondary font-weight-bold mb-3">
          <i class="fas fa-calendar-alt"></i> Tahun Akademik
        </h6>
        <p class="mb-2"><strong>Tahun Akademik:</strong><br><?= $detail['tahun_akademik'] ?? '-' ?></p>
        <p class="mb-2"><strong>Semester:</strong><br><?= $detail['semester_text'] ?? '-' ?></p>
      </div>

      <!-- Kolom 3 -->
      <div class="col-md-3 mb-3">
        <h6 class="text-secondary font-weight-bold mb-3">
          <i class="fas fa-clock"></i> Jadwal
        </h6>
        <p class="mb-2">
          <strong>Tanggal Pendaftaran:</strong><br>
          <?= !empty($detail['tgl_mulai']) ? date('d M Y', strtotime($detail['tgl_mulai'])) : '-' ?>
          s/d
          <?= !empty($detail['tgl_selesai']) ? date('d M Y', strtotime($detail['tgl_selesai'])) : '-' ?>
        </p>
        <p class="mb-0"><strong>Tanggal Yudisium:</strong><br>
          <?= !empty($detail['tgl_yudisium']) ? date('d M Y', strtotime($detail['tgl_yudisium'])) : '-' ?>
        </p>
      </div>

      <!-- Kolom 4 -->
      <div class="col-md-3 mb-3">
        <h6 class="text-secondary font-weight-bold mb-3">
          <i class="fas fa-folder-open"></i> Berkas Yudisium
        </h6>

        <p class="mb-3">
          <strong>Berita Acara (BA):</strong><br>
          <?php if (!empty($detail['ba'])): ?>
            <a href="<?= base_url('assets/arsip/periode_yudisium/'.$detail['ba']); ?>" 
               target="_blank" class="btn btn-sm btn-outline-primary mt-2 w-100">
              <i class="fas fa-file-pdf"></i> Lihat BA
            </a>
          <?php else: ?>
            <span class="text-muted">Belum ada berkas</span>
          <?php endif; ?>
        </p>

        <p class="mb-0">
          <strong>SK Yudisium:</strong><br>
          <?php if (!empty($detail['sk'])): ?>
            <a href="<?= base_url('assets/arsip/periode_yudisium/'.$detail['sk']); ?>" 
               target="_blank" class="btn btn-sm btn-outline-success mt-2 w-100">
              <i class="fas fa-file-alt"></i> Lihat SK
            </a>
          <?php else: ?>
            <span class="text-muted">Belum ada berkas</span>
          <?php endif; ?>
        </p>
      </div>

    </div>
  </div>
</div>


  <!-- CARD DAFTAR MAHASISWA -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 bg-primary text-white d-flex justify-content-between align-items-center">
      <div>
        <h6 class="m-0 font-weight-bold">Periode: <?= $detail['nama_periode']; ?></h6>
      </div>

      <div class="d-flex align-items-center gap-2">
        <!-- Tombol Kembali -->
        <a href="<?= base_url('arsip/periodeyudisium'); ?>" class="btn btn-light btn-sm mr-2">
          <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <!-- Tombol Tambah Mahasiswa -->
        <button class="btn btn-light btn-sm text-primary" data-toggle="modal" data-target="#modalTambahMahasiswa">
          <i class="fas fa-user-plus"></i> Tambah Mahasiswa
        </button>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
          <thead class="thead-light text-center">
            <tr>
              <th>#</th>
              <th>NIM</th>
              <th>Nama Lengkap</th>
              <th>Admin</th>
              <th>Tanggal Update</th>
              <th>Periksa Berkas</th>
              <th>Status</th>
              <th>Verifikasi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($ypdetail as $s): ?>
              <tr class="text-center">
                <td><?= $i++; ?></td>
                <td>
                  <a href="<?= base_url('arsip/yudisiumdetail/'.$s['nim_mahasiswa']); ?>">
                    <?= $s['nim_mahasiswa']; ?>
                  </a>
                </td>
                <td class="text-left"><?= $s['nama_lengkap']; ?></td>
                <td><?= $s['admin']; ?></td>
                <td><?= $s['date_updated']; ?></td>

                <!-- Kolom Periksa Berkas -->
                <td>
                  <div class="btn-group" role="group">
                    <?php if (!empty($s['transkrip'])): ?>
                      <a href="<?= base_url('assets/arsip/yudisium/'.$s['transkrip']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Transkrip">
                        <i class="fas fa-file-pdf text-danger"></i>
                      </a>
                    <?php endif; ?>

                    <?php if (!empty($s['skripsi'])): ?>
                      <a href="<?= base_url('assets/arsip/yudisium/'.$s['skripsi']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Skripsi">
                        <i class="fas fa-file-alt text-primary"></i>
                      </a>
                    <?php endif; ?>

                    <?php if (!empty($s['ukt'])): ?>
                      <a href="<?= base_url('assets/arsip/yudisium/'.$s['ukt']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="UKT">
                        <i class="fas fa-file-invoice-dollar text-success"></i>
                      </a>
                    <?php endif; ?>

                    <?php if (!empty($s['bebaslab'])): ?>
                      <a href="<?= base_url('assets/arsip/yudisium/'.$s['bebaslab']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Bebas Lab">
                        <i class="fas fa-flask text-warning"></i>
                      </a>
                    <?php endif; ?>
                  </div>
                </td>
                <td><?= $s['status']; ?></td>

                <!-- Kolom Verifikasi -->
                <td>
                  <?php if ($s['status'] == 'Terverifikasi'): ?>
                    <span class="badge badge-success">
                      <i class="fas fa-check-circle"></i> Sudah
                    </span>
                  <?php else: ?>
                    <div class="d-flex justify-content-center">
                      <a href="<?= base_url('arsip/accept/'.$s['nim_mahasiswa'].'/'.$detail['id_periode']); ?>" 
                         class="btn btn-sm btn-success mr-2"
                         onclick="return confirm('Yakin ingin memverifikasi mahasiswa ini?');">
                        <i class="fas fa-check"></i> Verifikasi
                      </a>

                      <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalKembalikan<?= $s['nim_mahasiswa']; ?>">
                        <i class="fas fa-undo"></i> Kembalikan
                      </button>
                    </div>
                  <?php endif; ?>
                </td>
              </tr>

              <!-- Modal Kembalikan -->
              <div class="modal fade" id="modalKembalikan<?= $s['nim_mahasiswa']; ?>" tabindex="-1" aria-labelledby="kembalikanLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="<?= base_url('arsip/reject/'.$s['nim_mahasiswa'].'/'.$detail['id_periode']); ?>" method="post">
                      <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="kembalikanLabel">Kembalikan Berkas</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <p>Masukkan alasan mengapa berkas dikembalikan:</p>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tuliskan alasan pengembalian..." required></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Kembalikan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of Main Content -->

<!-- MODAL TAMBAH MAHASISWA -->
<div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" aria-labelledby="tambahMahasiswaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('arsip/tambahmahasiswa'); ?>" method="post">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="tambahMahasiswaLabel">Tambah Mahasiswa ke Periode Ini</h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_periode" value="<?= $detail['id_periode']; ?>">
          <div class="form-group">
            <label for="nim_mahasiswa">NIM Mahasiswa</label>
            <input type="text" class="form-control" name="nim_mahasiswa" id="nim_mahasiswa" placeholder="Masukkan NIM" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
