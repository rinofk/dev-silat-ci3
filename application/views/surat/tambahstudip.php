<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Pengajuan Surat Baru
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
                            <div class="col-sm-9"> <input type="text" name="nim" class="form-control" id="nim" value="<?= $user['nim']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9"> <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="<?= $user['name']; ?>" readonly></div>
                        </div>
                        <div class="form-group row">
                            <label for="judul_proposal" class="col-sm-3 col-form-label">Judul Proposal Penelitian</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="judul_proposal" class="form-control" id="judul_proposal"><?= set_value('judul_proposal'); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tujuan_surat" class="col-sm-3 col-form-label">Tujuan Surat</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="tujuan_surat" class="form-control" id="tujuan_surat"><?= set_value('tujuan_surat'); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat_tujuan" class="col-sm-3 col-form-label">Alamat Tujuan</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="alamat_tujuan" class="form-control" id="alamat_tujuan"><?= set_value('alamat_tujuan'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-3 col-form-label">Perihal</label>
                            <div class="col-sm-9"> <input type="text" name="perihal" class="form-control" id="perihal" value="<?= set_value('perihal'); ?>">
                            </div>
                        </div>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">ADD NEW</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
</div>