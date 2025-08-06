<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!--<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>-->

 

    <!-- DATA TABLES TAMBAHAN-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
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
                                            <th scope="col">Periode</th>
                                            <th scope="col">Stase</th>
                                            <th scope="col">Tanggal Penagihan</th>
                                            <th scope="col">Tanggal Pembayaran</th>
                                            <th scope="col">Status Pembayaran</th>
                                            <!-- <th scope="col">Status</th> -->
                                 
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($surat as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>

                                                <td><?= $s['tgl_mulai']; ?> s/d<br><?= $s['tgl_selesai']; ?></td>
                                                <td><a href="<?= base_url(); ?>stase/kelompokdetail/<?= $s['id_praktekklinik']; ?>"><?= $s['nama_stase']; ?></a> <br>
                                                <a href="<?= base_url(); ?>assets/klinis/pengantar/<?= $s['pengantar']; ?>" target='_blank' class="badge badge-dark"><?= $s['pengantar']; ?></a>
                                                <a href="<?= base_url(); ?>assets/klinis/kwitansi/<?= $s['kwitansi']; ?>" target='_blank' class="badge badge-dark"><?= $s['kwitansi']; ?></a></td>
                                                <td><?= $s['tgl_penagihan']; ?></td>
                                                <td><?= $s['tgl_pembayaran']; ?></td>
                                                <td><?= $s['status_pembayaran']; ?></td>
                                                <!-- <td><?= $s['status']; ?></td> -->
                                                
                                  
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

    </DIV>
    
     
    <!-- <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">Untuk Bantuan Operator Surat Aktif Kuliah</p>
                    <p class="card-text"><a href="https://wa.me/6289530657256?text=Hai%20Admin%20Aplikasi%20Aktif%20Kuliah, " rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i> Indra</a></p>
                </div>
            </div>
        </div>
    </div> -->

</div>
</div>