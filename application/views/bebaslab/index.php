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
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
        overflow: hidden;
    }
    .card-custom-main .card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f3f9;
        padding: 20px 24px;
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
        padding: 15px 10px;
        text-align: center;
    }
    .table-custom tbody td {
        vertical-align: middle !important;
        color: #5a5c69;
        font-size: 0.85rem;
        padding: 14px 10px;
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

<div class="container-fluid px-4">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Pengajuan Bebas Laboratorium</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- CARD INFORMASI SISTEM -->
    <div class="alert alert-info shadow-sm border-left-primary mb-4">
        <h5 class="text-primary mb-3"><i class="fas fa-info-circle mr-2"></i> Informasi Pengajuan Bebas Lab</h5>
        <ul class="mb-0 pl-3">
            <li><b>Masa berlaku Surat Bebas Lab adalah 90 hari</b> sejak tanggal surat terbit.</li>
            <li><b>Mahasiswa dapat mengajukan kembali setelah 60 hari</b> sejak pengajuan terakhir.</li>
            <li>Pastikan data diri dan berkas KTM Anda sudah lengkap dan jelas sebelum mengajukan.</li>
        </ul>
    </div>

    <!-- tombol tambah pengajuan -->
    <div class="mb-4">
        <a href="<?= base_url('laboratorium/tambah'); ?>" class="btn btn-custom-add">
            <i class="fas fa-plus mr-2"></i> Buat Pengajuan Baru
        </a>
    </div>

    <!-- daftar pengajuan -->
    <div class="card card-custom-main shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list-alt mr-2"></i>Daftar Riwayat Pengajuan</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-custom" id="tblPengajuan">
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
                                <td class="text-center align-middle font-weight-bold"><?= $p['id_bebaslab']; ?></td>
                                <td class="text-center align-middle"><?= htmlspecialchars(strtoupper($p['nim_mahasiswa'])); ?></td>

                                <td class="text-center align-middle">
                                    <?php if ($p['status'] == 'di ajukan'): ?>
                                        <span class="badge-pill-custom badge-status-diajukan">Diajukan</span>
                                    <?php elseif ($p['status'] == 'proses'): ?>
                                        <span class="badge-pill-custom badge-status-diproses">Diproses</span>
                                    <?php elseif ($p['status'] == 'reject'): ?>
                                        <span class="badge-pill-custom badge-status-ditolak">Ditolak</span>
                                    <?php elseif ($p['status'] == 'accept'): ?>
                                        <span class="badge-pill-custom badge-status-diterima">Diterima</span>
                                    <?php else: ?>
                                        <span class="badge-pill-custom badge-status-draft">Draft</span>
                                    <?php endif; ?>
                                    <?php if (!empty($p['keterangan'])): ?>
                                        <div class="mt-1" style="line-height: 1.2;">
                                            <span class="text-danger small font-italic" style="font-size: 11px;"><?= htmlspecialchars($p['keterangan']); ?></span>
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
                                            <span style="font-size: 10px; font-weight: 600;">Belum Upload / Default</span>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="text-center align-middle font-weight-bold"><?= date('d-m-Y', strtotime($p['date_created'])); ?></td>
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
                                <td class="align-middle">
                                    <div class="btn-action-group">
                                        <!-- Tombol Edit -->
                                        <?php if ($p['status'] != 'di ajukan' && $p['status'] != 'accept'): ?>
                                            <a href="<?= base_url('laboratorium/edit/' . $p['id_bebaslab']); ?>"
                                                class="btn-action-custom btn-action-edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        <?php endif; ?>

                                        <!-- Tombol Ajukan -->
                                        <?php if ($p['status'] == '' || $p['status'] == 'reject'): ?>
                                            <a href="<?= base_url('laboratorium/ajukan/' . $p['id_bebaslab']); ?>"
                                                class="btn-action-custom btn-action-ajukan">
                                                <i class="fas fa-paper-plane"></i> Ajukan
                                            </a>
                                        <?php endif; ?>

                                        <!-- Tombol Delete -->
                                        <?php if ($p['status'] != 'accept' && $p['status'] != 'di ajukan' && $p['status'] != 'reject'): ?>
                                            <a href="<?= site_url('laboratorium/delete/' . $p['id_bebaslab']); ?>"
                                                class="btn-action-custom btn-action-hapus"
                                                onclick="return confirm('Yakin ingin menghapus data ini?');">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </a>
                                        <?php endif; ?>

                                        <!-- Tombol Cetak -->
                                        <?php if ($p['status'] == 'accept'): ?>
                                            <a href="<?= site_url('laboratorium/cetak/' . $p['id_bebaslab']); ?>"
                                                class="btn-action-custom btn-action-cetak" target="_blank">
                                                <i class="fas fa-print"></i> Cetak
                                            </a>
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

<script>
    $(document).ready(function() {
        $('#tblPengajuan').DataTable({
            scrollX: true,
            autoWidth: false,
            pageLength: 10,
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
    });
</script>
