<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    
    <!-- <div class="row mt-3">
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMahasiswaModal<?= $id_praktekklinik; ?>">Tambah Mahasiswa</a> 
    </div> -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Periode <?= $detail['nama_periode']; ?></h6>
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
                                            <th scope="col">Admin</th>
                                            <th scope="col">Date Update</th>
                                            <!-- <th scope="col">Aksi</th> -->

                             
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($ypdetail as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <!-- <td><a href="<?= base_url(); ?>admin/ubah/<?= $s['id_klinik']; ?>"><?= $s['id_klinik']; ?></a></td> -->
                                                <td><a href="<?= base_url(); ?>arsip/yudisiumdetail/<?= $s['nim_mahasiswa']; ?>"><?= $s['nim_mahasiswa']; ?></td>
                                                <td><?= $s['nama_lengkap']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['admin']; ?></td>
                                                <td><?= $s['date_updated']; ?></td>
                                                <!-- <td><a href="<?= base_url(); ?>klinis/hapus_mahasiswa/<?= $s['id_kelompok']; ?>" class="btn btn-danger float-right" onclick="return confirm('Apakah Anda yakin <?= $s['nim_mahasiswa']; ?> [-<?= $s['nama_lengkap']; ?>-] data ini di HAPUS');"><i class="fas fa-trash"></i> Hapus</a></td> -->

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
</div>
<!-- End of Main Content -->
