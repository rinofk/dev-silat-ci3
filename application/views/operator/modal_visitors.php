<div class="modal-header">
    <h5 class="modal-title">Daftar Visitor Tanggal <?= isset($selected_date) ? $selected_date : ''; ?></h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="width:100%;">
            <thead>
                <tr>
                    <th style="width:5%;">#</th>
                    <th style="width:12%;">NIM</th>
                    <th style="width:25%;">Nama Lengkap</th>
                    <th style="width:20%;">Program Studi</th>
                    <th style="width:23%;">Pengajuan Surat</th>
                    <th style="width:15%;">Login At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($visitors)): $no=1; foreach($visitors as $v): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td class="font-weight-bold"><?= $v->nim; ?></td>
                        <td><?= $v->nama_lengkap ? $v->nama_lengkap : '<em class="text-muted">Bukan Mahasiswa/Admin</em>'; ?></td>
                        <td><?= $v->nama_prodi ? $v->nama_prodi : '-'; ?></td>
                        <td>
                            <?php 
                                $has_letter = false;
                                if ($v->jml_aktif_kuliah > 0) {
                                    echo '<span class="badge badge-primary mr-1 mb-1">Aktif Kuliah (' . $v->jml_aktif_kuliah . ')</span>';
                                    $has_letter = true;
                                }
                                if ($v->jml_bebas_lab > 0) {
                                    echo '<span class="badge badge-warning text-dark mr-1 mb-1">Bebas Lab (' . $v->jml_bebas_lab . ')</span>';
                                    $has_letter = true;
                                }
                                if ($v->jml_skl > 0) {
                                    echo '<span class="badge badge-info mr-1 mb-1">SKL (' . $v->jml_skl . ')</span>';
                                    $has_letter = true;
                                }
                                if ($v->jml_bebas_perpus > 0) {
                                    echo '<span class="badge badge-success mr-1 mb-1">Bebas Perpus (' . $v->jml_bebas_perpus . ')</span>';
                                    $has_letter = true;
                                }
                                if (!$has_letter) {
                                    echo '<span class="badge badge-secondary">Tidak ada pengajuan</span>';
                                }
                            ?>
                        </td>
                        <td><?= date('d-m-Y H:i:s', strtotime($v->login_at)); ?></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="6" class="text-center">Tidak ada visitor</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
