<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row mt-3 mb-3">
        <div class="col-md-6">
            <a href="<?= base_url('admin/tambah'); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-plus-square"></i></span>
                <span class="text">Tambah Admin</span>
            </a>
        </div>
    </div>

    <!-- Admin Operator Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin Operator Silat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="datatableAdmin">
                    <thead class="table-primary">
                        <tr class="text-center">
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Role ID</th>
                            <th>Ubah Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($tbuser as $s): ?>
                            <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td><a href="<?= base_url('admin/ubah/'.$s['id']); ?>"><?= $s['nim']; ?></a></td>
                                <td><?= $s['name']; ?></td>
                                <td><?= $s['email']; ?></td>
                                <td class="text-center"><?= $s['role_id']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/password/'.$s['id']); ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-key"></i> Ganti
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Mahasiswa Login Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Login Mahasiswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="datatableMahasiswa">
                    <thead class="table-primary">
                        <tr class="text-center">
                            <th>#</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Role ID</th>
                            <th>Ubah Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($tb2user as $s): ?>
                            <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td><a href="<?= base_url('admin/ubah/'.$s['id']); ?>"><?= $s['nim']; ?></a></td>
                                <td><?= $s['name']; ?></td>
                                <td><?= $s['email']; ?></td>
                                <td class="text-center"><?= $s['role_id']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/password/'.$s['id']); ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-key"></i> Ganti
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
