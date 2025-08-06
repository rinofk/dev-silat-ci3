<!-- Begin Page Content -->
<div class="container-fluid">
 
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?= base_url(); ?>klinik/tambahpraktekpraktek" type="button" class="btn btn-primary mb-3 btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-square"></i> </span>
                <span class="text">Tambah Baru</span></a>
        </div>
    </div> -->

  <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Penagihan Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_penagihan ; ?></div>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penagihan Baru Profesi Dokter</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_penagihan_dokter ; ?></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
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
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penagihan Baru Profesi Apoteker</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_penagihan_apoteker ; ?></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
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
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penagihan Baru Profesi Ners</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_penagihan_ners ; ?></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
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

    </div>
    <!-- Content Row -->

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
                                            <th scope="col">Nama Klinik</th>
                                            <!--<th scope="col">Periode</th>-->
                                            <th scope="col">Stase</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Tanggal Tagihan</th>
                                            <th scope="col">Status Pembayaran</th>
                                            <th scope="col">Date Create</th>
                                            <th scope="col">Pengantar</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pkb as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $s['nama_klinik']; ?><br><small><?= $s['tgl_mulai']; ?> s/d <?= $s['tgl_selesai']; ?></small></td>
                                                <td><a href="<?= base_url(); ?>klinikbpp/bppkelompokdetail/<?= $s['id_praktekklinik']; ?>"><?= $s['nama_stase']; ?></a></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['tgl_penagihan']; ?></td>
                                                <td><?= $s['tgl_pembayaran']; ?><br><?= $s['status_pembayaran']; ?></td>
                                                <td><small><?= $s['date_create']; ?></small></td>
                                                <td><a href="<?= base_url(); ?>assets/klinis/pengantar/<?= $s['pengantar']; ?>" target='_blank'><?= $s['pengantar']; ?></a></td>
                                                <td><?= $s['admin']; ?></td>                                                                                  
                                                <td><a href="" data-toggle="modal" class="badge badge-primary float-right" data-target="#newUpdateModal<?= $s['id_praktekklinik']; ?>">Update ID-<?= $s['id_praktekklinik']; ?></a><br><small><?= $s['date_update']; ?></small></td>

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
                                            <th scope="col">Nama Klinik</th>
                                            <!--<th scope="col">Periode</th>-->
                                            <th scope="col">Stase</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Tanggal Tagihan</th>
                                            <th scope="col">Status Pembayaran</th>
                                            <th scope="col">Date Create</th>
                                            <th scope="col">Admin</th>
                                            <!-- <th scope="col">Bukti Bayar</th> -->
                                            <th scope="col">Action</th>
                                            <!--<th scope="col">Date Update</th>-->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pks as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $s['nama_klinik']; ?><br><small><?= $s['tgl_mulai']; ?> s/d <?= $s['tgl_selesai']; ?></small></td>
                                                <td><a href="<?= base_url(); ?>klinikbpp/bppkelompokdetail/<?= $s['id_praktekklinik']; ?>"><?= $s['nama_stase']; ?></a></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['tgl_penagihan']; ?></td>
                                                <td><?= $s['tgl_pembayaran']; ?><br><?= $s['status_pembayaran']; ?></td>
                                                <td><small><?= $s['date_create']; ?></small></td>
                                                <td><?= $s['admin']; ?></td>
                                                <!-- <td><a href="#">Download</a></td> -->
                                                <td><a href="" data-toggle="modal" class="badge badge-primary float-right" data-target="#newUpdateLunasModal<?= $s['id_praktekklinik']; ?>">Update ID-<?= $s['id_praktekklinik']; ?></a><br><small><?= $s['date_update']; ?></small></td>
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


<!-- Update Tagihan Modal -->
<?php $no = 0;
foreach ($pkb as $s) : $no++; ?>


<div class="modal fade" id="newUpdateModal<?= $s['id_praktekklinik']; ?>" tabindex="-1" role="dialog" aria-labelledby="newUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newJejaringModalLabel">Update ID-<?= $s['id_praktekklinik']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                        <?= $s['nama_klinik']; ?>     <br>    
                        Periode : <?= $s['tgl_mulai']; ?> s/d <?= $s['tgl_selesai']; ?><br>
                        Stase : <?= $s['nama_stase']; ?>
            </div>
            <form action="<?= base_url('klinikbpp'); ?>" method="post">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="id_praktekklinik" name="id_praktekklinik" placeholder="ID Praktek Klinik" value=<?= $s['id_praktekklinik']; ?> hidden>
                    </div>
                </div>
           
                <div class="modal-body">
                    <label>Tanggal Penagihan</label>
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_penagihan" name="tgl_penagihan" placeholder="Tanggal Penagihan" value=<?= $s['tgl_penagihan']; ?>>
                    </div>
                </div>
               

                <div class="modal-body">
                    <label>Tanggal Pembayaran</label>
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_pembayaran" name="tgl_pembayaran" placeholder="Tanggal Pembayaran" value=<?= $s['tgl_pembayaran']; ?>>
                    </div>
                </div>

                <div class="modal-body">
                    <label>Status Pembayaran</label>
                            <select id="status_pembayaran" name="status_pembayaran" class="form-control" >
                            <option value=<?= $s['status_pembayaran']; ?>><?= $s['status_pembayaran']; ?></option>
                                    <option value="Lunas">Lunas</option>
                                    <option value="-">-</option>
                            </select>     
                    </div>                                 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
<?php endforeach; ?>


<!-- Update Lunas Modal -->
<?php $no = 0;
foreach ($pks as $s) : $no++; ?>


<div class="modal fade" id="newUpdateLunasModal<?= $s['id_praktekklinik']; ?>" tabindex="-1" role="dialog" aria-labelledby="newUpdateLunasModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newJejaringModalLabel">Update ID-<?= $s['id_praktekklinik']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                        <?= $s['nama_klinik']; ?>     <br>    
                        Periode : <?= $s['tgl_mulai']; ?> s/d <?= $s['tgl_selesai']; ?><br>
                        Stase : <?= $s['nama_stase']; ?>
            </div>
            <form action="<?= base_url('klinikbpp'); ?>" method="post">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="id_praktekklinik" name="id_praktekklinik" placeholder="ID Praktek Klinik" value=<?= $s['id_praktekklinik']; ?> hidden>
                    </div>
                </div>
           
                <div class="modal-body">
                    <label>Tanggal Tagihan</label>
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_penagihan" name="tgl_penagihan" placeholder="Tanggal Penagihan" value=<?= $s['tgl_penagihan']; ?>>
                    </div>
                </div>
               

                <div class="modal-body">
                    <label>Tanggal Pembayaran</label>
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_pembayaran" name="tgl_pembayaran" placeholder="Tanggal Pembayaran" value=<?= $s['tgl_pembayaran']; ?>>
                    </div>
                </div>

                <div class="modal-body">
                    <label>Status Pembayaran</label>
                            <select id="status_pembayaran" name="status_pembayaran" class="form-control" >
                            <option value=<?= $s['status_pembayaran']; ?>><?= $s['status_pembayaran']; ?></option>
                                    <option value="Lunas">Lunas</option>
                                    <option value="-">-</option>
                            </select>     
                    </div>                                 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
<?php endforeach; ?>