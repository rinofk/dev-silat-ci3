<!-- Begin Page Content -->
<style>
    /* Custom CSS for Tambah Pengajuan Bebas Lab */
    .profile-card-custom {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: #ffffff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(78, 115, 223, 0.15);
        overflow: hidden;
        position: relative;
    }
    .profile-card-custom::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        top: -40px;
        right: -40px;
    }
    .profile-card-custom::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        bottom: -20px;
        left: -20px;
    }
    .profile-card-custom .card-header {
        background: rgba(0, 0, 0, 0.1);
        border-bottom: none;
        padding: 20px 24px;
    }
    .profile-card-custom .info-label {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 700;
        margin-bottom: 2px;
    }
    .profile-card-custom .info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 16px;
        line-height: 1.4;
    }
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
        padding: 35px 20px;
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
        <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Buat Pengajuan Baru</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Profil/Informasi Mahasiswa -->
        <div class="col-lg-5 mb-4">
            <div class="card profile-card-custom shadow h-100">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-id-card fa-lg mr-2"></i>
                    <h6 class="m-0 font-weight-bold">Informasi Mahasiswa</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="info-label">Nama Lengkap</div>
                            <div class="info-value"><?= htmlspecialchars($mahasiswa['nama_lengkap']); ?></div>

                            <div class="info-label">NIM</div>
                            <div class="info-value"><?= htmlspecialchars(strtoupper($mahasiswa['nim'])); ?></div>

                            <div class="info-label">Program Studi</div>
                            <div class="info-value"><?= htmlspecialchars($mahasiswa['nama_prodi']); ?></div>

                            <div class="info-label">Email</div>
                            <div class="info-value"><?= htmlspecialchars($user['email']); ?></div>

                            <div class="info-label">Tempat, Tanggal Lahir</div>
                            <div class="info-value"><?= htmlspecialchars($mahasiswa['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($mahasiswa['tgl_lahir']))); ?></div>

                            <div class="info-label">Alamat Lengkap</div>
                            <div class="info-value" style="margin-bottom: 0;"><?= htmlspecialchars($mahasiswa['alamat']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Formulir Upload & Save -->
        <div class="col-lg-7 mb-4">
            <div class="card form-card-custom shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit mr-2"></i>Formulir Bebas Laboratorium</h6>
                </div>
                <div class="card-body p-4">
                    <?= form_open_multipart('laboratorium/do_upload'); ?>
                        
                        <!-- NIM hidden input -->
                        <input type="hidden" name="nim" value="<?= $mahasiswa['nim'] ?>">

                        <div class="form-group mb-4">
                            <label for="no_hp" class="font-weight-bold text-gray-800">Nomor WhatsApp (Aktif)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0"><i class="fab fa-whatsapp text-success font-weight-bold"></i></span>
                                </div>
                                <input type="text" class="form-control border-left-0 bg-light" id="no_hp" name="no_hp" 
                                    value="<?= htmlspecialchars($mahasiswa['no_hp']); ?>" placeholder="Contoh: 08123456789" required>
                            </div>
                            <small class="form-text text-muted">Pastikan nomor aktif agar dapat dihubungi oleh petugas jika diperlukan.</small>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-gray-800">Unggah KTM (Kartu Tanda Mahasiswa)</label>
                            <div class="file-upload-wrapper mb-2">
                                <i id="file-upload-icon" class="fas fa-cloud-upload-alt fa-3x text-gray-400 mb-3"></i>
                                <p id="file-upload-text" class="mb-1 font-weight-bold text-gray-700">Pilih atau Seret file KTM Anda disini</p>
                                <p class="text-xs text-muted mb-0">Format file yang diperbolehkan: <strong>JPG, JPEG, PNG</strong> (Maksimal 2MB)</p>
                                <input type="file" id="ktm" name="ktm" accept=".jpg,.jpeg,.png" required>
                            </div>
                            <small class="form-text text-muted font-italic text-center">Format penamaan berkas otomatis akan disesuaikan oleh sistem.</small>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-4" style="gap: 10px;">
                            <a href="<?= base_url('laboratorium'); ?>" class="btn btn-secondary btn-cancel-custom">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-submit-custom shadow-sm">
                                <i class="fas fa-save mr-2"></i>Simpan Pengajuan
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
            document.getElementById('file-upload-text').innerText = "Pilih atau Seret file KTM Anda disini";
            document.getElementById('file-upload-icon').className = "fas fa-cloud-upload-alt fa-3x text-gray-400 mb-3";
        }
    });
</script>