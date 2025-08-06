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



    <!-- DATA TABLES TAMBAHAN-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
            <p> - jika terjadi kesalahan dalam input data, Hubungi Admin <a href="https://wa.me/6285252620977?text=Hai%20Admin%20Aplikasi%20Surat%20SKL%20Yudisium, " rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i> Yuti Maisarah</a></p>

        </div>

        <?php
        if (empty($status['id_alumni'])) {; ?>
            <!-- <div class="container"> -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="container">Anda harus terdaftar sebagai alumni</div>

                </div>
            </div>
            <!-- </div> -->
        <?php } else {; ?>

            <?php
            if (empty($status_skl['jenis_skl'])) {; ?>
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <a href="<?= base_url(); ?>alumni/sklyudistambah/<?= $user['nim']; ?>" type="button" class="btn btn-outline-primary mb-3">Ajukan Surat</a>
                        </div>
                    </div>
                </div>
            <?php } else {; ?>

                <!-- DATA TABLES Index-->
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="DataTables_length" id="dataTable_length">

                                            <table class="table" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">NIM</th>
                                                        <th scope="col">Tanggal Lulus</th>
                                                        <th scope="col">IPK</th>
                                                        <!--<th scope="col">Predikat</th>-->
                                                        <th scope="col">Create At</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Cetak Surat</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>

                                                        <td><?= $skl['nim']; ?>
                                                        <td><?= $skl['tgl_lulus_yudisium']; ?>
                                                        <td><?= $skl['ipk']; ?></td>
                                                        <!--<td><?= $skl['predikat']; ?></td>-->
                                                        <td><?= tgl_ind(date($skl['date_create'])); ?></td>
                                                        <td><?= $skl['status']; ?><br><?= $skl['admin']; ?></td>
                                                        <td>

                                                            <?php
                                                            if ($skl['status'] == 'diajukan') {; ?>
                                                                <a href="<?= base_url(); ?>alumni/sklyudiscetak/<?= $skl['id_skl']; ?>" target='_blank' class="badge badge-dark"><i class="fas fa-print"></i><br>Print Klik Disini</a>
                                                            <?php }; ?>
                                                            <?php
                                                            if ($skl['status'] == 'selesai') {; ?>
                                                                <a href="<?= base_url(); ?>alumni/sklyudiscetak2/<?= $skl['id_skl']; ?>" target='_blank' class="badge badge-dark"><i class="fas fa-print"></i><br>Cetak SKL</a>
                                                            <?php }; ?>
                                                        </td>
                                                    </tr>

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

            <?php }; ?>
        <?php }; ?>

        <!---->

    </DIV>
</div>
</div>