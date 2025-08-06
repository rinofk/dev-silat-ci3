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
                    Detail Penagihan Praktek Klinik
                </div>
                <div class="card-body">
                    <table>
   
                        <tr>
                            <td>Tanggal Penagihan</td>
                            <td><?= $klinik['tgl_penagihan']; ?></td>
                        </tr>
         
                        <tr>
                            <td>Status Penagihan</td>
                            <td><?= $klinik['status_penagihan']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pembayaran</td>
                            <td><?= $klinik['tgl_pembayaran']; ?></td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td><?= $klinik['status_pembayaran']; ?></td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td><?= $klinik['status']; ?></td>
                        </tr>

                    </table>
                    <a href="<?= base_url(); ?>klinikbpp/update/<?= $klinik['id_praktekklinik']; ?>"  class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Update</span>
                    </a>
                    <p class="card-text">
                        ---------------- detail info ----------------
                    </p>
                    <a href="<?= base_url(); ?>praktekbpp/yudisium" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                    <a href="<?= base_url(); ?>skl/prosesyudisium/<?= $klinik['id_skl']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Proses</a>
                    <a href="<?= base_url(); ?>skl/selesaiyudisium/<?= $klinik['id_skl']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Selesai</a>
                    <a href="<?= base_url(); ?>skl/cetakyudisium/<?= $klinik['id_skl']; ?>" target='_blank' class="btn btn-primary"><i class="fas fa-print"></i> Cetak Pdf</a>

                </div>
            </div>
        </div>
    </div>
</div>
</div>