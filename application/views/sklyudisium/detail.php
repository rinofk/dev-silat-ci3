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
                    Detail SKL Yudisium Data Mahasiswa
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="180">Nama</td>
                            <td><?= $surat['nama_lengkap']; ?></td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td><?= $surat['nim']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td><?= $surat['tempat_lahir'] . ', ' . tgl_ind(date($surat['tgl_lahir'])); ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?= $surat['alamat_sekarang']; ?></td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td><?= $surat['nama_prodi']; ?></td>
                        </tr>
                        <tr>
                            <td>IPK</td>
                            <td><?= $surat['ipk']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lulus</td>
                            <td><?= $surat['tgl_lulus_yudisium']; ?></td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>
                                <h5 class="card-title"><b><?= $surat['status']; ?></b></h5>
                            </td>
                        </tr>
                    </table>
                    <a href="<?= base_url(); ?>skl/updateyudisium/<?= $surat['id_alumni']; ?>"  class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i> </span>
                        <span class="text">Update</span>
                    </a>
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