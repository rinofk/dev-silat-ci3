<style>
    .detail-profile-avatar {
        width: 50px;
        height: 50px;
        min-width: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3);
    }
    .info-table-custom td {
        padding: 8px 10px;
        vertical-align: middle;
        font-size: 0.88rem;
    }
    .info-label {
        width: 30%;
        font-weight: 600;
        color: #64748b;
    }
    .info-separator {
        width: 3%;
        color: #94a3b8;
    }
    .info-value {
        color: #1e293b;
    }
    @media (max-width: 576px) {
        .info-table-custom tr {
            display: flex;
            flex-direction: column;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .info-table-custom tr:last-child {
            border-bottom: none;
        }
        .info-table-custom td {
            padding: 1px 0;
            width: 100% !important;
        }
        .info-label {
            font-size: 0.78rem;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .info-separator {
            display: none;
        }
        .info-value {
            font-size: 0.9rem;
            font-weight: 600;
        }
    }
    .ktm-preview-box {
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        min-height: 220px;
        max-height: 320px;
    }
    .ktm-preview-box img {
        max-width: 100%;
        max-height: 300px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
    .ktm-preview-box img:hover {
        transform: scale(1.03);
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid px-3 px-md-4">

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="row mt-2">
            <div class="col-12">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Page Header & Back Button -->
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-3 gap-2">
        <div class="d-flex align-items-center flex-wrap gap-2">
            <a href="<?= base_url('bebaslab?prodi=' . $bl->slug); ?>" class="btn btn-sm btn-outline-secondary shadow-sm font-weight-bold mr-2" style="border-radius: 8px;">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <h1 class="h5 mb-0 text-gray-800 font-weight-bold d-inline-flex align-items-center">
                <i class="fas fa-microscope text-primary mr-2"></i> Detail Bebas Laboratorium
            </h1>
            <span class="badge badge-light border text-muted font-weight-bold px-2 py-1 ml-sm-2" style="font-size: 11px;">
                #<?= $bl->id_bebaslab; ?>
            </span>
        </div>
        <div class="mt-2 mt-sm-0">
            <?php 
                $status = strtolower($bl->status);
                if ($status == 'accept') {
                    echo '<span class="badge badge-success px-3 py-2 shadow-sm font-weight-bold" style="font-size: 12px; border-radius: 20px;"><i class="fas fa-check-circle mr-1"></i> Diterima (Accept)</span>';
                } elseif ($status == 'reject') {
                    echo '<span class="badge badge-danger px-3 py-2 shadow-sm font-weight-bold" style="font-size: 12px; border-radius: 20px;"><i class="fas fa-times-circle mr-1"></i> Ditolak (Reject)</span>';
                } elseif ($status == 'proses') {
                    echo '<span class="badge badge-info px-3 py-2 shadow-sm font-weight-bold" style="font-size: 12px; border-radius: 20px;"><i class="fas fa-spinner fa-spin mr-1"></i> Diproses</span>';
                } else {
                    echo '<span class="badge badge-warning text-dark px-3 py-2 shadow-sm font-weight-bold" style="font-size: 12px; border-radius: 20px;"><i class="fas fa-clock mr-1"></i> Menunggu Validasi</span>';
                }
            ?>
        </div>
    </div>

    <div class="row">
        <!-- Main Info & Files (Left Column on Desktop, Stacks on Mobile) -->
        <div class="col-lg-8">
            
            <!-- Student Information Card -->
            <div class="card shadow-sm mb-3 border-0" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header py-3 px-3 px-md-4 bg-white border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user-graduate mr-2"></i>Informasi Mahasiswa
                    </h6>
                    <span class="badge badge-primary badge-pill px-2 py-1 small"><?= htmlspecialchars($bl->nama_prodi); ?></span>
                </div>
                
                <div class="card-body p-3 p-md-4">
                    <!-- Profile Header Banner -->
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <div class="detail-profile-avatar mr-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-gray-900 mb-1" style="font-size: 1.1rem;">
                                <?= htmlspecialchars($bl->nama_lengkap); ?>
                            </h5>
                            <div class="d-flex align-items-center flex-wrap" style="gap: 6px;">
                                <span class="badge badge-light border text-primary font-weight-bold px-2 py-1" style="font-size: 0.8rem;">
                                    <i class="fas fa-id-badge mr-1"></i> <?= htmlspecialchars($bl->nim_mahasiswa); ?>
                                </span>
                                <span class="badge badge-light border text-muted font-weight-bold px-2 py-1" style="font-size: 0.8rem;">
                                    Semester <?= htmlspecialchars($bl->semester); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Details Table -->
                    <table class="table table-borderless info-table-custom mb-0">
                        <tbody>
                            <tr>
                                <td class="info-label"><i class="fas fa-envelope text-muted mr-1"></i> Email</td>
                                <td class="info-separator">:</td>
                                <td class="info-value"><?= htmlspecialchars($bl->email ? $bl->email : '-'); ?></td>
                            </tr>
                            <tr>
                                <td class="info-label"><i class="fas fa-graduation-cap text-muted mr-1"></i> Program Studi</td>
                                <td class="info-separator">:</td>
                                <td class="info-value font-weight-bold text-primary"><?= htmlspecialchars($bl->nama_prodi); ?></td>
                            </tr>
                            <tr>
                                <td class="info-label"><i class="fas fa-birthday-cake text-muted mr-1"></i> Tempat, Tgl Lahir</td>
                                <td class="info-separator">:</td>
                                <td class="info-value">
                                    <?= htmlspecialchars($bl->tempat_lahir); ?>, 
                                    <?= (!empty($bl->tgl_lahir) && $bl->tgl_lahir != '0000-00-00') ? tgl_ind(date('Y-m-d', strtotime($bl->tgl_lahir))) : '-'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="info-label"><i class="fas fa-map-marker-alt text-muted mr-1"></i> Alamat</td>
                                <td class="info-separator">:</td>
                                <td class="info-value"><?= htmlspecialchars($bl->alamat ? $bl->alamat : '-'); ?></td>
                            </tr>
                            <tr>
                                <td class="info-label"><i class="fab fa-whatsapp text-muted mr-1"></i> No. HP / WhatsApp</td>
                                <td class="info-separator">:</td>
                                <td class="info-value">
                                    <?php if (!empty($bl->no_hp)): ?>
                                        <a href="https://wa.me/<?= preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $bl->no_hp)); ?>" target="_blank" class="text-success font-weight-bold d-inline-flex align-items-center">
                                            <i class="fab fa-whatsapp mr-1 fa-lg"></i> <?= htmlspecialchars($bl->no_hp); ?>
                                        </a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Documents Card (Berkas KTM) -->
            <div class="card shadow-sm mb-3 border-0" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header py-3 px-3 px-md-4 bg-white border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-id-card mr-2"></i>Berkas KTM (Kartu Tanda Mahasiswa)
                    </h6>
                    <?php 
                        $ext_ktm = strtolower(pathinfo($bl->ktm, PATHINFO_EXTENSION));
                        $is_pdf_ktm = ($ext_ktm === 'pdf');
                        $has_ktm = (!empty($bl->ktm) && $bl->ktm !== 'default.jpg' && file_exists('./assets/bebaslab/' . $bl->ktm));
                    ?>
                    <?php if ($is_pdf_ktm): ?>
                        <span class="badge badge-danger font-weight-bold px-2 py-1"><i class="fas fa-file-pdf mr-1"></i>PDF</span>
                    <?php elseif ($has_ktm): ?>
                        <span class="badge badge-success font-weight-bold px-2 py-1"><i class="fas fa-check-circle mr-1"></i>Terunggah</span>
                    <?php else: ?>
                        <span class="badge badge-secondary px-2 py-1">Default</span>
                    <?php endif; ?>
                </div>
                
                <div class="card-body p-3 p-md-4">
                    <div class="ktm-preview-box mb-3">
                        <?php if ($has_ktm && !$is_pdf_ktm): ?>
                            <img src="<?= base_url('assets/bebaslab/' . $bl->ktm); ?>" alt="KTM Preview" style="cursor: pointer;" data-toggle="modal" data-target="#modalPreviewKtm" title="Klik untuk memperbesar">
                        <?php elseif ($is_pdf_ktm): ?>
                            <iframe src="<?= base_url('assets/bebaslab/' . $bl->ktm); ?>#toolbar=0&navpanes=0" style="width: 100%; height: 260px; border: none;" loading="lazy"></iframe>
                        <?php else: ?>
                            <div class="text-center py-4 text-muted small d-flex flex-column align-items-center justify-content-center">
                                <i class="far fa-image fa-3x text-gray-300 mb-2"></i>
                                <span>Berkas KTM default / belum diunggah</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex flex-wrap" style="gap: 8px;">
                        <?php if ($has_ktm && !$is_pdf_ktm): ?>
                            <button type="button" class="btn btn-sm btn-outline-primary flex-fill font-weight-bold py-2" data-toggle="modal" data-target="#modalPreviewKtm" style="border-radius: 8px;">
                                <i class="fas fa-search-plus mr-1"></i> Perbesar KTM
                            </button>
                            <a href="<?= base_url('assets/bebaslab/' . $bl->ktm); ?>" target="_blank" class="btn btn-sm btn-primary flex-fill font-weight-bold shadow-sm py-2" style="border-radius: 8px;">
                                <i class="fas fa-external-link-alt mr-1"></i> Buka File Asli
                            </a>
                        <?php elseif ($has_ktm && $is_pdf_ktm): ?>
                            <a href="<?= base_url('assets/bebaslab/' . $bl->ktm); ?>" target="_blank" class="btn btn-sm btn-primary btn-block font-weight-bold shadow-sm py-2" style="border-radius: 8px;">
                                <i class="fas fa-file-pdf mr-1"></i> Buka Dokumen PDF
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url('assets/bebaslab/' . $bl->ktm); ?>" target="_blank" class="btn btn-sm btn-outline-secondary btn-block font-weight-bold py-2" style="border-radius: 8px;">
                                <i class="fas fa-external-link-alt mr-1"></i> Buka File Default
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Verification Results Box (If Accept or Reject) -->
            <?php if ($status == 'accept'): ?>
                <div class="card shadow-sm mb-3 border-left-success" style="border-radius: 14px; overflow: hidden;">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3 text-success">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-success mb-0">Pengajuan Bebas Lab Telah Disetujui</h6>
                                <small class="text-muted">Surat resmi telah diterbitkan dan dapat dicetak.</small>
                            </div>
                        </div>
                        <div class="row pt-2 border-top">
                            <div class="col-sm-6 mb-2">
                                <span class="text-muted small d-block">Nomor Surat:</span>
                                <span class="font-weight-bold text-primary" style="font-size: 0.95rem;"><?= htmlspecialchars($bl->nomor ?: '-'); ?></span>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <span class="text-muted small d-block">Petugas Verifikator:</span>
                                <span class="font-weight-bold text-gray-800"><?= htmlspecialchars($bl->lab1_admin ?: '-'); ?></span>
                            </div>
                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <span class="text-muted small d-block">Tanggal Surat:</span>
                                <span class="font-weight-bold text-gray-800">
                                    <?= (!empty($bl->date_finished) && $bl->date_finished != '0000-00-00 00:00:00') ? date('d-m-Y', strtotime($bl->date_finished)) : '-' ?>
                                </span>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted small d-block">Masa Berlaku Sampai:</span>
                                <span class="font-weight-bold text-success">
                                    <?= (!empty($bl->berlaku_sampai) && $bl->berlaku_sampai != '0000-00-00') ? date('d-m-Y', strtotime($bl->berlaku_sampai)) : '-' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif ($status == 'reject'): ?>
                <div class="card shadow-sm mb-3 border-left-danger" style="border-radius: 14px; overflow: hidden;">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex align-items-start">
                            <div class="mr-3 text-danger mt-1">
                                <i class="fas fa-times-circle fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-danger mb-1">Pengajuan Ditolak</h6>
                                <div class="alert alert-danger py-2 px-3 mb-2 small" style="border-radius: 8px; background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b;">
                                    <strong>Alasan:</strong> <?= htmlspecialchars($bl->keterangan ?: 'Berkas tidak sesuai syarat.'); ?>
                                </div>
                                <small class="text-muted d-block">Ditolak oleh: <strong><?= htmlspecialchars($bl->lab1_admin ?: 'Admin'); ?></strong> pada <?= (!empty($bl->date_updated)) ? date('d-m-Y H:i', strtotime($bl->date_updated)) : '-' ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Action Buttons Footer Card (Mobile & Desktop Friendly) -->
            <div class="card shadow-sm mb-4 border-0" style="border-radius: 14px;">
                <div class="card-body p-3 px-md-4">
                    <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 8px;">
                        <a href="<?= base_url('bebaslab?prodi=' . $bl->slug); ?>" class="btn btn-secondary font-weight-bold flex-fill flex-sm-grow-0 py-2" style="border-radius: 8px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>

                        <div class="d-flex flex-wrap flex-fill justify-content-end" style="gap: 8px;">
                            <!-- PROSES BUTTON (Only for 'di ajukan') -->
                            <?php if ($status == 'di ajukan') : ?>
                                <a href="<?= base_url('bebaslab/proses/' . $bl->id_bebaslab); ?>" class="btn btn-info font-weight-bold flex-fill flex-sm-grow-0 py-2 shadow-sm" style="border-radius: 8px;">
                                    <i class="fas fa-sync-alt mr-1"></i> Proses Pengajuan
                                </a>
                            <?php endif; ?>

                            <!-- REJECT BUTTON (Only for 'di ajukan' or 'proses') -->
                            <?php if (in_array($status, ['di ajukan', 'proses'])) : ?>
                                <button type="button" class="btn btn-danger font-weight-bold flex-fill flex-sm-grow-0 py-2 shadow-sm" data-toggle="modal" data-target="#modalReject" style="border-radius: 8px;">
                                    <i class="fas fa-times mr-1"></i> Tolak (Reject)
                                </button>
                            <?php endif; ?>

                            <!-- ACCEPT BUTTON (For 'di ajukan', 'proses', or 'reject') -->
                            <?php if (in_array($status, ['di ajukan', 'proses', 'reject'])) : ?>
                                <button type="button" class="btn btn-success font-weight-bold flex-fill flex-sm-grow-0 py-2 shadow-sm" data-toggle="modal" data-target="#modalAccept" style="border-radius: 8px;">
                                    <i class="fas fa-check mr-1"></i> Setujui (Accept)
                                </button>
                            <?php endif; ?>

                            <!-- CETAK & UPDATE TANGGAL (Only for 'accept') -->
                            <?php if ($status == 'accept') : ?>
                                <button type="button" class="btn btn-info font-weight-bold flex-fill flex-sm-grow-0 py-2 shadow-sm" data-toggle="modal" data-target="#modalTanggal" style="border-radius: 8px;">
                                    <i class="fas fa-calendar-alt mr-1"></i> Update Tanggal
                                </button>
                                <a href="<?= base_url('bebaslab/cetak/' . $bl->id_bebaslab); ?>" class="btn btn-primary font-weight-bold flex-fill flex-sm-grow-0 py-2 shadow-sm" target="_blank" style="border-radius: 8px;">
                                    <i class="fas fa-print mr-1"></i> Cetak Surat Bebas Lab
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar Summary & Guide (Right Column on Desktop, Stacks on Mobile) -->
        <div class="col-lg-4">
            
            <!-- Status Timeline / Summary Card -->
            <div class="card shadow-sm mb-3 border-0" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header py-3 px-3 bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-primary small">
                        <i class="fas fa-info-circle mr-1"></i> Ringkasan Status
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="text-center pb-3 mb-3 border-bottom">
                        <?php if ($status == 'accept'): ?>
                            <div class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle mb-2 shadow-sm" style="width: 50px; height: 50px;">
                                <i class="fas fa-check fa-lg"></i>
                            </div>
                            <h6 class="font-weight-bold text-success mb-1">Pengajuan Disetujui</h6>
                            <span class="small text-muted">Surat Bebas Laboratorium telah diterbitkan resmi.</span>
                        <?php elseif ($status == 'reject'): ?>
                            <div class="d-inline-flex align-items-center justify-content-center bg-danger text-white rounded-circle mb-2 shadow-sm" style="width: 50px; height: 50px;">
                                <i class="fas fa-times fa-lg"></i>
                            </div>
                            <h6 class="font-weight-bold text-danger mb-1">Pengajuan Ditolak</h6>
                            <span class="small text-danger font-italic"><?= htmlspecialchars($bl->keterangan ?: '-'); ?></span>
                        <?php elseif ($status == 'proses'): ?>
                            <div class="d-inline-flex align-items-center justify-content-center bg-info text-white rounded-circle mb-2 shadow-sm" style="width: 50px; height: 50px;">
                                <i class="fas fa-spinner fa-spin fa-lg"></i>
                            </div>
                            <h6 class="font-weight-bold text-info mb-1">Sedang Diproses</h6>
                            <span class="small text-muted">Berkas sedang diperiksa oleh laboran prodi.</span>
                        <?php else: ?>
                            <div class="d-inline-flex align-items-center justify-content-center bg-warning text-white rounded-circle mb-2 shadow-sm" style="width: 50px; height: 50px;">
                                <i class="fas fa-clock fa-lg"></i>
                            </div>
                            <h6 class="font-weight-bold text-warning mb-1">Menunggu Validasi</h6>
                            <span class="small text-muted">Menunggu pemeriksaan dan verifikasi berkas dari laboran.</span>
                        <?php endif; ?>
                    </div>

                    <div class="small">
                        <div class="d-flex justify-content-between py-1.5 border-bottom">
                            <span class="text-muted">Nomor Surat:</span>
                            <span class="font-weight-bold text-gray-900"><?= htmlspecialchars($bl->nomor ?: '-'); ?></span>
                        </div>
                        <div class="d-flex justify-content-between py-1.5 border-bottom">
                            <span class="text-muted">Tgl Pengajuan:</span>
                            <span class="font-weight-bold text-gray-900"><?= (!empty($bl->date_created)) ? date('d-m-Y H:i', strtotime($bl->date_created)) : '-'; ?></span>
                        </div>
                        <div class="d-flex justify-content-between py-1.5 border-bottom">
                            <span class="text-muted">Tgl Update:</span>
                            <span class="font-weight-bold text-gray-900"><?= (!empty($bl->date_updated)) ? date('d-m-Y H:i', strtotime($bl->date_updated)) : '-'; ?></span>
                        </div>
                        <div class="d-flex justify-content-between py-1.5">
                            <span class="text-muted">Petugas Lab:</span>
                            <span class="font-weight-bold text-primary"><?= htmlspecialchars($bl->lab1_admin ?: '-'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verification Guide Card -->
            <div class="card shadow-sm mb-4 border-0" style="border-radius: 14px; overflow: hidden; background: #f8fafc;">
                <div class="card-header py-3 px-3 bg-white border-bottom">
                    <h6 class="m-0 font-weight-bold text-info small">
                        <i class="fas fa-clipboard-check mr-1"></i> Panduan Verifikasi
                    </h6>
                </div>
                <div class="card-body p-3 small text-muted" style="line-height: 1.6;">
                    <ol class="pl-3 mb-0">
                        <li class="mb-2">Periksa keaslian & kejelasan file <b>KTM</b> yang diunggah mahasiswa.</li>
                        <li class="mb-2">Pastikan mahasiswa <b>bebas peminjaman alat lab</b> dan administrasi laboratorium.</li>
                        <li class="mb-2">Jika dokumen valid, klik <b>Setujui (Accept)</b> dan masukkan <b>Nomor Surat</b>.</li>
                        <li class="mb-2">Jika berkas tidak sesuai, klik <b>Tolak (Reject)</b> serta isi alasan penolakan.</li>
                        <li>Gunakan tombol <b>Update Tanggal</b> jika ingin menyesuaikan kembali tanggal terbit surat.</li>
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
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-success text-white py-3">
                <h6 class="modal-title font-weight-bold" id="modalAcceptLabel">
                    <i class="fas fa-check-circle mr-1"></i> Setujui Pengajuan Bebas Laboratorium
                </h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bebaslab/accept/' . $bl->id_bebaslab); ?>" method="post">
                <div class="modal-body p-4">
                    <p class="small text-muted mb-3">
                        Anda akan menyetujui pengajuan Bebas Laboratorium untuk <strong><?= htmlspecialchars($bl->nama_lengkap); ?> (<?= htmlspecialchars($bl->nim_mahasiswa); ?>)</strong>.
                    </p>
                    <div class="form-group mb-0">
                        <label for="nomor" class="small font-weight-bold text-gray-800">Nomor Surat Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-weight-bold text-primary" id="nomor" name="nomor" value="<?= htmlspecialchars(isset($nomor_otomatis) ? $nomor_otomatis : ''); ?>" required placeholder="Contoh: 1234<?= htmlspecialchars(isset($base_nomor) ? $base_nomor : ''); ?>" style="border-radius: 6px;">
                        <small class="form-text text-muted mt-1">
                            Template dari <strong>tb_nomorsurat</strong>: <span class="badge badge-light border text-dark font-weight-bold"><code><?= htmlspecialchars(isset($base_nomor) ? $base_nomor : ''); ?></code></span>.<br>
                            Silakan ketik nomor urut di awal (contoh: <code>1234<?= htmlspecialchars(isset($base_nomor) ? $base_nomor : ''); ?></code>).
                        </small>
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

<!-- Modal Reject / Tolak -->
<div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-labelledby="modalRejectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-danger text-white py-3">
                <h6 class="modal-title font-weight-bold" id="modalRejectLabel">
                    <i class="fas fa-times-circle mr-1"></i> Tolak Pengajuan Bebas Laboratorium
                </h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bebaslab/reject/' . $bl->id_bebaslab); ?>" method="post">
                <div class="modal-body p-4">
                    <p class="small text-muted mb-3">Anda akan menolak pengajuan Bebas Lab mahasiswa ini. Silakan masukkan <b>Alasan Penolakan</b>:</p>
                    <div class="form-group mb-0">
                        <label class="small font-weight-bold text-gray-800">Alasan Penolakan / Keterangan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required placeholder="Contoh: File KTM buram, silakan upload ulang berkas KTM yang jelas." style="border-radius: 6px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer py-2 px-3 bg-light">
                    <button type="button" class="btn btn-sm btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                    <button type="submit" class="btn btn-sm btn-danger font-weight-bold px-3 shadow-sm" style="border-radius: 6px;">
                        <i class="fas fa-times mr-1"></i> Tolak (Reject)
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Tanggal Surat -->
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
            <form action="<?= base_url('bebaslab/tanggal/' . $bl->id_bebaslab); ?>" method="post">
                <div class="modal-body p-4">
                    <div class="form-group mb-0">
                        <label class="small font-weight-bold text-gray-800">Tanggal Surat</label>
                        <?php 
                            $current_date = (!empty($bl->date_finished) && $bl->date_finished != '0000-00-00 00:00:00' && $bl->date_finished != '1970-01-01 00:00:00') 
                                ? date('Y-m-d', strtotime($bl->date_finished)) 
                                : ((!empty($bl->date_updated) && $bl->date_updated != '0000-00-00 00:00:00') ? date('Y-m-d', strtotime($bl->date_updated)) : date('Y-m-d'));
                        ?>
                        <input type="text" class="form-control datepicker font-weight-bold" id="tanggal" name="tanggal" value="<?= htmlspecialchars($current_date); ?>" required placeholder="YYYY-MM-DD" style="border-radius: 6px;">
                        <small class="form-text text-muted mt-1">Format: YYYY-MM-DD. Masa berlaku surat otomatis dihitung 90 hari dari tanggal ini.</small>
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

<!-- Modal Preview KTM Zoom -->
<?php if ($has_ktm && !$is_pdf_ktm): ?>
<div class="modal fade" id="modalPreviewKtm" tabindex="-1" role="dialog" aria-labelledby="modalPreviewKtmLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header py-2 px-3 bg-white border-bottom d-flex align-items-center justify-content-between">
                <h6 class="modal-title font-weight-bold text-gray-800" id="modalPreviewKtmLabel">
                    <i class="fas fa-id-card text-primary mr-1"></i> Pratinjau Berkas KTM: <?= htmlspecialchars($bl->nama_lengkap); ?>
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-2 text-center bg-dark" style="max-height: 80vh; overflow-y: auto;">
                <img src="<?= base_url('assets/bebaslab/' . $bl->ktm); ?>" alt="KTM Full Preview" class="img-fluid" style="max-height: 75vh; border-radius: 6px;">
            </div>
            <div class="modal-footer py-2 px-3 bg-light d-flex justify-content-between">
                <a href="<?= base_url('assets/bebaslab/' . $bl->ktm); ?>" target="_blank" class="btn btn-sm btn-primary font-weight-bold" style="border-radius: 6px;">
                    <i class="fas fa-external-link-alt mr-1"></i> Buka di Tab Baru
                </a>
                <button type="button" class="btn btn-sm btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 6px;">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

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


