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
                            <td>Tempat Lahir</td>
                            <td><?= $surat['tempat_lahir']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td><?= $surat['tgl_lahir']; ?></td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td><?= $surat['nim_mahasiswa']; ?></td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td><?= $surat['semester']; ?></td>
                        </tr>
                        <tr>
                            <td>Prodi</td>
                            <td><?= $surat['nama_prodi']; ?></td>
                        </tr>
                        <tr>
                            <td>Tahun Ajaran</td>
                            <td><?= $surat['tahun_ajaran']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?= $surat['alamat']; ?></td>
                        </tr>
                        <tr>
                            <td>Keperluan</td>
                            <td><?= $surat['nama_keperluan']; ?> <?= $surat['keterangan']; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                           <td>
                                <b><?= $surat['status']; ?></b>
                                <?php if (!empty($surat['status_keterangan'])): ?>
                                    &nbsp;<?= $surat['status_keterangan']; ?>
                                <?php endif; ?>
                                <br>
                            </td>

                        </tr>

                    </table>
                    <a href="<?= base_url(); ?>assets/aktifkuliah/<?= $surat['ktm']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">KTM</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/aktifkuliah/<?= $surat['kk']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Kartu Keluarga</span>
                    </a>
                    <a href="<?= base_url(); ?>assets/aktifkuliah/<?= $surat['sk']; ?>" target="_blank" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">sk</span>
                    </a>
                    <p class="card-text">
                        ---------------- detail info ----------------
                    </p>
                    <a href="<?= base_url(); ?>transaksi/aktifkuliah" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                    <!-- <a href="<?= base_url(); ?>transaksi/proses/<?= $surat['id_suratpengajuan']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Proses</a> -->

                    <a href="<?= base_url(); ?>transaksi/proses/<?= $surat['id_suratpengajuan']; ?>" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        <span class="text">Proses</span>
                    </a>
                    <a href="<?= base_url(); ?>transaksi/ubah/<?= $surat['id_suratpengajuan']; ?>" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        <span class="text">Ubah</span>
                    </a>
                    <!-- <a href="<?= base_url(); ?>transaksi/tolak/<?= $surat['id_suratpengajuan']; ?>" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        <span class="text">Tolak</span>
                    </a>  -->
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#newRoleModal"> <i class="fas fa-times"></i> Tolak</a>


                    <!-- <a href="<?= base_url(); ?>transaksi/selesai/<?= $surat['id_suratpengajuan']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Selesai</a> -->

                    <!-- <a href="<?= base_url(); ?>transaksi/selesai/<?= $surat['id_suratpengajuan']; ?>" class="btn btn-success btn-icon-split"> -->
                    <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#selesaiModal">
                     
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Selesai</span>
                    </a>
                   

                    <a href="<?= base_url(); ?>transaksi/cetak/<?= $surat['id_suratpengajuan']; ?>" target='_blank' class="btn btn-primary"><i class="fas fa-print"></i> Cetak Pdf</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Keterangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transaksi/tolak/' . $surat['id_suratpengajuan']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="status_keterangan" name="status_keterangan" placeholder="alasan di Tolak">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Upload Surat Selesai -->
<div class="modal fade" id="selesaiModal" tabindex="-1" role="dialog" aria-labelledby="selesaiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= base_url('transaksi/selesai/' . $surat['id_suratpengajuan']); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="selesaiModalLabel">Upload Surat Selesai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="file_surat">Pilih File Surat (PDF)</label>
            <input type="file" class="form-control" id="file_surat" name="file_surat" accept="application/pdf" required>
          </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Upload & Selesai</button>
        </div>
      </div>
    </form>
  </div>
</div>
