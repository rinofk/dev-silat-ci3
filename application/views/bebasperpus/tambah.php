<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-xl-8 col-lg-10">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Premium Form Layout -->
    <div class="row">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow mb-4 border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header py-3 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>Buat Pengajuan Bebas Perpustakaan</h6>
                </div>

                <div class="card-body p-4 p-md-5">
                    
                    <?= form_open_multipart('perpustakaan/do_upload', ['id' => 'formBebasPerpus']); ?>

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
                            <input type="text" class="form-control" id="semester" name="semester" placeholder="Contoh: 8" required>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h5 class="text-gray-800 font-weight-bold mb-3"><i class="fas fa-file-alt mr-1"></i> Berkas Persyaratan</h5>

                    <!-- KTM File Upload -->
                    <div class="form-group row align-items-center">
                        <label class="col-sm-3 col-form-label font-weight-bold text-gray-800">KTM (PDF/Gambar)</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="ktm" name="ktm" accept="image/*,application/pdf" required>
                                    <label class="custom-file-label" for="ktm">Pilih berkas...</label>
                                </div>
                            </div>
                            <input type="hidden" name="temp_ktm" id="temp_ktm" value="" required>
                            <div class="upload-status-msg mt-2 font-weight-bold" id="status-ktm" style="display:none; font-size: 0.9rem;"></div>
                            <small class="text-muted d-block mt-1">Format: jpg, jpeg, png, pdf. Maksimal 2 MB.</small>
                        </div>
                    </div>

                    <!-- Kartu Anggota Perpustakaan -->
                    <div class="form-group row align-items-center mt-3">
                        <label class="col-sm-3 col-form-label font-weight-bold text-gray-800">Kartu Perpustakaan</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="anggota" name="anggota" accept="image/*,application/pdf">
                                    <label class="custom-file-label" for="anggota">Pilih berkas...</label>
                                </div>
                            </div>
                            <input type="hidden" name="temp_anggota" id="temp_anggota" value="">
                            <div class="upload-status-msg mt-2 font-weight-bold" id="status-anggota" style="display:none; font-size: 0.9rem;"></div>
                            <small class="text-muted d-block mt-1">Format: jpg, jpeg, png, pdf. Maksimal 2 MB. (Opsional / Lewati jika tidak ada)</small>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <a href="<?= base_url('perpustakaan'); ?>" class="btn btn-secondary px-4 py-2 font-weight-bold mr-2 shadow-sm" style="border-radius: 10px;">
                                <i class="fas fa-arrow-left mr-1"></i> Batal
                            </a>
                            <button type="submit" id="btnSubmit" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="border-radius: 10px;">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
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

</div>
</div>

<!-- AJAX Real-time Upload Script -->
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
            
            // Disable submit button during upload
            $('#btnSubmit, a.btn').prop('disabled', true).addClass('disabled');

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
                        $('#btnSubmit, a.btn').prop('disabled', false).removeClass('disabled');
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

        // Client-side verification on form submit to ensure KTM is uploaded
        $('#formBebasPerpus').on('submit', function(e) {
            if ($('#temp_ktm').val() === '') {
                e.preventDefault();
                alert('Silakan tunggu hingga berkas KTM selesai diunggah, atau unggah ulang berkas KTM Anda.');
            }
        });
    });
</script>