<!-- Begin Page Content -->
<div class="container-fluid px-3">

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('flash')) : ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Swal !== 'undefined') {
                    var flash = "<?= $this->session->flashdata('flash'); ?>";
                    var title = 'Berhasil!';
                    var text = 'Berkas perpustakaan berhasil ' + flash + '.';
                    var icon = 'success';
                    
                    if (flash === 'dihapus') {
                        title = 'Berhasil Dihapus!';
                        text = 'Berkas pengajuan telah berhasil dihapus dari sistem.';
                    } else if (flash === 'ditolak') {
                        title = 'Pengajuan Ditolak';
                        text = 'Berkas pengajuan berhasil ditolak.';
                        icon = 'info';
                    } else if (flash === 'diterima') {
                        title = 'Pengajuan Disetujui!';
                        text = 'Berkas pengajuan telah berhasil disetujui & divalidasi.';
                    }

                    Swal.fire({
                        icon: icon,
                        title: title,
                        text: text,
                        timer: 2500,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                }
            });
        </script>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm py-2 px-3 col-md-6 mb-3 small" role="alert" style="border-radius: 6px;">
            <i class="fas fa-check-circle mr-1"></i> Berkas perpus <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
            <button type="button" class="close py-2" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Page Header & Back Button -->
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <a href="<?= base_url('pustakawan'); ?>" class="btn btn-sm btn-outline-secondary shadow-sm mr-3 font-weight-bold" style="border-radius: 6px;">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <h1 class="h5 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-file-alt mr-1 text-primary"></i> Detail Bebas Perpustakaan
            </h1>
            <span class="badge badge-light border text-muted ml-2 font-weight-normal px-2 py-1" style="font-size: 11px;">
                #<?= $perpus['id_bp']; ?>
            </span>
        </div>
        <div>
            <?php 
                $status = strtolower($perpus['status']);
                if ($status == 'accept') {
                    echo '<span class="badge badge-success px-3 py-2 shadow-sm font-weight-bold" style="font-size: 12px; border-radius: 6px;"><i class="fas fa-check-circle mr-1"></i> Selesai (Accept)</span>';
                } elseif ($status == 'reject') {
                    echo '<span class="badge badge-danger px-3 py-2 shadow-sm font-weight-bold" style="font-size: 12px; border-radius: 6px;"><i class="fas fa-times-circle mr-1"></i> Ditolak (Reject)</span>';
                } else {
                    echo '<span class="badge badge-warning text-white px-3 py-2 shadow-sm font-weight-bold" style="font-size: 12px; border-radius: 6px;"><i class="fas fa-clock mr-1"></i> Menunggu Validasi</span>';
                }
            ?>
        </div>
    </div>

    <div class="row">
        <!-- Main Info & Files (Left Column) -->
        <div class="col-lg-8">
            
            <!-- Student Information Card -->
            <div class="card shadow-sm mb-3 border-0" style="border-radius: 10px;">
                <div class="card-header py-2 px-3 bg-white border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary small">
                        <i class="fas fa-user-graduate mr-1"></i> Informasi Mahasiswa
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0" style="font-size: 0.85rem;">
                            <tbody>
                                <tr>
                                    <td class="text-muted font-weight-bold" style="width: 25%;">Nama Lengkap</td>
                                    <td style="width: 2%;">:</td>
                                    <td class="font-weight-bold text-gray-900"><?= htmlspecialchars($perpus['nama_lengkap']); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted font-weight-bold">NIM</td>
                                    <td>:</td>
                                    <td class="font-weight-bold text-primary"><?= htmlspecialchars($perpus['nim_mahasiswa']); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted font-weight-bold">Program Studi</td>
                                    <td>:</td>
                                    <td><?= htmlspecialchars($perpus['nama_prodi'] ?: '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted font-weight-bold">Email</td>
                                    <td>:</td>
                                    <td><?= htmlspecialchars($perpus['email'] ?: '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted font-weight-bold">Tempat, Tgl Lahir</td>
                                    <td>:</td>
                                    <td>
                                        <?= htmlspecialchars($perpus['tempat_lahir']); ?>, 
                                        <?= (!empty($perpus['tgl_lahir']) && $perpus['tgl_lahir'] != '0000-00-00') ? tgl_indo($perpus['tgl_lahir']) : '-'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted font-weight-bold">Alamat</td>
                                    <td>:</td>
                                    <td><?= htmlspecialchars($perpus['alamat'] ?: '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted font-weight-bold">No. HP / WhatsApp</td>
                                    <td>:</td>
                                    <td>
                                        <?php if (!empty($perpus['no_hp'])): ?>
                                            <a href="https://wa.me/<?= preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $perpus['no_hp'])); ?>" target="_blank" class="text-success font-weight-bold">
                                                <i class="fab fa-whatsapp mr-1"></i><?= htmlspecialchars($perpus['no_hp']); ?>
                                            </a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted font-weight-bold">Semester Pengajuan</td>
                                    <td>:</td>
                                    <td><span class="badge badge-light border font-weight-bold text-dark px-2 py-1">Semester <?= htmlspecialchars($perpus['semester'] ?: '-'); ?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Documents Card (KTM & Kartu Perpustakaan) -->
            <div class="card shadow-sm mb-3 border-0" style="border-radius: 10px;">
                <div class="card-header py-2 px-3 bg-white border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary small">
                        <i class="fas fa-file-invoice mr-1"></i> Berkas Persyaratan
                    </h6>
                    <span class="text-muted small" style="font-size: 11px;">Pratinjau Dokumen</span>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <!-- KTM Card -->
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="p-3 border rounded bg-light h-100 d-flex flex-column justify-content-between" style="border-radius: 8px !important;">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold small text-gray-800">
                                            <i class="fas fa-id-card text-primary mr-1"></i> KTM (Kartu Mahasiswa)
                                        </span>
                                        <?php 
                                            $ext_ktm = strtolower(pathinfo($perpus['ktm'], PATHINFO_EXTENSION));
                                            $is_pdf_ktm = ($ext_ktm === 'pdf');
                                            $has_ktm = (!empty($perpus['ktm']) && $perpus['ktm'] !== 'default.jpg');
                                        ?>
                                        <?php if ($is_pdf_ktm): ?>
                                            <span class="badge badge-danger font-weight-bold px-2 py-1" style="font-size: 10px;"><i class="fas fa-file-pdf mr-1"></i>PDF</span>
                                        <?php elseif ($has_ktm): ?>
                                            <span class="badge badge-info font-weight-bold px-2 py-1" style="font-size: 10px;"><i class="fas fa-image mr-1"></i>Gambar</span>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($has_ktm && !$is_pdf_ktm): ?>
                                        <div class="text-center p-1 mb-2 bg-white border rounded position-relative" style="height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                            <img src="<?= base_url('assets/bebasperpus/' . $perpus['ktm']); ?>" alt="KTM Preview" style="max-width: 100%; max-height: 190px; object-fit: contain; cursor: pointer;" data-toggle="modal" data-target="#modalPreviewKtm" title="Klik untuk memperbesar">
                                        </div>
                                    <?php elseif ($is_pdf_ktm): ?>
                                        <div class="mb-2 bg-white border rounded position-relative" style="height: 200px; overflow: hidden;">
                                            <iframe src="<?= base_url('assets/bebasperpus/' . $perpus['ktm']); ?>#toolbar=0&navpanes=0" style="width: 100%; height: 100%; border: none;" loading="lazy"></iframe>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center py-4 mb-2 bg-white border rounded text-muted small d-flex flex-column align-items-center justify-content-center" style="height: 200px;">
                                            <i class="fas fa-exclamation-circle fa-2x text-warning mb-2"></i>
                                            <span>Berkas default / belum diunggah</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mt-2">
                                    <div class="btn-group btn-block" role="group">
                                        <?php if ($has_ktm || $is_pdf_ktm): ?>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalPreviewKtm" style="border-radius: 6px 0 0 6px;">
                                                <i class="fas fa-search-plus mr-1"></i> Preview
                                            </button>
                                            <a href="<?= base_url('assets/bebasperpus/' . $perpus['ktm']); ?>" target="_blank" class="btn btn-sm btn-primary" style="border-radius: 0 6px 6px 0;">
                                                <i class="fas fa-external-link-alt mr-1"></i> Buka File
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('assets/bebasperpus/' . $perpus['ktm']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary btn-block" style="border-radius: 6px;">
                                                <i class="fas fa-external-link-alt mr-1"></i> Buka File Default
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kartu Perpustakaan Card -->
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light h-100 d-flex flex-column justify-content-between" style="border-radius: 8px !important;">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold small text-gray-800">
                                            <i class="fas fa-address-card text-success mr-1"></i> Kartu Perpustakaan
                                        </span>
                                        <?php 
                                            $ext_kartu = strtolower(pathinfo($perpus['kartuperpus'], PATHINFO_EXTENSION));
                                            $is_pdf_kartu = ($ext_kartu === 'pdf');
                                            $has_kartu = (!empty($perpus['kartuperpus']) && $perpus['kartuperpus'] !== 'default.jpg');
                                        ?>
                                        <?php if ($is_pdf_kartu): ?>
                                            <span class="badge badge-danger font-weight-bold px-2 py-1" style="font-size: 10px;"><i class="fas fa-file-pdf mr-1"></i>PDF</span>
                                        <?php elseif ($has_kartu): ?>
                                            <span class="badge badge-info font-weight-bold px-2 py-1" style="font-size: 10px;"><i class="fas fa-image mr-1"></i>Gambar</span>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($has_kartu && !$is_pdf_kartu): ?>
                                        <div class="text-center p-1 mb-2 bg-white border rounded position-relative" style="height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                            <img src="<?= base_url('assets/bebasperpus/' . $perpus['kartuperpus']); ?>" alt="Kartu Perpus Preview" style="max-width: 100%; max-height: 190px; object-fit: contain; cursor: pointer;" data-toggle="modal" data-target="#modalPreviewKartu" title="Klik untuk memperbesar">
                                        </div>
                                    <?php elseif ($is_pdf_kartu): ?>
                                        <div class="mb-2 bg-white border rounded position-relative" style="height: 200px; overflow: hidden;">
                                            <iframe src="<?= base_url('assets/bebasperpus/' . $perpus['kartuperpus']); ?>#toolbar=0&navpanes=0" style="width: 100%; height: 100%; border: none;" loading="lazy"></iframe>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center py-4 mb-2 bg-white border rounded text-muted small d-flex flex-column align-items-center justify-content-center" style="height: 200px;">
                                            <i class="fas fa-info-circle fa-2x text-muted mb-2"></i>
                                            <span>Berkas lewati / tidak ada kartu</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mt-2">
                                    <div class="btn-group btn-block" role="group">
                                        <?php if ($has_kartu || $is_pdf_kartu): ?>
                                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalPreviewKartu" style="border-radius: 6px 0 0 6px;">
                                                <i class="fas fa-search-plus mr-1"></i> Preview
                                            </button>
                                            <a href="<?= base_url('assets/bebasperpus/' . $perpus['kartuperpus']); ?>" target="_blank" class="btn btn-sm btn-success" style="border-radius: 0 6px 6px 0;">
                                                <i class="fas fa-external-link-alt mr-1"></i> Buka File
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('assets/bebasperpus/' . $perpus['kartuperpus']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary btn-block" style="border-radius: 6px;">
                                                <i class="fas fa-external-link-alt mr-1"></i> Buka File Default
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons Footer Card -->
            <div class="card shadow-sm mb-4 border-0" style="border-radius: 10px;">
                <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
                    <a href="<?= base_url('pustakawan'); ?>" class="btn btn-sm btn-secondary px-3 font-weight-bold" style="border-radius: 6px;">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                    </a>
                    
                    <div class="mt-2 mt-sm-0">
                        <?php if ($status == 'accept'): ?>
                            <button type="button" class="btn btn-sm btn-warning text-dark font-weight-bold shadow-sm mr-2" style="border-radius: 6px;" data-toggle="modal" data-target="#modalUbahStatus">
                                <i class="fas fa-exchange-alt mr-1"></i> Ubah Status
                            </button>
                            <button type="button" class="btn btn-sm btn-info px-3 font-weight-bold shadow-sm mr-2" style="border-radius: 6px;" data-toggle="modal" data-target="#modalTanggal">
                                <i class="fas fa-calendar-alt mr-1"></i> Update Tanggal
                            </button>
                            <a href="<?= base_url('pustakawan/cetak/' . $perpus['id_bp']); ?>" class="btn btn-sm btn-primary px-4 font-weight-bold shadow-sm" style="border-radius: 6px;" target="_blank">
                                <i class="fas fa-print mr-1"></i> Cetak Surat Bebas Perpus
                            </a>
                        <?php elseif ($status == 'reject'): ?>
                            <button type="button" class="btn btn-sm btn-warning text-dark font-weight-bold shadow-sm mr-2" style="border-radius: 6px;" data-toggle="modal" data-target="#modalUbahStatus">
                                <i class="fas fa-exchange-alt mr-1"></i> Ubah Status
                            </button>
                            <button type="button" class="btn btn-sm btn-success px-4 font-weight-bold shadow-sm" style="border-radius: 6px;" data-toggle="modal" data-target="#modalAccept">
                                <i class="fas fa-check mr-1"></i> Setujui (Accept)
                            </button>
                        <?php else: // di ajukan ?>
                            <button type="button" class="btn btn-sm btn-danger px-3 font-weight-bold shadow-sm mr-2" style="border-radius: 6px;" data-toggle="modal" data-target="#modalReject">
                                <i class="fas fa-times mr-1"></i> Tolak (Reject)
                            </button>
                            <button type="button" class="btn btn-sm btn-success px-4 font-weight-bold shadow-sm" style="border-radius: 6px;" data-toggle="modal" data-target="#modalAccept">
                                <i class="fas fa-check mr-1"></i> Setujui (Accept)
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar Summary & Guide (Right Column) -->
        <div class="col-lg-4">
            
            <!-- Status Detail Card -->
            <div class="card shadow-sm mb-3 border-0" style="border-radius: 10px;">
                <div class="card-header py-2 px-3 bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-primary small">
                        <i class="fas fa-info-circle mr-1"></i> Status Pengajuan
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="text-center pb-3 mb-3 border-bottom">
                        <?php if ($status == 'accept'): ?>
                            <div class="icon-box d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle mb-2" style="width: 54px; height: 54px;">
                                <i class="fas fa-check fa-2x"></i>
                            </div>
                            <h6 class="font-weight-bold text-success mb-1">Pengajuan Disetujui</h6>
                            <span class="small text-muted">Surat Bebas Perpustakaan telah diverifikasi dan diterbitkan.</span>
                        <?php elseif ($status == 'reject'): ?>
                            <div class="icon-box d-inline-flex align-items-center justify-content-center bg-danger text-white rounded-circle mb-2" style="width: 54px; height: 54px;">
                                <i class="fas fa-times fa-2x"></i>
                            </div>
                            <h6 class="font-weight-bold text-danger mb-1">Pengajuan Ditolak</h6>
                            <span class="small text-danger font-italic"><?= htmlspecialchars($perpus['keterangan'] ?: '-'); ?></span>
                        <?php else: ?>
                            <div class="icon-box d-inline-flex align-items-center justify-content-center bg-warning text-white rounded-circle mb-2" style="width: 54px; height: 54px;">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                            <h6 class="font-weight-bold text-warning mb-1">Menunggu Validasi</h6>
                            <span class="small text-muted">Menunggu pemeriksaan dan verifikasi dari petugas pustakawan.</span>
                        <?php endif; ?>
                    </div>

                    <div class="small">
                        <div class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Nomor Surat:</span>
                            <span class="font-weight-bold text-gray-900"><?= htmlspecialchars($perpus['nomor'] ?: '-'); ?></span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Tgl Pengajuan:</span>
                            <span class="font-weight-bold text-gray-900"><?= (!empty($perpus['date_created']) && $perpus['date_created'] != '0000-00-00 00:00:00') ? date('d-m-Y H:i', strtotime($perpus['date_created'])) : '-'; ?></span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Tgl Update:</span>
                            <span class="font-weight-bold text-gray-900"><?= (!empty($perpus['date_updated']) && $perpus['date_updated'] != '0000-00-00 00:00:00') ? date('d-m-Y H:i', strtotime($perpus['date_updated'])) : '-'; ?></span>
                        </div>
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Petugas Verifikator:</span>
                            <span class="font-weight-bold text-primary"><?= htmlspecialchars($perpus['admin'] ?: '-'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verification Guide Card -->
            <div class="card shadow-sm mb-4 border-0" style="border-radius: 10px; background: #f8fafc;">
                <div class="card-header py-2 px-3 bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-info small">
                        <i class="fas fa-clipboard-check mr-1"></i> Panduan Verifikasi
                    </h6>
                </div>
                <div class="card-body p-3 small text-muted" style="line-height: 1.5;">
                    <ol class="pl-3 mb-0">
                        <li class="mb-2">Periksa kejelasan berkas <b>KTM</b> dan <b>Kartu Anggota</b> yang diunggah mahasiswa.</li>
                        <li class="mb-2">Pastikan mahasiswa <b>tidak memiliki tanggungan peminjaman buku</b> atau denda perpustakaan.</li>
                        <li class="mb-2">Jika berkas lengkap dan sesuai, klik <b>Setujui (Accept)</b> dan masukkan <b>Nomor Surat</b>.</li>
                        <li class="mb-2">Jika berkas salah atau belum memenuhi syarat, klik <b>Tolak (Reject)</b> serta tulis alasan penolakannya.</li>
                        <li>Setelah berstatus <b>Selesai (Accept)</b>, mahasiswa dapat langsung <b>mengunduh surat secara mandiri</b> di akun SILAT masing-masing.</li>
                    </ol>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Modal Accept -->
<div class="modal fade" id="modalAccept" tabindex="-1" role="dialog" aria-labelledby="modalAcceptLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-success text-white py-3">
                <h6 class="modal-title font-weight-bold" id="modalAcceptLabel">
                    <i class="fas fa-check-circle mr-1"></i> Setujui Pengajuan Bebas Perpustakaan
                </h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pustakawan/accept/' . $perpus['id_bp']); ?>" method="post">
                <div class="modal-body p-4">
                    <p class="small text-muted mb-3">
                        Anda akan menyetujui pengajuan Bebas Perpustakaan untuk <strong><?= htmlspecialchars($perpus['nama_lengkap']); ?> (<?= htmlspecialchars($perpus['nim_mahasiswa']); ?>)</strong>.
                    </p>
                    <div class="form-group">
                        <label for="nomor" class="small font-weight-bold text-gray-800">Nomor Surat Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-weight-bold text-primary" id="nomor" name="nomor" value="<?= htmlspecialchars(isset($nomor_otomatis) ? $nomor_otomatis : ''); ?>" required placeholder="Contoh: 1234<?= htmlspecialchars(isset($base_nomor) ? $base_nomor : ''); ?>" style="border-radius: 6px;">
                        <small class="form-text text-muted mt-1">
                            Template dari <strong>tb_nomorsurat</strong>: <span class="badge badge-light border text-dark font-weight-bold"><code><?= htmlspecialchars(isset($base_nomor) ? $base_nomor : ''); ?></code></span>.<br>
                            Silakan ketik nomor urut di awal (contoh: <code>1234<?= htmlspecialchars(isset($base_nomor) ? $base_nomor : ''); ?></code>).
                        </small>
                    </div>
                    <div class="form-group mb-0">
                        <label for="link" class="small font-weight-bold text-gray-800">Link Dokumen (Opsional)</label>
                        <input type="text" class="form-control" id="link" name="link" value="<?= htmlspecialchars($perpus['link'] ?: ''); ?>" placeholder="https://..." style="border-radius: 6px;">
                    </div>
                </div>
                <div class="modal-footer py-2 px-3 bg-light">
                    <button type="button" class="btn btn-sm btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                    <button type="submit" class="btn btn-sm btn-success font-weight-bold px-3 shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-check mr-1"></i> Setujui (Accept)
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.jQuery) {
            $('#modalAccept').on('shown.bs.modal', function () {
                var input = document.getElementById('nomor');
                if (input) {
                    input.focus();
                    if (input.value.startsWith('/')) {
                        input.setSelectionRange(0, 0);
                    }
                }
            });
        }
    });
</script>

<!-- Modal Reject -->
<div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="modalRejectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-danger text-white py-3">
                <h6 class="modal-title font-weight-bold" id="modalRejectLabel">
                    <i class="fas fa-times-circle mr-1"></i> Tolak Pengajuan Bebas Perpustakaan
                </h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pustakawan/reject/' . $perpus['id_bp']); ?>" method="post">
                <div class="modal-body p-4">
                    <p class="small text-muted mb-3">
                        Silakan tuliskan alasan penolakan berkas mahasiswa <strong><?= htmlspecialchars($perpus['nama_lengkap']); ?></strong> agar dapat diperbaiki:
                    </p>
                    <div class="form-group mb-0">
                        <label for="keterangan" class="small font-weight-bold text-gray-800">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required placeholder="Contoh: Berkas KTM tidak terbaca jelas / masih ada tanggungan buku..." style="border-radius: 6px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer py-2 px-3 bg-light">
                    <button type="button" class="btn btn-sm btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                    <button type="submit" class="btn btn-sm btn-danger font-weight-bold px-3 shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-times mr-1"></i> Tolak Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah Status -->
<div class="modal fade" id="modalUbahStatus" tabindex="-1" role="dialog" aria-labelledby="modalUbahStatusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-warning text-dark py-3">
                <h6 class="modal-title font-weight-bold" id="modalUbahStatusLabel">
                    <i class="fas fa-exchange-alt mr-1"></i> Ubah Status Pengajuan
                </h6>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pustakawan/ubah_status/' . $perpus['id_bp']); ?>" method="post">
                <div class="modal-body p-4">
                    <p class="small text-muted mb-3">
                        Ubah status pengajuan Bebas Perpustakaan untuk <strong><?= htmlspecialchars($perpus['nama_lengkap']); ?> (<?= htmlspecialchars($perpus['nim_mahasiswa']); ?>)</strong>:
                    </p>
                    
                    <div class="form-group">
                        <label for="select_status" class="small font-weight-bold text-gray-800">Pilih Status Baru <span class="text-danger">*</span></label>
                        <select name="status" id="select_status" class="form-control font-weight-bold custom-select" required style="border-radius: 6px;">
                            <option value="di ajukan" <?= ($status == 'di ajukan' || empty($status)) ? 'selected' : ''; ?>>Di Ajukan (Menunggu Validasi)</option>
                            <option value="accept" <?= ($status == 'accept') ? 'selected' : ''; ?>>Selesai (Accept / Disetujui)</option>
                            <option value="reject" <?= ($status == 'reject') ? 'selected' : ''; ?>>Ditolak (Reject)</option>
                        </select>
                    </div>

                    <!-- Field Nomor Surat (Muncul jika status Accept) -->
                    <div class="form-group" id="group_nomor" style="<?= ($status == 'accept') ? '' : 'display: none;'; ?>">
                        <label for="nomor_ubah" class="small font-weight-bold text-gray-800">Nomor Surat Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-weight-bold text-primary" id="nomor_ubah" name="nomor" value="<?= htmlspecialchars(isset($nomor_otomatis) ? $nomor_otomatis : ''); ?>" placeholder="Contoh: 1234<?= htmlspecialchars(isset($base_nomor) ? $base_nomor : ''); ?>" style="border-radius: 6px;">
                        <small class="form-text text-muted">Format otomatis dari <strong>tb_nomorsurat</strong>: <code><?= htmlspecialchars(isset($base_nomor) ? $base_nomor : ''); ?></code></small>
                    </div>

                    <!-- Field Keterangan / Alasan -->
                    <div class="form-group mb-0" id="group_keterangan">
                        <label for="keterangan_ubah" class="small font-weight-bold text-gray-800" id="label_keterangan">Keterangan / Catatan</label>
                        <textarea class="form-control" id="keterangan_ubah" name="keterangan" rows="3" placeholder="Masukkan keterangan..." style="border-radius: 6px;"><?= htmlspecialchars($perpus['keterangan'] ?: ''); ?></textarea>
                    </div>
                </div>
                <div class="modal-footer py-2 px-3 bg-light">
                    <button type="button" class="btn btn-sm btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                    <button type="submit" class="btn btn-sm btn-warning text-dark font-weight-bold px-3 shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-save mr-1"></i> Simpan Status Baru
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.jQuery) {
            $('#select_status').on('change', function() {
                var val = $(this).val();
                if (val === 'accept') {
                    $('#group_nomor').slideDown(200);
                    $('#label_keterangan').text('Catatan (Opsional)');
                    $('#keterangan_ubah').val('Validasi Lengkap');
                } else if (val === 'reject') {
                    $('#group_nomor').slideUp(200);
                    $('#label_keterangan').html('Alasan Penolakan <span class="text-danger">*</span>');
                    if ($('#keterangan_ubah').val() === 'Validasi Lengkap' || $('#keterangan_ubah').val() === 'menunggu proses validasi') {
                        $('#keterangan_ubah').val('');
                    }
                    $('#keterangan_ubah').attr('placeholder', 'Tuliskan alasan penolakan...');
                } else { // di ajukan
                    $('#group_nomor').slideUp(200);
                    $('#label_keterangan').text('Keterangan');
                    $('#keterangan_ubah').val('menunggu proses validasi');
                }
            });
        }
    });
