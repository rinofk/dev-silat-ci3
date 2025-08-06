<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    Surat Keterangan Lulus
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
                            <label for="alamat_sekarang" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9"><textarea type="text" name="alamat_sekarang" class="form-control" id="alamat_sekarang"><?= $alumni['alamat_sekarang']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_lulus" class="col-sm-3 col-form-label">Tanggal Lulus Yudisium</label>
                            <div class="col-sm-9">
                                <input type="text" name="tgl_lulus" class="form-control datepicker" id="tgl_lulus" value="<?= $alumni['tgl_lulus_sidang']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ipk" class="col-sm-3 col-form-label">IPK</label>
                            <div class="col-sm-9"> <input type="text" name="ipk" class="form-control" id="ipk" value="<?= $alumni['ipk']; ?>"></div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="predikat" class="col-sm-3 col-form-label">Predikat</label>
                            <div class="col-sm-9"> <input type="text" name="predikat" class="form-control" id="predikat" value="<?= $alumni['predikat']; ?>"></div>
                        </div> -->
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Kirim</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
</div>