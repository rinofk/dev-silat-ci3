<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?php
    if (empty($ay['nim_mahasiswa'])) { 
        if (empty($periode['status_periode'])) {; ?>

        <div class="container"> 
            <div class="row mt-3">
                <div class="col-md-6">
                    Tidak Ada Periode Aktif
                    <!-- <a href="<?= base_url(); ?>berkas/tambahyudisium" type="button" class="btn btn-outline-primary mb-3">Ajukan Yudisium</a> -->
                </div>
            </div>
        </div>
        
    <?php } else {; ?>
        <div class="container"> 
            <div class="row mt-3">
                <div class="col-md-6">
                    Pendaftaran Yudisium telah di buka<br>
                    Masa Periode Pendaftaran dimulai Tanggal<br>
                    <?= tgl_indo($periode['tgl_mulai']); ?> s/d <?= tgl_indo($periode['tgl_selesai']); ?><br><br>
                    <a href="<?= base_url(); ?>berkas/tambahyudisium" type="button" class="btn btn-outline-primary mb-3">Ajukan Yudisium </a>
                </div>
            </div>
        </div>

    <?php }} else {; ?>
        <!-- Basic Card Example -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Berkas Yudisium</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <?= form_open_multipart('berkas/yudisium_update'); ?>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $mahasiswa['nama_lengkap'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nim" name="nim" value="<?= $mahasiswa['nim'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $mahasiswa['nama_prodi'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ttl" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ttl" name="ttl" value="<?= $mahasiswa['tempat_lahir'] . ', ' . $mahasiswa['tgl_lahir'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $mahasiswa['alamat'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $mahasiswa['no_hp'] ?>" readonly>
                                    </div>
                                </div>
              
                                <div class="form-group row">
                                    <label for="id_periode" class="col-sm-2 col-form-label">Periode</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_periode" name="id_periode" value="<?= $periode['id_periode'] ?>" hidden>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">Scan Transkrip Nilai</div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="transkrip" name="transkrip" aria-describedby="inputGroupFileAddon04">
                                                        <label class="custom-file-label" for="transkrip"><?= $ay['transkrip'] ?></label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/arsip/yudisium/<?= $ay['transkrip'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                format filename "nim_transkrip.pdf"
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4">Bukti Penyerahan Skripsi</div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="skripsi" name="skripsi" aria-describedby="inputGroupFileAddon04">
                                                        <label class="custom-file-label" for="skripsi"><?= $ay['skripsi'] ?></label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/arsip/yudisium/<?= $ay['skripsi'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                format filename "nim_skripsi.pdf"
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4">Kwitansi Pembayaran UKT</div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="ukt" name="ukt" aria-describedby="inputGroupFileAddon04">
                                                        <label class="custom-file-label" for="ukt"><?= $ay['ukt'] ?></label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/arsip/yudisium/<?= $ay['ukt'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                format filename "nim_ukt.pdf"
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4">Bukti Bebas Lab</div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="bebaslab" name="bebaslab" aria-describedby="inputGroupFileAddon04">
                                                        <label class="custom-file-label" for="bebaslab"><?= $ay['bebaslab'] ?></label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a href="<?= base_url(); ?>assets/arsip/yudisium/<?= $ay['bebaslab'] ?>" target="_blank" class="btn btn-outline-secondary">
                                                            Preview
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                format filename "nim_bebaslab.pdf"
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status" name="status" value="<?= $ay['status'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $ay['keterangan'] ?>" readonly>
                                    </div>
                                </div>
                                <?php
                                if (empty($ay['status'])) {; ?>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="<?= base_url(); ?>berkas/ajukanyudisium/<?= $ay['nim_mahasiswa']; ?>" class="btn btn-outline-primary"> KIRIM </a>
                                        </div>
                                    </div>
                                <?php }; ?>
                                <?php
                                if ($ay['status'] == 'di tolak') {; ?>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="<?= base_url(); ?>berkas/ajukanyudisium/<?= $ay['nim_mahasiswa']; ?>" class="btn btn-outline-primary"> Kirim </a>
                                        </div>
                                    </div>
                                <?php }; ?>
                                <!-- <?php
                                if ($ay['status'] == 'accept') {; ?>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-2">
                                            <a href="<?= base_url(); ?>perpustakaan/cetak/<?= $ay['nim_mahasiswa']; ?>" class="btn btn-outline-primary" target="blank"> Cetak </a>
                                        </div>
                                    </div>
                                <?php }; ?> -->

                                (* upload file max 2 mb, dalam bentuk file pdf)
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        
                    <p> - Untuk Bantuan Admin, Silakan Hubungi <a href="https://wa.me/6285391044299?text=Hai%20Admin%20Aplikasi%20Berkas%20Yudisium, " rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i> Admin Rino</a></p>

        
    <?php }; ?>

</div>

</div>
<!-- End of Main Content -->