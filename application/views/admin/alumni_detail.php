<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <!-- Profile Photo Card -->
        <div class="col-xl-4 col-md-5">
            <div class="card shadow mb-4 border-bottom-primary">
                <div class="card-body text-center">
                    <img src="<?= base_url('assets/img/alumni/') . ($alumni['poto'] ? $alumni['poto'] : 'default.jpg'); ?>" class="img-profile rounded-circle img-thumbnail mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4 class="font-weight-bold text-gray-800 mb-1"><?= $alumni['nama_lengkap'] ? $alumni['nama_lengkap'] : '-'; ?></h4>
                    <p class="text-primary font-weight-bold mb-1"><?= $alumni['nim_alumni']; ?></p>
                    <p class="text-gray-600 small mb-3"><?= $alumni['nama_prodi'] ? $alumni['nama_prodi'] : '-'; ?></p>
                    <hr>
                    <div class="text-center">
                        <?php if ($alumni['status_alumni'] == 1) : ?>
                            <span class="badge badge-success px-3 py-2 font-weight-bold">Status: Aktif / Terverifikasi</span>
                        <?php else : ?>
                            <span class="badge badge-warning px-3 py-2 font-weight-bold">Status: Diajukan / Belum Aktif</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alumni Details Card -->
        <div class="col-xl-8 col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Alumni</h6>
                    <div>
                        <a href="<?= base_url('admin/alumni_ubah/' . $alumni['id_alumni']); ?>" class="btn btn-sm btn-primary btn-icon-split">
                            <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                            <span class="text">Edit</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <th width="30%">NIM</th>
                                    <td>: <?= $alumni['nim_alumni']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>: <?= $alumni['nama_lengkap'] ? $alumni['nama_lengkap'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Program Studi</th>
                                    <td>: <?= $alumni['nama_prodi'] ? $alumni['nama_prodi'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Tahun Akademik</th>
                                    <td>: <?= $alumni['thn_akademik'] ? $alumni['thn_akademik'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Semester</th>
                                    <td>: <?= $alumni['ganjilgenap'] ? $alumni['ganjilgenap'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Tahun Wisuda</th>
                                    <td>: <?= $alumni['tahun_wisuda'] ? $alumni['tahun_wisuda'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Jalur Masuk</th>
                                    <td>: <?= $alumni['jalur_masuk'] ? $alumni['jalur_masuk'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>IPK</th>
                                    <td>: <span class="font-weight-bold"><?= $alumni['ipk'] ? $alumni['ipk'] : '-'; ?></span></td>
                                </tr>
                                <tr>
                                    <th>Predikat Kelulusan</th>
                                    <td>: <?= $alumni['predikat'] ? $alumni['predikat'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lulus Sidang</th>
                                    <td>: <?= $alumni['tgl_lulus_sidang'] && $alumni['tgl_lulus_sidang'] != '2020-01-01' ? $alumni['tgl_lulus_sidang'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lulus Yudisium</th>
                                    <td>: <?= $alumni['tgl_lulus_yudisium'] && $alumni['tgl_lulus_yudisium'] != '2020-01-01' ? $alumni['tgl_lulus_yudisium'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat Sekarang</th>
                                    <td>: <?= $alumni['alamat_sekarang'] ? $alumni['alamat_sekarang'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Judul Skripsi</th>
                                    <td>: <span class="font-italic"><?= $alumni['judul_skripsi'] ? $alumni['judul_skripsi'] : '-'; ?></span></td>
                                </tr>
                                <tr>
                                    <th>Pesan & Kesan</th>
                                    <td>: <?= $alumni['pesan_kesan'] ? $alumni['pesan_kesan'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Terdaftar</th>
                                    <td>: <?= $alumni['tanggal_daftar'] ? $alumni['tanggal_daftar'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th>Terakhir Diperbarui</th>
                                    <td>: <?= $alumni['tanggal_updatealumni'] ? $alumni['tanggal_updatealumni'] : '-'; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-12 text-right">
                            <a href="<?= base_url('admin/alumni'); ?>" class="btn btn-secondary">Kembali ke Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
