<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?php
    if (empty($bp['nim_mahasiswa'])) {; ?>
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-6">
                    <a href="<?= base_url(); ?>perpustakaan/tambah" type="button" class="btn btn-outline-primary mb-3">Buat Surat Bebas Perpustakaan</a>
                </div>
            </div>
        </div>
    <?php } else {; ?>
        <!-- Basic Card Example -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Bebas Perpustakaan</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <?= form_open_multipart('perpustakaan/do_update'); ?>
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
                                <div class="form-group row">
                                    <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="semester" name="semester" value="<?= $bp['semester'] ?>">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-2">KTM</div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="ktm" name="ktm" aria-describedby="inputGroupFileAddon04">
                                                        <label class="custom-file-label" for="ktm"><?= $bp['ktm'] ?></label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/bebasperpus/<?= $bp['ktm'] ?>" target="_blank" class="btn btn-outline-secondary">
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
                                    <div class="col-sm-2">Kartu Anggota Perpustakaan</div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="anggota" name="anggota" aria-describedby="inputGroupFileAddon04">
                                                        <label class="custom-file-label" for="anggota"><?= $bp['kartuperpus'] ?></label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/bebasperpus/<?= $bp['kartuperpus'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
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
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status" name="status" value="<?= $bp['status'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $bp['keterangan'] ?>" readonly>
                                    </div>
                                </div>
                                <?php
                                if (empty($bp['status'])) {; ?>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="<?= base_url(); ?>perpustakaan/ajukan/<?= $bp['id_bp']; ?>" class="btn btn-outline-primary"> KIRIM </a>
                                        </div>
                                    </div>
                                <?php }; ?>
                                <?php
                                if ($bp['status'] == 'reject') {; ?>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="<?= base_url(); ?>perpustakaan/ajukan/<?= $bp['id_bp']; ?>" class="btn btn-outline-primary"> Kirim </a>
                                        </div>
                                    </div>
                                <?php }; ?>
                                <?php
                                if ($bp['status'] == 'accept') {; ?>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-2">
                                            <a href="<?= base_url(); ?>perpustakaan/cetak/<?= $bp['id_bp']; ?>" class="btn btn-outline-primary" target="blank"> Cetak </a>
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
        
                    <p> - Untuk Bantuan Admin, Silakan Hubungi <a href="https://wa.me/6281345434600?text=Hai%20Admin%20Aplikasi%20bebas%20Perpustakaan, " rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i> Admin Suryani</a></p>

        
    <?php }; ?>

</div>

</div>
<!-- End of Main Content -->