<div class="container-fluid">

    <h1 class="h4 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow">
        <div class="card-header">
            <strong>Edit Pengajuan</strong>
        </div>

        <div class="card-body">
            <form action="<?= base_url('laboratorium/do_update'); ?>" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id_bebaslab" value="<?= $pengajuan['id_bebaslab']; ?>">

                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" class="form-control" value="<?= $pengajuan['nim_mahasiswa']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Upload KTM (opsional)</label><br>
                    <?php if (!empty($pengajuan['ktm'])): ?>
                        <img src="<?= base_url('assets/bebaslab/' . $pengajuan['ktm']); ?>"
                            width="120" class="mb-2">
                    <?php endif; ?>

                    <input type="file" name="ktm" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('laboratorium'); ?>" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>

</div>