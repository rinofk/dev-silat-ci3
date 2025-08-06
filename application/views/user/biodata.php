<div class="container-fluid">

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Biodata <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <div class="row mt-3">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    Form Biodata
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
                            <div class="col-sm-9">
                                <input type="text" name="nim" class="form-control" id="nim" value="<?= $user['nim'];?>" readonly>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="<?= set_value('nama_lengkap'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?= set_value('tempat_lahir'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                            
                                <input type="text" name="tgl_lahir" class="form-control datepicker" id="tgl_lahir" value="<?= set_value('tgl_lahir'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="program_studi" class="col-sm-3 col-form-label">Program Studi</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="program_studi" name="program_studi">
                                    <?php foreach ($prodi as $p) : ?>
                                        <?php if ($p['id_prodi'] == $mahasiswa['prodi_id']) : ?>

                                            <option value="<?= $p['id_prodi']; ?>" selected><?= $p['nama_prodi']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $p['id_prodi']; ?>"><?= $p['nama_prodi']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="alamat" class="form-control" id="alamat"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_hp" class="col-sm-3 col-form-label">No. Hp</label>
                            <div class="col-sm-9">
                                <input type="text" name="no_hp" class="form-control" id="no_hp" value="<?= set_value('no_hp'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="agama" name="agama">
                                    <?php foreach ($agama as $a) : ?>
                                               <option value="<?= $a['id_agama']; ?>"><?= $a['nama_agama']; ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="agamaa" class="col-sm-3 col-form-label">Ketik Kembali Nama Agama</label>
                            <div class="col-sm-9">
                                <input type="text" name="agamaa" class="form-control" id="agamaa" value="<?= set_value('agamaa'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9"> <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option >-- Pilih --</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>

                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_ayah" class="form-control" id="nama_ayah" value="<?= set_value('nama_ayah'); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_ibu" class="form-control" id="nama_ibu" value="<?= set_value('nama_ibu'); ?>">
                            </div>
                        </div>
                        
                        <button type="submit" name="ubah" class="btn btn-primary float-right"><i class="far fa-fw fa-edit"></i>Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
</div>