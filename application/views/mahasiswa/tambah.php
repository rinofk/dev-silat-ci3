<div class="container">
    <div class="row mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Form Tambah Data Mahasiswa
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>


                    <form action="" method="post">
                        <div class="form-group row">
                            <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                            <div class="col-sm-9"> <input type="text" name="nim" class="form-control" id="nim">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9"> <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="<?= set_value('nama_lengkap'); ?>"></div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9"> <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?= set_value('tempat_lahir'); ?>"></div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9"> <input type="text" name="tgl_lahir" class="form-control" id="tgl_lahir" value="<?= set_value('tgl_lahir'); ?>"></div>
                        </div>
                        <div class="form-group row">
                            <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                            <div class="col-sm-9"> <input type="text" name="semester" class="form-control" id="semester" value="<?= set_value('semester'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahun_ajaran" class="col-sm-3 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-9"> <input type="text" name="tahun_ajaran" class="form-control" id="tahun_ajaran" value="<?= set_value('tahun_ajaran'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="program_studi" class="col-sm-3 col-form-label">Program Studi</label>
                            <div class="col-sm-9"> <select class="form-control" id="program_studi" name="program_studi">
                                    <option value="#">Pilih Prodi</option>
                                    <?php foreach ($prodi as $p) : ?>
                                        <option value="<?= $p['id'] ?>"><?= $p['nama_prodi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keperluan" class="col-sm-3 col-form-label">Keperluan</label>
                            <div class="col-sm-9">



                                <select class="form-control" id="keperluan" name="keperluan">
                                    <option value="#">Pilih Keperluan</option>

                                    <?php foreach ($keperluan as $k) : ?>
                                        <option value="<?= $k['nama_keperluan'] ?>"><?= $k['nama_keperluan'] ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keperluan_ket" class="col-sm-3 col-form-label">Keterangan Keperluan</label>
                            <div class="col-sm-9"> <input type="text" name="keperluan_ket" class="form-control" id="keperluan_ket" value="<?= set_value('keperluan_ket'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9"> <input type="text" name="alamat" class="form-control" id="alamat" value="<?= set_value('alamat'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ortu" class="col-sm-3 col-form-label">Nama Orang Tua</label>
                            <div class="col-sm-9"> <input type="text" name="ortu" class="form-control" id="ortu" value="<?= set_value('ortu'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nip" class="col-sm-3 col-form-label">NIP/NRP/NPS</label>
                            <div class="col-sm-9"> <input type="text" name="nip" class="form-control" id="nip" value="<?= set_value('nip'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pangkat" class="col-sm-3 col-form-label">Pangkat/ Golongan</label>
                            <div class="col-sm-9"> <input type="text" name="pangkat" class="form-control" id="pangkat" value="<?= set_value('pangkat'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="instansi" class="col-sm-3 col-form-label">Instansi</label>
                            <div class="col-sm-9"> <input type="text" name="instansi" class="form-control" id="instansi" value="<?= set_value('instansi'); ?>">
                            </div>
                        </div>

                        <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah Data</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>