<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data alumni <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mt-3 mb-3">
        <div class="col-md-12">
            <a href="<?= base_url('admin/alumni_tambah'); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-plus-square"></i></span>
                <span class="text">Tambah Alumni</span>
            </a>
        </div>
    </div>

    <!-- DataTables Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Alumni Mahasiswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead class="table-primary">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Foto</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Program Studi</th>
                            <th>Tahun Wisuda</th>
                            <th>IPK</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($alumni as $a): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $i++; ?></td>
                                <td class="text-center align-middle">
                                    <img src="<?= base_url('assets/img/alumni/') . ($a['poto'] ? $a['poto'] : 'default.jpg'); ?>" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="align-middle">
                                    <a href="<?= base_url('admin/alumni_detail/' . $a['id_alumni']); ?>" class="font-weight-bold"><?= $a['nim_alumni']; ?></a>
                                </td>
                                <td class="align-middle"><?= $a['nama_lengkap'] ? $a['nama_lengkap'] : '-'; ?></td>
                                <td class="align-middle"><?= $a['nama_prodi'] ? $a['nama_prodi'] : '-'; ?></td>
                                <td class="text-center align-middle"><?= $a['tahun_wisuda']; ?></td>
                                <td class="text-center align-middle"><?= $a['ipk']; ?></td>
                                <td class="text-center align-middle">
                                    <?php if ($a['status_alumni'] == 1) : ?>
                                        <span class="badge badge-success">Aktif / Terverifikasi</span>
                                    <?php else : ?>
                                        <span class="badge badge-warning">Diajukan / Belum Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/alumni_detail/' . $a['id_alumni']); ?>" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="<?= base_url('admin/alumni_ubah/' . $a['id_alumni']); ?>" class="btn btn-sm btn-primary" title="Ubah">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('admin/alumni_hapus/' . $a['id_alumni']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data alumni ini?');" title="Hapus">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