</script>

<!-- Modal Tanggal -->
<div class="modal fade" id="modalTanggal" tabindex="-1" role="dialog" aria-labelledby="modalTanggalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-info text-white py-3">
                <h6 class="modal-title font-weight-bold" id="modalTanggalLabel">
                    <i class="fas fa-calendar-alt mr-1"></i> Update Tanggal Surat
                </h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pustakawan/tanggal/' . $perpus['id_bp']); ?>" method="post">
                <div class="modal-body p-4">
                    <div class="form-group mb-0">
                        <label for="tanggal" class="small font-weight-bold text-gray-800">Tanggal Surat</label>
                        <input type="text" class="form-control datepicker" id="tanggal" name="tanggal" value="<?= htmlspecialchars((!empty($perpus['date_updated']) && $perpus['date_updated'] != '0000-00-00 00:00:00') ? date('Y-m-d', strtotime($perpus['date_updated'])) : date('Y-m-d')); ?>" required style="border-radius: 6px;">
                        <small class="form-text text-muted">Format: YYYY-MM-DD</small>
                    </div>
                </div>
                <div class="modal-footer py-2 px-3 bg-light">
                    <button type="button" class="btn btn-sm btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                    <button type="submit" class="btn btn-sm btn-info font-weight-bold px-3 shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-save mr-1"></i> Simpan Tanggal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Preview KTM -->
