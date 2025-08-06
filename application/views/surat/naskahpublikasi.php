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
            <a href="<?= base_url(); ?>surat/tambahnaspub" type="button" class="btn btn-outline-primary mb-3">Ajukan Surat Baru</a>
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
                                            <th scope="col">Judul Naskah Publikasi</th>
                                            <th scope="col">Create At</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($naspub as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>

                                                <td>[-<?= $s['id_naspub']; ?>-]</td>
                                                <td><?= $s['judul_naspub']; ?></td>
                                                <td><?= date('d F Y', $s['date_create']); ?></td>
                                                <td>

                                                    <?php
                                                    if ($s['status'] == 'diajukan') {; ?>
                                                        <a href="<?= base_url(); ?>surat/cetaknaspub/<?= $s['id_naspub']; ?>" target='_blank' class="badge badge-dark"><i class="fas fa-print"></i><br>Print Surat Pengajuan</a>
                                                    <?php
                                                    } else {
                                                        if ($s['status'] == 'reject') {
                                                            echo  $s['status'] . '<br>' . tgl_ind(date($s['date_updated'])) . '<br>'; ?>
                                                            <a href="<?= base_url(); ?>surat/updatenaspub/<?= $s['id_naspub']; ?>" class="badge badge-primary"><i class="fas fa-print"></i><br>UPDATE</a>
                                                        <?php
                                                        } else {
    
                                                            echo  'Selesai ' . '<br>' . date('d F Y', $s['date_finish']) . '<br>'; ?>
                                                            <a href="<?= base_url(); ?>surat/cetakbarcode/<?= $s['id_naspub']; ?>" target='_blank' class="badge badge-dark"><i class="fas fa-print"></i><br>Print Barcode Naspub</a>
                                                        <?php
                                                        }; ?>
                                                     <?php
                                                    }; ?>

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

    </DIV>
    
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">Untuk Bantuan Admin Naskap Publikasi</p>
                    <p class="card-text"><a href="https://wa.me/6285158447713?text=Hai%20Admin%20Naskah%20Publikasi%20Online, " rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i> Andeff Gena Fetrian</a></p>
                    <p class="card-text"><a href="https://wa.me/6285391044299?text=Hai%20Admin%20Naskah%20Publikasi%20Online, " rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i> Rino Firmansyah</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>