<div class="container-fluid">

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Ajuan Surat <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mt-3">

        <!-- Detail Mahasiswa -->
        <div class="col-xl-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Data Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
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
                            <td>Tanggal Lulus Yudisium</td>
                            <td><?= $surat['tgl_lulus_sidang']; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <span class="badge 
                                    <?php if ($surat['status'] == 'proses') echo 'badge-warning';
                                          elseif ($surat['status'] == 'selesai') echo 'badge-success';
                                          else echo 'badge-secondary'; ?>">
                                    <?= ucfirst($surat['status']); ?>
                                </span>
                            </td>
                        </tr>
                    </table>

                    <hr>
                    <div class="d-flex flex-wrap">
                        <a href="<?= base_url('skl'); ?>" class="btn btn-secondary mr-2 mb-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="<?= base_url('skl/proses/' . $surat['id_skl']); ?>" class="btn btn-warning mr-2 mb-2">
                            <i class="far fa-edit"></i> Proses
                        </a>
                        <a href="<?= base_url('skl/delete/' . $surat['id_skl']); ?>" 
                           class="btn btn-danger mr-2 mb-2"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus data <?= $surat['nama_lengkap']; ?> [-<?= $surat['id_skl']; ?>-]?');">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Proses SKL -->
        <?php if ($surat['status'] == 'proses' || $surat['status'] == 'selesai') : ?>
        <div class="col-xl-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Proses Surat Keterangan Lulus</h6>
                </div>
                <div class="card-body">
                    <?= form_open_multipart('skl/prosesupdateskl/' . $surat['id_skl']); ?>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">NIM</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nim" value="<?= $surat['nim_alumni']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tahun Akademik</label>
                            <div class="col-sm-8">
                                <select name="thn_akademik" class="form-control">
                                    <option value="<?= $surat['thn_akademik']; ?>"><?= $surat['thn_akademik']; ?></option>
                                    <?php foreach (['2025/2026','2024/2025','2023/2024','2022/2023','2021/2022','2020/2021','2019/2020'] as $th) : ?>
                                        <option value="<?= $th; ?>"><?= $th; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Ganjil/Genap</label>
                            <div class="col-sm-8">
                                <select name="ganjilgenap" class="form-control">
                                    <option value="<?= $surat['ganjilgenap']; ?>"><?= $surat['ganjilgenap']; ?></option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Predikat</label>
                            <div class="col-sm-8">
                                <input type="text" name="predikat" class="form-control" value="<?= $surat['predikat']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">IPK</label>
                            <div class="col-sm-8">
                                <input type="text" name="ipk" class="form-control" value="<?= $surat['ipk']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Lulus Yudisium</label>
                            <div class="col-sm-8">
                                <input type="text" name="tgl_lulus" class="form-control datepicker" value="<?= $surat['tgl_lulus_sidang']; ?>">
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex flex-wrap">
                            <button type="submit" class="btn btn-primary mr-2 mb-2">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="<?= base_url('skl/cetak/' . $surat['id_skl']); ?>" target="_blank" class="btn btn-info mr-2 mb-2">
                                <i class="fas fa-print"></i> Cetak PDF
                            </a>
                            <a href="#" class="btn btn-success mr-2 mb-2" data-toggle="modal" data-target="#selesaiModal">
                                <i class="fas fa-upload"></i> Upload & Selesai
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Modal Upload Surat Selesai -->
    <div class="modal fade" id="selesaiModal" tabindex="-1" aria-labelledby="selesaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url('skl/selesai/' . $surat['id_skl']); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Surat Selesai</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih File Surat (PDF)</label>
                            <input type="file" class="form-control" name="file_surat" accept="application/pdf" required>
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

</div>
