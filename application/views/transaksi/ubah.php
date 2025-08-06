<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Form Ubah Aktif Kuliah
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open_multipart('transaksi/ubah/' . $surat['id_suratpengajuan']); ?>

                    <!-- <form action="" method="post"> -->
                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                        <div class="col-sm-9"> <input type="text" name="nim" class="form-control" id="nim" value="<?= $surat['nim']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9"> <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="<?= $surat['nama_lengkap']; ?>" readonly></div>
                    </div>

                    <div class="form-group row">
                        <label for="semester" class="col-sm-3 col-form-label">semester</label>
                        <div class="col-sm-9">
                            <select id="semester" name="semester" class="form-control">
                                <option value="<?= $surat['semester']; ?>" selected><?= $surat['semester']; ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
             

                    <div class="form-group row">
                        <label for="tahun_ajaran" class="col-sm-3 col-form-label">Tahun ajaran</label>
                        <div class="col-sm-9">
                            <select id="tahun_ajaran" name="tahun_ajaran" class="form-control">
                                <option value="<?= $surat['tahun_ajaran']; ?>" selected><?= $surat['tahun_ajaran']; ?></option>
                                <option value="2025/2026">2025/2026</option>
                                <option value="2024/2025">2024/2025</option>
                                <option value="2023/2024">2023/2024</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2021/2022">2021/2022</option>
                                <option value="2020/2021">2020/2021</option>
                                <option value="2019/2020">2019/2020</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keperluan</label>
                        <div class="col-sm-9"> <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $surat['keterangan']; ?>" ></div>
                    </div>

                    <div class="form-group row" id="id_keperluan">
                        <label for="ortu" class="col-sm-3 col-form-label">Nama Orang Tua</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="ortu" class="form-control" value="<?= $surat['ortu']; ?>" />
                            </div>

                        </div>
                        <label for="nip" class="col-sm-3 col-form-label">NIP / NRP / NPS</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="nip" class="form-control" value="<?= $surat['nip']; ?>" />
                            </div>
                        </div>
                        <label for="pangkat" class="col-sm-3 col-form-label">Pangkat / Golongan</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="pangkat" class="form-control" value="<?= $surat['pangkat']; ?>" />
                            </div>
                        </div>
                        <label for="instansi" class="col-sm-3 col-form-label">Instansi</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="instansi" class="form-control" value="<?= $surat['instansi']; ?>" />
                            </div>
                        </div>
                        <label for="alamat_instansi" class="col-sm-3 col-form-label">Alamat Instansi</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="alamat_instansi" class="form-control" value="<?= $surat['alamat_instansi']; ?>">
                            </div>
                        </div>

                    </div>
                    <button type=" submit" class="btn btn-primary float-right">Ubah</button>
                    <!-- <button type="submit" class="btn btn-primary">UPLOAD</button> -->


                </div>
            </div>
        </div>
    </div>

</div>
</div>