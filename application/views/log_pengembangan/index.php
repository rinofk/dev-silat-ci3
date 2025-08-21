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
                <table class="table table-bordered table-hover" id="dataTableLog" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr class="text-center">
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
                            <?php 
                                // Pilih warna badge berdasarkan kategori
                                switch (strtolower($log['kategori'])) {
                                    case 'bug': 
                                        $badge = 'badge-danger'; break;
                                    case 'fitur': 
                                        $badge = 'badge-success'; break;
                                    case 'update': 
                                        $badge = 'badge-warning'; break;
                                    case 'dokumentasi': 
                                        $badge = 'badge-info'; break;
                                    default: 
                                        $badge = 'badge-secondary'; break;
                                }
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><span class="badge <?= $badge; ?>"><?= ucfirst($log['kategori']); ?></span></td>
                                <td class="text-primary font-weight-bold"><?= $log['judul']; ?></td>
                                <td><?= $log['deskripsi']; ?></td>
                                <td class="text-center"><?= $log['tanggal']; ?></td>
                                <td class="text-center"><?= $log['dibuat_oleh']; ?></td>
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
            "autoWidth": false,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data"
            }
        });
    });
</script>
