<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!--<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>-->



    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data mahasiswa <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <!-- Basic Card Example -->
    <?php
    if ($status) {
        if ($status['status_alumni'] == 1) {; ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upload Pas Poto</h6>
                </div>
                <div class="card-body">

                    <?= form_open_multipart('alumni/upload'); ?>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?= $user['nim'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat Sekarang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $alumni['alamat_sekarang'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Pas Poto</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="<?= base_url('assets/img/alumni/') . $alumni['poto']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="poto" name="poto">
                                        <label class="custom-file-label" for="poto">Choose file, poto maks 4 Mb</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">UPDATE</button> 
                        </div>
                    </div>
                    </form>
                    <a href="<?= base_url(); ?>alumni/cetak/<?= $alumni['nim_alumni']; ?>" type="button" target='_blank' class="btn btn-outline-primary mb-3 float-right">Cetak</a>

                </div>
            </div>
    <?php }
    }; ?>


    <!-- DATA TABLES TAMBAHAN-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <?php
        if (empty($status['id_alumni'])) {; ?>
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <a href="<?= base_url(); ?>alumni/tambah" type="button" class="btn btn-outline-primary mb-3">Daftar Menjadi Alumni</a>
                    </div>
                </div>
            </div>
        <?php } else {; ?>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="card-body">

                        <table>
                            <tr>
                                <td width="200">Nama</td>
                                <td><?= $alumni['nama_lengkap']; ?></td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td><?= $alumni['nim_alumni']; ?></td>
                            </tr>
                            <tr>
                                <td>Tempat / tanggal lahir</td>
                                <td><?= $alumni['tempat_lahir']; ?>, <?= $alumni['tgl_lahir']; ?></td>
                            </tr>
                            <tr>
                                <td>Nomor Hp</td>
                                <td><?= $alumni['no_hp']; ?></td>
                            </tr>
                            <tr>
                                <td>email</td>
                                <td><?= $alumni['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><?= $alumni['alamat']; ?></td>
                            </tr>
                            <tr>
                                <td>Tahun Wisuda</td>
                                <td><?= $alumni['tahun_wisuda']; ?></td>
                            </tr>
                            <tr>
                                <td>Jalur Masuk</td>
                                <td><?= $alumni['jalur_masuk']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Prodi</td>
                                <td><?= $alumni['nama_prodi']; ?></td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td><?= $alumni['agamaa']; ?></td>
                            </tr>
                            <tr>
                                <td>Judul Skripsi</td>
                                <td><?= $alumni['judul_skripsi']; ?></td>
                            </tr>
                            <tr>
                                <td>Pesan dan Kesan</td>
                                <td><?= $alumni['pesan_kesan']; ?></td>
                            </tr>
                            </tr>
                        </table>

                    </div>

                    <div class="col-md-6">
                        <?php
                        if ($status['status_alumni'] == 0) {; ?>
                            <a href="<?= base_url(); ?>alumni/ubah/<?= $alumni['nim_alumni']; ?>" type="button" class="btn btn-outline-primary mb-3">Ubah</a>
                            <a href="<?= base_url(); ?>alumni/kirim/<?= $alumni['nim_alumni']; ?>" type="button" class="btn btn-outline-primary mb-3 float-right">Kirim</a>
                        <?php } else {; ?>

                            <!-- <a href="<?= base_url(); ?>alumni/cetak/<?= $alumni['nim_alumni']; ?>" type="button" target='_blank' class="btn btn-outline-primary mb-3 float-right">Cetak</a> -->

                        <?php }; ?>

                    </div>
                </div>
            </div>
        <?php }; ?>

        <!---->

    </DIV>
</div>
</div>