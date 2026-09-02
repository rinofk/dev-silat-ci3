<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-xl-8 col-lg-10">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?php if (empty($bp['nim_mahasiswa'])) { ?>
        <div class="row mt-3">
            <div class="col-xl-8 col-lg-10 text-center py-5">
                <div class="card shadow border-0 p-4" style="border-radius: 20px;">
                    <div class="card-body">
                        <div class="icon-box mb-4 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(2, 132, 199, 0.1); border-radius: 50%; color: var(--primary);">
                            <i class="fas fa-book-reader fa-3x"></i>
                        </div>
                        <h4 class="font-weight-bold text-gray-900 mb-3">Surat Bebas Perpustakaan</h4>
                        <p class="text-muted mb-4" style="max-width: 500px; margin: 0 auto;">
                            Anda belum mengajukan surat bebas perpustakaan. Silakan unggah dokumen persyaratan Anda untuk memulai proses pengajuan.
                        </p>
                        <a href="<?= base_url('perpustakaan/tambah'); ?>" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 10px;">
                            <i class="fas fa-plus-circle mr-1"></i> Buat Surat Bebas Perpustakaan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <!-- Premium Form Layout -->
        <div class="row">
            <div class="col-xl-8 col-lg-10">
                <div class="card shadow mb-4 border-0" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header py-3 bg-gradient-primary text-white">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-book-open mr-2"></i>Status Bebas Perpustakaan</h6>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        
                        <!-- Status Alert Box -->
                        <div class="mb-4">
                            <?php if ($bp['status'] == 'accept') { ?>
                                <div class="alert alert-success border-0 shadow-sm p-3 d-flex align-items-center" style="border-radius: 12px; background-color: rgba(46, 204, 113, 0.15); color: #27ae60;">
                                    <i class="fas fa-check-circle fa-2x mr-3"></i>
                                    <div>
                                        <strong class="d-block mb-1" style="font-size: 16px;">Pengajuan Disetujui!</strong>
                                        Surat Bebas Perpustakaan Anda telah diverifikasi dan disetujui oleh petugas. Silakan cetak dokumen resmi Anda.
                                    </div>
                                </div>
                            <?php } elseif ($bp['status'] == 'reject') { ?>
                                <div class="alert alert-danger border-0 shadow-sm p-3 d-flex align-items-start" style="border-radius: 12px; background-color: rgba(231, 76, 60, 0.15); color: #c0392b;">
                                    <i class="fas fa-times-circle fa-2x mr-3 mt-1"></i>
                                    <div>
                                        <strong class="d-block mb-1" style="font-size: 16px;">Pengajuan Ditolak</strong>
                                        <span>Alasan penolakan: <strong><?= $bp['keterangan'] ?: '-' ?></strong></span>
                                        <div class="mt-2 text-muted small">Silakan perbarui berkas yang salah di bawah ini dan klik tombol <strong>Kirim Ulang</strong> untuk memperbarui data sekaligus mengajukannya kembali.</div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-warning border-0 shadow-sm p-3 d-flex align-items-center" style="border-radius: 12px; background-color: rgba(241, 196, 15, 0.15); color: #d35400;">
                                    <i class="fas fa-info-circle fa-2x mr-3"></i>
                                    <div>
                                        <strong class="d-block mb-1" style="font-size: 16px;">Dalam Proses Verifikasi</strong>
                                        Berkas Anda telah diajukan dan sedang menunggu verifikasi oleh pustakawan.
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <?= form_open_multipart('perpustakaan/do_update'); ?>
                        
                        <!-- Action type parameter to handle update vs resubmit -->
                        <input type="hidden" name="action_type" id="action_type" value="save">

                        <!-- Data Diri Mahasiswa -->
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-light" id="name" name="name" value="<?= $mahasiswa['nama_lengkap'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nim" class="col-sm-3 col-form-label font-weight-bold text-gray-800">NIM</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-light" id="nim" name="nim" value="<?= $mahasiswa['nim'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-light" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prodi" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Program Studi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-light" id="prodi" name="prodi" value="<?= $mahasiswa['nama_prodi'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ttl" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-light" id="ttl" name="ttl" value="<?= $mahasiswa['tempat_lahir'] . ', ' . $mahasiswa['tgl_lahir'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-light" id="alamat" name="alamat" value="<?= $mahasiswa['alamat'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_hp" class="col-sm-3 col-form-label font-weight-bold text-gray-800">No HP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-light" id="no_hp" name="no_hp" value="<?= $mahasiswa['no_hp'] ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="semester" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Semester</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="semester" name="semester" value="<?= $bp['semester'] ?>" <?= ($bp['status'] != 'reject') ? 'readonly class="bg-light"' : '' ?> required>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="text-gray-800 font-weight-bold mb-3"><i class="fas fa-file-alt mr-1"></i> Berkas Persyaratan</h5>

                        <!-- KTM File Upload & Thumbnail -->
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bold text-gray-800">KTM (PDF/Gambar)</label>
                            <div class="col-sm-9">
                                <?php if ($bp['status'] == 'reject') { ?>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 mr-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="ktm" name="ktm" accept="image/*,application/pdf">
                                                <label class="custom-file-label" for="ktm"><?= $bp['ktm'] ?: 'Pilih berkas...' ?></label>
                                            </div>
                                            <input type="hidden" name="temp_ktm" id="temp_ktm" value="">
                                            <div class="upload-status-msg mt-2 font-weight-bold" id="status-ktm" style="display:none; font-size: 0.9rem;"></div>
                                            <small class="text-muted d-block mt-1">Format: jpg, jpeg, png, pdf. Maksimal 2 MB.</small>
                                        </div>
                                        <?php if (!empty($bp['ktm'])) { 
                                            $ext_ktm = pathinfo($bp['ktm'], PATHINFO_EXTENSION);
                                            $is_pdf_ktm = strtolower($ext_ktm) === 'pdf';
                                        ?>
                                            <div class="thumbnail-preview">
                                                <a href="<?= base_url('assets/bebasperpus/' . $bp['ktm']); ?>" target="_blank" title="Klik untuk memperbesar / melihat berkas">
                                                    <?php if ($is_pdf_ktm) { ?>
                                                        <div class="d-flex align-items-center justify-content-center bg-light border rounded shadow-sm" style="width: 60px; height: 60px; color: #e74c3c;">
                                                            <i class="fas fa-file-pdf fa-2x"></i>
                                                        </div>
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('assets/bebasperpus/' . $bp['ktm']); ?>" alt="KTM" class="img-thumbnail shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="d-flex align-items-center">
                                        <?php 
                                            $ext_ktm = pathinfo($bp['ktm'], PATHINFO_EXTENSION);
                                            $is_pdf_ktm = strtolower($ext_ktm) === 'pdf';
                                        ?>
                                        <?php if (!empty($bp['ktm'])) { ?>
                                            <div class="thumbnail-preview mr-3">
                                                <a href="<?= base_url('assets/bebasperpus/' . $bp['ktm']); ?>" target="_blank" title="Klik untuk melihat berkas">
                                                    <?php if ($is_pdf_ktm) { ?>
                                                        <div class="d-flex align-items-center justify-content-center bg-light border rounded shadow-sm" style="width: 60px; height: 60px; color: #e74c3c;">
                                                            <i class="fas fa-file-pdf fa-2x"></i>
                                                        </div>
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('assets/bebasperpus/' . $bp['ktm']); ?>" alt="KTM" class="img-thumbnail shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i> Terunggah</span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Kartu Anggota Perpustakaan & Thumbnail -->
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-3 col-form-label font-weight-bold text-gray-800">Kartu Perpustakaan</label>
                            <div class="col-sm-9">
                                <?php if ($bp['status'] == 'reject') { ?>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 mr-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="anggota" name="anggota" accept="image/*,application/pdf">
                                                <label class="custom-file-label" for="anggota"><?= $bp['kartuperpus'] ?: 'Pilih berkas...' ?></label>
                                            </div>
                                            <input type="hidden" name="temp_anggota" id="temp_anggota" value="">
                                            <div class="upload-status-msg mt-2 font-weight-bold" id="status-anggota" style="display:none; font-size: 0.9rem;"></div>
                                            <small class="text-muted d-block mt-1">Format: jpg, jpeg, png, pdf. Maksimal 2 MB.</small>
                                        </div>
                                        <?php if (!empty($bp['kartuperpus'])) { 
                                            $ext_anggota = pathinfo($bp['kartuperpus'], PATHINFO_EXTENSION);
                                            $is_pdf_anggota = strtolower($ext_anggota) === 'pdf';
                                        ?>
                                            <div class="thumbnail-preview">
                                                <a href="<?= base_url('assets/bebasperpus/' . $bp['kartuperpus']); ?>" target="_blank" title="Klik untuk memperbesar / melihat berkas">
                                                    <?php if ($is_pdf_anggota) { ?>
                                                        <div class="d-flex align-items-center justify-content-center bg-light border rounded shadow-sm" style="width: 60px; height: 60px; color: #e74c3c;">
                                                            <i class="fas fa-file-pdf fa-2x"></i>
                                                        </div>
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('assets/bebasperpus/' . $bp['kartuperpus']); ?>" alt="Kartu Perpustakaan" class="img-thumbnail shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="d-flex align-items-center">
                                        <?php 
                                            $ext_anggota = pathinfo($bp['kartuperpus'], PATHINFO_EXTENSION);
                                            $is_pdf_anggota = strtolower($ext_anggota) === 'pdf';
                                        ?>
                                        <?php if (!empty($bp['kartuperpus'])) { ?>
                                            <div class="thumbnail-preview mr-3">
                                                <a href="<?= base_url('assets/bebasperpus/' . $bp['kartuperpus']); ?>" target="_blank" title="Klik untuk melihat berkas">
                                                    <?php if ($is_pdf_anggota) { ?>
                                                        <div class="d-flex align-items-center justify-content-center bg-light border rounded shadow-sm" style="width: 60px; height: 60px; color: #e74c3c;">
                                                            <i class="fas fa-file-pdf fa-2x"></i>
                                                        </div>
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('assets/bebasperpus/' . $bp['kartuperpus']); ?>" alt="Kartu Perpustakaan" class="img-thumbnail shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i> Terunggah</span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <?php if ($bp['status'] == 'reject') { ?>
                                    <button type="submit" onclick="document.getElementById('action_type').value='save';" class="btn btn-primary px-4 py-2 font-weight-bold mr-2 shadow-sm" style="border-radius: 10px;">
                                        <i class="fas fa-save mr-1"></i> Update
                                    </button>
                                    <button type="submit" onclick="document.getElementById('action_type').value='resubmit';" class="btn btn-success px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 10px;">
                                        <i class="fas fa-paper-plane mr-1"></i> Kirim Ulang
                                    </button>
                                <?php } elseif ($bp['status'] == 'accept') { ?>
                                    <a href="<?= base_url('perpustakaan/cetak/' . $bp['id_bp']); ?>" class="btn btn-success px-5 py-2.5 font-weight-bold shadow-sm" target="_blank" style="border-radius: 10px; font-size: 16px;">
                                        <i class="fas fa-print mr-1"></i> Cetak Surat Bebas Perpustakaan
                                    </a>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-secondary px-4 py-2 font-weight-bold shadow-sm disabled" style="border-radius: 10px;" disabled>
                                        <i class="fas fa-lock mr-1"></i> Berkas Sedang Ditinjau
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>

                <!-- Bantuan Admin -->
                <div class="mt-4 p-3 bg-light rounded shadow-sm d-flex align-items-center" style="border-radius: 12px; border: 1px solid #e2e8f0;">
                    <div class="text-success mr-3" style="font-size: 1.5rem;"><i class="fab fa-whatsapp"></i></div>
                    <div class="small">
                        Butuh bantuan perihal Bebas Perpustakaan? Hubungi petugas perpustakaan: <a href="https://wa.me/6281345434600?text=Hai%20Admin%20Aplikasi%20bebas%20Perpustakaan" target="_blank" class="font-weight-bold text-success">Suryani (WhatsApp)</a>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>

</div>
</div>

<!-- AJAX Real-time Upload Script (Hanya aktif jika status ditolak/bisa diubah) -->
<?php if (!empty($bp['status']) && $bp['status'] == 'reject') { ?>
<script>
    $(document).ready(function() {
        // Handle label updating
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        // AJAX Real-time upload function
        function handleRealtimeUpload(inputElement, statusElement, hiddenInput) {
            var file = inputElement.files[0];
            if (!file) return;

            // Client-side size check (2 MB limit)
            var maxSize = 2 * 1024 * 1024;
            if (file.size > maxSize) {
                statusElement.show().removeClass('text-success text-info').addClass('text-danger').html(
                    '<i class="fas fa-exclamation-triangle mr-1"></i> Ukuran berkas melebihi batas 2 MB (Ukuran berkas Anda: ' + (file.size / (1024 * 1024)).toFixed(2) + ' MB)'
                );
                // Reset input
                $(inputElement).val('');
                $(inputElement).next('.custom-file-label').removeClass("selected").html('Pilih berkas...');
                hiddenInput.val('');
                return;
            }

            var formData = new FormData();
            formData.append(inputElement.id, file);

            // Display loading indicator
            statusElement.show().removeClass('text-success text-danger').addClass('text-info').html(
                '<i class="fas fa-spinner fa-spin mr-1"></i> Sedang mengunggah berkas...'
            );
            
            // Disable buttons during upload
            $('button[type="submit"], a.btn').prop('disabled', true).addClass('disabled');

            $.ajax({
                url: '<?= base_url("perpustakaan/upload_ajax"); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        statusElement.removeClass('text-info text-danger').addClass('text-success').html(
                            '<i class="fas fa-check-circle mr-1"></i> Berhasil diunggah: ' + response.file_name
                        );
                        hiddenInput.val(response.file_name);
                    } else {
                        statusElement.removeClass('text-info text-success').addClass('text-danger').html(
                            '<i class="fas fa-times-circle mr-1"></i> Gagal: ' + response.message
                        );
                        $(inputElement).val('');
                        $(inputElement).next('.custom-file-label').removeClass("selected").html('Pilih berkas...');
                        hiddenInput.val('');
                    }
                },
                error: function(xhr, status, error) {
                    var errMsg = 'Terjadi kesalahan saat mengunggah.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errMsg = xhr.responseJSON.message;
                    }
                    statusElement.removeClass('text-info text-success').addClass('text-danger').html(
                        '<i class="fas fa-times-circle mr-1"></i> Gagal: ' + errMsg
                    );
                    $(inputElement).val('');
                    $(inputElement).next('.custom-file-label').removeClass("selected").html('Pilih berkas...');
                    hiddenInput.val('');
                },
                complete: function() {
                    // Check if any other uploads are still active
                    var activeUploads = false;
                    $('.upload-status-msg').each(function() {
                        if ($(this).hasClass('text-info')) {
                            activeUploads = true;
                        }
                    });
                    if (!activeUploads) {
                        $('button[type="submit"], a.btn').prop('disabled', false).removeClass('disabled');
                    }
                }
            });
        }

        // Attach listeners to file inputs
        $('#ktm').on('change', function() {
            handleRealtimeUpload(this, $('#status-ktm'), $('#temp_ktm'));
        });
        $('#anggota').on('change', function() {
            handleRealtimeUpload(this, $('#status-anggota'), $('#temp_anggota'));
        });
    });
</script>
<?php } ?>