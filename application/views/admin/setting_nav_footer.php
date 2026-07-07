<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>

            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs mb-4" id="settingTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="navbar-tab" data-toggle="tab" href="#navbar-settings" role="tab" aria-controls="navbar-settings" aria-selected="true">
                        <i class="fas fa-fw fa-bars mr-1"></i> Pengaturan Navbar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="footer-tab" data-toggle="tab" href="#footer-settings" role="tab" aria-controls="footer-settings" aria-selected="false">
                        <i class="fas fa-fw fa-dock mr-1"></i> Pengaturan Footer
                    </a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="settingTabContent">
                
                <!-- Tab 1: Navbar Settings -->
                <div class="tab-pane fade show active" id="navbar-settings" role="tabpanel" aria-labelledby="navbar-tab">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Menu Navigasi Halaman Utama</h6>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newNavbarModal">
                                <i class="fas fa-plus fa-sm mr-1"></i> Tambah Menu Navbar
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 5%;">#</th>
                                            <th>Label</th>
                                            <th>URL</th>
                                            <th style="width: 10%;">Urutan</th>
                                            <th style="width: 15%;">Tipe</th>
                                            <th style="width: 10%;">Status</th>
                                            <th style="width: 15%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($navbar as $nv) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><strong><?= htmlspecialchars($nv['label']); ?></strong></td>
                                                <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    <a href="<?= $nv['url']; ?>" target="_blank" class="text-info" title="<?= htmlspecialchars($nv['url']); ?>"><?= htmlspecialchars($nv['url']); ?></a>
                                                </td>
                                                <td><?= $nv['order_no']; ?></td>
                                                <td>
                                                    <?php if ($nv['is_button'] == 1) : ?>
                                                        <span class="badge badge-primary">Tombol (Aksen)</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-secondary">Link Standar</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($nv['is_active'] == 1) : ?>
                                                        <span class="badge badge-success">Aktif</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-danger">Non-aktif</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success btn-sm btn-edit-navbar" 
                                                            data-toggle="modal" 
                                                            data-target="#editNavbarModal"
                                                            data-id="<?= $nv['id']; ?>"
                                                            data-label="<?= htmlspecialchars($nv['label']); ?>"
                                                            data-url="<?= htmlspecialchars($nv['url']); ?>"
                                                            data-order="<?= $nv['order_no']; ?>"
                                                            data-active="<?= $nv['is_active']; ?>"
                                                            data-button="<?= $nv['is_button']; ?>">
                                                        <i class="fas fa-edit fa-sm"></i> Ubah
                                                    </button>
                                                    <a href="<?= base_url('admin/setting_navbar_delete/') . $nv['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus menu navbar ini?');">
                                                        <i class="fas fa-trash fa-sm"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Footer Settings -->
                <div class="tab-pane fade" id="footer-settings" role="tabpanel" aria-labelledby="footer-tab">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Menu Footer Halaman Utama</h6>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newFooterModal">
                                <i class="fas fa-plus fa-sm mr-1"></i> Tambah Menu Footer
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 5%;">#</th>
                                            <th>Bagian (Section)</th>
                                            <th>Label</th>
                                            <th>URL</th>
                                            <th style="width: 10%;">Urutan</th>
                                            <th style="width: 10%;">Status</th>
                                            <th style="width: 15%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($footer as $ft) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td>
                                                    <?php if ($ft['section'] == 'layanan') : ?>
                                                        <span class="badge badge-info">Layanan Utama</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-warning">Tautan Terkait</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><strong><?= htmlspecialchars($ft['label']); ?></strong></td>
                                                <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    <a href="<?= $ft['url']; ?>" target="_blank" class="text-info" title="<?= htmlspecialchars($ft['url']); ?>"><?= htmlspecialchars($ft['url']); ?></a>
                                                </td>
                                                <td><?= $ft['order_no']; ?></td>
                                                <td>
                                                    <?php if ($ft['is_active'] == 1) : ?>
                                                        <span class="badge badge-success">Aktif</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-danger">Non-aktif</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success btn-sm btn-edit-footer" 
                                                            data-toggle="modal" 
                                                            data-target="#editFooterModal"
                                                            data-id="<?= $ft['id']; ?>"
                                                            data-section="<?= $ft['section']; ?>"
                                                            data-label="<?= htmlspecialchars($ft['label']); ?>"
                                                            data-url="<?= htmlspecialchars($ft['url']); ?>"
                                                            data-order="<?= $ft['order_no']; ?>"
                                                            data-active="<?= $ft['is_active']; ?>">
                                                        <i class="fas fa-edit fa-sm"></i> Ubah
                                                    </button>
                                                    <a href="<?= base_url('admin/setting_footer_delete/') . $ft['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus menu footer ini?');">
                                                        <i class="fas fa-trash fa-sm"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- ==========================================
     MODALS FOR NAVBAR SETTINGS
     ========================================== -->

