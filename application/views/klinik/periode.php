<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row mt-3">
        <div class="col-md-6">
            <!-- <a href="<?= base_url(); ?>admin/tambah" type="button" class="btn btn-primary mb-3 btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-square"></i> </span>
                <span class="text">Tambah Baru</span></a> -->

                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPeriodeModal">Tambah Baru</a>

        </div>
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
                                            <th scope="col">Nama Periode</th>
                                            <th scope="col">Nama Prodi</th>
                                            <th scope="col">Tangal Mulai</th>
                                            <th scope="col">Tanggal Selesai</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pa as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $s['nama_periode']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['tgl_mulai']; ?></td>
                                                <td><?= $s['tgl_selesai']; ?></td>
                                                <td><?= $s['status']; ?></td>
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
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Periode Praktek Klinik</h6>
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
                                        <th scope="col">Nama Periode</th>
                                        <th scope="col">Nama Prodi</th>
                                        <th scope="col">Tangal Mulai</th>
                                        <th scope="col">Tanggal Selesai</th>
                                        <th scope="col">Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pk as $s) { ?>
                                            <tr>
                                            <th scope="row"><?= $i; ?></th>
                                                <td><?= $s['nama_periode']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['tgl_mulai']; ?></td>
                                                <td><?= $s['tgl_selesai']; ?></td>
                                                <td><?= $s['status']; ?></td>
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
<div class="modal fade" id="newPeriodeModal" tabindex="-1" role="dialog" aria-labelledby="newPeriodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPeriodeModalLabel">Tambah Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('klinik/periode'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_periode" name="nama_periode" placeholder="Nama Periode">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <label for="id_prodi" class="col-sm-3 col-form-label">Prodi</label>
                        <div class="col-sm-9">
                        <select name="id_prodi" id="id_prodi" class="form-control">
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
                        <input type="text" class="form-control datepicker" id="tgl_mulai" name="tgl_mulai" placeholder="Tanggal Mulai">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_selesai" name="tgl_selesai" placeholder="Tanggal Selesai">
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