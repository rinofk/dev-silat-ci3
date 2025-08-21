<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Log Pengembangan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableLog" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Dibuat Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($logs as $log): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><span class="badge badge-info"><?= ucfirst($log['kategori']); ?></span></td>
                                <td class="text-primary font-weight-bold"><?= $log['judul']; ?></td>
                                <td><?= $log['deskripsi']; ?></td>
                                <td><?= $log['tanggal']; ?></td>
                                <td><?= $log['dibuat_oleh']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DataTables Script -->
<script>
    $(document).ready(function () {
        $('#dataTableLog').DataTable({
            "pageLength": 10,
            "ordering": true,
            "lengthChange": true,
            "autoWidth": false
        });
    });
</script>
