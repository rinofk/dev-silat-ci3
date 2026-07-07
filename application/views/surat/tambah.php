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
                    <h6 class="m-0 font-weight-bold">Pengajuan Surat Baru</h6>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger shadow-sm" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open_multipart('surat/tambah'); ?>

                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label font-weight-bold text-gray-800">NIM</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="nim" class="form-control bg-light" id="nim" value="<?= $user['nim']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_lengkap" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Nama Lengkap</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="nama_lengkap" class="form-control bg-light" id="nama_lengkap" value="<?= $user['name']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="semester" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Semester</label>
                        <div class="col-sm-9">
                            <select id="semester" name="semester" class="form-control" value="<?= set_value('semester'); ?>">
                                <option value="">Silakan Pilih</option>
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
                                <option value="">Silakan Pilih</option>
                                <?php foreach ($years_list as $ta): ?>
                                    <option value="<?= $ta; ?>" <?= ($ta === $now_ta) ? 'selected' : ''; ?>>
                                        <?= $ta; ?><?= ($ta === $now_ta) ? ' (Tahun Sekarang)' : ''; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keperluan" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Keperluan</label>
                        <div class="col-sm-9">
                            <select id="keperluan" name="keperluan" class="form-control" value="<?= set_value('keperluan'); ?>">
                                <option value="">Silakan Pilih</option>
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
                        <label for="ktm" class="col-sm-3 col-form-label font-weight-bold text-gray-800">KTM (PDF)</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="ktm" name="ktm" accept="application/pdf">
                                <label class="custom-file-label" for="ktm">Upload KTM (format filename "nim-ktm.pdf")</label>
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan (id="keterangan") -->
                    <div id="keterangan" hidden>
                        <div class="form-group row">
                            <label for="keterangan_input" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" name="keterangan" id="keterangan_input" class="form-control" placeholder="Masukkan keterangan keperluan..." />
                            </div>
                        </div>
                    </div>

                    <!-- Lainnya (id="lainnya") -->
                    <div id="lainnya" hidden>
                        <div class="form-group row">
                            <label for="lainnya_input" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Keperluan Lainnya</label>
                            <div class="col-sm-9">
                                <input type="text" name="lainnya" id="lainnya_input" class="form-control" placeholder="Tuliskan keperluan lainnya..." />
                            </div>
                        </div>
                    </div>

                    <!-- Detail Orang Tua & Berkas tambahan (id="id_keperluan") -->
                    <div id="id_keperluan" hidden>
                        <hr class="my-4">
                        <h5 class="text-gray-800 font-weight-bold mb-3"><i class="fas fa-user-friends mr-1"></i> Data Orang Tua / Wali</h5>
                        
                        <div class="form-group row">
                            <label for="ortu" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Nama Orang Tua</label>
                            <div class="col-sm-9">
                                <input type="text" name="ortu" id="ortu" class="form-control" placeholder="Nama Ayah/Ibu/Wali" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nip" class="col-sm-3 col-form-label font-weight-bold text-gray-800">NIP / NRP / NPS</label>
                            <div class="col-sm-9">
                                <input type="text" name="nip" id="nip" class="form-control" placeholder="NIP/NRP/NPS Orang Tua" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="pangkat" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Pangkat / Golongan</label>
                            <div class="col-sm-9">
                                <input type="text" name="pangkat" id="pangkat" class="form-control" placeholder="Pangkat dan Golongan PNS/TNI/Polri" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="instansi" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Instansi</label>
                            <div class="col-sm-9">
                                <input type="text" name="instansi" id="instansi" class="form-control" placeholder="Nama instansi tempat bekerja" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="alamat_instansi" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Alamat Instansi</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat_instansi" id="alamat_instansi" class="form-control" placeholder="Alamat lengkap instansi tempat bekerja" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kk" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Kartu Keluarga (PDF)</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="kk" name="kk" accept="application/pdf">
                                    <label class="custom-file-label" for="kk">Upload KK (format filename "nim-kk.pdf")</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sk" class="col-sm-3 col-form-label font-weight-bold text-gray-800">SK Orang Tua (PDF)</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="sk" name="sk" accept="application/pdf">
                                    <label class="custom-file-label" for="sk">Upload SK (format filename "nim-sk.pdf")</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-sm-12 text-right">
                            <a href="<?= base_url('surat'); ?>" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50"><i class="fas fa-paper-plane"></i></span>
                                <span class="text">Kirim Pengajuan</span>
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

<!-- jQuery script to handle Bootstrap file input label updating -->
<script>
    $(document).ready(function() {
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>