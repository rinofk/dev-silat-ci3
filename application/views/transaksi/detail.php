<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Pengajuan Surat Aktif Kuliah</h1>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    Ajuan Surat <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mt-3">
        <!-- Student Info Column -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-white border-bottom-primary">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-graduate mr-1"></i> Biodata & Detail Pengajuan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th width="30%" class="font-weight-bold text-gray-800">Nama Lengkap</th>
                                    <td><?= $surat['nama_lengkap']; ?></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold text-gray-800">NIM</th>
                                    <td><span class="font-weight-bold text-primary"><?= $surat['nim_mahasiswa']; ?></span></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold text-gray-800">No. HP / WhatsApp</th>
                                    <td>
                                        <?php 
                                        $no_hp = trim($surat['no_hp'] ?? '');
                                        if (!empty($no_hp)): 
                                            // Clean phone number format for WhatsApp link
                                            $no_hp_clean = preg_replace('/[^0-9]/', '', $no_hp);
                                            if (strpos($no_hp_clean, '0') === 0) {
                                                $no_hp_clean = '62' . substr($no_hp_clean, 1);
                                            } elseif (strpos($no_hp_clean, '8') === 0) {
                                                $no_hp_clean = '62' . $no_hp_clean;
                                            }
                                            $wa_url = "https://wa.me/" . $no_hp_clean;
                                        ?>
                                            <a href="<?= $wa_url; ?>" target="_blank" class="btn btn-sm btn-outline-success font-weight-bold shadow-sm">
                                                <i class="fab fa-whatsapp mr-1"></i> <?= htmlspecialchars($no_hp); ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted small"><em>Belum mengisi nomor HP</em></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold text-gray-800">Tempat / Tanggal Lahir</th>
                                    <td><?= $surat['tempat_lahir']; ?>, <?= date('d F Y', strtotime($surat['tgl_lahir'])); ?></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold text-gray-800">Program Studi</th>
                                    <td><?= $surat['nama_prodi']; ?></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold text-gray-800">Semester</th>
                                    <td><span class="badge badge-secondary px-2 py-1"><?= $surat['semester']; ?></span></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold text-gray-800">Tahun Ajaran</th>
                                    <td><?= $surat['tahun_ajaran']; ?></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold text-gray-800">Alamat Rumah</th>
                                    <td><?= $surat['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold text-gray-800">Keperluan Pengajuan</th>
                                    <td>
                                        <span class="font-weight-bold text-dark"><?= $surat['nama_keperluan']; ?></span>
                                        <?php if (!empty($surat['keterangan'])): ?>
                                            <br><small class="text-muted"><?= $surat['keterangan']; ?></small>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold text-gray-800">Status</th>
                                    <td>
                                        <?php
                                        $status_class = 'secondary';
                                        $status_label = $surat['status'];
                                        if ($surat['status'] == 'diajukan') {
                                            $status_class = 'primary';
                                        } elseif ($surat['status'] == 'proses') {
                                            $status_class = 'info';
                                        } elseif ($surat['status'] == 'selesai') {
                                            $status_class = 'success';
                                        } elseif (stripos($surat['status'], 'tolak') !== false || stripos($surat['status'], 'reject') !== false) {
                                            $status_class = 'danger';
                                        }
                                        ?>
                                        <span class="badge badge-<?= $status_class; ?> px-3 py-2 text-uppercase font-weight-bold"><?= $status_label; ?></span>
                                        <?php if (!empty($surat['status_keterangan'])): ?>
                                            <div class="alert alert-danger mt-2 mb-0 py-2 px-3 small shadow-sm">
                                                <strong>Keterangan Tolak:</strong> <?= $surat['status_keterangan']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attachments Column -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-white border-bottom-secondary">
                    <h6 class="m-0 font-weight-bold text-secondary"><i class="fas fa-paperclip mr-1"></i> Lampiran Dokumen</h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-3">Klik tombol tinjau untuk melihat pratinjau dokumen di sebelah kiri.</p>
                    
                    <div class="list-group">
                        <?php if(!empty($surat['ktm'])): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center mb-2 border rounded shadow-sm">
                                <span class="text-gray-800"><i class="fas fa-id-card text-secondary mr-2"></i> KTM</span>
                                <a href="<?= base_url(); ?>assets/aktifkuliah/<?= $surat['ktm']; ?>" data-name="KTM" class="btn btn-sm btn-outline-secondary border tinjau-btn"><i class="fas fa-eye"></i> Tinjau</a>
                            </div>
                        <?php else: ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center mb-2 border rounded disabled bg-light text-muted">
                                <span><i class="fas fa-id-card mr-2"></i> KTM (Tidak Ada)</span>
                            </div>
                        <?php endif; ?>

                        <?php if ($surat['keperluan'] == 1 || $surat['keperluan'] == 2): ?>
                            <?php if(!empty($surat['kk'])): ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center mb-2 border rounded shadow-sm">
                                    <span class="text-gray-800"><i class="fas fa-users text-secondary mr-2"></i> Kartu Keluarga</span>
                                    <a href="<?= base_url(); ?>assets/aktifkuliah/<?= $surat['kk']; ?>" data-name="Kartu Keluarga" class="btn btn-sm btn-outline-secondary border tinjau-btn"><i class="fas fa-eye"></i> Tinjau</a>
                                </div>
                            <?php else: ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center mb-2 border rounded disabled bg-light text-muted">
                                    <span><i class="fas fa-users mr-2"></i> KK (Tidak Ada)</span>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($surat['sk'])): ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center mb-2 border rounded shadow-sm">
                                    <span class="text-gray-800"><i class="fas fa-file-alt text-secondary mr-2"></i> SK Pangkat</span>
                                    <a href="<?= base_url(); ?>assets/aktifkuliah/<?= $surat['sk']; ?>" data-name="SK Pangkat" class="btn btn-sm btn-outline-secondary border tinjau-btn"><i class="fas fa-eye"></i> Tinjau</a>
                                </div>
                            <?php else: ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center mb-2 border rounded disabled bg-light text-muted">
                                    <span><i class="fas fa-file-alt mr-2"></i> SK (Tidak Ada)</span>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Row -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center py-3">
                    <a href="<?= base_url(); ?>transaksi/aktifkuliah" class="btn btn-secondary btn-icon-split mb-2">
                        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                        <span class="text">Kembali</span>
                    </a>
                    
                    <div class="d-flex flex-wrap justify-content-end mb-2">
                        <a href="<?= base_url(); ?>transaksi/proses/<?= $surat['id_suratpengajuan']; ?>" class="btn btn-info btn-icon-split mr-2 mb-1">
                            <span class="icon text-white-50"><i class="fas fa-spinner"></i></span>
                            <span class="text">Proses</span>
                        </a>
                        <a href="<?= base_url(); ?>transaksi/ubah/<?= $surat['id_suratpengajuan']; ?>" class="btn btn-warning btn-icon-split mr-2 mb-1">
                            <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                            <span class="text">Ubah</span>
                        </a>
                        <button class="btn btn-danger btn-icon-split mr-2 mb-1" data-toggle="modal" data-target="#newRoleModal">
                            <span class="icon text-white-50"><i class="fas fa-times"></i></span>
                            <span class="text">Tolak</span>
                        </button>
                        <button class="btn btn-success btn-icon-split mr-2 mb-1" data-toggle="modal" data-target="#selesaiModal">
                            <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                            <span class="text">Selesai</span>
                        </button>
                        <a href="<?= base_url(); ?>transaksi/cetak/<?= $surat['id_suratpengajuan']; ?>" target="_blank" class="btn btn-primary btn-icon-split mb-1">
                            <span class="icon text-white-50"><i class="fas fa-print"></i></span>
                            <span class="text">Cetak PDF</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Left Drawer for Document Preview -->
