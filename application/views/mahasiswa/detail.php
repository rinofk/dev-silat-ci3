<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-9">
            <div class="card border-dark mb-3" style="max-width: 30rem;">
                <div class="card-header">Detail Data Mahasiswa</div>
                <div class="card-body text-dark">
                    <table>
                        <tr>
                            <td width="150">Nama</td>
                            <td><?= $mahasiswa['nama_lengkap']; ?></td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td><?= $mahasiswa['nim']; ?></td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir</td>
                            <td><?= $mahasiswa['tempat_lahir']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td><?= $mahasiswa['tgl_lahir']; ?></td>
                        </tr>

                        <tr>
                            <td>Prodi</td>
                            <td><?= $mahasiswa['nama_prodi']; ?></td>
                        </tr>

                        <tr>
                            <td>No HP</td>
                            <td><?= $mahasiswa['no_hp']; ?></td>
                        </tr>


                    </table>
                    <p class="card-text">
                        ---------------- detail info ----------------
                    </p>




                    <a href="<?= base_url(); ?>mahasiswa" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
                    <a href="<?= base_url(); ?>mahasiswa/ubah/<?= $mahasiswa['nim']; ?>" class="btn btn-primary float-right"><i class="far fa-edit"></i> EDIT</a>

                </div>
            </div>
        </div>
    </div>
</div>
</div>