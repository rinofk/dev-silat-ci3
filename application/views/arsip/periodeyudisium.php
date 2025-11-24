<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <!-- ========================== -->
  <!-- CARD 6 PRODI -->
  <!-- ========================== -->
  <div class="row mb-4">
    <?php 
    $prodis = [
      ['id' => 1, 'slug' => 'kedokteran', 'nama' => 'Kedokteran', 'icon' => 'fa-user-md'],
      ['id' => 2, 'slug' => 'farmasi', 'nama' => 'Farmasi', 'icon' => 'fa-flask'],
      ['id' => 3, 'slug' => 'keperawatan', 'nama' => 'Keperawatan', 'icon' => 'fa-heartbeat'],
      ['id' => 6, 'slug' => 'profesi-dokter', 'nama' => 'Profesi Dokter', 'icon' => 'fa-stethoscope'],
      ['id' => 4, 'slug' => 'profesi-apoteker', 'nama' => 'Profesi Apoteker', 'icon' => 'fa-pills'],
      ['id' => 5, 'slug' => 'profesi-ners', 'nama' => 'Profesi Ners', 'icon' => 'fa-user-nurse']
    ];

    $selected_prodi = isset($selected_prodi) ? $selected_prodi : null;
    foreach ($prodis as $p): 
      $active = ($selected_prodi == $p['id']) ? 'border-left-success' : 'border-left-primary';
    ?>
      <div class="col-xl-2 col-md-4 mb-4">
        <a href="<?= base_url('arsip/periodeyudisium/'.$p['slug']); ?>" class="text-decoration-none">
          <div class="card <?= $active; ?> shadow h-100 py-2 position-relative">
            <div class="card-body text-center">
              <i class="fas <?= $p['icon']; ?> fa-2x text-primary mb-2"></i>
              <h6 class="text-primary font-weight-bold"><?= $p['nama']; ?></h6>

              <!-- Badge Aktif -->
              <?php 
              $isActiveProdi = false;
              foreach ($periode as $cek) {
                if ($cek['id_prodi'] == $p['id'] && date('Y-m-d') >= $cek['tgl_mulai'] && date('Y-m-d') <= $cek['tgl_selesai']) {
                  $isActiveProdi = true;
                  break;
                }
              }
              ?>
              <?php if ($isActiveProdi): ?>
                <span class="badge badge-success position-absolute" style="top:10px; right:10px;">Aktif</span>
              <?php endif; ?>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Tombol tambah periode -->
  <div class="row mt-3 mb-4">
    <div class="col-md-6">
      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newPeriodeModal">
        <i class="fas fa-plus"></i> Tambah Periode
      </a>
    </div>
  </div>

  <!-- ========================== -->
  <!-- TABEL PERIODE AKTIF -->
  <!-- ========================== -->
  <div class="card shadow mb-4 border-left-success">
    <div class="card-header py-3 bg-success text-white">
      <h6 class="m-0 font-weight-bold">
        Periode Aktif
        <?php if ($selected_prodi_name): ?>
          (<?= $selected_prodi_name; ?>)
        <?php endif; ?>
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-light text-center">
            <tr>
              <th>#</th>
              <th>Nama Periode</th>
              <th>Tahun</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Selesai</th>
              <th>Tanggal Yudisium</th>
              <th>BA</th>
              <th>SK</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            $today = date('Y-m-d');
            foreach ($periode as $s):
              $isActive = ($today >= $s['tgl_mulai'] && $today <= $s['tgl_selesai']);
              if ($isActive): ?>
                <tr class="text-center">
                  <td><?= $i++; ?></td>
                  <td><a href="<?= base_url('arsip/yudisiumperiodedetail/'.$s['id_periode']); ?>"><?= $s['nama_periode']; ?></a></td>
                  <td><?= $s['tahun_sem']; ?></td>
                  <td><?= $s['tgl_mulai']; ?></td>
                  <td><?= $s['tgl_selesai']; ?></td>
                  <td><?= $s['tgl_yudisium']; ?></td>
                  <td>
                      <?php if (!empty($s['ba'])): ?>
                        <a href="<?= base_url('assets/arsip/periode_yudisium/'.$s['ba']); ?>" target="_blank" title="Lihat Berita Acara">
                          <i class="fas fa-file-alt text-success"></i>
                        </a>
                      <?php else: ?>
                        <i class="fas fa-times text-danger"></i>
                      <?php endif; ?>
                    </td>

                    <td>
                      <?php if (!empty($s['sk'])): ?>
                        <a href="<?= base_url('assets/arsip/periode_yudisium/'.$s['sk']); ?>" target="_blank" title="Lihat SK Yudisium">
                          <i class="fas fa-file-signature text-primary"></i>
                        </a>
                      <?php else: ?>
                        <i class="fas fa-times text-danger"></i>
                      <?php endif; ?>
                    </td>
                  <td><span class="badge badge-success">Aktif</span></td>
                  <td><a href="#" class="badge badge-primary" data-toggle="modal" data-target="#updatePeriodeModal<?= $s['id_periode']; ?>">Update</a></td>
                </tr>
              <?php endif;
            endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- ========================== -->
  <!-- TABEL PERIODE SELESAI -->
  <!-- ========================== -->
  <div class="card shadow mb-4 border-left-secondary">
    <div class="card-header py-3 bg-secondary text-white">
      <h6 class="m-0 font-weight-bold">Periode Selesai</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="thead-light text-center">
            <tr>
              <th>#</th>
              <th>Nama Periode</th>
              <th>Tahun</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Selesai</th>
              <th>Tanggal Yudisium</th>
              <th>BA</th>
              <th>SK</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($periode as $s):
              $isActive = ($today >= $s['tgl_mulai'] && $today <= $s['tgl_selesai']);
              if (!$isActive): ?>
                <tr class="text-center">
                  <td><?= $i++; ?></td>
                  <td><a href="<?= base_url('arsip/yudisiumperiodedetail/'.$s['id_periode']); ?>"><?= $s['nama_periode']; ?></a></td>
                  <td><?= $s['tahun_sem']; ?></td>
                  <td><?= $s['tgl_mulai']; ?></td>
                  <td><?= $s['tgl_selesai']; ?></td>
                  <td><?= $s['tgl_yudisium']; ?></td>
                  <td>
                    <?php if (!empty($s['ba'])): ?>
                      <a href="<?= base_url('assets/arsip/periode_yudisium/'.$s['ba']); ?>" target="_blank" title="Lihat Berita Acara">
                        <i class="fas fa-file-alt text-success"></i>
                      </a>
                    <?php else: ?>
                      <i class="fas fa-times text-danger"></i>
                    <?php endif; ?>
                  </td>

                  <td>
                    <?php if (!empty($s['sk'])): ?>
                      <a href="<?= base_url('assets/arsip/periode_yudisium/'.$s['sk']); ?>" target="_blank" title="Lihat SK Yudisium">
                        <i class="fas fa-file-signature text-primary"></i>
                      </a>
                    <?php else: ?>
                      <i class="fas fa-times text-danger"></i>
                    <?php endif; ?>
                  </td>
                  <td><span class="badge badge-secondary">Tidak Aktif</span></td>
                  <td><a href="#" class="badge badge-primary" data-toggle="modal" data-target="#updatePeriodeModal<?= $s['id_periode']; ?>">Update</a></td>
                </tr>
              <?php endif;
            endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<!-- MODAL TAMBAH DAN UPDATE tetap sama seperti kode kamu sebelumnya -->

