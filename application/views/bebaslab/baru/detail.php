<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="row mt-3">
            <div class="col-md-12">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= isset($title) ? $title : 'Detail Bebas Laboratorium' ?></h1>

    <div class="row">
        <!-- Main Form Card -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pengajuan Mahasiswa</h6>
                    <div>
                        <?php if (strtolower($bl->status) == 'di ajukan') : ?>
                            <span class="badge badge-warning text-dark px-3 py-2">Diajukan</span>
                        <?php elseif (strtolower($bl->status) == 'proses') : ?>
                            <span class="badge badge-info px-3 py-2">Diproses</span>
                        <?php elseif (strtolower($bl->status) == 'accept') : ?>
                            <span class="badge badge-success px-3 py-2">Diterima (Accept)</span>
                        <?php elseif (strtolower($bl->status) == 'reject') : ?>
                            <span class="badge badge-danger px-3 py-2">Ditolak (Reject)</span>
                        <?php else : ?>
                            <span class="badge badge-secondary px-3 py-2">Draft</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Personal Info Fields -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($bl->nama_lengkap) ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">NIM</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($bl->nim_mahasiswa) ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($bl->email ? $bl->email : '-') ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Program Studi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($bl->nama_prodi) ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Tempat, Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($bl->tempat_lahir . ', ' . $bl->tgl_lahir) ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="2" readonly><?= htmlspecialchars($bl->alamat) ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">No. HP / WhatsApp</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($bl->no_hp) ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Semester Pengajuan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($bl->semester) ?>" readonly>
                        </div>
                    </div>

                    <hr>

                    <!-- KTM Verification File -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold">KTM (Kartu Tanda Mahasiswa)</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($bl->ktm) ?>" readonly>
                                <div class="input-group-append">
                                    <a href="<?= base_url('assets/bebaslab/' . $bl->ktm) ?>" target="_blank" class="btn btn-outline-secondary">
                                        <i class="fas fa-external-link-alt"></i> Buka File
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Premium Embedded Preview if Image -->
                            <?php 
                            $ext = strtolower(pathinfo($bl->ktm, PATHINFO_EXTENSION));
                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) : 
                            ?>
                                <div class="mt-2 text-center p-2 border rounded bg-light" style="max-height: 250px; overflow: hidden;">
                                    <img src="<?= base_url('assets/bebaslab/' . $bl->ktm) ?>" alt="KTM Preview" style="max-width: 100%; max-height: 230px; object-fit: contain;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Verification Results Info -->
                    <?php if (strtolower($bl->status) == 'accept') : ?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Nomor Surat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control is-valid" value="<?= htmlspecialchars($bl->nomor) ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Diverifikasi Oleh</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($bl->lab1_admin) ?>" readonly>
                            </div>
                        </div>
                    <?php elseif (strtolower($bl->status) == 'reject') : ?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Alasan Ditolak</label>
                            <div class="col-sm-9">
                                <textarea class="form-control is-invalid" rows="2" readonly><?= htmlspecialchars($bl->keterangan) ?></textarea>
                            </div>
                        </div>
                    <?php endif; ?>

                    <hr>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="<?= base_url('bebaslab?prodi=' . $bl->slug) ?>" class="btn btn-secondary mr-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>

                            <!-- PROSES BUTTON (Only shown for 'di ajukan') -->
                            <?php if (strtolower($bl->status) == 'di ajukan') : ?>
                                <a href="<?= base_url('bebaslab/proses/' . $bl->id_bebaslab) ?>" class="btn btn-info mr-2">
                                    <i class="fas fa-sync-alt"></i> Proses Pengajuan
                                </a>
                            <?php endif; ?>

                            <!-- REJECT BUTTON (Only shown for 'di ajukan' or 'proses') -->
                            <?php if (in_array(strtolower($bl->status), ['di ajukan', 'proses'])) : ?>
                                <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#modalReject">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            <?php endif; ?>

                            <!-- ACCEPT BUTTON (Only shown for 'di ajukan' or 'proses') -->
                            <?php if (in_array(strtolower($bl->status), ['di ajukan', 'proses'])) : ?>
                                <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modalAccept">
                                    <i class="fas fa-check"></i> Accept & Validasi
                                </button>
                            <?php endif; ?>

                            <!-- CETAK BUTTON (Only shown for 'accept') -->
                            <?php if (strtolower($bl->status) == 'accept') : ?>
                                <a href="<?= base_url('bebaslab/cetak/' . $bl->id_bebaslab) ?>" class="btn btn-primary" target="_blank">
                                    <i class="fas fa-print"></i> Cetak Surat Bebas Lab
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Sidebar Info Guide -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-info-circle"></i> Panduan Verifikasi</h6>
                </div>
                <div class="card-body">
                    <p>Silakan ikuti instruksi berikut untuk memverifikasi pengajuan berkas Bebas Laboratorium:</p>
                    <ol class="pl-3">
                        <li class="mb-2">Periksa keaslian file KTM yang diunggah oleh mahasiswa dengan mengklik tombol <b>Buka File</b>.</li>
                        <li class="mb-2">Jika dokumen sudah valid dan lengkap, klik tombol <b>Accept & Validasi</b> kemudian masukkan Nomor Surat yang sesuai.</li>
                        <li class="mb-2">Jika ingin memproses dokumen terlebih dahulu sebelum validasi akhir, klik <b>Proses Pengajuan</b>.</li>
                        <li class="mb-2">Jika dokumen salah, buram, atau tidak sesuai syarat, klik <b>Reject</b> dan isi alasan penolakannya secara jelas.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Page Content -->


<!-- Modal Accept & Validasi -->
<div class="modal fade" id="modalAccept" tabindex="-1" role="dialog" aria-labelledby="modalAcceptLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-left-success shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-success" id="modalAcceptLabel">
                    <i class="fas fa-check-circle"></i> Validasi Pengajuan (Accept)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bebaslab/accept/' . $bl->id_bebaslab); ?>" method="post">
                <div class="modal-body">
                    <p>Anda akan menyetujui pengajuan Bebas Lab mahasiswa ini. Silakan masukkan <b>Nomor Surat</b> yang diterbitkan:</p>
                    <div class="form-group">
                        <label class="font-weight-bold">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor" name="nomor" value="<?= htmlspecialchars($nomor_otomatis); ?>" required placeholder="Masukkan nomor surat">
                        <small class="form-text text-muted">Nomor surat otomatis telah digenerate di atas. Anda bisa mengeditnya jika diperlukan.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Setujui (Accept)</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Reject / Tolak -->
<div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="modalRejectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-left-danger shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-danger" id="modalRejectLabel">
                    <i class="fas fa-times-circle"></i> Tolak Pengajuan (Reject)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bebaslab/reject/' . $bl->id_bebaslab); ?>" method="post">
                <div class="modal-body">
                    <p>Anda akan menolak pengajuan Bebas Lab mahasiswa ini. Silakan masukkan <b>Alasan Penolakan</b>:</p>
                    <div class="form-group">
                        <label class="font-weight-bold">Alasan Penolakan / Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required placeholder="Contoh: File KTM buram, silakan upload ulang berkas KTM yang jelas."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak (Reject)</button>
                </div>
            </form>
        </div>
    </div>
</div>
