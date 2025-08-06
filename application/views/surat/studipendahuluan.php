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


    <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?= base_url(); ?>surat/tambahstudip" type="button" class="btn btn-outline-primary mb-3">Ajukan Surat Baru</a>
        </div>

    </div>
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
                                            <th scope="col">ID</th>
                                            <th scope="col">Keperluan</th>
                                            <th scope="col">Create At</th>
                                            <th scope="col">Tujuan Surat</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Cetak Surat</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($naspub as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>

                                                <td>[-<?= $s['id_studip']; ?>-]</td>
                                                <td><?= $s['perihal']; ?></td>
                                                <td><?= date('d F Y', $s['date_create']); ?></td>
                                                <td><?= $s['tujuan_surat']; ?></td>
                                                <td><?= $s['status']; ?><br><?= $s['admin']; ?></td>
                                                <td>
                                                    <a href="<?= base_url(); ?>surat/cetakpengantarstudipendahuluan/<?= $s['id_studip']; ?>" target='_blank' class="badge badge-dark"><i class="fas fa-print"></i><br>Print Klik Disini</a>

                                                </td>
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