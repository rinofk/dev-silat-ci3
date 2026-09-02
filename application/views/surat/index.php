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
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data surat pengajuan <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- CARD INFORMASI ALUR PENGAJUAN -->
    <div class="card shadow-sm mb-4 border-left-primary" style="border-radius: 12px;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
                <div class="mr-3 d-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-sm" style="width: 42px; height: 42px; min-width: 42px;">
                    <i class="fas fa-info-circle fa-lg"></i>
                </div>
                <div>
                    <h5 class="m-0 font-weight-bold text-primary">Informasi & Alur Pengajuan Surat Aktif Kuliah</h5>
                    <small class="text-muted">Panduan alur proses pengajuan surat permohonan aktif kuliah hingga pengunduhan dokumen selesai.</small>
                </div>
            </div>

            <!-- Steps Grid -->
            <div class="row text-dark mt-3">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="p-3 bg-light rounded h-100 border" style="border-left: 4px solid #4e73df !important;">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge badge-primary badge-pill mr-2 px-2 py-1">Langkah 1</span>
                            <strong class="text-gray-800"><i class="fas fa-plus-circle text-primary mr-1"></i> Buat Pengajuan</strong>
                        </div>
                        <p class="small text-muted mb-0">Klik tombol <strong>+ Tambah</strong> untuk mengisi formulir keperluan pengajuan surat aktif kuliah.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="p-3 bg-light rounded h-100 border" style="border-left: 4px solid #f6c23e !important;">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge badge-warning text-white badge-pill mr-2 px-2 py-1">Langkah 2</span>
                            <strong class="text-gray-800"><i class="fas fa-paper-plane text-warning mr-1"></i> Kirim Pengajuan</strong>
                        </div>
                        <p class="small text-muted mb-0">Setelah data dibuat (draft), klik tombol <strong>Kirim</strong> pada kolom <em>Status</em> agar dapat diverifikasi oleh operator.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="p-3 bg-light rounded h-100 border" style="border-left: 4px solid #36b9cc !important;">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge badge-info badge-pill mr-2 px-2 py-1">Langkah 3</span>
                            <strong class="text-gray-800"><i class="fas fa-user-check text-info mr-1"></i> Verifikasi Operator</strong>
                        </div>
                        <p class="small text-muted mb-0">Operator akan memvalidasi data dan memproses pembuatan surat (status menjadi <em>diajukan</em>).</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="p-3 bg-light rounded h-100 border" style="border-left: 4px solid #1cc88a !important;">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge badge-success badge-pill mr-2 px-2 py-1">Langkah 4</span>
                            <strong class="text-gray-800"><i class="fas fa-file-download text-success mr-1"></i> Unduh Dokumen</strong>
                        </div>
                        <p class="small text-muted mb-0">Surat yang telah selesai diproses (status <strong>selesai</strong>) dapat langsung diunduh melalui tombol <strong>Lihat Surat Selesai</strong> di halaman ini.</p>
                    </div>
                </div>
            </div>

            <!-- Notice Box -->
            <div class="alert alert-info mb-0 mt-2 py-2 px-3 small d-flex align-items-center border-0 shadow-sm" style="border-radius: 8px; background-color: #e8f4fd; color: #1e6091;">
                <i class="fas fa-cloud-download-alt mr-2 text-info" style="font-size: 1.3rem;"></i>
                <div>
                    <strong>Penting:</strong> Surat yang sudah selesai diproses dan ditandatangani <strong>akan otomatis muncul dan dapat di-download langsung pada tabel di halaman ini</strong> (pada kolom <em>Cetak Surat</em>).
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
            <div class="col-md-6">
                <a href="<?= base_url(); ?>surat/tambah" type="button" class="btn btn-primary btn-icon-split shadow-sm" style="border-radius: 8px;">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-square"></i> </span>
                    <span class="text font-weight-bold">Tambah Pengajuan</span></a>
            </div>
        </div>
    <?php endif; ?>


    <!-- DATA TABLES TAMBAHAN-->
    <div class="card shadow mb-4" style="border-radius: 12px;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list-alt mr-2"></i>Daftar Riwayat Pengajuan Surat Aktif Kuliah</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="DataTables_length" id="dataTable_length">

                                <table class="table table-hover" id="datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" width="5%">#</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Keperluan</th>
                                            <th scope="col">Create At</th>
                                            <th scope="col">Tahun Ajaran</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Cetak Surat</th>
                                 
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($surat as $s) { ?>
                                            <tr>
                                                <th scope="row" class="align-middle"><?= $i; ?></th>

                                                <td class="align-middle font-weight-bold">[-<?= $s['id_suratpengajuan']; ?>-]</td>
                                                <td class="align-middle"><?= $s['nama_keperluan']; ?> <?= $s['keterangan']; ?></td>
                                                <td class="align-middle"><?= date('d F Y', $s['date_create']); ?></td>
                                                <td class="align-middle"><?= $s['tahun_ajaran']; ?></td>
                                                <td class="align-middle"><?php
                                                    if (empty($s['status'])) {; ?>

                                                        <a href="<?= base_url(); ?>surat/edit/<?= $s['id_suratpengajuan']; ?>" class="btn btn-sm btn-warning btn-icon-split mb-1">
                                                            <span class="icon text-white-50">
                                                                <i class="far fa-edit"></i> </span>
                                                            <span class="text">Ubah</span>
                                                        </a>
                                                        <a href="<?= base_url(); ?>surat/hapus/<?= $s['id_suratpengajuan']; ?>" class="btn btn-sm btn-danger btn-icon-split mb-1">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                            <span class="text">Hapus</span>
                                                        </a>
                                                        <a href="<?= base_url(); ?>surat/kirim/<?= $s['id_suratpengajuan']; ?>" class="btn btn-sm btn-primary btn-icon-split mb-1">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-paper-plane"></i>
                                                            </span>
                                                            <span class="text">Kirim</span>
                                                        </a>

                                                    <?php
                                                    } else {
                                                        if ($s['status'] == 'diajukan') {
                                                            echo '<span class="badge badge-warning px-2 py-1"><i class="fas fa-clock mr-1"></i> Diajukan</span>';
                                                        } elseif ($s['status'] == 'selesai') {
                                                            echo '<span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Selesai</span>';
                                                        } else {
                                                            echo '<span class="badge badge-info px-2 py-1">' . htmlspecialchars($s['status']) . '</span>';
                                                        }
                                                        if (!empty($s['status_keterangan'])) {
                                                            echo '<div class="small text-muted mt-1">' . htmlspecialchars($s['status_keterangan']) . '</div>';
                                                        }
                                                    }; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?php if ($s['status_aktif'] == 1): ?>
                                                        <?php if ($s['status'] == 'diajukan'): ?>
                                                            <span class="text-muted small font-italic"><i class="fas fa-hourglass-half mr-1 text-warning"></i> Menunggu proses verifikasi operator</span>
                                                        <?php else: ?>
                                                            <?php if (!empty($s['date_finish']) && $s['date_finish'] > 0): ?>
                                                                <div class="small font-weight-bold text-gray-800"><?= date('d F Y', $s['date_finish']); ?></div>
                                                                <?php if (!empty($s['admin'])): ?>
                                                                    <div class="small text-muted"><i class="fas fa-user-shield mr-1"></i><?= $s['admin']; ?></div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            
                                                            <?php if ($s['status'] == 'selesai' && !empty($s['file_selesai'])): ?>
                                                                <a href="<?= base_url('assets/surat_selesai/' . $s['file_selesai']); ?>" target="_blank" class="btn btn-sm btn-primary mt-1 shadow-sm font-weight-bold" style="border-radius: 6px;">
                                                                    <i class="fas fa-download mr-1"></i> Lihat Surat Selesai
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary">Anda Tidak Lagi Aktif</span>
                                                    <?php endif; ?> 
                                                </td>

                                            </tr>
                                        <?php $i++;
                                        }
                                        ?>
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
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