<div id="docDrawer" class="doc-drawer">
    <div class="doc-drawer-content">
        <div class="doc-drawer-header">
            <h5 class="doc-drawer-title font-weight-bold text-gray-800">Pratinjau Dokumen</h5>
            <div class="d-flex align-items-center">
                <a id="openNewTabBtn" href="#" target="_blank" class="btn btn-sm btn-outline-primary mr-3 shadow-sm">
                    <i class="fas fa-external-link-alt mr-1"></i> Tab Baru
                </a>
                <button type="button" class="close" id="closeDrawer" style="line-height:1; outline:none;">&times;</button>
            </div>
        </div>
        <div class="doc-drawer-body">
            <iframe id="docFrame" src="" style="width:100%; height:100%; border:none; display:none;"></iframe>
            <div id="imgPreviewContainer" class="text-center" style="display:none; height:100%; overflow:auto;">
                <img id="imgPreview" src="" class="img-fluid" style="max-height:100%; object-fit: contain;">
            </div>
        </div>
    </div>
</div>
<div class="doc-drawer-overlay"></div>

<!-- Modal Tolak -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger text-white">
                <h5 class="modal-title font-weight-bold" id="newRoleModalLabel">Alasan Tolak Pengajuan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transaksi/tolak/' . $surat['id_suratpengajuan']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status_keterangan" class="font-weight-bold">Keterangan Alasan:</label>
                        <input type="text" class="form-control" id="status_keterangan" name="status_keterangan" placeholder="Masukkan alasan penolakan..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Tolak Pengajuan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Upload Surat Selesai -->
