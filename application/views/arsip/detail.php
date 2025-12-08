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
                    <h6 class="m-0 font-weight-bold text-primary">Arsip Yudisium</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <?= form_open_multipart('pustakawan/accept/' . $ydetail['nim_mahasiswa']); ?>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $ydetail['nama_lengkap'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nim" name="nim" value="<?= $ydetail['nim'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $ydetail['email'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $ydetail['nama_prodi'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ttl" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ttl" name="ttl" value="<?= $ydetail['tempat_lahir'] . ', ' . $ydetail['tgl_lahir'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $ydetail['alamat'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $ydetail['no_hp'] ?>" readonly>
                                </div>
                            </div>



                            <div class="form-group row">
                                <div class="col-sm-2">Transkrip</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="<?= $ydetail['transkrip'] ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/arsip/yudisium/<?= $ydetail['transkrip'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            format filename "nim_transkrip.pdf"
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2">Bukti Penyerahan Skripsi</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="<?= $ydetail['skripsi'] ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/arsip/yudisium/<?= $ydetail['skripsi'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            format filename "nim_skripsi.pdf"
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-2">Kwitansi Pembayaran UKT</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="<?= $ydetail['ukt'] ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/arsip/yudisium/<?= $ydetail['ukt'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            format filename "nim_ukt.pdf"
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-2">Bukti Bebas Lab</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="<?= $ydetail['bebaslab'] ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/arsip/yudisium/<?= $ydetail['bebaslab'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            format filename "nim_bebaslab.pdf"
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="status" name="status" value="<?= $ydetail['status']; ?>, <?= $ydetail['keterangan']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <a href="<?= base_url(); ?>arsip/yudisium" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                                    <a href="<?= base_url('arsip/accept/' . $ydetail['nim_mahasiswa']); ?>" class="btn btn-primary"> <i class="fas fa-check"></i> Terima</a>
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#newRoleModal"> <i class="fas fa-times"></i> Tolak</a>
                                    <!-- <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newRoleModalTanggal"> <i class="fas fa-check"></i> Update Tanggal</a> -->
                                    <!-- <a href="<?= base_url(); ?>pustakawan/cetak/<?= $ydetail['nim_mahasiswa']; ?>" class="btn btn-outline-primary" target="blank"> Cetak </a> -->
                                </div>
                            </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
</div>



<!-- Modal Reject-->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Keterangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('arsip/reject/' . $ydetail['nim_mahasiswa']); ?>" method="post">
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
<!-- <div class="modal fade" id="newRoleModalTanggal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalTanggal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalTanggal">Tanggal Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pustakawan/tanggal/' . $ydetail['id_bp']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= $ydetail['date_updated']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Tanggal</button>
                </div>
            </form>
        </div>
    </div>
</div> -->