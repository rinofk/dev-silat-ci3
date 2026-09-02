<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Pengajuan Surat Aktif Kuliah</h1>
    </div>

    <?php if ($this->session->flashdata('message')) : ?>
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show py-2 px-3 small shadow-sm" role="alert" style="border-radius: 8px;">
            <i class="fas fa-check-circle mr-1"></i> Data pengajuan surat <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
            <button type="button" class="close py-2" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- CARD INFORMASI ALUR PENGAJUAN -->
    <div class="card shadow-sm mb-4 border-left-primary" style="border-radius: 12px;">
        <div class="card-body p-3 p-md-4">
            <div class="d-flex align-items-center mb-3">
                <div class="mr-3 d-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-sm" style="width: 38px; height: 38px; min-width: 38px;">
                    <i class="fas fa-info-circle fa-lg"></i>
                </div>
                <div>
                    <h5 class="m-0 font-weight-bold text-primary" style="font-size: 1.05rem;">Alur Pengajuan Surat Aktif Kuliah</h5>
                    <small class="text-muted d-block" style="font-size: 0.8rem;">Panduan proses pengajuan hingga unduh dokumen selesai.</small>
                </div>
            </div>

            <!-- Steps Grid (Responsif 2 kolom di HP, 4 kolom di Laptop/PC) -->
            <div class="row text-dark">
                <div class="col-6 col-md-3 mb-2 mb-md-3 px-2">
                    <div class="p-2 p-md-3 bg-light rounded h-100 border" style="border-left: 3px solid #4e73df !important;">
                        <div class="d-flex flex-wrap align-items-center mb-1">
                            <span class="badge badge-primary badge-pill mr-1 mb-1" style="font-size: 0.7rem;">Langkah 1</span>
                            <strong class="text-gray-800 small d-block mb-1">Buat Pengajuan</strong>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.76rem; line-height: 1.3;">Klik tombol <strong>+ Tambah</strong> untuk mengisi formulir keperluan surat.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-2 mb-md-3 px-2">
                    <div class="p-2 p-md-3 bg-light rounded h-100 border" style="border-left: 3px solid #f6c23e !important;">
                        <div class="d-flex flex-wrap align-items-center mb-1">
                            <span class="badge badge-warning text-white badge-pill mr-1 mb-1" style="font-size: 0.7rem;">Langkah 2</span>
                            <strong class="text-gray-800 small d-block mb-1">Kirim Pengajuan</strong>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.76rem; line-height: 1.3;">Klik tombol <strong>Kirim</strong> agar draf dapat diverifikasi operator.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-2 mb-md-3 px-2">
                    <div class="p-2 p-md-3 bg-light rounded h-100 border" style="border-left: 3px solid #36b9cc !important;">
                        <div class="d-flex flex-wrap align-items-center mb-1">
                            <span class="badge badge-info badge-pill mr-1 mb-1" style="font-size: 0.7rem;">Langkah 3</span>
                            <strong class="text-gray-800 small d-block mb-1">Verifikasi</strong>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.76rem; line-height: 1.3;">Operator memvalidasi & memproses pembuatan surat aktif.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-2 mb-md-3 px-2">
                    <div class="p-2 p-md-3 bg-light rounded h-100 border" style="border-left: 3px solid #1cc88a !important;">
                        <div class="d-flex flex-wrap align-items-center mb-1">
                            <span class="badge badge-success badge-pill mr-1 mb-1" style="font-size: 0.7rem;">Langkah 4</span>
                            <strong class="text-gray-800 small d-block mb-1">Unduh Dokumen</strong>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.76rem; line-height: 1.3;">Surat yang <strong>selesai</strong> dapat langsung di-download di halaman ini.</p>
                    </div>
                </div>
            </div>

            <!-- Notice Box -->
            <div class="alert alert-info mb-0 mt-2 py-2 px-3 small d-flex align-items-start border-0 shadow-sm" style="border-radius: 8px; background-color: #e8f4fd; color: #1e6091; font-size: 0.82rem;">
                <i class="fas fa-cloud-download-alt mr-2 mt-1 text-info fa-lg"></i>
                <div>
                    <strong>Catatan:</strong> Surat yang selesai diproses akan langsung dapat diunduh pada riwayat di bawah. Mahasiswa yang <strong>telah terdaftar sebagai alumni tidak dapat lagi mengajukan surat aktif kuliah</strong>.
                </div>
            </div>
        </div>
    </div>

    <?php
    $allow_tambah = false;
    if (empty($status['id_alumni'])) {
        $allow_tambah = true;
    } else {
        $tgl_daftar = strtotime($status['tanggal_daftar']);
        if ($tgl_daftar) {
            $diff = time() - $tgl_daftar;
            $days = $diff / (60 * 60 * 24);
            if ($days <= 60) {
                $allow_tambah = true;
            }
        }
    }
    if ($allow_tambah) : ?>
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <a href="<?= base_url(); ?>surat/tambah" type="button" class="btn btn-primary btn-icon-split shadow-sm d-inline-flex" style="border-radius: 8px;">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-square"></i>
                    </span>
                    <span class="text font-weight-bold">Tambah Pengajuan</span>
                </a>
            </div>
        </div>
    <?php endif; ?>


    <!-- RIWAYAT PENGAJUAN -->
    <div class="card shadow-sm mb-4 border-0" style="border-radius: 12px;">
        <div class="card-header py-3 bg-white border-bottom d-flex align-items-center justify-content-between" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list-alt mr-2"></i>Daftar Riwayat Pengajuan</h6>
            <span class="badge badge-primary badge-pill px-2 py-1 small"><?= count($surat); ?> Pengajuan</span>
        </div>
        <div class="card-body p-3">

            <!-- 1. TAMPILAN MOBILE (Khusus HP / Layar Kecil) -->
            <div class="d-block d-md-none">
                <?php if (empty($surat)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-folder-open fa-3x mb-2 text-gray-300"></i>
                        <p class="mb-0 small font-weight-bold">Belum ada riwayat pengajuan surat.</p>
                    </div>
                <?php else: ?>
                    <?php $i = 1; foreach ($surat as $s): 
                        $card_border = 'border-left-secondary';
                        if ($s['status'] == 'selesai') {
                            $card_border = 'border-left-success';
                        } elseif ($s['status'] == 'diajukan') {
                            $card_border = 'border-left-warning';
                        } elseif (empty($s['status'])) {
                            $card_border = 'border-left-primary';
                        }
                    ?>
                        <div class="card shadow-sm mb-3 <?= $card_border; ?>" style="border-radius: 10px; border-width: 1px;">
                            <div class="card-body p-3">
                                <!-- Baris Atas: ID & Status -->
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                    <span class="badge badge-light border text-gray-800 px-2 py-1 font-weight-bold small">
                                        #<?= $i; ?> &bull; [-<?= $s['id_suratpengajuan']; ?>-]
                                    </span>
                                    <div>
                                        <?php
                                        if (empty($s['status'])) {
                                            echo '<span class="badge badge-secondary px-2 py-1 small"><i class="fas fa-pencil-alt mr-1"></i> Draf</span>';
                                        } elseif ($s['status'] == 'diajukan') {
                                            echo '<span class="badge badge-warning px-2 py-1 small"><i class="fas fa-clock mr-1"></i> Diajukan</span>';
                                        } elseif ($s['status'] == 'selesai') {
                                            echo '<span class="badge badge-success px-2 py-1 small"><i class="fas fa-check-circle mr-1"></i> Selesai</span>';
                                        } else {
                                            echo '<span class="badge badge-info px-2 py-1 small">' . htmlspecialchars($s['status']) . '</span>';
                                        }
                                        ?>
                                    </div>
                                </div>

                                <!-- Detail Keperluan -->
                                <div class="mb-2">
                                    <div class="text-muted small" style="font-size: 0.75rem;">KEPERLUAN:</div>
                                    <div class="text-gray-900 font-weight-bold" style="font-size: 0.92rem;">
                                        <?= htmlspecialchars($s['nama_keperluan']); ?>
                                    </div>
                                    <?php if (!empty($s['keterangan'])): ?>
                                        <div class="small text-muted mt-1 bg-light p-2 rounded" style="font-size: 0.82rem;">
                                            <?= htmlspecialchars($s['keterangan']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Info Tanggal & TA -->
                                <div class="d-flex justify-content-between text-muted small mb-2" style="font-size: 0.78rem;">
                                    <span><i class="far fa-calendar-alt text-gray-400 mr-1"></i> <?= date('d M Y', $s['date_create']); ?></span>
                                    <span><i class="fas fa-graduation-cap text-gray-400 mr-1"></i> TA: <?= htmlspecialchars($s['tahun_ajaran']); ?></span>
                                </div>

                                <?php if (!empty($s['status_keterangan'])): ?>
                                    <div class="small text-info mb-2 bg-light p-2 rounded" style="font-size: 0.8rem;">
                                        <i class="fas fa-info-circle mr-1"></i> <?= htmlspecialchars($s['status_keterangan']); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Tombol Aksi Mobile -->
                                <div class="pt-2 border-top">
                                    <?php if ($s['status_aktif'] == 1): ?>
                                        <?php if (empty($s['status'])): ?>
                                            <div class="d-flex justify-content-between">
                                                <a href="<?= base_url('surat/edit/' . $s['id_suratpengajuan']); ?>" class="btn btn-sm btn-outline-warning font-weight-bold flex-fill mr-1" style="border-radius: 6px; font-size: 0.82rem;">
                                                    <i class="far fa-edit mr-1"></i> Ubah
                                                </a>
                                                <a href="<?= base_url('surat/hapus/' . $s['id_suratpengajuan']); ?>" class="btn btn-sm btn-outline-danger font-weight-bold flex-fill mr-1" onclick="return confirm('Yakin ingin menghapus pengajuan ini?');" style="border-radius: 6px; font-size: 0.82rem;">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                                <a href="<?= base_url('surat/kirim/' . $s['id_suratpengajuan']); ?>" class="btn btn-sm btn-primary font-weight-bold flex-fill" style="border-radius: 6px; font-size: 0.82rem;">
                                                    <i class="fas fa-paper-plane mr-1"></i> Kirim
                                                </a>
                                            </div>
                                        <?php elseif ($s['status'] == 'diajukan'): ?>
                                            <div class="text-center py-1 text-warning small font-italic bg-light rounded" style="font-size: 0.8rem;">
                                                <i class="fas fa-hourglass-half mr-1"></i> Menunggu verifikasi operator
                                            </div>
                                        <?php elseif ($s['status'] == 'selesai'): ?>
                                            <?php if (!empty($s['file_selesai'])): ?>
                                                <a href="<?= base_url('assets/surat_selesai/' . $s['file_selesai']); ?>" target="_blank" class="btn btn-success btn-block btn-sm font-weight-bold shadow-sm py-2" style="border-radius: 8px; font-size: 0.88rem;">
                                                    <i class="fas fa-download mr-1"></i> Unduh Surat Selesai
                                                </a>
                                            <?php else: ?>
                                                <div class="text-center text-success small font-weight-bold">
                                                    <i class="fas fa-check-circle mr-1"></i> Surat telah selesai diproses
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="text-center text-muted small">Status Tidak Aktif</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php $i++; endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- 2. TAMPILAN DESKTOP & TABLET (Tabel DataTable) -->
            <div class="d-none d-md-block">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0" id="datatable" style="font-size: 0.88rem;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="5%" class="align-middle text-center">#</th>
                                <th scope="col" class="align-middle" style="white-space: nowrap;">ID Surat</th>
                                <th scope="col" class="align-middle">Keperluan & Keterangan</th>
                                <th scope="col" class="align-middle" style="white-space: nowrap;">Tgl Pengajuan</th>
                                <th scope="col" class="align-middle" style="white-space: nowrap;">Tahun Ajaran</th>
                                <th scope="col" class="align-middle text-center" style="white-space: nowrap;">Status</th>
                                <th scope="col" class="align-middle text-center" style="white-space: nowrap;">Aksi / Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($surat as $s) { ?>
                                <tr>
                                    <th scope="row" class="align-middle text-center font-weight-normal"><?= $i; ?></th>
                                    <td class="align-middle font-weight-bold text-primary" style="white-space: nowrap;">[-<?= $s['id_suratpengajuan']; ?>-]</td>
                                    <td class="align-middle">
                                        <div class="font-weight-bold text-gray-900"><?= htmlspecialchars($s['nama_keperluan']); ?></div>
                                        <?php if (!empty($s['keterangan'])): ?>
                                            <div class="small text-muted"><?= htmlspecialchars($s['keterangan']); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle" style="white-space: nowrap;"><?= date('d F Y', $s['date_create']); ?></td>
                                    <td class="align-middle" style="white-space: nowrap;"><?= htmlspecialchars($s['tahun_ajaran']); ?></td>
                                    <td class="align-middle text-center" style="white-space: nowrap;">
                                        <?php
                                        if (empty($s['status'])) {
                                            echo '<span class="badge badge-secondary px-2 py-1"><i class="fas fa-pencil-alt mr-1"></i> Draf</span>';
                                        } elseif ($s['status'] == 'diajukan') {
                                            echo '<span class="badge badge-warning px-2 py-1"><i class="fas fa-clock mr-1"></i> Diajukan</span>';
                                        } elseif ($s['status'] == 'selesai') {
                                            echo '<span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Selesai</span>';
                                        } else {
                                            echo '<span class="badge badge-info px-2 py-1">' . htmlspecialchars($s['status']) . '</span>';
                                        }
                                        if (!empty($s['status_keterangan'])) {
                                            echo '<div class="small text-muted mt-1">' . htmlspecialchars($s['status_keterangan']) . '</div>';
                                        }
                                        ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php if ($s['status_aktif'] == 1): ?>
                                            <?php if (empty($s['status'])): ?>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="<?= base_url('surat/edit/' . $s['id_suratpengajuan']); ?>" class="btn btn-warning btn-sm" title="Ubah">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url('surat/hapus/' . $s['id_suratpengajuan']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="<?= base_url('surat/kirim/' . $s['id_suratpengajuan']); ?>" class="btn btn-primary btn-sm" title="Kirim">
                                                        <i class="fas fa-paper-plane mr-1"></i> Kirim
                                                    </a>
                                                </div>
                                            <?php elseif ($s['status'] == 'diajukan'): ?>
                                                <span class="text-muted small font-italic"><i class="fas fa-hourglass-half mr-1 text-warning"></i> Menunggu verifikasi operator</span>
                                            <?php else: ?>
                                                <?php if (!empty($s['date_finish']) && $s['date_finish'] > 0): ?>
                                                    <div class="small font-weight-bold text-gray-800"><?= date('d F Y', $s['date_finish']); ?></div>
                                                    <?php if (!empty($s['admin'])): ?>
                                                        <div class="small text-muted"><i class="fas fa-user-shield mr-1"></i><?= $s['admin']; ?></div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                
                                                <?php if ($s['status'] == 'selesai' && !empty($s['file_selesai'])): ?>
                                                    <a href="<?= base_url('assets/surat_selesai/' . $s['file_selesai']); ?>" target="_blank" class="btn btn-sm btn-success mt-1 shadow-sm font-weight-bold px-3" style="border-radius: 6px;">
                                                        <i class="fas fa-download mr-1"></i> Unduh Surat
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Tidak Aktif</span>
                                        <?php endif; ?> 
                                    </td>
                                </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
     
    <!-- BANTUAN OPERATOR -->
    <div class="card shadow-sm border-left-success mb-4" style="max-width: 520px; border-radius: 12px;">
        <div class="card-body py-3">
            <div class="d-flex align-items-center">
                <div class="mr-3 text-success" style="font-size: 2.2rem;">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold text-gray-800 mb-1">Butuh Bantuan Operator?</h6>
                    <p class="small text-muted mb-2">Jika ada pertanyaan atau kendala pengajuan Surat Aktif Kuliah, silakan hubungi:</p>
                    <a href="https://wa.me/6289530657256?text=Hai%20Admin%20Aplikasi%20Aktif%20Kuliah," class="btn btn-sm btn-success font-weight-bold shadow-sm" target="_blank" rel="nofollow" style="border-radius: 20px;">
                        <i class="fab fa-whatsapp mr-1"></i> Hubungi Indra (WhatsApp)
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>