<!-- Add Navbar Modal -->
<div class="modal fade" id="newNavbarModal" tabindex="-1" role="dialog" aria-labelledby="newNavbarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newNavbarModalLabel">Tambah Menu Navbar Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/setting_navbar_add'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nav_label">Label Menu</label>
                        <input type="text" class="form-control" id="nav_label" name="label" placeholder="Contoh: Siremun" required>
                    </div>
                    <div class="form-group">
                        <label for="nav_url">URL / Link</label>
                        <input type="text" class="form-control" id="nav_url" name="url" placeholder="Contoh: https://siremun.untan.ac.id/" required>
                    </div>
                    <div class="form-group">
                        <label for="nav_order">Urutan Tampilan</label>
                        <input type="number" class="form-control" id="nav_order" name="order_no" placeholder="Contoh: 1" required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="nav_button" name="is_button" value="1">
                        <label class="form-check-label" for="nav_button">Tampilkan sebagai Tombol Utama (Aksen)</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="nav_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="nav_active">Aktifkan Menu</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Navbar Modal -->
<div class="modal fade" id="editNavbarModal" tabindex="-1" role="dialog" aria-labelledby="editNavbarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNavbarModalLabel">Ubah Menu Navbar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nav_label">Label Menu</label>
                        <input type="text" class="form-control" id="edit_nav_label" name="label" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_nav_url">URL / Link</label>
                        <input type="text" class="form-control" id="edit_nav_url" name="url" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_nav_order">Urutan Tampilan</label>
                        <input type="number" class="form-control" id="edit_nav_order" name="order_no" required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="edit_nav_button" name="is_button" value="1">
                        <label class="form-check-label" for="edit_nav_button">Tampilkan sebagai Tombol Utama (Aksen)</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="edit_nav_active" name="is_active" value="1">
                        <label class="form-check-label" for="edit_nav_active">Aktifkan Menu</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Perbaharui</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ==========================================
     MODALS FOR FOOTER SETTINGS
     ========================================== -->

<!-- Add Footer Modal -->
<div class="modal fade" id="newFooterModal" tabindex="-1" role="dialog" aria-labelledby="newFooterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newFooterModalLabel">Tambah Menu Footer Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/setting_footer_add'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="foot_section">Bagian (Section)</label>
                        <select class="form-control" id="foot_section" name="section" required>
                            <option value="layanan">Layanan Utama (Kiri)</option>
                            <option value="tautan">Tautan Terkait (Kanan)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="foot_label">Label Menu</label>
                        <input type="text" class="form-control" id="foot_label" name="label" placeholder="Contoh: Fakultas Kedokteran UNTAN" required>
                    </div>
                    <div class="form-group">
                        <label for="foot_url">URL / Link</label>
                        <input type="text" class="form-control" id="foot_url" name="url" placeholder="Contoh: http://kedokteran.untan.ac.id/" required>
                    </div>
                    <div class="form-group">
                        <label for="foot_order">Urutan Tampilan</label>
                        <input type="number" class="form-control" id="foot_order" name="order_no" placeholder="Contoh: 1" required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="foot_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="foot_active">Aktifkan Menu</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Footer Modal -->
<div class="modal fade" id="editFooterModal" tabindex="-1" role="dialog" aria-labelledby="editFooterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFooterModalLabel">Ubah Menu Footer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_foot_section">Bagian (Section)</label>
                        <select class="form-control" id="edit_foot_section" name="section" required>
                            <option value="layanan">Layanan Utama (Kiri)</option>
                            <option value="tautan">Tautan Terkait (Kanan)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_foot_label">Label Menu</label>
                        <input type="text" class="form-control" id="edit_foot_label" name="label" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_foot_url">URL / Link</label>
                        <input type="text" class="form-control" id="edit_foot_url" name="url" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_foot_order">Urutan Tampilan</label>
                        <input type="number" class="form-control" id="edit_foot_order" name="order_no" required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="edit_foot_active" name="is_active" value="1">
                        <label class="form-check-label" for="edit_foot_active">Aktifkan Menu</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Perbaharui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add jQuery trigger scripts at the end of content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle tabs dynamically
        $('#settingTab a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // Populate edit navbar modal
        $('.btn-edit-navbar').on('click', function() {
            const id = $(this).data('id');
            const label = $(this).data('label');
            const url = $(this).data('url');
            const order_no = $(this).data('order');
            const is_active = $(this).data('active');
            const is_button = $(this).data('button');

            $('#editNavbarModal form').attr('action', '<?= base_url("admin/setting_navbar_edit/"); ?>' + id);
            $('#edit_nav_label').val(label);
            $('#edit_nav_url').val(url);
            $('#edit_nav_order').val(order_no);
            
            if (is_active == 1) {
                $('#edit_nav_active').prop('checked', true);
            } else {
                $('#edit_nav_active').prop('checked', false);
            }

            if (is_button == 1) {
                $('#edit_nav_button').prop('checked', true);
            } else {
                $('#edit_nav_button').prop('checked', false);
            }
        });

        // Populate edit footer modal
        $('.btn-edit-footer').on('click', function() {
            const id = $(this).data('id');
            const section = $(this).data('section');
            const label = $(this).data('label');
            const url = $(this).data('url');
            const order_no = $(this).data('order');
            const is_active = $(this).data('active');

            $('#editFooterModal form').attr('action', '<?= base_url("admin/setting_footer_edit/"); ?>' + id);
            $('#edit_foot_section').val(section);
            $('#edit_foot_label').val(label);
            $('#edit_foot_url').val(url);
            $('#edit_foot_order').val(order_no);
            
            if (is_active == 1) {
                $('#edit_foot_active').prop('checked', true);
            } else {
                $('#edit_foot_active').prop('checked', false);
            }
        });
    });
</script>