<div class="modal fade" id="modalPreviewKtm" tabindex="-1" role="dialog" aria-labelledby="modalPreviewKtmLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="max-width: 90vw;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-primary text-white py-2 px-3 d-flex align-items-center justify-content-between">
                <h6 class="modal-title font-weight-bold" id="modalPreviewKtmLabel">
                    <i class="fas fa-id-card mr-1"></i> Pratinjau KTM - <?= htmlspecialchars($perpus['nama_lengkap']); ?>
                </h6>
                <div>
                    <a href="<?= base_url('assets/bebasperpus/' . $perpus['ktm']); ?>" target="_blank" class="btn btn-xs btn-light text-primary font-weight-bold mr-2" style="font-size: 11px;">
                        <i class="fas fa-external-link-alt mr-1"></i> Tab Baru
                    </a>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body p-0 bg-dark text-center" style="min-height: 75vh;">
                <?php 
                    $ext_ktm = strtolower(pathinfo($perpus['ktm'], PATHINFO_EXTENSION));
                    if ($ext_ktm === 'pdf'):
                ?>
                    <iframe src="<?= base_url('assets/bebasperpus/' . $perpus['ktm']); ?>" style="width: 100%; height: 75vh; border: none;"></iframe>
                <?php else: ?>
                    <div class="p-3 d-flex align-items-center justify-content-center" style="min-height: 75vh;">
                        <img src="<?= base_url('assets/bebasperpus/' . $perpus['ktm']); ?>" alt="KTM Full Preview" style="max-width: 100%; max-height: 72vh; object-fit: contain; border-radius: 4px;">
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer py-2 px-3 bg-light d-flex justify-content-between">
                <span class="small text-muted font-italic"><?= htmlspecialchars($perpus['ktm']); ?></span>
                <button type="button" class="btn btn-sm btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 6px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Kartu Perpustakaan -->
