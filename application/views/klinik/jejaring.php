<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row mt-3">
        
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newJejaringModal">Tambah Baru</a>


    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Praktek Klinik Aktif</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="DataTables_length" id="dataTable_length">
                                <table class="table" id="datatable">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                            <th scope="col">Nama Mitra Jejaring</th>
                                            <th scope="col">Jenis Mitra</th>
                                            <th scope="col">Kontak Mitra</th>
                                            <th scope="col">Alamat Mitra</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Date Create</th>

                             
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pka as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <!-- <td><a href="<?= base_url(); ?>admin/ubah/<?= $s['id_klinik']; ?>"><?= $s['id_klinik']; ?></a></td> -->
                                                <td><?= $s['nama_klinik']; ?></td>
                                                <td><?= $s['jenis']; ?></td>
                                                <td><?= $s['kontak']; ?></td>
                                                <td><?= $s['alamat']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['status']; ?></td>
                                                <td><?= $s['admin']; ?></td>
                                                <td><?= $s['date_create']; ?><a href="<?= base_url(); ?>klinik/hapus_klinik/<?= $s['id_klinik']; ?>" class="badge badge-danger float-right" onclick="return confirm('Apakah Anda yakin <?= $s['nama_klinik']; ?> [-<?= $s['id_klinik']; ?>-] data ini di HAPUS');"><i class="fas fa-trash"></i> Hapus</a></td>

                                                <!-- <td><a href="<?= base_url(); ?>admin/password/<?= $s['id_praktekklinik']; ?>">Download</a></td> -->
                                            </tr>
                                        <?php $i++;
                                        }
                                        ?>
                                    </tbody>

                                </table>

                                <!---->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!---->


    </div>
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Praktek Klinik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="DataTables_length" id="dataTable_length">
                                <table class="table" id="datatable">
                                <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Mitra Jejaring</th>
                                            <th scope="col">Jenis Mitra</th>
                                            <th scope="col">Kontak Mitra</th>
                                            <th scope="col">Alamat Mitra</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Date Create</th>
                             
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pkna as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <!-- <td><a href="<?= base_url(); ?>admin/ubah/<?= $s['id_klinik']; ?>"><?= $s['id_klinik']; ?></a></td> -->
                                                <td><?= $s['nama_klinik']; ?></td>
                                                <td><?= $s['jenis']; ?></td>
                                                <td><?= $s['kontak']; ?></td>
                                                <td><?= $s['alamat']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['status']; ?></td>
                                                <td><?= $s['admin']; ?></td>
                                                <td><?= $s['date_create']; ?><a href="<?= base_url(); ?>klinik/hapus_klinik/<?= $s['id_klinik']; ?>" class="btn btn-danger float-right" onclick="return confirm('Apakah Anda yakin <?= $s['nama_klinik']; ?> [-<?= $s['id_klinik']; ?>-] data ini di HAPUS');"><i class="fas fa-trash"></i></a></td>

                                                <!-- <td><a href="<?= base_url(); ?>admin/password/<?= $s['id_praktekklinik']; ?>">Download</a></td> -->
                                            </tr>
                                        <?php $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        


    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="newJejaringModal" tabindex="-1" role="dialog" aria-labelledby="newJejaringModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newJejaringModalLabel">Tambah Jejaring</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('klinik/Jejaring'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_klinik" name="nama_klinik" placeholder="Nama Mitra Jejaring">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis Mitra Rumah Sakit/Puskesmas/Apotik">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Kontak">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    </div>
                </div>
                <!-- <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="prodi_klinik" name="prodi_klinik" placeholder="Prodi">
                    </div>
                </div> -->
                <div class="modal-body">
                <div class="form-group row">
                        <label for="prodi_klinik" class="col-sm-3 col-form-label">Prodi</label>
                        <div class="col-sm-9">
                            <select id="prodi_klinik" name="prodi_klinik" class="form-control">
                            <option value="">Select Prodi</option>
                                <?php foreach ($prodi as $m) : ?>
                                    <option value="<?= $m['id_prodi'] ?>"><?= $m['nama_prodi'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <input type="radio" id="status" name="status" value="aktif" checked />Aktif 
                        <input type="radio" id="status" name="status" value="tidak aktif"/>Tidak Aktif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>