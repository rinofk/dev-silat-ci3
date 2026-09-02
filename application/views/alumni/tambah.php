<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Pendaftaran Alumni</h1>
    </div>

    <!-- Alert Peringatan -->
    <div class="alert alert-warning border-left-warning shadow-sm mb-4" style="border-radius: 12px;" role="alert">
        <div class="d-flex align-items-start">
            <div class="mr-3 text-warning mt-1" style="font-size: 1.5rem;">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div>
                <strong class="d-block mb-1 text-gray-900">Perhatian Sebelum Mendaftar Alumni:</strong>
                <span class="small text-gray-800">Setelah Anda mendaftarkan diri sebagai <strong>Alumni</strong>, Anda <strong>tidak akan dapat mengajukan Surat Aktif Kuliah lagi</strong>. Pastikan seluruh keperluan surat keterangan aktif kuliah Anda sudah selesai sebelum menyimpan data pendaftaran ini.</span>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Form Pendaftaran (col-lg-8) -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header py-3 bg-gradient-primary text-white" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user-graduate mr-2"></i>Formulir Pendaftaran Alumni</h6>
                </div>
                <div class="card-body p-4">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger shadow-sm mb-3 py-2 px-3 small" role="alert" style="border-radius: 8px;">
                            <i class="fas fa-exclamation-triangle mr-1"></i> <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="post">
                        <div class="form-group row">
                            <label for="nim_alumni" class="col-sm-3 col-form-label text-gray-800">
                                <i class="fas fa-id-card text-primary mr-1"></i> NIM
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="nim_alumni" class="form-control bg-light" id="nim_alumni" value="<?= $user['nim']; ?>" readonly>
                                <small class="text-muted">NIM akun mahasiswa yang sedang aktif.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahun_wisuda" class="col-sm-3 col-form-label text-gray-800">
                                <i class="fas fa-calendar-alt text-primary mr-1"></i> Tahun Wisuda
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="tahun_wisuda" class="form-control" id="tahun_wisuda" value="<?= set_value('tahun_wisuda'); ?>" maxlength="4" placeholder="Contoh: 2026" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                <small class="text-muted">Masukkan 4 digit tahun kelulusan/wisuda resmi.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jalur_masuk" class="col-sm-3 col-form-label text-gray-800">
                                <i class="fas fa-sign-in-alt text-primary mr-1"></i> Jalur Masuk
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="jalur_masuk" class="form-control" id="jalur_masuk" placeholder="Contoh: SNMPTN, SBMPTN, SMMPTN/Mandiri" value="<?= set_value('jalur_masuk'); ?>">
                                <small class="text-muted">Jalur seleksi masuk saat memulai perkuliahan.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="judul_skripsi" class="col-sm-3 col-form-label text-gray-800">
                                <i class="fas fa-book text-primary mr-1"></i> Judul Skripsi
                            </label>
                            <div class="col-sm-9">
                                <textarea name="judul_skripsi" class="form-control" id="judul_skripsi" rows="3" placeholder="Masukkan judul skripsi / tugas akhir"><?= set_value('judul_skripsi') ?></textarea>
                                <small class="text-muted">Tuliskan judul lengkap tugas akhir / skripsi Anda.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pesan_kesan" class="col-sm-3 col-form-label text-gray-800">
                                <i class="fas fa-comment-dots text-primary mr-1"></i> Pesan & Kesan
                            </label>
                            <div class="col-sm-9">
                                <textarea name="pesan_kesan" class="form-control" id="pesan_kesan" rows="3" placeholder="Tuliskan pesan dan kesan selama masa studi"><?= set_value('pesan_kesan') ?></textarea>
                                <small class="text-muted">Pesan, kesan, atau testimoni Anda selama menempuh studi di FK UNTAN.</small>
                            </div>
                        </div>

                        <div class="row mt-4 pt-3 border-top">
                            <div class="col-sm-12 text-right">
                                <a href="<?= base_url('alumni'); ?>" class="btn btn-secondary px-4 py-2 font-weight-bold mr-2 shadow-sm" style="border-radius: 8px;">
                                    <i class="fas fa-arrow-left mr-1"></i> Batal
                                </a>
                                <button type="submit" name="tambah" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 8px;">
                                    <i class="fas fa-save mr-1"></i> Simpan Pendaftaran
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Kolom Informasi (col-lg-4) -->
        <div class="col-lg-4 mb-4">
            <!-- Card Panduan -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                <div class="card-header py-3 bg-white border-bottom" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle mr-2"></i>Petunjuk Pendaftaran
                    </h6>
                </div>
                <div class="card-body p-3" style="font-size: 0.88rem;">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-check-circle text-success mr-2 mt-1"></i>
                            <div>
                                <strong class="text-gray-800 d-block">Biodata Akurat</strong>
                                <span class="text-muted small">Lengkapi tahun kelulusan, jalur masuk, dan judul tugas akhir sesuai data akademik.</span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-camera text-info mr-2 mt-1"></i>
                            <div>
                                <strong class="text-gray-800 d-block">Unggah Foto</strong>
                                <span class="text-muted small">Setelah mengisi biodata, Anda dapat mengunggah pas foto formal pada halaman data alumni.</span>
                            </div>
                        </li>
                        <li class="mb-1 d-flex align-items-start">
                            <i class="fas fa-print text-primary mr-2 mt-1"></i>
                            <div>
                                <strong class="text-gray-800 d-block">Cetak Bukti</strong>
                                <span class="text-muted small">Setelah data disimpan, Anda dapat mencetak Bukti Pendaftaran Alumni sewaktu-waktu.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
</div>