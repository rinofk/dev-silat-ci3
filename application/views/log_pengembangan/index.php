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
            <ul class="list-group">
                <?php foreach ($logs as $log): ?>
                    <li class="list-group-item">
                        <strong>[<?= ucfirst($log['kategori']); ?>]</strong> 
                        <span class="text-primary"><?= $log['judul']; ?></span>  
                        <br>
                        <small><?= $log['deskripsi']; ?></small><br>
                        <small class="text-muted"><?= $log['tanggal']; ?> - <?= $log['dibuat_oleh']; ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
