<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Daftar Alumni
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>


                    <form action="" method="post">
                        <div class="form-group row">
                            <label for="nim_alumni" class="col-sm-3 col-form-label">NIM</label>
                            <div class="col-sm-9"> <input type="text" name="nim_alumni" class="form-control" id="nim_alumni" value="<?= $user['nim']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahun_wisuda" class="col-sm-3 col-form-label">Tahun Wisuda</label>
                            <div class="col-sm-9"> <input type="text" name="tahun_wisuda" class="form-control" id="tahun_wisuda" value="<?= set_value('tahun_wisuda'); ?>"></div>
                        </div>
                        <div class="form-group row">
                            <label for="jalur_masuk" class="col-sm-3 col-form-label">Jalur Masuk</label>
                            <div class="col-sm-9"> <input type="text" name="jalur_masuk" class="form-control" id="jalur_masuk" value="<?= set_value('jalur_masuk'); ?>"></div>
                        </div>
                        <div class="form-group row">
                            <label for="judul_skripsi" class="col-sm-3 col-form-label">Judul Skripsi</label>
                            <div class="col-sm-9"><textarea type="text" name="judul_skripsi" class="form-control" id="judul_skripsi"><?= set_value('judul_skripsi') ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pesan_kesan" class="col-sm-3 col-form-label">Pesan Kesan</label>
                            <div class="col-sm-9"><textarea type="text" name="pesan_kesan" class="form-control" id="pesan_kesan"><?= set_value('pesan_kesan') ?></textarea>
                            </div>
                        </div>

                        <button type="submit" name="tambah" class="btn btn-primary float-right">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
</div>