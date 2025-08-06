<div class="container-fluid">
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Berkas wisuda <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <div class="row mt-3">
        <div class="col-xl">
            <div class="card">
                <div class="card-header">
                    Detail Berkas Wisuda
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="180">Nama</td>
                            <td><?= $wisuda['nama_lengkap']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td><?= $wisuda['tempat_lahir'] . ', ' . tgl_ind(date($wisuda['tgl_lahir'])); ?></td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td><?= $wisuda['nim']; ?></td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td><?= $wisuda['nama_prodi']; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <h5 class="card-title"><b><?= $wisuda['status']; ?>, </b><?= $wisuda['keterangan']; ?></h5>
                            </td>
                        </tr>

                    </table>
                    <p class="card-text">
                        ---------------- ---------------- Lampiran ---------------- ----------------
                    </p>
                    <a href="<?= base_url(); ?>assets/berkaswisuda/<?= $wisuda['kwitansi']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Kwitansi</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/berkaswisuda/<?= $wisuda['biodata']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Biodata</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/berkaswisuda/<?= $wisuda['biodata']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Biodata</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/berkaswisuda/<?= $wisuda['biodata']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Biodata</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/berkaswisuda/<?= $wisuda['biodata']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Biodata</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/berkaswisuda/<?= $wisuda['biodata']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Biodata</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/berkaswisuda/<?= $wisuda['biodata']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Biodata</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/berkaswisuda/<?= $wisuda['biodata']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Biodata</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/berkaswisuda/<?= $wisuda['biodata']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Biodata</span>
                    </a>

                    <p class="card-text">
                        ---------------- ---------------- ---------------- ---------------- ----------------
                    </p>
                    <a href="<?= base_url(); ?>adminwisuda" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                    <a href="<?= base_url(); ?>adminwisuda/accept/<?= $wisuda['id_bw']; ?>" class="btn btn-primary"> <i class="fas fa-check"></i> Accept</a>
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#newRoleModal"> <i class="fas fa-times"></i> Reject</a>


                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Keterangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('adminwisuda/reject/' . $wisuda['id_bw']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="alasan di reject">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>