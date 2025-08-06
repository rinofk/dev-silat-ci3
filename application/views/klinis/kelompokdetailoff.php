<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
 
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Kelompok Mahasiswa | <?= $pk['nama_klinik']; ?> | Periode : <?= $pk['tgl_mulai']; ?> s/d <?= $pk['tgl_selesai']; ?> | Stase : <?= $pk['nama_stase']; ?></h6>
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
                                            <th scope="col">Admin</th>
                                            <th scope="col">Date Create</th>                             
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kd as $s) { ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <!-- <td><a href="<?= base_url(); ?>admin/ubah/<?= $s['id_klinik']; ?>"><?= $s['id_klinik']; ?></a></td> -->
                                                <td><?= $s['nim_mahasiswa']; ?></td>
                                                <td><?= $s['nama_lengkap']; ?></td>
                                                <td><?= $s['admin']; ?></td>
                                                <td><?= $s['date_create']; ?></td>
                                                <!-- <td><a href="<?= base_url(); ?>klinik/hapus_klinik/<?= $s['id_klinik']; ?>" class="btn btn-danger float-right" onclick="return confirm('Apakah Anda yakin <?= $s['nama_klinik']; ?> [-<?= $s['id_klinik']; ?>-] data ini di HAPUS');"><i class="fas fa-trash"></i></a></td> -->

                                                <!-- <td><a href="<?= base_url(); ?>admin/password/<?= $s['id_praktekklinik']; ?>">Download</a></td> -->
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
        </div>
        </div>
        
        
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-4">
            <div class="card shadow mb-8">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upload Pengantar</h6>
                </div>
                <div class="card-body">
                    <?= form_open_multipart('klinis/pengantar_update/' . $pk['id_praktekklinik']); ?>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="pengantar" name="pengantar" aria-describedby="inputGroupFileAddon04">
                                            <label class="custom-file-label" for="pengantar"><?= $pk['pengantar']; ?></label>
                                        </div>
                                        <div class="input-group-append">
                                            <a href="<?= base_url(); ?>assets/klinis/pengantar/<?= $pk['pengantar']; ?>" target="_blank" class="btn btn-outline-secondary">
                                                Preview
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>

                    (* upload file max 2 mb, dalam bentuk file pdf)
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->
