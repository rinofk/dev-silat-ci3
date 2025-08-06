<div class="container-fluid">
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Ajuan Surat <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <div class="row mt-3">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Detail Data Mahasiswa
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="200">Nama</td>
                            <td><?= $surat['nama_lengkap']; ?></td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td><?= $surat['nim']; ?></td>
                        </tr>
                        <tr>
                            <td>e-Mail</td>
                            <td><?= $surat['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Pembimbing Utama</td>
                            <td><?= $surat['pembimbing']; ?></td>
                        </tr>
                        <tr>
                            <td>Judul Naspub</td>
                            <td><?= $surat['judul_naspub']; ?></td>
                        </tr>
                        <tr>
                            <td>Abstrack</td>
                            <td><?= $surat['abstrack']; ?></td>
                        </tr>
                    </table>
                    <a href="<?= base_url(); ?>assets/naspub/<?= $surat['naspub']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Soft File Naspub</span>
                    </a>
                    <a href="<?= base_url(); ?>jurnal/download/<?= $surat['naspub']; ?>" target="_blank" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Download File</span>
                    </a>
                   
                    <p class="card-text">
                        ---------------- detail info ----------------
                    </p>
                    status : <b><?= $surat['status']; ?></b><br>
                    Keterangan : <b><?= $surat['ket']; ?></b>
                     <p class="card-text">
                        ---------------- ----------- ----------------
                    </p>
                    <a href="<?= base_url(); ?>jurnal" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                    <a href="<?= base_url(); ?>jurnal/proses/<?= $surat['id_naspub']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Proses</a>
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#newRoleModal"> <i class="fas fa-times"></i> Reject</a>
                    <!-- <a href="<?= base_url(); ?>jurnal/selesai/<?= $surat['id_naspub']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Selesai</a> -->

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
            <form action="<?= base_url('jurnal/reject/' . $surat['id_naspub']); ?>" method="post">
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