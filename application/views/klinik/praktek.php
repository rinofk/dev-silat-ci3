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
                                            <th scope="col">Periode</th>
                                            <th scope="col">Kelompok</th>
                                            <th scope="col">Stase</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Tanggal Tagihan</th>
                                            <th scope="col">Status Penagihan</th>
                                            <th scope="col">Tanggal Pembayaran</th>
                                            <th scope="col">Status Pembayaran</th>
                                            <th scope="col">Date Create</th>
                                            <th scope="col">Date Update</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Bukti Bayar</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pk as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $s['nama_klinik']; ?></td>
                                                <td><?= $s['nama_periode']; ?></td>
                                                <td><a href="<?= base_url(); ?>klinik/kelompokdetail/<?= $s['id_kelompok']; ?>"><?= $s['id_kelompok']; ?> | <?= $s['nama_kelompok']; ?></a></td>
                                                <td><?= $s['nama_stase']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['tgl_penagihan']; ?></td>
                                                <td><?= $s['status_penagihan']; ?></td>
                                                <td><?= $s['tgl_pembayaran']; ?></td>
                                                <td><?= $s['status_pembayaran']; ?></td>
                                                <td><?= $s['date_create']; ?></td>
                                                <td><?= $s['date_update']; ?></td>
                                                <td><?= $s['admin']; ?></td>
                                                <td><a href="#">Download</a></td>
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
                                        <th scope="col">Kelompok</th>
                                            <th scope="col">Nama Klinik</th>
                                            <th scope="col">Stase</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Tanggal Tagihan</th>
                                            <th scope="col">Status Penagihan</th>
                                            <th scope="col">Tanggal Pembayaran</th>
                                            <th scope="col">Status Pembayaran</th>
                                            <th scope="col">Date Create</th>
                                            <th scope="col">Date Update</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Bukti Bayar</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pk as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><a href="<?= base_url(); ?>klinik/kelompokdetail/<?= $s['id_kelompok']; ?>"><?= $s['id_kelompok']; ?> | <?= $s['nama_kelompok']; ?></a></td>
                                                <td><?= $s['nama_klinik']; ?></td>
                                                <td><?= $s['nama_stase']; ?></td>
                                                <td><?= $s['nama_prodi']; ?></td>
                                                <td><?= $s['tgl_penagihan']; ?></td>
                                                <td><?= $s['status_penagihan']; ?></td>
                                                <td><?= $s['tgl_pembayaran']; ?></td>
                                                <td><?= $s['status_pembayaran']; ?></td>
                                                <td><?= $s['date_create']; ?></td>
                                                <td><?= $s['date_update']; ?></td>
                                                <td><?= $s['admin']; ?></td>
                                                <td><a href="#">Download</a></td>
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
            <form action="<?= base_url('klinik/Praktek'); ?>" method="post">
                <!-- <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="id_kelompok" name="id_kelompok" placeholder="Nama Kelompok">
                    </div>
                </div> -->

                <div class="modal-body">
                            <select id="id_kelompok" name="id_kelompok" class="form-control">
                            <option value="">Pilih Kelompok</option>
                                <?php foreach ($kelompok as $m) : ?>
                                    <option value="<?= $m['id_kelompok'] ?>"><?= $m['id_kelompok']?>-<?= $m['nama_kelompok']?>- Prodi <?= $m['nama_prodi']?></option>
                                <?php endforeach; ?>
                            </select>     
                </div>
                <div class="modal-body">
                            <select id="id_klinik" name="id_klinik" class="form-control">
                            <option value="">Pilih Klinik</option>
                                <?php foreach ($klinik as $m) : ?>
                                    <option value="<?= $m['id_klinik'] ?>"><?= $m['id_klinik']?>-<?= $m['nama_klinik']?>- Prodi <?= $m['nama_prodi']?></option>
                                <?php endforeach; ?>
                            </select>     
                </div>
                <div class="modal-body">
                            <select id="id_stase" name="id_stase" class="form-control">
                            <option value="">Pilih Stase</option>
                                <?php foreach ($stase as $m) : ?>
                                    <option value="<?= $m['id_stase'] ?>"><?= $m['id_stase']?>-<?= $m['nama_stase']?>- Prodi <?= $m['nama_prodi']?></option>
                                <?php endforeach; ?>
                            </select>     
                </div>
                <div class="modal-body">
                            <select id="id_periode" name="id_periode" class="form-control">
                            <option value="">Pilih Periode</option>
                                <?php foreach ($periode as $m) : ?>
                                    <option value="<?= $m['id_periode'] ?>"><?= $m['id_periode']?> | <?= $m['nama_periode']?> | <?= $m['nama_prodi']?></option>
                                <?php endforeach; ?>
                            </select>     
                </div>
                <div class="modal-body">
                <!-- <div class="form-group row"> -->
                        <!-- <label for="prodi_klinik" class="col-sm-3 col-form-label">Prodi</label> -->
                        <!-- <div class="col-sm-9"> -->
                            <select id="id_prodi" name="id_prodi" class="form-control">
                            <option value="">Pilih Prodi</option>
                                <?php foreach ($prodi as $m) : ?>
                                    <option value="<?= $m['id_prodi'] ?>"><?= $m['nama_prodi'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        <!-- </div> -->
                    <!-- </div> -->
                </div>
                <!-- <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_penagihan" name="tgl_penagihan" placeholder="Tanggal Tagihan">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <select id="status_penagihan" name="status_penagihan" class="form-control" value="<?= set_value('status_penagihan'); ?>">
                                <option value="">Status Tagihan</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                   
                            </select>                   
                         </div>
                </div> -->
<!-- 
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <input type="radio" id="status" name="status" value="aktif" checked />Aktif 
                        <input type="radio" id="status" name="status" value="tidak aktif"/>Tidak Aktif
                    </div>
                </div> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>