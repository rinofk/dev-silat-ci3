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
                    Detail Data Mahasiswa
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="120">Nama</td>
                            <td><?= $surat['nama_lengkap']; ?></td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td><?= $surat['nim']; ?></td>
                        </tr>
                        <tr>
                            <td>Judul Proposal Penelitian</td>
                            <td><?= $surat['judul_proposal']; ?></td>
                        </tr>
                        <tr>
                            <td>Tujuan Surat</td>
                            <td><?= $surat['tujuan_surat']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat Tujuan</td>
                            <td><?= $surat['alamat_tujuan']; ?></td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td><?= $surat['perihal']; ?></td>
                        </tr>

                        </tr>
                    </table>
                    <p class="card-text">
                        ---------------- detail info ----------------
                    </p>
                    <a href="<?= base_url(); ?>studi" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                    <a href="<?= base_url(); ?>studi/proses/<?= $surat['id_studip']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Proses</a>
                    <a href="<?= base_url(); ?>studi/selesai/<?= $surat['id_studip']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Selesai</a>
                    <a href="<?= base_url(); ?>studi/cetak/<?= $surat['id_studip']; ?>" target='_blank' class="btn btn-primary"><i class="fas fa-print"></i> Cetak Pdf</a>

                </div>
            </div>
        </div>
    </div>
</div>
</div>