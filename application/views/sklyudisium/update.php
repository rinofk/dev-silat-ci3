<div class="container-fluid">
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Ajuan Surat <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <div class="row mt-3">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Update SKL Yudisium Data Mahasiswa
                </div>
                
                <?= form_open_multipart('skl/updateyudisium/'.$surat['id_alumni']); ?>

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
                        <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Tanggal Lahir</label>
                        <div class="col-sm-9"> <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?= $surat['tempat_lahir'] . ', ' . tgl_ind(date($surat['tgl_lahir'])); ?>" readonly></div>
                    </div>

                    <div class="form-group row">
                        <label for="ipk" class="col-sm-3 col-form-label">IPK</label>
                        <div class="col-sm-9"> <input type="text" name="ipk" class="form-control" id="ipk" value="<?= $surat['ipk']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                            <label for="tgl_lulus" class="col-sm-3 col-form-label">Tanggal Lulus</label>
                            <div class="col-sm-9">
                                <input type="text" name="tgl_lulus" class="form-control datepicker" id="tgl_lulus" value="<?= $surat['tgl_lulus_yudisium']; ?>">
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                    <a href="<?= base_url(); ?>skl/detailyudisium/<?= $surat['id_skl']; ?>" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>   
                    </form> 
                
                
                <div class="card-body">
                    
                    <p class="card-text">
                        ---------------- detail info ----------------
                    </p>
                    <a href="<?= base_url(); ?>skl/yudisium" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                    <a href="<?= base_url(); ?>skl/prosesyudisium/<?= $surat['id_skl']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Proses</a>
                    <a href="<?= base_url(); ?>skl/selesaiyudisium/<?= $surat['id_skl']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Selesai</a>
                    <a href="<?= base_url(); ?>skl/cetakyudisium/<?= $surat['id_skl']; ?>" target='_blank' class="btn btn-primary"><i class="fas fa-print"></i> Cetak Pdf</a>

                </div>
            </div>
        </div>
    </div>
</div>
</div>