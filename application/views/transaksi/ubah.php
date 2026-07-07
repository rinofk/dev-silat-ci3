<?php
$current_year = date('Y');
$current_month = date('n');
if ($current_month >= 8) {
    $now_ta = $current_year . '/' . ($current_year + 1);
} else {
    $now_ta = ($current_year - 1) . '/' . $current_year;
}

$years_list = [];
$start_year = date('Y') + 1; 
for ($i = 0; $i < 3; $i++) {
    $y = $start_year - $i;
    $years_list[] = ($y - 1) . '/' . $y;
}
?>
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">Form Ubah Aktif Kuliah</h6>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger shadow-sm" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open_multipart('transaksi/ubah/' . $surat['id_suratpengajuan']); ?>

                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label font-weight-bold text-gray-800">NIM</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="nim" class="form-control bg-light" id="nim" value="<?= $surat['nim']; ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="nama_lengkap" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Nama Lengkap</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="nama_lengkap" class="form-control bg-light" id="nama_lengkap" value="<?= $surat['nama_lengkap']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="semester" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Semester</label>
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
                        <label for="tahun_ajaran" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Tahun Ajaran</label>
                        <div class="col-sm-9">
                            <select id="tahun_ajaran" name="tahun_ajaran" class="form-control">
                                <?php foreach ($years_list as $ta): ?>
                                    <option value="<?= $ta; ?>" <?= ($surat['tahun_ajaran'] === $ta) ? 'selected' : (($ta === $now_ta && empty($surat['tahun_ajaran'])) ? 'selected' : ''); ?>>
                                        <?= $ta; ?><?= ($ta === $now_ta) ? ' (Tahun Sekarang)' : ''; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Keperluan</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $surat['keterangan']; ?>" placeholder="Contoh: Pengajuan Beasiswa">
                        </div>
                    </div>

                    <hr class="my-4">
                    <h5 class="text-gray-800 font-weight-bold mb-3"><i class="fas fa-user-friends mr-1"></i> Data Orang Tua / Wali</h5>

                    <div id="id_keperluan">
                        <div class="form-group row">
                            <label for="ortu" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Nama Orang Tua</label>
                            <div class="col-sm-9">
                                <input type="text" name="ortu" id="ortu" class="form-control" value="<?= $surat['ortu']; ?>" placeholder="Nama Ayah/Ibu/Wali" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nip" class="col-sm-3 col-form-label font-weight-bold text-gray-800">NIP / NRP / NPS</label>
                            <div class="col-sm-9">
                                <input type="text" name="nip" id="nip" class="form-control" value="<?= $surat['nip']; ?>" placeholder="NIP/NRP/NPS Orang Tua" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="pangkat" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Pangkat / Golongan</label>
                            <div class="col-sm-9">
                                <input type="text" name="pangkat" id="pangkat" class="form-control" value="<?= $surat['pangkat']; ?>" placeholder="Pangkat dan Golongan PNS/TNI/Polri" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="instansi" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Instansi</label>
                            <div class="col-sm-9">
                                <input type="text" name="instansi" id="instansi" class="form-control" value="<?= $surat['instansi']; ?>" placeholder="Nama instansi tempat bekerja" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="alamat_instansi" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Alamat Instansi</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat_instansi" id="alamat_instansi" class="form-control" value="<?= $surat['alamat_instansi']; ?>" placeholder="Alamat lengkap instansi tempat bekerja">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-sm-12 text-right">
                            <a href="<?= base_url('transaksi/detail/' . $surat['id_suratpengajuan']); ?>" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50"><i class="fas fa-save"></i></span>
                                <span class="text">Simpan Perubahan</span>
                            </button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>