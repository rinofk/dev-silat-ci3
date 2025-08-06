<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row mt-3">
        <div class="col-md-6">
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newStaseModal">+ Periode</a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Stase</h6>
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
                                            <th scope="col">Tanggal Mulai</th>
                                            <th scope="col">Tanggal Selesai</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Update</th>
              
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($periode as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><a href="<?= base_url(); ?>arsip/yudisiumperiodedetail/<?= $s['id_periode']; ?>"><?= $s['nama_periode']; ?></a></td>
                                                <td><?= $s['tgl_mulai']; ?></td>
                                                <td><?= $s['tgl_selesai']; ?></td>
                                                <td><?= $s['status_periode']; ?></td>
                                                <td><a href="" data-toggle="modal" class="badge badge-primary float-right" data-target="#newUpdateModal<?= $s['id_periode']; ?>">Update ID-<?= $s['id_periode']; ?></a></td>
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

<!-- 

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
                                        <th scope="col">Nama Stase</th>
                                        <th scope="col">Prodi</th>
                     
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($stase as $s) { ?>
                                            <tr>
                                            <th scope="row"><?= $i; ?></th>
                                                <td><?= $s['nama_stase']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>

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



    </div> -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newStaseModal" tabindex="-1" role="dialog" aria-labelledby="newStaseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newStaseModalLabel">Tambah Periode Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('arsip/periodeyudisium'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_periode" name="nama_periode" placeholder="Nama Periode">
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
                <div class="modal-body">
                    <div class="form-group">
                    <input type="radio" id="status_periode" name="status_periode" value="Aktif" checked> Aktif<br>
                    <input type="radio" id="status_periode" name="status_periode" value="Selesai"> Selesai<br>
                    <!-- <input type="text" class="form-control datepicker" id="tgl_selesai" name="tgl_selesai" placeholder="Tanggal Selesai"> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<!-- Modal Update -->
<?php $no = 0;
foreach ($periode as $s) : $no++; ?>


<div class="modal fade" id="newUpdateModal<?= $s['id_periode']; ?>" tabindex="-1" role="dialog" aria-labelledby="newUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newJejaringModalLabel">Update ID-<?= $s['id_periode']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('arsip/updateyudisium'); ?>" method="post">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="id_periode" name="id_periode"  value=<?= $s['id_periode']; ?> hidden>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_periode" name="nama_periode"  value=<?= $s['nama_periode']; ?>>
                    </div>
                </div>
               
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_mulai" name="tgl_mulai" placeholder="Tanggal Mulai" value=<?= $s['tgl_mulai']; ?>>
                    </div>
                </div>
               

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_selesai" name="tgl_selesai" placeholder="Tanggal Selesai" value=<?= $s['tgl_selesai']; ?>>
                    </div>
                </div>
                <div class="modal-body">
                            <select id="status_periode" name="status_periode" class="form-control">
                            <option value="<?= $s['status_periode']?>"><?= $s['status_periode']?></option>
                            <option value="Aktif">Aktif</option>
                            <option value="Selesai">Selesai</option>
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