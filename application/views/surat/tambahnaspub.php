<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-xl-8">
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

                    <?= form_open_multipart('surat/tambahnaspub'); ?>

                    <!-- <form action="" method="post"> -->
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
                        <label for="judul_naspub" class="col-sm-3 col-form-label">Judul Naskah Publikasi</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="judul_naspub" class="form-control" id="judul_naspub"><?= set_value('judul_naspub'); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="abstrack" class="col-sm-3 col-form-label">Abstrack</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="abstrack" class="form-control" id="abstrack"><?= set_value('abstrack'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pembimbing" class="col-sm-3 col-form-label">Pembimbing Utama</label>
                        <div class="col-sm-9"> <input type="text" name="pembimbing" class="form-control" id="pembimbing" value="<?= set_value('pembimbing'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nip" class="col-sm-3 col-form-label">NIP/ NIDK</label>
                        <div class="col-sm-9"> <input type="text" name="nip" class="form-control" id="nip" value="<?= set_value('nip'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="naspub" class="col-sm-3 col-form-label">Softfile Jurnal</label>
                        <div class="col-sm-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="naspub" name="naspub">
                                <label class="custom-file-label" for="naspub">file dalam bentuk pdf</label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            format filename "jurnal_nim.pdf"
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ket" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9"> <input type="text" name="ket" class="form-control" id="ket" value="<?= set_value('ket'); ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">ADD NEW</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
</div>