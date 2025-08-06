<div class="container-fluid">
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Berkas perpus <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <!-- Basic Card Example -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bebas Perpustakaan</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <?= form_open_multipart('pustakawan/accept/' . $perpus['id_bp']); ?>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $perpus['nama_lengkap'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nim" name="nim" value="<?= $perpus['nim'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $perpus['email'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $perpus['nama_prodi'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ttl" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ttl" name="ttl" value="<?= $perpus['tempat_lahir'] . ', ' . $perpus['tgl_lahir'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $perpus['alamat'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $perpus['no_hp'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="semester" name="semester" value="<?= $perpus['semester'] ?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-2">KTM</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="<?= $perpus['ktm'] ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/bebasperpus/<?= $perpus['ktm'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            format filename "nim_ktm.jpg"
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2">Kartu Anggota Perpustakaan</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="<?= $perpus['kartuperpus'] ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/bebasperpus/<?= $perpus['kartuperpus'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            format filename "nim_kartuanggota.jpg"
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nomor" class="col-sm-2 col-form-label">Nomor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nomor" name="nomor" value="<?= $perpus['nomor'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="status" name="status" value="<?= $perpus['status']; ?>, <?= $perpus['keterangan']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <a href="<?= base_url(); ?>pustakawan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                                    <!-- <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Accept</button> -->
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newRoleModalAccept"> <i class="fas fa-check"></i> Accept</a>
                                    <!-- <a href="<?= base_url(); ?>pustakawan/accept/<?= $perpus['id_bp']; ?>" class="btn btn-primary"> <i class="fas fa-check"></i> Accept</a> -->
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#newRoleModal"> <i class="fas fa-times"></i> Reject</a>
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newRoleModalTanggal"> <i class="fas fa-check"></i> Update Tanggal</a>
                                    <a href="<?= base_url(); ?>pustakawan/cetak/<?= $perpus['id_bp']; ?>" class="btn btn-outline-primary" target="blank"> Cetak </a>
                                </div>
                            </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>



    <!-- 
    <div class="row mt-3">
        <div class="col-xl">
            <div class="card">
                <div class="card-header">
                    Detail Berkas perpus
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="180">Nama</td>
                            <td><?= $perpus['nama_lengkap']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td><?= $perpus['tempat_lahir'] . ', ' . tgl_ind(date($perpus['tgl_lahir'])); ?></td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td><?= $perpus['nim']; ?></td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td><?= $perpus['nama_prodi']; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <h5 class="card-title"><b><?= $perpus['status']; ?>, </b><?= $perpus['keterangan']; ?></h5>
                            </td>
                        </tr>

                    </table>
                    <p class="card-text">
                        ---------------- ---------------- Lampiran ---------------- ----------------
                    </p>

                    <a href="<?= base_url(); ?>assets/bebasperpus/<?= $perpus['ktm']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">ktm</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/bebasperpus/<?= $perpus['kartuperpus']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">kartuperpus</span>
                    </a>

                    <p class="card-text">
                        ---------------- ---------------- ---------------- ---------------- ----------------
                    </p>
                    <a href="<?= base_url(); ?>pustakawan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                    <a href="<?= base_url(); ?>pustakawan/accept/<?= $perpus['id_bp']; ?>" class="btn btn-primary"> <i class="fas fa-check"></i> Accept</a>
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#newRoleModal"> <i class="fas fa-times"></i> Reject</a>


                </div>
            </div>
        </div>
    </div> -->
</div>
</div>


<!-- Modal Accept -->
<div class="modal fade" id="newRoleModalAccept" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Nomor Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pustakawan/accept/' . $perpus['id_bp']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nomor" name="nomor" value="<?= $perpus['nomor']; ?>">
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Accept</button>
                </div>
            </form>
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
            <form action="<?= base_url('pustakawan/reject/' . $perpus['id_bp']); ?>" method="post">
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


<!-- Modal Tanggal-->
<div class="modal fade" id="newRoleModalTanggal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalTanggal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalTanggal">Tanggal Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pustakawan/tanggal/' . $perpus['id_bp']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= $perpus['date_updated']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Tanggal</button>
                </div>
            </form>
        </div>
    </div>
</div>