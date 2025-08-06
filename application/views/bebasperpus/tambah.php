<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

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
                            <?= form_open_multipart('perpustakaan/do_upload'); ?>
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
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $mahasiswa['no_hp'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="semester" name="semester" value="<?= set_value('semester'); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2">KTM</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="ktm" name="ktm">
                                                <label class="custom-file-label" for="ktm"></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            format filename "nim_ktm.jpg"
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2">Kartu Anggota Perpustakaan</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="anggota" name="anggota">
                                                <label class="custom-file-label" for="anggota"></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            format filename "nim_kartuanggota.jpg"
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
<!-- End of Main Content -->