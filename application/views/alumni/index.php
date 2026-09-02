<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Data Alumni</h1>
    </div>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show py-2 px-3 small shadow-sm" role="alert" style="border-radius: 8px;">
            <i class="fas fa-check-circle mr-1"></i> Data alumni <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
            <button type="button" class="close py-2" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- ALERT PERINGATAN KETENTUAN ALUMNI -->
    <div class="alert alert-warning border-left-warning shadow-sm mb-3 py-2 px-3 small" style="border-radius: 8px;" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-triangle text-warning mr-2 fa-lg"></i>
            <div class="text-gray-800">
                <strong>Penting:</strong> Mahasiswa yang telah mendaftar sebagai <strong>Alumni</strong> tidak dapat lagi mengajukan <strong>Surat Aktif Kuliah</strong>. Pastikan seluruh permohonan surat aktif kuliah Anda telah selesai sebelum mendaftar alumni.
            </div>
        </div>
    </div>

    <?php if (empty($status['id_alumni'])) { ?>
        <!-- LAYOUT BELUM MENDAFTAR ALUMNI -->
        <div class="card shadow mb-4 border-0" style="border-radius: 16px;">
            <div class="card-body p-4 text-center py-5">
                <div class="icon-box mb-4 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(78, 115, 223, 0.1); border-radius: 50%; color: #4e73df;">
                    <i class="fas fa-user-graduate fa-3x"></i>
                </div>
                <h4 class="font-weight-bold text-gray-900 mb-2">Pendaftaran Alumni</h4>
                <p class="text-muted mb-4" style="max-width: 520px; margin: 0 auto; font-size: 0.95rem;">
                    Anda belum terdaftar sebagai alumni. Silakan klik tombol di bawah untuk melengkapi data kelulusan Anda.
                </p>
                <a href="<?= base_url(); ?>alumni/tambah" class="btn btn-primary px-4 py-2.5 font-weight-bold shadow-sm" style="border-radius: 10px; font-size: 0.95rem;">
                    <i class="fas fa-plus-circle mr-2"></i> Daftar Menjadi Alumni
                </a>
            </div>
        </div>

    <?php } else { 
        $foto_file = !empty($alumni['poto']) && file_exists('./assets/img/alumni/' . $alumni['poto'])
            ? $alumni['poto']
            : 'default.jpg';
        $foto_url = base_url('assets/img/alumni/' . $foto_file) . '?v=' . time();
    ?>
        <!-- LAYOUT SUDAH MENDAFTAR ALUMNI (2 KOLOM: 4 / 8) -->
        <div class="row">
            <!-- Kolom Kiri: Pas Foto, Alamat & Cetak (col-lg-4) -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                    <div class="card-header py-3 bg-gradient-primary text-white d-flex align-items-center justify-content-between" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-camera mr-2"></i>Pas Foto Alumni</h6>
                        <span class="badge badge-light px-2 py-1 small"><i class="fas fa-bolt text-warning mr-1"></i>Realtime</span>
                    </div>
                    <div class="card-body p-3 text-center d-flex flex-column justify-content-between">
                        <div>
                            <!-- Foto Preview Box -->
                            <div class="position-relative d-inline-block shadow-sm rounded mb-3 mt-1" style="border: 3px solid #e3e6f0; overflow: hidden; background: #fafafa; width: 125px; height: 160px;">
                                <img id="preview-poto" src="<?= $foto_url; ?>" class="w-100 h-100" style="object-fit: cover;" alt="Pas Foto">
                                <div id="upload-loading" class="d-none position-absolute w-100 h-100 align-items-center justify-content-center" style="top:0; left:0; background: rgba(255,255,255,0.85);">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                </div>
                            </div>

                            <!-- Input Foto -->
                            <div class="custom-file text-left mb-2">
                                <input type="file" class="custom-file-input" id="poto" name="poto" accept=".jpg,.jpeg,.png,.gif,image/jpeg,image/png,image/gif">
                                <label class="custom-file-label small text-truncate" for="poto" id="poto-label">Pilih berkas foto...</label>
                            </div>
                            <small class="text-muted d-block small mb-2 text-left" style="font-size: 0.78rem;">
                                <i class="fas fa-info-circle mr-1"></i>JPG, JPEG, PNG (maks. 6 MB). Otomatis tersimpan.
                            </small>
                            <div id="upload-status" class="mb-3"></div>

                            <hr class="my-3">

                            <!-- Form Update Alamat Sekarang -->
                            <?= form_open('alumni/upload', ['class' => 'text-left']); ?>
                            <input type="hidden" name="nim" value="<?= $user['nim']; ?>">
                            <label for="alamat" class="small font-weight-bold text-gray-800 mb-1">
                                <i class="fas fa-map-marker-alt text-danger mr-1"></i> Alamat Domisili Sekarang:
                            </label>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Tulis alamat domisili..." value="<?= htmlspecialchars($alumni['alamat_sekarang'] ?? ''); ?>">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary font-weight-bold px-3">
                                        <i class="fas fa-save mr-1"></i> Simpan
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>

                        <!-- Tombol Cetak Kartu Alumni -->
                        <div class="mt-3 pt-2 border-top">
                            <a href="<?= base_url('alumni/cetak/' . $alumni['nim_alumni']); ?>" target="_blank" class="btn btn-success btn-block font-weight-bold shadow-sm py-2" style="border-radius: 8px; font-size: 0.92rem;">
                                <i class="fas fa-print mr-1"></i> Cetak Bukti Alumni
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Tabel Biodata Alumni (col-lg-8) -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                    <div class="card-header py-3 bg-white border-bottom d-flex align-items-center justify-content-between" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-id-card mr-2"></i>Biodata Alumni
                        </h6>
                        <a href="<?= base_url('alumni/ubah/' . $alumni['nim_alumni']); ?>" class="btn btn-sm btn-warning font-weight-bold shadow-sm" style="border-radius: 6px;">
                            <i class="fas fa-edit mr-1"></i> Ubah Biodata
                        </a>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered mb-0" style="font-size: 0.88rem;">
                                <tbody>
                                    <tr>
                                        <td width="200" class="bg-light text-gray-800 align-middle">Nama Lengkap</td>
                                        <td class="text-gray-800 align-middle"><?= htmlspecialchars($alumni['nama_lengkap']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">NIM</td>
                                        <td class="text-gray-800 align-middle"><?= htmlspecialchars($alumni['nim_alumni']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">Tempat / Tgl Lahir</td>
                                        <td class="text-gray-800 align-middle"><?= htmlspecialchars($alumni['tempat_lahir']); ?>, <?= htmlspecialchars($alumni['tgl_lahir']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">Nomor HP</td>
                                        <td class="text-gray-800 align-middle"><?= htmlspecialchars($alumni['no_hp']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">Email</td>
                                        <td class="text-gray-800 align-middle"><?= htmlspecialchars($alumni['email']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">Alamat Asal</td>
                                        <td class="text-gray-800 align-middle"><?= htmlspecialchars($alumni['alamat']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">Tahun Wisuda</td>
                                        <td class="text-gray-800 align-middle"><?= htmlspecialchars($alumni['tahun_wisuda']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">Jalur Masuk</td>
                                        <td class="text-gray-800 align-middle"><?= htmlspecialchars($alumni['jalur_masuk']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">Program Studi</td>
                                        <td class="text-gray-800 align-middle"><?= htmlspecialchars($alumni['nama_prodi']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">Agama</td>
                                        <td class="text-gray-800 align-middle"><?= htmlspecialchars($alumni['agamaa']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">Judul Skripsi</td>
                                        <td class="text-gray-800 align-middle text-justify"><?= htmlspecialchars($alumni['judul_skripsi']); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light text-gray-800 align-middle">Pesan dan Kesan</td>
                                        <td class="text-gray-800 align-middle text-justify"><?= htmlspecialchars($alumni['pesan_kesan']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <?php if ($status['status_alumni'] == 0) { ?>
                            <div class="mt-3 text-right pt-2 border-top">
                                <a href="<?= base_url('alumni/kirim/' . $alumni['nim_alumni']); ?>" class="btn btn-primary px-4 font-weight-bold shadow-sm" style="border-radius: 8px;">
                                    <i class="fas fa-paper-plane mr-1"></i> Kirim Data Alumni
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('poto');
        if (!fileInput) return;

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            const label = document.getElementById('poto-label');
            if (label) {
                label.textContent = file.name;
            }

            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/pjpeg', 'image/x-png'];
            const statusEl = document.getElementById('upload-status');
            const loadingEl = document.getElementById('upload-loading');
            const previewEl = document.getElementById('preview-poto');

            if (!validTypes.includes(file.type.toLowerCase()) && !file.name.match(/\.(jpg|jpeg|png|gif)$/i)) {
                if (statusEl) {
                    statusEl.innerHTML = '<div class="alert alert-danger py-1 px-2 mb-0 small"><i class="fas fa-exclamation-triangle mr-1"></i> Format file harus JPG, JPEG, PNG, atau GIF.</div>';
                }
                fileInput.value = '';
                return;
            }

            if (file.size > 6 * 1024 * 1024) {
                if (statusEl) {
                    statusEl.innerHTML = '<div class="alert alert-danger py-1 px-2 mb-0 small"><i class="fas fa-exclamation-triangle mr-1"></i> Ukuran file maks. 6 MB.</div>';
                }
                fileInput.value = '';
                return;
            }

            // Preview instan lokal (FileReader)
            const reader = new FileReader();
            reader.onload = function(e) {
                if (previewEl) {
                    previewEl.src = e.target.result;
                }
            };
            reader.readAsDataURL(file);

            // Tampilkan state loading
            if (loadingEl) {
                loadingEl.classList.remove('d-none');
                loadingEl.classList.add('d-flex');
            }
            if (statusEl) {
                statusEl.innerHTML = '<div class="text-primary small font-weight-bold"><i class="fas fa-spinner fa-spin mr-1"></i> Mengunggah...</div>';
            }

            // Upload Realtime via AJAX FormData
            const formData = new FormData();
            formData.append('poto', file);

            fetch('<?= base_url("alumni/upload_ajax"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(res) {
                if (loadingEl) {
                    loadingEl.classList.add('d-none');
                    loadingEl.classList.remove('d-flex');
                }
                if (res.status === 'success') {
                    if (previewEl && res.file_url) {
                        previewEl.src = res.file_url;
                    }
                    if (statusEl) {
                        statusEl.innerHTML = '<div class="alert alert-success py-1 px-2 mb-0 small shadow-sm"><i class="fas fa-check-circle mr-1"></i> Foto tersimpan!</div>';
                        setTimeout(function() {
                            if (statusEl) {
                                statusEl.innerHTML = '';
                            }
                        }, 4000);
                    }
                } else {
                    if (statusEl) {
                        statusEl.innerHTML = '<div class="alert alert-danger py-1 px-2 mb-0 small shadow-sm"><i class="fas fa-times-circle mr-1"></i> ' + (res.message || 'Gagal unggah.') + '</div>';
                    }
                }
            })
            .catch(function(err) {
                if (loadingEl) {
                    loadingEl.classList.add('d-none');
                    loadingEl.classList.remove('d-flex');
                }
                if (statusEl) {
                    statusEl.innerHTML = '<div class="alert alert-danger py-1 px-2 mb-0 small shadow-sm"><i class="fas fa-times-circle mr-1"></i> Gagal koneksi server.</div>';
                }
            });
        });
    });
</script>