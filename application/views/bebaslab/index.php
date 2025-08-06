<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?php
    if (empty($bl['nim_mahasiswa'])) {; ?>
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-6">
                    <a href="<?= base_url(); ?>laboratorium/tambah" type="button" class="btn btn-outline-primary mb-3">Buat Surat Bebas Lab</a>
                </div>
            </div>
        </div>
    <?php } else {; ?>
        <!-- Basic Card Example -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Bebas laboratorium</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <?= form_open_multipart('laboratorium/do_update'); ?>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $mahasiswa['nama_lengkap'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nim" name="nim" value="<?= $mahasiswa['nim'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $mahasiswa['nama_prodi'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ttl" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ttl" name="ttl" value="<?= $mahasiswa['tempat_lahir'] . ', ' . $mahasiswa['tgl_lahir'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $mahasiswa['alamat'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $mahasiswa['no_hp'] ?>" readonly>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="semester" name="semester" value="<?= $bl['semester'] ?>">
                                    </div>
                                </div> -->


                                <div class="form-group row">
                                    <div class="col-sm-2">KTM</div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="ktm" name="ktm" aria-describedby="inputGroupFileAddon04">
                                                        <label class="custom-file-label" for="ktm"><?= $bl['ktm'] ?></label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/bebaslab/<?= $bl['ktm'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
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
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status" name="status" value="<?= $bl['status'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $bl['keterangan'] ?>" readonly>
                                    </div>
                                </div>
                                <?php
                                if (empty($bl['status'])) {; ?>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="<?= base_url(); ?>laboratorium/ajukan/<?= $bl['id_bebaslab']; ?>" class="btn btn-outline-primary"> KIRIM </a>
                                        </div>
                                    </div>
                                <?php }; ?>
                                <?php
                                if ($bl['status'] == 'reject') {; ?>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="<?= base_url(); ?>laboratorium/ajukan/<?= $bl['id_bebaslab']; ?>" class="btn btn-outline-primary"> Kirim </a>
                                        </div>
                                    </div>
                                <?php }; ?>
                                <?php
                                if ($bl['status'] == 'accept') {; ?>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-2">
                                            <a href="<?= base_url(); ?>laboratorium/cetak/<?= $bl['id_bebaslab']; ?>" class="btn btn-outline-primary" target="blank"> Cetak </a>
                                        </div>
                                    </div>
                                <?php }; ?>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php }; ?>

</div>

</div>
<!-- End of Main Content -->