<!-- Begin Page Content -->
<style>
    /* Custom Styling for Bebas Lab Student View */
    .btn-custom-add {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        color: #fff;
        padding: 10px 24px;
        border-radius: 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3);
        transition: all 0.3s ease;
    }
    .btn-custom-add:hover {
        background: linear-gradient(135deg, #224abe 0%, #1e3d99 100%);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(78, 115, 223, 0.4);
        text-decoration: none;
    }
    .card-custom-main {
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
        overflow: hidden;
    }
    .card-custom-main .card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f3f9;
        padding: 16px 20px;
    }
    .table-custom {
        width: 100% !important;
    }
    .table-custom thead th {
        background-color: #f8f9fc;
        color: #4e73df;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.8px;
        border-bottom: 2px solid #eaecf4;
        padding: 12px 10px;
        text-align: center;
        white-space: nowrap;
    }
    .table-custom tbody td {
        vertical-align: middle !important;
        color: #5a5c69;
        font-size: 0.85rem;
        padding: 12px 10px;
        border-bottom: 1px solid #eaecf4;
    }
    .table-custom tbody tr:hover {
        background-color: #fbfcfe;
    }
    
    /* Badge status pill styling */
    .badge-pill-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.72rem;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        width: 100%;
        max-width: 110px;
    }
    .badge-status-diajukan {
        background-color: #e2e8f0;
        color: #475569;
    }
    .badge-status-diproses {
        background-color: #fef3c7;
        color: #d97706;
    }
    .badge-status-ditolak {
        background-color: #fee2e2;
        color: #dc2626;
    }
    .badge-status-diterima {
        background-color: #dcfce7;
        color: #16a34a;
    }
    .badge-status-draft {
        background-color: #f1f5f9;
        color: #64748b;
    }

    /* Thumbnail custom styling */
    .ktm-thumb-container {
        position: relative;
        display: inline-block;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.06);
        border: 2px solid #e3e6f0;
        transition: all 0.3s ease;
        line-height: 0;
    }
    .ktm-thumb-container img {
        transition: all 0.3s ease;
    }
    .ktm-thumb-container:hover {
        border-color: #4e73df;
        box-shadow: 0 6px 12px rgba(78, 115, 223, 0.25);
    }
    .ktm-thumb-container:hover img {
        transform: scale(1.15);
    }

    /* Action button design styling */
    .btn-action-group {
        display: flex;
        gap: 6px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .btn-action-custom {
        border-radius: 20px;
        padding: 6px 14px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
    }
    .btn-action-edit {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    .btn-action-edit:hover {
        background-color: #fde68a;
        color: #b45309;
        text-decoration: none;
    }
    .btn-action-ajukan {
        background-color: #dcfce7;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }
    .btn-action-ajukan:hover {
        background-color: #bbf7d0;
        color: #15803d;
        text-decoration: none;
    }
    .btn-action-hapus {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .btn-action-hapus:hover {
        background-color: #fecaca;
        color: #b91c1c;
        text-decoration: none;
    }
    .btn-action-cetak {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: #ffffff;
        border: none;
        box-shadow: 0 4px 8px rgba(6, 182, 212, 0.25);
    }
    .btn-action-cetak:hover {
        background: linear-gradient(135deg, #0891b2 0%, #0369a1 100%);
        color: #ffffff;
        box-shadow: 0 6px 12px rgba(6, 182, 212, 0.35);
        text-decoration: none;
    }

    /* Customizing Datatable search input & entries */
    div.dataTables_wrapper div.dataTables_filter input {
        border-radius: 20px;
        padding: 5px 15px;
        border: 1px solid #cbd5e1;
        outline: none;
        transition: all 0.2s ease;
        margin-left: 0.5em;
    }
    div.dataTables_wrapper div.dataTables_filter input:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 2px rgba(78, 115, 223, 0.15);
    }
    div.dataTables_wrapper div.dataTables_length select {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 4px 8px;
    }
    .table-responsive {
        border: none;
    }
</style>

<div class="container-fluid px-3 px-md-4">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Pengajuan Bebas Laboratorium</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- CARD INFORMASI SISTEM -->
    <div class="alert alert-info shadow-sm border-left-primary mb-3 p-3" style="border-radius: 12px; font-size: 0.88rem;">
        <h6 class="text-primary font-weight-bold mb-2"><i class="fas fa-info-circle mr-2"></i> Informasi Pengajuan Bebas Lab</h6>
        <ul class="mb-0 pl-3" style="line-height: 1.5;">
            <li><strong>Masa berlaku Surat Bebas Lab adalah 90 hari</strong> sejak tanggal surat terbit.</li>
            <li><strong>Mahasiswa dapat mengajukan kembali setelah 60 hari</strong> sejak pengajuan terakhir.</li>
            <li>Pastikan data diri dan berkas KTM Anda sudah lengkap dan jelas sebelum mengajukan.</li>
        </ul>
    </div>

    <!-- tombol tambah pengajuan -->
    <div class="mb-3">
        <a href="<?= base_url('laboratorium/tambah'); ?>" class="btn btn-custom-add shadow-sm d-inline-flex align-items-center">
            <i class="fas fa-plus mr-2"></i> Buat Pengajuan Baru
        </a>
    </div>

    <!-- DAFTAR PENGAJUAN -->
    <div class="card card-custom-main shadow-sm mb-4">
        <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list-alt mr-2"></i>Daftar Riwayat Pengajuan</h6>
            <span class="badge badge-primary badge-pill px-2 py-1 small"><?= count($pengajuan); ?> Data</span>
        </div>

        <div class="card-body p-3">

            <!-- 1. TAMPILAN MOBILE (Khusus Layar HP / Small Screen) -->
            <div class="d-block d-md-none">
                <?php if (empty($pengajuan)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-folder-open fa-3x mb-2 text-gray-300"></i>
                        <p class="mb-0 small font-weight-bold">Belum ada pengajuan bebas laboratorium.</p>
                    </div>
                <?php else: ?>
                    <?php $no = 1; foreach ($pengajuan as $p): 
                        $card_border = 'border-left-primary';
                        if ($p['status'] == 'accept') {
                            $card_border = 'border-left-success';
                        } elseif ($p['status'] == 'reject') {
                            $card_border = 'border-left-danger';
                        } elseif ($p['status'] == 'di ajukan' || $p['status'] == 'proses') {
                            $card_border = 'border-left-warning';
                        }
                    ?>
                        <div class="card shadow-sm mb-3 <?= $card_border; ?>" style="border-radius: 12px; border-width: 1px;">
                            <div class="card-body p-3">
                                <!-- Baris Atas: ID & Status -->
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                    <span class="badge badge-light border text-gray-800 px-2 py-1 font-weight-bold small">
                                        #<?= $no++; ?> &bull; ID: <?= htmlspecialchars($p['id_bebaslab']); ?>
                                    </span>
                                    <div>
                                        <?php if ($p['status'] == 'di ajukan'): ?>
                                            <span class="badge badge-warning px-2 py-1 small"><i class="fas fa-clock mr-1"></i> Diajukan</span>
                                        <?php elseif ($p['status'] == 'proses'): ?>
                                            <span class="badge badge-info px-2 py-1 small"><i class="fas fa-spinner fa-spin mr-1"></i> Diproses</span>
                                        <?php elseif ($p['status'] == 'reject'): ?>
                                            <span class="badge badge-danger px-2 py-1 small"><i class="fas fa-times-circle mr-1"></i> Ditolak</span>
                                        <?php elseif ($p['status'] == 'accept'): ?>
                                            <span class="badge badge-success px-2 py-1 small"><i class="fas fa-check-circle mr-1"></i> Diterima</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary px-2 py-1 small"><i class="fas fa-pencil-alt mr-1"></i> Draf</span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Baris Konten: Info & KTM -->
                                <div class="row no-gutters align-items-center mb-2">
                                    <div class="col-8 pr-2">
                                        <div class="small text-muted mb-1" style="font-size: 0.78rem;">
                                            <i class="fas fa-user mr-1 text-gray-400"></i> NIM: <strong class="text-gray-900"><?= htmlspecialchars(strtoupper($p['nim_mahasiswa'])); ?></strong>
                                        </div>
                                        <div class="small text-muted mb-1" style="font-size: 0.78rem;">
                                            <i class="far fa-calendar-alt mr-1 text-gray-400"></i> Tgl Pengajuan: <span class="text-dark font-weight-bold"><?= date('d-m-Y', strtotime($p['date_created'])); ?></span>
                                        </div>
                                        <?php if (!empty($p['date_finished']) && $p['date_finished'] != '0000-00-00' && $p['date_finished'] != '1970-01-01'): ?>
                                            <div class="small text-muted mb-1" style="font-size: 0.78rem;">
                                                <i class="fas fa-certificate mr-1 text-gray-400"></i> Tgl Surat: <span class="text-dark font-weight-bold"><?= date('d-m-Y', strtotime($p['date_finished'])); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($p['berlaku_sampai']) && $p['berlaku_sampai'] != '0000-00-00' && $p['berlaku_sampai'] != '1970-01-01'): ?>
                                            <div class="small text-muted" style="font-size: 0.78rem;">
                                                <i class="fas fa-clock mr-1 text-success"></i> Berlaku s.d: <strong class="text-success"><?= date('d-m-Y', strtotime($p['berlaku_sampai'])); ?></strong>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-4 text-center">
                                        <?php if (!empty($p['ktm']) && $p['ktm'] !== 'default.jpg' && file_exists('./assets/bebaslab/' . $p['ktm'])): ?>
                                            <a href="<?= base_url('assets/bebaslab/' . $p['ktm']); ?>" target="_blank" class="ktm-thumb-container d-inline-block">
                                                <img src="<?= base_url('assets/bebaslab/' . $p['ktm']); ?>" style="width: 60px; height: 75px; object-fit: cover;" alt="KTM" class="img-fluid rounded">
                                            </a>
                                            <div class="text-muted" style="font-size: 9px; margin-top: 2px;">Berkas KTM</div>
                                        <?php else: ?>
                                            <div class="d-inline-flex flex-column align-items-center text-muted">
                                                <i class="far fa-image fa-2x mb-1 text-gray-300"></i>
                                                <span style="font-size: 9px;">KTM Default</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if ($p['status'] == 'reject' && !empty($p['keterangan'])): ?>
                                    <div class="alert alert-danger py-1 px-2 mb-2 small" style="font-size: 0.8rem; border-radius: 6px;">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> <strong>Alasan:</strong> <?= htmlspecialchars($p['keterangan']); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Tombol Aksi Mobile -->
                                <div class="pt-2 border-top">
                                    <?php if ($p['status'] == 'accept'): ?>
                                        <a href="<?= site_url('laboratorium/cetak/' . $p['id_bebaslab']); ?>" target="_blank" class="btn btn-success btn-block btn-sm font-weight-bold shadow-sm py-2" style="border-radius: 8px; font-size: 0.88rem;">
                                            <i class="fas fa-print mr-1"></i> Cetak Surat Bebas Lab
                                        </a>
                                    <?php elseif ($p['status'] == '' || $p['status'] == 'reject'): ?>
                                        <div class="d-flex justify-content-between">
                                            <a href="<?= base_url('laboratorium/edit/' . $p['id_bebaslab']); ?>" class="btn btn-sm btn-outline-warning font-weight-bold flex-fill mr-1" style="border-radius: 6px; font-size: 0.82rem;">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <a href="<?= site_url('laboratorium/delete/' . $p['id_bebaslab']); ?>" class="btn btn-sm btn-outline-danger font-weight-bold flex-fill mr-1 btn-hapus" data-nama="pengajuan Bebas Lab (ID: #<?= $p['id_bebaslab']; ?>)" style="border-radius: 6px; font-size: 0.82rem;">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </a>
                                            <a href="<?= base_url('laboratorium/ajukan/' . $p['id_bebaslab']); ?>" class="btn btn-sm btn-primary font-weight-bold flex-fill" style="border-radius: 6px; font-size: 0.82rem;">
                                                <i class="fas fa-paper-plane mr-1"></i> Ajukan
                                            </a>
                                        </div>
                                    <?php elseif ($p['status'] == 'di ajukan' || $p['status'] == 'proses'): ?>
                                        <div class="text-center py-1 text-warning small font-italic bg-light rounded" style="font-size: 0.8rem;">
                                            <i class="fas fa-hourglass-half mr-1"></i> Sedang diproses & divalidasi oleh petugas lab
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- 2. TAMPILAN DESKTOP & TABLET (Tabel DataTable) -->
            <div class="d-none d-md-block">
                <div class="table-responsive">
                    <table class="table table-custom table-hover" id="tblPengajuan">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>ID Surat</th>
                                <th>NIM</th>
                                <th>Status</th>
                                <th>Berkas KTM</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Tanggal Surat</th>
                                <th>Berlaku Sampai</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;
                            foreach ($pengajuan as $p): ?>
                                <tr>
                                    <td class="text-center align-middle font-weight-bold"><?= $no++; ?></td>
                                    <td class="text-center align-middle font-weight-bold text-primary">#<?= $p['id_bebaslab']; ?></td>
                                    <td class="text-center align-middle"><?= htmlspecialchars(strtoupper($p['nim_mahasiswa'])); ?></td>

                                    <td class="text-center align-middle">
                                        <?php if ($p['status'] == 'di ajukan'): ?>
                                            <span class="badge-pill-custom badge-status-diajukan">Diajukan</span>
                                            <div class="mt-1" style="line-height: 1.2;">
                                                <span class="text-warning small font-italic" style="font-size: 11px;">menunggu validasi</span>
                                            </div>
                                        <?php elseif ($p['status'] == 'proses'): ?>
                                            <span class="badge-pill-custom badge-status-diproses">Diproses</span>
                                        <?php elseif ($p['status'] == 'reject'): ?>
                                            <span class="badge-pill-custom badge-status-ditolak">Ditolak</span>
                                            <?php if (!empty($p['keterangan'])): ?>
                                                <div class="mt-1" style="line-height: 1.2;">
                                                    <span class="text-danger small font-italic" style="font-size: 11px;"><?= htmlspecialchars($p['keterangan']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        <?php elseif ($p['status'] == 'accept'): ?>
                                            <span class="badge-pill-custom badge-status-diterima">Diterima</span>
                                        <?php else: ?>
                                            <span class="badge-pill-custom badge-status-draft">Draft</span>
                                            <div class="mt-1" style="line-height: 1.2;">
                                                <span class="text-muted small font-italic" style="font-size: 11px;">belum dikirim</span>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center align-middle">
                                        <?php if (!empty($p['ktm']) && $p['ktm'] !== 'default.jpg' && file_exists('./assets/bebaslab/' . $p['ktm'])): ?>
                                            <a href="<?= base_url('assets/bebaslab/' . $p['ktm']); ?>" target="_blank" class="ktm-thumb-container">
                                                <img src="<?= base_url('assets/bebaslab/' . $p['ktm']); ?>" width="55" alt="KTM" class="img-fluid rounded">
                                            </a>
                                        <?php else: ?>
                                            <div class="d-inline-flex flex-column align-items-center text-muted">
                                                <i class="far fa-image fa-2x mb-1 text-gray-300"></i>
                                                <span style="font-size: 10px; font-weight: 600;">Default</span>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td class="text-center align-middle"><?= date('d-m-Y', strtotime($p['date_created'])); ?></td>
                                    <td class="text-center align-middle">
                                        <?php if ($p['date_finished'] != '0000-00-00' && $p['date_finished'] != '1970-01-01' && !empty($p['date_finished'])): ?>
                                            <span class="text-dark font-weight-bold"><?= date('d-m-Y', strtotime($p['date_finished'])); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted font-italic">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <?php if ($p['berlaku_sampai'] != '0000-00-00' && $p['berlaku_sampai'] != '1970-01-01' && !empty($p['berlaku_sampai'])): ?>
                                            <span class="text-success font-weight-bold"><?= date('d-m-Y', strtotime($p['berlaku_sampai'])); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted font-italic">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-inline-flex align-items-center justify-content-center" style="gap: 6px;">
                                            <!-- Tombol Ajukan -->
                                            <?php if ($p['status'] == '' || $p['status'] == 'reject'): ?>
                                                <a href="<?= base_url('laboratorium/ajukan/' . $p['id_bebaslab']); ?>"
                                                    class="btn-action-custom btn-action-ajukan">
                                                    <i class="fas fa-paper-plane"></i> Ajukan
                                                </a>
                                            <?php endif; ?>

                                            <!-- Tombol Cetak -->
                                            <?php if ($p['status'] == 'accept'): ?>
                                                <a href="<?= site_url('laboratorium/cetak/' . $p['id_bebaslab']); ?>"
                                                    class="btn-action-custom btn-action-cetak" target="_blank">
                                                    <i class="fas fa-print"></i> Cetak
                                                </a>
                                            <?php endif; ?>

                                            <!-- Dropdown Menu Titik Tiga (Edit & Hapus) -->
                                            <?php 
                                                $can_edit  = ($p['status'] != 'di ajukan' && $p['status'] != 'accept');
                                                $can_hapus = ($p['status'] != 'accept' && $p['status'] != 'di ajukan' && $p['status'] != 'reject');
                                            ?>
                                            <?php if ($can_edit || $can_hapus): ?>
                                                <div class="dropdown d-inline-block">
                                                    <a href="javascript:void(0)" class="text-muted px-2 py-1 d-inline-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Menu Aksi" style="text-decoration: none; cursor: pointer;">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow-sm border py-1" style="border-radius: 8px; min-width: 120px; font-size: 13px;">
                                                        <?php if ($can_edit): ?>
                                                            <a class="dropdown-item py-1.5 px-3 text-gray-800" href="<?= base_url('laboratorium/edit/' . $p['id_bebaslab']); ?>">
                                                                <i class="fas fa-edit mr-2 text-warning"></i> Edit
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if ($can_hapus): ?>
                                                            <a class="dropdown-item py-1.5 px-3 text-danger btn-hapus" href="<?= site_url('laboratorium/delete/' . $p['id_bebaslab']); ?>" data-nama="pengajuan Bebas Lab (ID: #<?= $p['id_bebaslab']; ?>)">
                                                                <i class="fas fa-trash-alt mr-2 text-danger"></i> Hapus
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php elseif ($p['status'] == 'di ajukan'): ?>
                                                <span class="badge badge-light border text-muted py-1 px-2" style="font-size: 11px;">
                                                    <i class="fas fa-clock mr-1 text-warning"></i> Diproses
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($pengajuan)): ?>
                                <tr>
                                    <td colspan="9" class="text-center text-muted p-4">
                                        <i class="fas fa-folder-open fa-3x mb-3 text-gray-300 d-block"></i>
                                        Belum ada pengajuan bebas laboratorium
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        if ($('#tblPengajuan').length) {
            $('#tblPengajuan').DataTable({
                scrollX: true,
                autoWidth: false,
                pageLength: 25,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
                ordering: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                    zeroRecords: "Tidak ditemukan data yang sesuai",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        }
    });
</script>
