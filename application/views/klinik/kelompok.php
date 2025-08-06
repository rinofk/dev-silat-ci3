<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row mt-3">
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKelompokBaruModal">Buat Kelompok Baru</a> 
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kelompok Mahasiswa Aktif</h6>
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
                                            <th scope="col">Nama Kelompok</th>
                                            <th scope="col">Nama Prodi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Date Create</th>
                                            <th scope="col">Date Update</th>
                                            <th scope="col">Ubah Status</th>

                             
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($id_kelompokaktif as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <!-- <td><a href="<?= base_url(); ?>admin/ubah/<?= $s['id_kelompok']; ?>"><?= $s['id_kelompok']; ?></a></td> -->
                                                <td><a href="<?= base_url(); ?>klinik/kelompokdetail/<?= $s['id_kelompok']; ?>"><?= $s['id_kelompok']; ?> | <?= $s['nama_kelompok']; ?></a></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['status']; ?></td>
                                                <td><?= $s['admin']; ?></td>
                                                <td><?= $s['date_create']; ?></td>
                                                <td><?= $s['date_update']; ?></td>
                                                <td><a href="<?= base_url(); ?>klinik/kelompokstatusaktif/<?= $s['id_kelompok']; ?>">Aktif</a> | <a href="<?= base_url(); ?>klinik/kelompokstatusselesai/<?= $s['id_kelompok']; ?>">Selesai</a></td>

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
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Kelompok Yang Sudah Selesai</h6>
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
                                            <th scope="col">Nama Kelompok</th>
                                            <th scope="col">Nama Prodi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Date Create</th>
                                            <th scope="col">Date Update</th>
                                            <th scope="col">Ubah Status</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($id_kelompokselesai as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <!-- <td><a href="<?= base_url(); ?>admin/ubah/<?= $s['id_periode']; ?>"><?= $s['id_periode']; ?></a></td> -->
                                                <td><a href="<?= base_url(); ?>klinik/kelompokdetail/<?= $s['id_kelompok']; ?>"><?= $s['id_kelompok']; ?> | <?= $s['nama_kelompok']; ?></a></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['status']; ?></td>
                                                <td><?= $s['admin']; ?></td>
                                                <td><?= $s['date_create']; ?></td>
                                                <td><?= $s['date_update']; ?></td>
                                                <td><a href="<?= base_url(); ?>klinik/kelompokstatusaktif/<?= $s['id_kelompok']; ?>">Aktif</a> | <a href="<?= base_url(); ?>klinik/kelompokstatusselesai/<?= $s['id_kelompok']; ?>">Selesai</a></td>

                                                <!-- <td><a href="<?= base_url(); ?>klinik/hapus_klinik/<?= $s['id_klinik']; ?>" class="btn btn-danger float-right" onclick="return confirm('Apakah Anda yakin <?= $s['nama_klinik']; ?> [-<?= $s['id_klinik']; ?>-] data ini di HAPUS');"><i class="fas fa-trash"></i></a></td> -->

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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="newKelompokBaruModal" tabindex="-1" role="dialog" aria-labelledby="newKelompokBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKelompokBaruModalLabel">Buat Kelompok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('klinik/Kelompok'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok" placeholder="Nama Kelompok">
                    </div>
                </div>
                <div class="modal-body">
                <div class="form-group row">
                        <label for="id_prodi" class="col-sm-3 col-form-label">Prodi</label>
                        <div class="col-sm-9">
                            <select id="id_prodi" name="id_prodi" class="form-control" value="<?= set_value('id_prodi'); ?>">
                                <?php foreach ($prodi as $m) : ?>
                                    <option value="<?= $m['id_prodi'] ?>"><?= $m['nama_prodi'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
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
