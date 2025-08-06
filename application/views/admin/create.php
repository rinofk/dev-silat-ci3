<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?= base_url(); ?>admin/tambah" type="button" class="btn btn-primary mb-3 btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-square"></i> </span>
                <span class="text">Tambah Admin</span></a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin Operator Silat</h6>
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
                                            <th scope="col">NIM</th>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">email</th>
                                            <th scope="col">Role ID</th>
                                            <th scope="col">Ubah Password</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($tbuser as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><a href="<?= base_url(); ?>admin/ubah/<?= $s['id']; ?>"><?= $s['nim']; ?></a></td>
                                                <td><?= $s['name']; ?></td>
                                                <td><?= $s['email']; ?></td>
                                                <td><?= $s['role_id']; ?></td>
                                                <td><a href="<?= base_url(); ?>admin/password/<?= $s['id']; ?>">Ubah Password</a></td>
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
            <h6 class="m-0 font-weight-bold text-primary">Login Mahasiswa</h6>
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
                                            <th scope="col">NIM</th>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">email</th>
                                            <th scope="col">Role ID</th>
                                            <th scope="col">Ubah Password</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($tb2user as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><a href="<?= base_url(); ?>admin/ubah/<?= $s['id']; ?>"><?= $s['nim']; ?></a></td>
                                                <td><?= $s['name']; ?></td>
                                                <td><?= $s['email']; ?></td>
                                                <td><?= $s['role_id']; ?></td>
                                                <td><a href="<?= base_url(); ?>admin/password/<?= $s['id']; ?>">Ubah Password</a></td>
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