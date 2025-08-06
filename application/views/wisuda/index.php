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
                    <h6 class="m-0 font-weight-bold text-primary">Berkas Wisuda</h6>
                </div>
                <?php
                if (empty($wisuda['nim_bw'])) {; ?>
                    <!-- <div class="container"> -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="container">Anda harus terdaftar sebagai alumni</div>

                        </div>
                    </div>
                    <!-- </div> -->
                <?php } else {; ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <?= form_open_multipart('wisuda/do_upload'); ?>
                                <div class="form-group row">
                                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nim" name="nim" value="<?= $user['nim'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-2">Kwitansi Pembayaran</div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="kwitansi" name="kwitansi">
                                                    <label class="custom-file-label" for="kwitansi"><?= $wisuda['kwitansi'] ?></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                format filename "nim-kwitansi.pdf"
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-2">Biodata Wisuda</div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="biodata" name="biodata">
                                                    <label class="custom-file-label" for="biodata"><?= $wisuda['biodata'] ?></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                format filename "nim-biodata.pdf"
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">UPLOAD</button>
                                    </div>
                                </div>
                                </form>
                            </div>

                        </div>

                    </div>
                <?php }; ?>
            </div>
        </div>
    </div>

</div>

</div>
<!-- End of Main Content -->