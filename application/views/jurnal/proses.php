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
                            <td><?= $user['email']; ?></td>
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
                    <p class="card-text">
                        ---------------- detail info ----------------
                    </p>

                    <form action="" method="post">
                        
                        <div class="form-group row">
                            <label for="nomorsurat" class="col-sm-3 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9"> <input type="text" name="nomorsurat" class="form-control" id="nomorsurat" value="<?= $surat['nomorsurat']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="link" class="col-sm-3 col-form-label">Link</label>
                            <div class="col-sm-9"> <input type="text" name="link" class="form-control" id="link" value="<?= $surat['link']; ?>">
                            </div>
                        </div>

                        <button type="submit" name="tambah" class="btn btn-primary float-right">Simpan</button>
                    </form>

                    <a href="<?= base_url(); ?>jurnal/detail/<?= $surat['id_naspub']; ?>" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                    <!-- <a href="<?= base_url(); ?>jurnal/proses/<?= $surat['id_naspub']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Proses</a> -->
                    <!-- <a href="<?= base_url(); ?>jurnal/selesai/<?= $surat['id_naspub']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Selesai</a> -->

                </div>
            </div>
        </div>
    </div>
</div>
</div>