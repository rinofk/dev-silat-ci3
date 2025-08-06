<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> Profesi Dokter</h1>

    <!-- <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?= base_url(); ?>klinik/tambahpraktekpraktek" type="button" class="btn btn-primary mb-3 btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-square"></i> </span>
                <span class="text">Tambah Baru</span></a>
        </div>
    </div> -->

    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPraktekModal">Tambah Baru</a>


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
                                            <th scope="col">Tanggal Tagihan</th>
                                            <th scope="col">Status Pembayaran</th>
                                            <th scope="col">Date Create</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Update</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pkd as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $s['nama_klinik']; ?><br><small><?= tgl_indo($s['tgl_mulai']); ?> s/d <?= tgl_indo($s['tgl_selesai']); ?></small></td>
                                                <td><a href="<?= base_url(); ?>klinis/kelompokdetail/<?= $s['id_praktekklinik']; ?>"><?= $s['nama_stase']; ?></a><br>
                                                    <a href="<?= base_url(); ?>assets/klinis/pengantar/<?= $s['pengantar']; ?>" target='_blank' class="badge badge-dark"><?= $s['pengantar']; ?></a>
                                                    <a href="<?= base_url(); ?>assets/klinis/kwitansi/<?= $s['kwitansi']; ?>" target='_blank' class="badge badge-dark"><?= $s['kwitansi']; ?></a>
                                                </td>
                                                <td><?= tgl_indo($s['tgl_penagihan']); ?></td>
                                                <td><?= tgl_indo($s['tgl_pembayaran']); ?><br><?= $s['status_pembayaran']; ?></td>
                                                <td><small><?= tgl_indo($s['date_create']); ?></small></td>
                                                <td><?= $s['admin']; ?></td>
                                                <td><a href="" data-toggle="modal" class="badge badge-primary float-right" data-target="#newUpdateModal<?= $s['id_praktekklinik']; ?>">Update ID-<?= $s['id_praktekklinik']; ?></a><br><small><?= tgl_indo($s['date_update']); ?></small></td>

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
                                            <th scope="col">Stase</th>
                                            <th scope="col">Tanggal Tagihan</th>
                                            <th scope="col">Status Pembayaran</th>
                                            <th scope="col">Date Create</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Date Update</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pkds as $s) { ?>
                                            <tr>
                                            <th scope="row"><?= $i; ?></th>
                                                <td><?= $s['nama_klinik']; ?><br><small><?= tgl_indo($s['tgl_mulai']); ?> s/d <?= tgl_indo($s['tgl_selesai']); ?></small></td>
                                                <td><a href="<?= base_url(); ?>klinis/kelompokdetailoff/<?= $s['id_praktekklinik']; ?>"><?= $s['nama_stase']; ?></a><br>
                                                    <a href="<?= base_url(); ?>assets/klinis/pengantar/<?= $s['pengantar']; ?>" target='_blank' class="badge badge-dark"><?= $s['pengantar']; ?></a>
                                                    <a href="<?= base_url(); ?>assets/klinis/kwitansi/<?= $s['kwitansi']; ?>" target='_blank' class="badge badge-dark"><?= $s['kwitansi']; ?></a>
                                                </td>
                                                <td><?= tgl_indo($s['tgl_penagihan']); ?></td>
                                                <td><?= tgl_indo($s['tgl_pembayaran']); ?><br><?= $s['status_pembayaran']; ?></td>
                                                <td><small><?= tgl_indo($s['date_create']); ?></small></td>
                                                <td><?= $s['admin']; ?></td>
                                                <td><small><?= tgl_indo($s['date_update']); ?></small></td>
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
<div class="modal fade" id="newPraktekModal" tabindex="-1" role="dialog" aria-labelledby="newPraktekModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newJejaringModalLabel">Tambah Praktek Klinik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('klinis/dokter'); ?>" method="post">
                <!-- <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="id_kelompok" name="id_kelompok" placeholder="Nama Kelompok">
                    </div>
                </div> -->

                
                <div class="modal-body">
                            <select id="id_klinik" name="id_klinik" class="form-control">
                            <option value="">Pilih Klinik</option>
                                <?php foreach ($klinis as $m) : ?>
                                    <option value="<?= $m['id_klinik'] ?>"><?= $m['id_klinik']?>-<?= $m['nama_klinik']?></option>
                                <?php endforeach; ?>
                            </select>     
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
                            <select id="id_stase" name="id_stase" class="form-control">
                            <option value="">Pilih Stase</option>
                                <?php foreach ($stase as $m) : ?>
                                    <option value="<?= $m['id_stase'] ?>"><?= $m['id_stase']?>-<?= $m['nama_stase']?></option>
                                <?php endforeach; ?>
                            </select>     
                </div>
               
              
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Update -->
<?php $no = 0;
foreach ($pkd as $s) : $no++; ?>


<div class="modal fade" id="newUpdateModal<?= $s['id_praktekklinik']; ?>" tabindex="-1" role="dialog" aria-labelledby="newUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h5 class="modal-title" id="newJejaringModalLabel">Update Praktek Klinik Profesi Dokter</h5>-->
                <h5 class="modal-title" id="newJejaringModalLabel">Update ID-<?= $s['id_praktekklinik']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('klinis/updatedokter'); ?>" method="post">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="id_praktekklinik" name="id_praktekklinik" placeholder="ID Praktek Klinik" value=<?= $s['id_praktekklinik']; ?> hidden>
                    </div>
                </div>
                <div class="modal-body">
                            <label>Pilih Klinik</label>
                            <select id="id_klinik" name="id_klinik" class="form-control">
                            <option value="<?= $s['id_klinik']?>"><?= $s['nama_klinik']?></option>
                                <?php foreach ($klinis as $m) : ?>
                                    <option value="<?= $m['id_klinik'] ?>"><?= $m['id_klinik']?>-<?= $m['nama_klinik']?></option>
                                <?php endforeach; ?>
                            </select>     
                </div>
                <div class="modal-body">
                    <label>Tanggal Mulai</label>
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_mulai" name="tgl_mulai" placeholder="Tanggal Penagihan" value=<?= $s['tgl_mulai']; ?>>
                    </div>
                </div>
               

                <div class="modal-body">
                    <label>Tanggal Selesai</label>
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_selesai" name="tgl_selesai" placeholder="Tanggal Pembayaran" value=<?= $s['tgl_selesai']; ?>>
                    </div>
                </div>
                <div class="modal-body">
                    <label>Pilih Stase</label>
                            <select id="id_stase" name="id_stase" class="form-control">
                            <option value="<?= $s['id_stase']?>"><?= $s['nama_stase']?></option>
                                <?php foreach ($stase as $m) : ?>
                                    <option value="<?= $m['id_stase'] ?>"><?= $m['id_stase']?>-<?= $m['nama_stase']?></option>
                                <?php endforeach; ?>
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