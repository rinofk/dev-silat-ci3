<style>
    /* Custom CSS for Edit Pengajuan Bebas Lab */
    .form-card-custom {
        border-radius: 16px;
        border: none;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
    }
    .form-card-custom .card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f3f9;
        padding: 20px 24px;
    }
    .file-upload-wrapper {
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 30px 20px;
        text-align: center;
        background-color: #f8f9fc;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }
    .file-upload-wrapper:hover {
        border-color: #4e73df;
        background-color: #f1f5f9;
    }
    .file-upload-wrapper i {
        color: #94a3b8;
        transition: all 0.3s ease;
    }
    .file-upload-wrapper:hover i {
        color: #4e73df;
        transform: translateY(-5px);
    }
    .file-upload-wrapper input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .image-preview-frame {
        border: 2px solid #eaecf4;
        border-radius: 12px;
        padding: 8px;
        background-color: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        max-width: 200px;
        display: inline-block;
        transition: all 0.3s ease;
    }
    .image-preview-frame:hover {
        transform: scale(1.03);
        border-color: #4e73df;
    }
    .btn-submit-custom {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        color: #fff;
        padding: 10px 28px;
        border-radius: 30px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3);
        transition: all 0.3s ease;
    }
    .btn-submit-custom:hover {
        background: linear-gradient(135deg, #224abe 0%, #1e3d99 100%);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(78, 115, 223, 0.4);
    }
    .btn-cancel-custom {
        border-radius: 30px;
        padding: 10px 28px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
</style>

<div class="container-fluid px-4">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Edit Pengajuan</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7 mb-4">
            <div class="card form-card-custom shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit mr-2"></i>Perbarui Berkas Bebas Laboratorium</h6>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('laboratorium/do_update'); ?>" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id_bebaslab" value="<?= $pengajuan['id_bebaslab']; ?>">

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-gray-800">NIM Mahasiswa</label>
                            <input type="text" class="form-control bg-light font-weight-bold" value="<?= htmlspecialchars(strtoupper($pengajuan['nim_mahasiswa'])); ?>" disabled>
                        </div>

                        <?php if (!empty($pengajuan['ktm']) && file_exists('./assets/bebaslab/' . $pengajuan['ktm'])): ?>
                            <div class="form-group mb-4 text-center">
                                <label class="d-block font-weight-bold text-gray-800 text-left">Berkas KTM Saat Ini</label>
                                <div class="image-preview-frame">
                                    <a href="<?= base_url('assets/bebaslab/' . $pengajuan['ktm']); ?>" target="_blank">
                                        <img src="<?= base_url('assets/bebaslab/' . $pengajuan['ktm']); ?>" class="img-fluid rounded" alt="KTM Saat Ini">
                                    </a>
                                </div>
                                <span class="d-block text-muted text-xs mt-2">Klik gambar untuk memperbesar</span>
                            </div>
                        <?php endif; ?>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-gray-800">Ganti Berkas KTM (Opsional)</label>
                            <div class="file-upload-wrapper mb-2">
                                <i id="file-upload-icon" class="fas fa-cloud-upload-alt fa-3x text-gray-400 mb-3"></i>
                                <p id="file-upload-text" class="mb-1 font-weight-bold text-gray-700">Pilih atau Seret file KTM baru untuk mengganti</p>
                                <p class="text-xs text-muted mb-0">Format file yang diperbolehkan: <strong>JPG, JPEG, PNG</strong> (Maksimal 2MB)</p>
                                <input type="file" id="ktm" name="ktm" accept=".jpg,.jpeg,.png">
                            </div>
                            <small class="form-text text-muted font-italic text-center">Biarkan kosong jika Anda tidak ingin mengganti berkas KTM.</small>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-4" style="gap: 10px;">
                            <a href="<?= base_url('laboratorium'); ?>" class="btn btn-secondary btn-cancel-custom">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-primary btn-submit-custom shadow-sm">
                                <i class="fas fa-save mr-2"></i>Update Pengajuan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Auto script update file name upload -->
<script>
    document.getElementById('ktm').addEventListener('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            var fileName = file.name;
            var fileSize = (file.size / 1024 / 1024).toFixed(2); // in MB
            document.getElementById('file-upload-text').innerHTML = '<strong>' + fileName + '</strong> (' + fileSize + ' MB)';
            document.getElementById('file-upload-icon').className = "fas fa-check-circle fa-3x text-success mb-3";
            document.getElementById('file-upload-icon').style.color = "#16a34a";
        } else {
            document.getElementById('file-upload-text').innerText = "Pilih atau Seret file KTM baru untuk mengganti";
            document.getElementById('file-upload-icon').className = "fas fa-cloud-upload-alt fa-3x text-gray-400 mb-3";
        }
    });
</script>