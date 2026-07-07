<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Alumni</h6>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('flash_error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $this->session->flashdata('flash_error'); ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open_multipart('admin/alumni_tambah'); ?>

                    <div class="form-group row">
                        <label for="nim_alumni" class="col-sm-3 col-form-label font-weight-bold">Mahasiswa <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="nim_alumni" class="form-control" id="nim_alumni" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                <?php foreach ($students as $s): ?>
                                    <option value="<?= $s['nim']; ?>" <?= set_select('nim_alumni', $s['nim']); ?>>
                                        <?= $s['nim']; ?> - <?= $s['nama_lengkap']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-muted">Hanya menampilkan mahasiswa yang belum terdaftar di Data Alumni.</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="thn_akademik" class="col-sm-3 col-form-label font-weight-bold">Tahun Akademik</label>
                        <div class="col-sm-9">
                            <input type="text" name="thn_akademik" class="form-control" id="thn_akademik" placeholder="Contoh: 2025/2026" value="<?= set_value('thn_akademik'); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ganjilgenap" class="col-sm-3 col-form-label font-weight-bold">Semester</label>
                        <div class="col-sm-9">
                            <select name="ganjilgenap" class="form-control" id="ganjilgenap">
                                <option value="Ganjil" <?= set_select('ganjilgenap', 'Ganjil'); ?>>Ganjil</option>
                                <option value="Genap" <?= set_select('ganjilgenap', 'Genap'); ?>>Genap</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tahun_wisuda" class="col-sm-3 col-form-label font-weight-bold">Tahun Wisuda <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="tahun_wisuda" class="form-control" id="tahun_wisuda" placeholder="Contoh: 2026" value="<?= set_value('tahun_wisuda'); ?>" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jalur_masuk" class="col-sm-3 col-form-label font-weight-bold">Jalur Masuk</label>
                        <div class="col-sm-9">
                            <input type="text" name="jalur_masuk" class="form-control" id="jalur_masuk" placeholder="Contoh: SNMPTN, SBMPTN, Mandiri" value="<?= set_value('jalur_masuk'); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ipk" class="col-sm-3 col-form-label font-weight-bold">IPK <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="ipk" class="form-control" id="ipk" placeholder="Contoh: 3.75" value="<?= set_value('ipk'); ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="predikat" class="col-sm-3 col-form-label font-weight-bold">Predikat</label>
                        <div class="col-sm-9">
                            <input type="text" name="predikat" class="form-control" id="predikat" placeholder="Contoh: Dengan Pujian, Sangat Memuaskan" value="<?= set_value('predikat'); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_lulus_sidang" class="col-sm-3 col-form-label font-weight-bold">Tanggal Lulus Sidang</label>
                        <div class="col-sm-9">
                            <input type="text" name="tgl_lulus_sidang" class="form-control datepicker" id="tgl_lulus_sidang" placeholder="YYYY-MM-DD" value="<?= set_value('tgl_lulus_sidang'); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_lulus_yudisium" class="col-sm-3 col-form-label font-weight-bold">Tanggal Lulus Yudisium</label>
                        <div class="col-sm-9">
                            <input type="text" name="tgl_lulus_yudisium" class="form-control datepicker" id="tgl_lulus_yudisium" placeholder="YYYY-MM-DD" value="<?= set_value('tgl_lulus_yudisium'); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat_sekarang" class="col-sm-3 col-form-label font-weight-bold">Alamat Sekarang</label>
                        <div class="col-sm-9">
                            <textarea name="alamat_sekarang" class="form-control" id="alamat_sekarang" rows="3" placeholder="Alamat tinggal alumni saat ini"><?= set_value('alamat_sekarang'); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="judul_skripsi" class="col-sm-3 col-form-label font-weight-bold">Judul Skripsi <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <textarea name="judul_skripsi" class="form-control" id="judul_skripsi" rows="3" placeholder="Judul tugas akhir / skripsi" required><?= set_value('judul_skripsi'); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pesan_kesan" class="col-sm-3 col-form-label font-weight-bold">Pesan & Kesan</label>
                        <div class="col-sm-9">
                            <textarea name="pesan_kesan" class="form-control" id="pesan_kesan" rows="3" placeholder="Pesan dan kesan selama kuliah"><?= set_value('pesan_kesan'); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status_alumni" class="col-sm-3 col-form-label font-weight-bold">Status Alumni</label>
                        <div class="col-sm-9">
                            <select name="status_alumni" class="form-control" id="status_alumni">
                                <option value="0" <?= set_select('status_alumni', '0'); ?>>Diajukan / Belum Aktif</option>
                                <option value="1" <?= set_select('status_alumni', '1', TRUE); ?>>Aktif / Terverifikasi</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="poto" class="col-sm-3 col-form-label font-weight-bold">Foto Alumni</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="poto" name="poto">
                                <label class="custom-file-label" for="poto">Pilih foto (Maks. 4MB, formats: gif/jpg/jpeg/png)</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-sm-12 text-right">
                            <a href="<?= base_url('admin/alumni'); ?>" class="btn btn-secondary mr-2">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
