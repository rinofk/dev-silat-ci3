<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!--<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>-->




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
    <div class="row">



        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_diajukan; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Reject</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_proses; ?></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_selesai; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_surat; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <!-- DATA TABLES TAMBAHAN-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Berkasi Bebas Perpustakaan belum Valid</h6>
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
                                            <th scope="col">Create At</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Update</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($perpus as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><a href="<?= base_url(); ?>pustakawan/detail/<?= $s['id_bp']; ?>"><?= $s['nim_mahasiswa']; ?> [-<?= $s['id_bp']; ?>-]</a></td>
                                                <td><?= $s['nama_lengkap']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['date_created']; ?></td>
                                                <td><?= $s['status']; ?></td>
                                                <td><?= $s['date_updated']; ?>, <br><?= $s['admin']; ?></td>
                                                <td><a href="<?= base_url(); ?>pustakawan/hapus/<?= $s['id_bp']; ?>" class="badge badge-danger float-right" onclick="return confirm('Apakah Anda yakin <?= $s['nama_lengkap']; ?> [-<?= $s['id_bp']; ?>-] data ini di HAPUS');"><i class="fas fa-trash">  Hapus</i></a></td>

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


    <!-- DATA TABLES ACCEPT-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Berkas Bebas Perpustakaan yang telah Valid</h6>
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
                                            <th scope="col">Create At</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Update</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($status as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><a href="<?= base_url(); ?>pustakawan/detail/<?= $s['id_bp']; ?>"><?= $s['nim_mahasiswa']; ?> [-<?= $s['id_bp']; ?>-]</a></td>
                                                <td><?= $s['nama_lengkap']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['date_created']; ?></td>
                                                <td><?= $s['status']; ?></td>
                                                <td><?= $s['date_updated']; ?></td>
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