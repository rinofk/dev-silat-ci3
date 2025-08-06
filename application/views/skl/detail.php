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
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    Detail Data Mahasiswa
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
                            <td>Tanggal Lulus Yudisium</td>
                            <td><?= $surat['tgl_lulus_sidang']; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <h5 class="card-title"><b><?= $surat['status']; ?></b></h5>
                            </td>
                        </tr>
                    </table>
                    <p class="card-text">
                        ---------------- detail info ----------------
                    </p>
                    <a href="<?= base_url(); ?>skl" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                    <a href="<?= base_url(); ?>skl/proses/<?= $surat['id_skl']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Proses</a>
                    <a href="<?= base_url(); ?>skl/delete/<?= $surat['id_skl']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin <?= $surat['nama_lengkap']; ?> [-<?= $surat['id_skl']; ?>-] data ini di HAPUS');"><i class="fas fa-trash"></i> Delete</a>

                </div>
            </div>
        </div>

        <!-- Basic Card Example -->
        <?php
        if ($surat['status'] == 'proses') {; ?>
            <div class="col-xl-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Surat Keterangan Lulus</h6>
                    </div>
                    <div class="card-body">

                        <?= form_open_multipart('skl/prosesupdateskl/' . $surat['id_skl']); ?>
                        <div class="form-group row">
                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nim" name="nim" value="<?= $surat['nim_alumni'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="thn_akademik" class="col-sm-2 col-form-label">Tahun Akademik</label>
                            <div class="col-sm-10">
                                <select id="thn_akademik" name="thn_akademik" class="form-control">
                                    <option value="<?= $surat['thn_akademik'] ?>"><?= $surat['thn_akademik'] ?></option>
                                    <option value="2024/2025">2024/2025 </option>
                                    <option value="2023/2024">2023/2024 </option>
                                    <option value="2022/2023">2022/2023 </option>
                                    <option value="2021/2022">2021/2022 </option>
                                    <option value="2020/2021">2020/2021</option>
                                    <option value="2019/2020">2019/2020 </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ganjilgenap" class="col-sm-2 col-form-label">Ganji/Genap</label>
                            <div class="col-sm-10">
                                <select id="ganjilgenap" name="ganjilgenap" class="form-control" value="<?= set_value('ganjilgenap'); ?>">>
                                    <option value="<?= $surat['ganjilgenap'] ?>"><?= $surat['ganjilgenap'] ?></option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select> </div>
                        </div>
                        <div class="form-group row">
                            <label for="predikat" class="col-sm-2 col-form-label">Predikat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="predikat" name="predikat" value="<?= $surat['predikat'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ipk" name="ipk" value="<?= $surat['ipk'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_lulus" class="col-sm-2 col-form-label">Tanggal Lulus Yudisium</label>
                            <div class="col-sm-10">
                                 <input type="text" name="tgl_lulus" class="form-control datepicker" id="tgl_lulus" value="<?= $surat['tgl_lulus_sidang']; ?>">
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="<?= base_url(); ?>skl/selesai/<?= $surat['id_skl']; ?>" class="btn btn-primary"><i class="far fa-edit"></i> Selesai</a>
                                <a href="<?= base_url(); ?>skl/cetak/<?= $surat['id_skl']; ?>" target='_blank' class="btn btn-primary"><i class="fas fa-print"></i> Cetak Pdf</a>

                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>

        <?php }; ?>

    </div>
</div>
</div>