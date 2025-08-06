<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Ubah Surat Pengajuan
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open_multipart('surat/ubah'); ?>

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
                                <option value="2025/2026" selected>2025/2026</option>
                                <option value="2024/2025" >2024/2025</option>
                                <option value="2023/2024" >2023/2024</option>
                                <option value="2022/2023" >2022/2023</option>
                                <option value="2021/2022">2021/2022</option>
                                <option value="2020/2021">2020/2021</option>
                                <option value="2019/2020">2019/2020</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keperluan" class="col-sm-3 col-form-label">Keperluan</label>
                        <div class="col-sm-9">
                            <select id="keperluan" name="keperluan" class="form-control">
                                <option value="<?= $surat['keperluan']; ?>"><?= $surat['nama_keperluan']; ?></option>
                                <option value="1">masuk dalam tunjangan gaji orang tua</option>
                                <option value="2">pensiun orang tua</option>
                                <option value="3">asuransi (askes)</option>
                                <option value="4">BPJS</option>
                                <option value="5">Pengajuan Beasiswa</option>
                                <option value="6">mengikuti kegiatan</option>
                                <option value="0">lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ktm" class="col-sm-3 col-form-label">KTM</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="ktm" name="ktm">
                                        <label class="custom-file-label" for="ktm" value="<?= $surat['keperluan']; ?>"><?= $surat['ktm']; ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    format filename "nim-ktm.pdf"
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" id="keterangan" value="" hidden>
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="keterangan" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="lainnya" value="" hidden>
                        <label for="lainnya" class="col-sm-3 col-form-label">lainnya</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="lainnya" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" id="id_keperluan" value="" hidden>
                        <label for="ortu" class="col-sm-3 col-form-label">Nama Orang Tua</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="ortu" class="form-control" />
                            </div>

                        </div>
                        <label for="nip" class="col-sm-3 col-form-label">NIP / NRP / NPS</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="nip" class="form-control" />
                            </div>
                        </div>
                        <label for="pangkat" class="col-sm-3 col-form-label">Pangkat / Golongan</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="pangkat" class="form-control" />
                            </div>
                        </div>
                        <label for="instansi" class="col-sm-3 col-form-label">Instansi</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="instansi" class="form-control" />
                            </div>
                        </div>
                        <label for="alamat_instansi" class="col-sm-3 col-form-label">Alamat Instansi</label>
                        <div class="col-sm-9">
                            <div class="col-sm-9">
                                <input type="text" name="alamat_instansi" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kk" class="col-sm-3 col-form-label">Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="kk" name="kk">
                                            <label class="custom-file-label" for="kk">upload KK</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        format filename "nim-kk.pdf"
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sk" class="col-sm-3 col-form-label">SK Terakhir Orang Tua</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="sk" name="sk">
                                            <label class="custom-file-label" for="sk">upload sk</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        format filename "nim-sk.pdf"
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Ubah</button>
                    <!-- <button type="submit" class="btn btn-primary">UPLOAD</button> -->

                    </!-->

                </div>
            </div>
        </div>
    </div>

</div>
</div>