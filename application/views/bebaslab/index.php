<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h4 mb-4 text-gray-800">Pengajuan Bebas Lab</h1>

    <div class="row mb-3">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- tombol tambah pengajuan -->
    <div class="row mb-3">
        <div class="col-md-4">
            <a href="<?= base_url('laboratorium/tambah'); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Pengajuan Baru
            </a>
        </div>
    </div>

    <!-- daftar pengajuan -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tblPengajuan">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>ID Surat</th>
                            <th>Nim</th>
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
                                <td><?= $no++; ?></td>
                                <td><?= $p['id_bebaslab']; ?></td>
                                <td><?= $p['nim_mahasiswa']; ?></td>

                                <td>
                                    <?php if ($p['status'] == 'di ajukan'): ?>
                                        <span class="badge badge-secondary">di Ajukan</span>
                                    <?php elseif ($p['status'] == 'proses'): ?>
                                        <span class="badge badge-warning">Diproses</span>
                                    <?php elseif ($p['status'] == 'reject'): ?>
                                        <span class="badge badge-danger">Ditolak</span>
                                    <?php elseif ($p['status'] == 'accept'): ?>
                                        <span class="badge badge-success">Diterima</span>
                                    <?php endif; ?>
                                    <br> <?= $p['keterangan']; ?>
                                </td>

                                <td>
                                    <?php if (!empty($p['ktm'])): ?>
                                        <img src="<?= base_url('assets/bebaslab/' . $p['ktm']); ?>"
                                            width="120" class="mb-2">
                                    <?php endif; ?>
                                    <!-- <?php if (!empty($p['ktm'])): ?>
                                    <a href="<?= base_url('assets/bebaslab/' . $p['ktm']); ?>" target="_blank">Lihat</a> -->
                                <?php else: ?>
                                    <span class="text-muted">Belum upload</span>
                                <?php endif; ?>
                                </td>
                                <td><?= date('Y-m-d', strtotime($p['date_created'])); ?></td>
                                <td><?php if ($p['date_finished'] != '1970-01-01' && !empty($p['date_finished'])): ?>
                                        <?= $p['date_finished']; ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($p['berlaku_sampai'])): ?>
                                        <?= $p['berlaku_sampai']; ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">

                                        <!-- Tombol Edit (tampil jika status bukan 'di ajukan' dan bukan 'accept') -->
                                        <?php if ($p['status'] != 'di ajukan' && $p['status'] != 'accept'): ?>
                                            <a href="<?= base_url('laboratorium/edit/' . $p['id_bebaslab']); ?>"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        <?php endif; ?>

                                        <!-- Tombol Ajukan (tampil jika status kosong atau 'reject') -->
                                        <?php if ($p['status'] == '' || $p['status'] == 'reject'): ?>
                                            <a href="<?= base_url('laboratorium/ajukan/' . $p['id_bebaslab']); ?>"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-paper-plane"></i> Ajukan
                                            </a>
                                        <?php endif; ?>

                                        <!-- Tombol Delete (tampil jika status bukan 'accept', bukan 'di ajukan', dan bukan 'reject') -->
                                        <?php if ($p['status'] != 'accept' && $p['status'] != 'di ajukan' && $p['status'] != 'reject'): ?>
                                            <a href="<?= site_url('laboratorium/delete/' . $p['id_bebaslab']); ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data ini?');">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </a>
                                        <?php endif; ?>

                                        <!-- Tombol Cetak (hanya status accept) -->
                                        <?php if ($p['status'] == 'accept'): ?>
                                            <a href="<?= site_url('laboratorium/cetak/' . $p['id_bebaslab']); ?>"
                                                class="btn btn-sm btn-info" target="_blank">
                                                <i class="fas fa-print"></i> Cetak
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($pengajuan)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada pengajuan</td>
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
            ordering: true
        });
    });
</script>