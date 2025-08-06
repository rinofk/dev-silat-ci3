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


    <!-- <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?= base_url(); ?>mahasiswa/tambah" class="btn btn-primary mb-3">Tambah Data Mahasiswa</a>
        </div>

    </div> -->

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
                <th scope="col">NIM</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Tempat Lahir</th>
                <th scope="col">Prodi</th>
                <th scope="col">No HP</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($mahasiswa)) : ?>
                <div class="alert alert-danger" role="alert">
                    data mahasiswa tidak ditemukan.
                </div>

            <?php endif; ?>
            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $mhs) { ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><a href="<?= base_url(); ?>mahasiswa/detail/<?= $mhs['nim']; ?>">
                            <?= $mhs['nim']; ?></a></td>
                    <td><?= $mhs['nama_lengkap']; ?></td>
                    <td><?= $mhs['tempat_lahir']; ?></td>
                    <td><?= $mhs['nama_prodi']; ?></td>
                    <td><?= $mhs['no_hp']; ?></td>

                </tr>
                <?php $i++; ?>
            <?php
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