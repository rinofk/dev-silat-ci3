<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?php
    if ($user['role_id'] == '2') {
        if ($mahasiswa['status_aktif'] != '1') {; ?>

            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <a href="<?= base_url(); ?>user/biodata" type="button" class="btn btn-outline-primary mb-3">Input Biodata</a>
                    </div>
                </div>
            </div>
        <?php }
        } else {; ?>
    <?php }; ?>


    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">Untuk Bantuan Penggunaan Aplikasi</p>
                    <p class="card-text"><a href="https://wa.me/6285391044299?text=Hai%20Administrator%20aplikasi%20silat%20fkuntan, " rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i> Hubungi Administrator Kami</a></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">Panduan</p>
                    <p class="card-text">1. <a href="https://drive.google.com/file/d/1LR9FskaTIKs4mLr_FysL0b6BT5JpVRns/view?usp=sharing" rel="nofollow" target="_blank">Download Panduan Berkas Yudisium.pdf</a></p>
                </div>
            </div>
        </div>
    </div> -->
    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->