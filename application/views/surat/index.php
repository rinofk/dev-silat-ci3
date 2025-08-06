<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!--<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>-->



    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data surat pengajuan <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php
    if (empty($status['id_alumni'])) {; ?>
        <!-- <div class="container"> -->
        <div class="row mt-3">
            <div class="col-md-6">
                <a href="<?= base_url(); ?>surat/tambah" type="button" class="btn btn-primary mb-3 btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-square"></i> </span>
                    <span class="text">Tambah</span></a>
            </div>
        </div>
        <!-- </div> -->
    <?php }; ?>


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
                                            <th scope="col">Tahun Ajaran</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Cetak Surat</th>
                                 
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($surat as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>

                                                <td>[-<?= $s['id_suratpengajuan']; ?>-]</td>
                                                <td><?= $s['nama_keperluan']; ?> <?= $s['keterangan']; ?></td>
                                                <td><?= date('d F Y', $s['date_create']); ?></td>
                                                <td><?= $s['tahun_ajaran']; ?></td>
                                                <td><?php
                                                    if (empty($s['status'])) {; ?>

                                                        <a href="<?= base_url(); ?>surat/edit/<?= $s['id_suratpengajuan']; ?>" class=" btn btn-warning btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="far fa-edit"></i> </span>
                                                            <span class="text">Ubah</span>
                                                        </a>
                                                        <a href="<?= base_url(); ?>surat/hapus/<?= $s['id_suratpengajuan']; ?>" class=" btn btn-danger btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                            <span class="text">Hapus</span>
                                                        </a>
                                                        <a href="<?= base_url(); ?>surat/kirim/<?= $s['id_suratpengajuan']; ?>" class=" btn btn-primary btn-icon-split">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-paper-plane"></i>
                                                            </span>
                                                            <span class="text">Kirim</span>
                                                        </a>

                                                    <?php
                                                    } else {
                                                        echo $s['status'] . ', ' . $s['status_keterangan'];
                                                        ;
                                                    }; ?>
                                                </td>
                                                <td>
                                                    <?php if ($s['status_aktif'] == 1): ?>
                                                        <?php if ($s['status'] == 'diajukan'): ?>
                                                            <!-- <a href="<?= base_url(); ?>surat/cetaksurat/<?= $s['id_suratpengajuan']; ?>" target="_blank" class="badge badge-dark">
                                                                <i class="fas fa-print"></i><br>Print Klik Disini
                                                            </a> -->
                                                        <?php else: ?>
                                                            <?= date('d F Y', $s['date_finish']) . '<br>' . $s['admin']; ?>
                                                            
                                                            <?php if ($s['status'] == 'selesai' && !empty($s['file_selesai'])): ?>
                                                                <br>
                                                                <a href="<?= base_url('assets/surat_selesai/' . $s['file_selesai']); ?>" target="_blank" class="btn btn-outline-success mt-2">
                                                                    <i class="fas fa-download"></i> Lihat Surat Selesai
                                                                </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        Anda Tidak Lagi Aktif
                                                    <?php endif; ?>
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
                    <p class="card-text">Untuk Bantuan Operator Surat Aktif Kuliah</p>
                    <p class="card-text"><a href="https://wa.me/6289530657256?text=Hai%20Admin%20Aplikasi%20Aktif%20Kuliah, " rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i> Indra</a></p>
                    <!--<p class="card-text"><a href="https://wa.me/6285245646559?text=Hai%20Admin%20Aplikasi%20Aktif%20Kuliah, " rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i> Nurhayani</a></p>-->
                   <!--<p class="card-text"><i class="fab fa-whatsapp"></i> Caturiani</p>-->
                </div>
            </div>
        </div>
    </div>
</div>
</div>