<div class="modal fade" id="selesaiModal" tabindex="-1" role="dialog" aria-labelledby="selesaiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= base_url('transaksi/selesai/' . $surat['id_suratpengajuan']); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header bg-gradient-success text-white">
          <h5 class="modal-title font-weight-bold" id="selesaiModalLabel">Selesaikan & Upload Surat</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="file_surat" class="font-weight-bold">Pilih File Surat Selesai (PDF)</label>
            <input type="file" class="form-control" id="file_surat" name="file_surat" accept="application/pdf" required>
            <small class="form-text text-muted">Hanya berkas format PDF yang diizinkan.</small>
          </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Upload & Selesai</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Custom CSS for Left Drawer -->
<style>
    .doc-drawer {
        position: fixed;
        top: 0;
        left: -900px;
        width: 850px;
        height: 100vh;
        z-index: 1060;
        transition: left 0.3s ease-in-out;
        display: flex;
        flex-direction: row;
    }
    @media (max-width: 768px) {
        .doc-drawer {
            width: 100%;
            left: -100%;
        }
    }
    .doc-drawer.open {
        left: 0;
    }
    .doc-drawer-content {
        width: 100%;
        height: 100%;
        background-color: #fff;
        box-shadow: 5px 0 15px rgba(0,0,0,0.15);
        display: flex;
        flex-direction: column;
    }
    .doc-drawer-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e3e6f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f8f9fc;
    }
    .doc-drawer-title {
        margin: 0;
    }
    .doc-drawer-body {
        flex: 1;
        padding: 1rem;
        background-color: #eaecf4;
        overflow: hidden;
        height: calc(100vh - 65px);
    }
    .doc-drawer-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0,0,0,0.4);
        z-index: 1050;
        display: none;
    }
</style>

<!-- jQuery script for handling the left drawer and loading document previews -->
<script>
    $(document).ready(function() {
        $('.tinjau-btn').on('click', function(e) {
            e.preventDefault();
            var fileUrl = $(this).attr('href');
            var fileName = $(this).data('name');
            
            $('.doc-drawer-title').text('Pratinjau Dokumen: ' + fileName);
            $('#openNewTabBtn').attr('href', fileUrl);
            
            // Detect if image or PDF
            var isImg = fileUrl.match(/\.(jpeg|jpg|gif|png|webp)$/i);
            if (isImg) {
                $('#docFrame').hide().attr('src', '');
                $('#imgPreview').attr('src', fileUrl);
                $('#imgPreviewContainer').show();
            } else {
                $('#imgPreviewContainer').hide().find('img').attr('src', '');
                $('#docFrame').show().attr('src', fileUrl);
            }
            
            $('#docDrawer').addClass('open');
            $('.doc-drawer-overlay').fadeIn(200);
        });
        
        $('#closeDrawer, .doc-drawer-overlay').on('click', function() {
            $('#docDrawer').removeClass('open');
            $('.doc-drawer-overlay').fadeOut(200);
            
            // Clear sources after animation completes to avoid loading resource in background
            setTimeout(function() {
                $('#docFrame').attr('src', '');
                $('#imgPreview').attr('src', '');
                $('#openNewTabBtn').attr('href', '#');
            }, 300);
        });
    });
</script>