<div class="modal fade" id="modalPreviewKartu" tabindex="-1" role="dialog" aria-labelledby="modalPreviewKartuLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="max-width: 90vw;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-success text-white py-2 px-3 d-flex align-items-center justify-content-between">
                <h6 class="modal-title font-weight-bold" id="modalPreviewKartuLabel">
                    <i class="fas fa-address-card mr-1"></i> Pratinjau Kartu Perpustakaan - <?= htmlspecialchars($perpus['nama_lengkap']); ?>
                </h6>
                <div>
                    <a href="<?= base_url('assets/bebasperpus/' . $perpus['kartuperpus']); ?>" target="_blank" class="btn btn-xs btn-light text-success font-weight-bold mr-2" style="font-size: 11px;">
                        <i class="fas fa-external-link-alt mr-1"></i> Tab Baru
                    </a>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body p-0 bg-dark text-center" style="min-height: 75vh;">
                <?php 
                    $ext_kartu = strtolower(pathinfo($perpus['kartuperpus'], PATHINFO_EXTENSION));
                    if ($ext_kartu === 'pdf'):
                ?>
                    <iframe src="<?= base_url('assets/bebasperpus/' . $perpus['kartuperpus']); ?>" style="width: 100%; height: 75vh; border: none;"></iframe>
                <?php else: ?>
                    <div class="p-3 d-flex align-items-center justify-content-center" style="min-height: 75vh;">
                        <img src="<?= base_url('assets/bebasperpus/' . $perpus['kartuperpus']); ?>" alt="Kartu Perpus Full Preview" style="max-width: 100%; max-height: 72vh; object-fit: contain; border-radius: 4px;">
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer py-2 px-3 bg-light d-flex justify-content-between">
                <span class="small text-muted font-italic"><?= htmlspecialchars($perpus['kartuperpus']); ?></span>
                <button type="button" class="btn btn-sm btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 6px;">Tutup</button>
            </div>
        </div>
    </div>
</div>