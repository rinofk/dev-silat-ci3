<?php
$current_year = date('Y');
$current_month = date('n');
if ($current_month >= 8) {
    $now_ta = $current_year . '/' . ($current_year + 1);
} else {
    $now_ta = ($current_year - 1) . '/' . $current_year;
}

$years_list = [];
$start_year = date('Y') + 1; 
for ($i = 0; $i < 3; $i++) {
    $y = $start_year - $i;
    $years_list[] = ($y - 1) . '/' . $y;
}
?>
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">Pengajuan Surat Baru</h6>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger shadow-sm" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open_multipart('surat/tambah'); ?>

                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label font-weight-bold text-gray-800">NIM</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="nim" class="form-control bg-light" id="nim" value="<?= $user['nim']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_lengkap" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Nama Lengkap</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="nama_lengkap" class="form-control bg-light" id="nama_lengkap" value="<?= $user['name']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="semester" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Semester</label>
                        <div class="col-sm-9">
                            <select id="semester" name="semester" class="form-control" value="<?= set_value('semester'); ?>">
                                <option value="">Silakan Pilih</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tahun_ajaran" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Tahun Ajaran</label>
                        <div class="col-sm-9">
                            <select id="tahun_ajaran" name="tahun_ajaran" class="form-control">
                                <option value="">Silakan Pilih</option>
                                <?php foreach ($years_list as $ta): ?>
                                    <option value="<?= $ta; ?>" <?= ($ta === $now_ta) ? 'selected' : ''; ?>>
                                        <?= $ta; ?><?= ($ta === $now_ta) ? ' (Tahun Sekarang)' : ''; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keperluan" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Keperluan</label>
                        <div class="col-sm-9">
                            <select id="keperluan" name="keperluan" class="form-control" value="<?= set_value('keperluan'); ?>">
                                <option value="">Silakan Pilih</option>
                                <option value="1">masuk dalam tunjangan gaji orang tua</option>
                                <option value="2">pensiun orang tua</option>
                                <option value="3">asuransi (askes)</option>
                                <option value="4">BPJS</option>
                                <option value="5">Pengajuan Beasiswa</option>
                                <option value="6">mengikuti kegiatan</option>
                                <option value="0">lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ktm" class="col-sm-3 col-form-label font-weight-bold text-gray-800">KTM (PDF)</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="ktm" name="ktm" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                <label class="custom-file-label" for="ktm">Upload KTM (format filename "nim-ktm.pdf")</label>
                            </div>
                            <input type="hidden" name="temp_ktm" id="temp_ktm" value="">
                            <div class="upload-status-msg mt-2 font-weight-bold" id="status-ktm" style="display:none; font-size: 0.9rem;"></div>
                        </div>
                    </div>

                    <!-- Keterangan (id="keterangan") -->
                    <div id="keterangan" hidden>
                        <div class="form-group row">
                            <label for="keterangan_input" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" name="keterangan" id="keterangan_input" class="form-control" placeholder="Masukkan keterangan keperluan..." />
                            </div>
                        </div>
                    </div>

                    <!-- Lainnya (id="lainnya") -->
                    <div id="lainnya" hidden>
                        <div class="form-group row">
                            <label for="lainnya_input" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Keperluan Lainnya</label>
                            <div class="col-sm-9">
                                <input type="text" name="lainnya" id="lainnya_input" class="form-control" placeholder="Tuliskan keperluan lainnya..." />
                            </div>
                        </div>
                    </div>

                    <!-- Detail Orang Tua & Berkas tambahan (id="id_keperluan") -->
                    <div id="id_keperluan" hidden>
                        <hr class="my-4">
                        <h5 class="text-gray-800 font-weight-bold mb-3"><i class="fas fa-user-friends mr-1"></i> Data Orang Tua / Wali</h5>
                        
                        <div class="form-group row">
                            <label for="ortu" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Nama Orang Tua</label>
                            <div class="col-sm-9">
                                <input type="text" name="ortu" id="ortu" class="form-control" placeholder="Nama Ayah/Ibu/Wali" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nip" class="col-sm-3 col-form-label font-weight-bold text-gray-800">NIP / NRP / NPS</label>
                            <div class="col-sm-9">
                                <input type="text" name="nip" id="nip" class="form-control" placeholder="NIP/NRP/NPS Orang Tua" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="pangkat" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Pangkat / Golongan</label>
                            <div class="col-sm-9">
                                <input type="text" name="pangkat" id="pangkat" class="form-control" placeholder="Pangkat dan Golongan PNS/TNI/Polri" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="instansi" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Instansi</label>
                            <div class="col-sm-9">
                                <input type="text" name="instansi" id="instansi" class="form-control" placeholder="Nama instansi tempat bekerja" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="alamat_instansi" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Alamat Instansi</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat_instansi" id="alamat_instansi" class="form-control" placeholder="Alamat lengkap instansi tempat bekerja" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kk" class="col-sm-3 col-form-label font-weight-bold text-gray-800">Kartu Keluarga (PDF)</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="kk" name="kk" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    <label class="custom-file-label" for="kk">Upload KK (format filename "nim-kk.pdf")</label>
                                </div>
                                <input type="hidden" name="temp_kk" id="temp_kk" value="">
                                <div class="upload-status-msg mt-2 font-weight-bold" id="status-kk" style="display:none; font-size: 0.9rem;"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sk" class="col-sm-3 col-form-label font-weight-bold text-gray-800">SK Orang Tua (PDF)</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="sk" name="sk" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    <label class="custom-file-label" for="sk">Upload SK (format filename "nim-sk.pdf")</label>
                                </div>
                                <input type="hidden" name="temp_sk" id="temp_sk" value="">
                                <div class="upload-status-msg mt-2 font-weight-bold" id="status-sk" style="display:none; font-size: 0.9rem;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-sm-12 text-right">
                            <a href="<?= base_url('surat'); ?>" class="btn btn-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50"><i class="fas fa-paper-plane"></i></span>
                                <span class="text">Kirim Pengajuan</span>
                            </button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- jQuery script to handle Bootstrap file input label updating and real-time upload -->
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

            // Client-side validation: 2 MB limit (2 * 1024 * 1024 bytes)
            var maxSize = 2 * 1024 * 1024;
            if (file.size > maxSize) {
                statusElement.show().removeClass('text-success text-info').addClass('text-danger').html(
                    '<i class="fas fa-exclamation-triangle mr-1"></i> Ukuran berkas melebihi batas 2 MB (Ukuran berkas Anda: ' + (file.size / (1024 * 1024)).toFixed(2) + ' MB)'
                );
                // Reset input
                $(inputElement).val('');
                $(inputElement).next('.custom-file-label').removeClass("selected").html('Upload berkas...');
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
            $('button[type="submit"]').prop('disabled', true).addClass('disabled');

            $.ajax({
                url: '<?= base_url("surat/upload_ajax"); ?>',
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
                        $(inputElement).next('.custom-file-label').removeClass("selected").html('Upload berkas...');
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
                    $(inputElement).next('.custom-file-label').removeClass("selected").html('Upload berkas...');
                    hiddenInput.val('');
                },
                complete: function() {
                    // Re-enable submit button if no uploads are currently in-progress
                    var activeUploads = false;
                    $('.upload-status-msg').each(function() {
                        if ($(this).hasClass('text-info')) {
                            activeUploads = true;
                        }
                    });
                    if (!activeUploads) {
                        $('button[type="submit"]').prop('disabled', false).removeClass('disabled');
                    }
                }
            });
        }

        // Attach listeners to file inputs
        $('#ktm').on('change', function() {
            handleRealtimeUpload(this, $('#status-ktm'), $('#temp_ktm'));
        });
        $('#kk').on('change', function() {
            handleRealtimeUpload(this, $('#status-kk'), $('#temp_kk'));
        });
        $('#sk').on('change', function() {
            handleRealtimeUpload(this, $('#status-sk'), $('#temp_sk'));
        });
    });
</script>