<!-- ========================== -->
<!-- MODAL TAMBAH PERIODE (2 KOLOM) -->
<!-- ========================== -->
<div class="modal fade" id="newPeriodeModal" tabindex="-1" role="dialog" aria-labelledby="newPeriodeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document"> <!-- modal-lg biar lebih lebar -->
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Periode Pendaftaran</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('arsip/periodeyudisium'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                <label>Program Studi</label>
                <select class="form-control" name="id_prodi" required>
                  <option value="">-- Pilih Prodi --</option>
                  <?php foreach ($prodis as $p): ?>
                    <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Nama Periode</label>
                <input type="text" class="form-control" name="nama_periode" placeholder="Contoh: Periode Yudisium 1 2025" required>
              </div>

              <div class="form-group">
                <label>Tahun</label>
                <input type="text" class="form-control" name="tahun_sem" placeholder="20251" required>
              </div>

            </div>
            <div class="col-md-6">

              <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" class="form-control" name="tgl_mulai" required>
              </div>

              <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" class="form-control" name="tgl_selesai" required>
              </div>

              <div class="form-group">
                <label>Tanggal Yudisium</label>
                <input type="date" class="form-control" name="tgl_yudisium">
              </div>

            </div>
          </div>

          <!-- <hr> -->
<!-- 
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Upload Berita Acara (PDF/DOC)</label>
                <input type="file" class="form-control" name="ba" accept=".pdf,.doc,.docx">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Upload SK Yudisium (PDF/DOC)</label>
                <input type="file" class="form-control" name="sk" accept=".pdf,.doc,.docx">
              </div>
            </div>
          </div> -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- ========================== -->
<!-- MODAL UPDATE PERIODE -->
<!-- ========================== -->
<?php foreach ($periode as $s): ?>
<div class="modal fade" id="updatePeriodeModal<?= $s['id_periode']; ?>" tabindex="-1" role="dialog" aria-labelledby="updatePeriodeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Update Periode: <?= $s['nama_periode']; ?></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('arsip/updateyudisium'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="id_periode" value="<?= $s['id_periode']; ?>">

          <?php 
          $slug = '';
          foreach ($prodis as $p) {
            if ($p['id'] == $s['id_prodi']) { $slug = $p['slug']; break; }
          }
          ?>
          <input type="hidden" name="slug" value="<?= $slug; ?>">

          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                <label>Program Studi</label>
                <select class="form-control" name="id_prodi" required>
                  <?php foreach ($prodis as $p): ?>
                    <option value="<?= $p['id']; ?>" <?= ($p['id'] == $s['id_prodi']) ? 'selected' : ''; ?>>
                      <?= $p['nama']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Nama Periode</label>
                <input type="text" class="form-control" name="nama_periode" value="<?= $s['nama_periode']; ?>" required>
              </div>

              <div class="form-group">
                <label>Tahun</label>
                <input type="text" class="form-control" name="tahun_sem" value="<?= $s['tahun_sem']; ?>" required>
              </div>

            </div>
            <div class="col-md-6">

              <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" class="form-control" name="tgl_mulai" value="<?= $s['tgl_mulai']; ?>" required>
              </div>

              <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" class="form-control" name="tgl_selesai" value="<?= $s['tgl_selesai']; ?>" required>
              </div>

              <div class="form-group">
                <label>Tanggal Yudisium</label>
                <input type="date" class="form-control" name="tgl_yudisium" value="<?= $s['tgl_yudisium']; ?>">
              </div>

            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Upload Berita Acara (PDF/DOC)</label>
                <input type="file" class="form-control" name="ba" accept=".pdf,.doc,.docx">
                <?php if (!empty($s['ba'])): ?>
                  <small class="text-muted">
                    File sekarang: <a href="<?= base_url('assets/arsip/periode_yudisium/'.$s['ba']); ?>" target="_blank">Lihat</a>
                  </small>
                  <input type="hidden" name="old_ba" value="<?= $s['ba']; ?>">
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Upload SK Yudisium (PDF/DOC)</label>
                <input type="file" class="form-control" name="sk" accept=".pdf,.doc,.docx">
                <?php if (!empty($s['sk'])): ?>
                  <small class="text-muted">
                    File sekarang: <a href="<?= base_url('assets/arsip/periode_yudisium/'.$s['sk']); ?>" target="_blank">Lihat</a>
                  </small>
                  <input type="hidden" name="old_sk" value="<?= $s['sk']; ?>">
                <?php endif; ?>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning text-white">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>
