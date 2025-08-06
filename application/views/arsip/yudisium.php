<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>




    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data mahasiswa <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

    <?php endif; ?>
    <!-- Content Row -->
    <!-- <div class="row"> -->



    <!-- Content Row -->
    <!-- DATA TABLES TAMBAHAN-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Arsip Yudisium</h6>
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
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Periode</th>
                                            <th scope="col">Create At</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Update</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Admin</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($ay as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><a href="<?= base_url(); ?>arsip/yudisiumdetail/<?= $s['nim_mahasiswa']; ?>"><?= $s['nim_mahasiswa']; ?></td>
                                                <td><?= $s['nama_lengkap']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['nama_periode']; ?></td>
                                                <td><?= $s['date_created']; ?></td>
                                                <td><?= $s['status']; ?></td>
                                                <td><?= $s['date_updated']; ?></td>
                                                <td><?= $s['keterangan']; ?></td>
                                                <td><?= $s['admin']; ?></td>
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
    </div> 

 
    <!-- DATA TABLES ACCEPT-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Berkas Yudisium yang telah Valid</h6>
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
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Periode</th>
                                            <th scope="col">Create At</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Update</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Admin</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($yl as $s) { ?>
                                            <tr>
                                            <th scope="row"><?= $i; ?></th>
                                                <!-- <td><a href="<?= base_url(); ?>pustakawan/detail/<?= $s['id_bp']; ?>"><?= $s['nim_mahasiswa']; ?> [-<?= $s['id_bp']; ?>-]</a></td> -->
                                                <td><a href="<?= base_url(); ?>arsip/yudisiumdetail/<?= $s['nim_mahasiswa']; ?>"><?= $s['nim_mahasiswa']; ?></td>
                                                <td><?= $s['nama_lengkap']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['nama_periode']; ?></td>
                                                <td><?= $s['date_created']; ?></td>
                                                <td><?= $s['status']; ?></td>
                                                <td><?= $s['date_updated']; ?></td>
                                                <td><?= $s['keterangan']; ?></td>
                                                <td><?= $s['admin']; ?></td>
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
</div>
