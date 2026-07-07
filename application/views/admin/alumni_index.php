<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data alumni <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Filter Form & Actions -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <form action="<?= base_url('admin/alumni'); ?>" method="get" class="form-inline bg-white p-3 rounded shadow-sm border">
                <div class="form-group mr-3">
                    <label for="tahun" class="mr-2 font-weight-bold text-gray-700">Filter Tahun Wisuda:</label>
                    <select name="tahun" id="tahun" class="form-control" onchange="this.form.submit()">
                        <option value="Semua" <?= $selected_year === 'Semua' ? 'selected' : ''; ?>>-- Tampilkan Semua Tahun --</option>
                        <?php foreach ($years as $yr): ?>
                            <option value="<?= $yr; ?>" <?= $selected_year === $yr ? 'selected' : ''; ?>><?= $yr; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50"><i class="fas fa-filter"></i></span>
                    <span class="text">Terapkan</span>
                </button>
            </form>
        </div>
        <div class="col-md-4 text-md-right mt-3 mt-md-0">
            <a href="<?= base_url('admin/alumni_tambah'); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-plus-square"></i></span>
                <span class="text">Tambah Alumni</span>
            </a>
        </div>
    </div>

    <!-- Alumni Counts per Prodi (Dynamic Cards) Header -->
    <div class="row mb-2">
        <div class="col-12">
            <h5 class="text-gray-800 font-weight-bold">
                Ringkasan per Program Studi 
                <small class="text-primary font-weight-normal ml-2" style="font-size: 80%;">
                    <i class="fas fa-info-circle"></i> Klik card prodi di bawah ini untuk menyaring tabel secara cepat.
                </small>
            </h5>
        </div>
    </div>

    <!-- Alumni Counts per Prodi (Dynamic Cards) -->
    <?php
    $prodi_counts = [];
    $prodis_list = $this->db->get('prodi')->result_array();
    foreach ($prodis_list as $pr) {
        $prodi_counts[$pr['nama_prodi']] = 0;
    }
    foreach ($alumni as $a) {
        $p_name = $a['nama_prodi'] ? $a['nama_prodi'] : 'Lainnya';
        if (!isset($prodi_counts[$p_name])) {
            $prodi_counts[$p_name] = 0;
        }
        $prodi_counts[$p_name]++;
    }

    // Map Prodi to border colors and icons
    $prodi_styles = [
        'Kedokteran' => ['border' => 'primary', 'text' => 'primary', 'icon' => 'fa-user-md'],
        'Farmasi' => ['border' => 'success', 'text' => 'success', 'icon' => 'fa-pills'],
        'Keperawatan' => ['border' => 'info', 'text' => 'info', 'icon' => 'fa-user-nurse'],
        'Pendidikan Profesi Dokter' => ['border' => 'danger', 'text' => 'danger', 'icon' => 'fa-stethoscope'],
        'Pendidikan Profesi Apoteker' => ['border' => 'warning', 'text' => 'warning', 'icon' => 'fa-prescription-bottle-alt'],
        'Pendidikan Profesi Ners' => ['border' => 'secondary', 'text' => 'secondary', 'icon' => 'fa-heartbeat'],
    ];
    ?>

    <div class="row">
        <?php foreach ($prodi_counts as $p_name => $count): 
            if (trim($p_name) == '' || $p_name == '-') {
                continue;
            }
            $style = isset($prodi_styles[$p_name]) ? $prodi_styles[$p_name] : ['border' => 'dark', 'text' => 'dark', 'icon' => 'fa-graduation-cap'];
        ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-<?= $style['border']; ?> shadow h-100 py-2 prodi-filter-card" 
                     data-prodi="<?= htmlspecialchars($p_name); ?>" 
                     style="cursor: pointer; transition: all 0.2s ease-in-out;"
                     title="Klik untuk menyaring Program Studi <?= $p_name; ?>">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-<?= $style['text']; ?> text-uppercase mb-1">
                                    <?= $p_name; ?>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $count; ?> <span class="text-xs font-weight-normal text-gray-500">Alumni</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas <?= $style['icon']; ?> fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Partition alumni by status for Tabs -->
    <?php
    $alumni_aktif = [];
    $alumni_pending = [];
    foreach ($alumni as $a) {
        if ($a['status_alumni'] == 1) {
            $alumni_aktif[] = $a;
        } else {
            $alumni_pending[] = $a;
        }
    }
    ?>

    <!-- Status Tabs -->
    <ul class="nav nav-tabs mb-4 border-bottom-primary" id="alumniTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active font-weight-bold text-gray-800" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">
                Semua <span class="badge badge-primary ml-1"><?= count($alumni); ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold text-gray-800" id="aktif-tab" data-toggle="tab" href="#aktif" role="tab" aria-controls="aktif" aria-selected="false">
                Aktif / Terverifikasi <span class="badge badge-success ml-1"><?= count($alumni_aktif); ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold text-gray-800" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">
                Diajukan / Belum Aktif <span class="badge badge-warning ml-1"><?= count($alumni_pending); ?></span>
            </a>
        </li>
    </ul>

    <!-- Tab Contents -->
    <div class="tab-content bg-white p-3 rounded shadow mb-4 border">
        
        <!-- Tab 1: Semua -->
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="datatable" style="width:100%">
                    <thead class="table-primary">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Foto</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Program Studi</th>
                            <th>Tahun Wisuda</th>
                            <th>IPK</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($alumni as $a): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $i++; ?></td>
                                <td class="text-center align-middle">
                                    <img src="<?= base_url('assets/img/alumni/') . ($a['poto'] ? $a['poto'] : 'default.jpg'); ?>" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="align-middle">
                                    <a href="<?= base_url('admin/alumni_detail/' . $a['id_alumni']); ?>" class="font-weight-bold"><?= $a['nim_alumni']; ?></a>
                                </td>
                                <td class="align-middle"><?= $a['nama_lengkap'] ? $a['nama_lengkap'] : '-'; ?></td>
                                <td class="align-middle"><?= $a['nama_prodi'] ? $a['nama_prodi'] : '-'; ?></td>
                                <td class="text-center align-middle"><?= $a['tahun_wisuda']; ?></td>
                                <td class="text-center align-middle"><?= $a['ipk']; ?></td>
                                <td class="text-center align-middle">
                                    <?php if ($a['status_alumni'] == 1) : ?>
                                        <span class="badge badge-success">Aktif / Terverifikasi</span>
                                    <?php else : ?>
                                        <span class="badge badge-warning">Diajukan / Belum Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/alumni_detail/' . $a['id_alumni']); ?>" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="<?= base_url('admin/alumni_ubah/' . $a['id_alumni']); ?>" class="btn btn-sm btn-primary" title="Ubah">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('admin/alumni_hapus/' . $a['id_alumni']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data alumni ini?');" title="Hapus">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab 2: Aktif -->
        <div class="tab-pane fade" id="aktif" role="tabpanel" aria-labelledby="aktif-tab">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="datatable-aktif" style="width:100%">
                    <thead class="table-success">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Foto</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Program Studi</th>
                            <th>Tahun Wisuda</th>
                            <th>IPK</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($alumni_aktif as $a): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $i++; ?></td>
                                <td class="text-center align-middle">
                                    <img src="<?= base_url('assets/img/alumni/') . ($a['poto'] ? $a['poto'] : 'default.jpg'); ?>" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="align-middle">
                                    <a href="<?= base_url('admin/alumni_detail/' . $a['id_alumni']); ?>" class="font-weight-bold"><?= $a['nim_alumni']; ?></a>
                                </td>
                                <td class="align-middle"><?= $a['nama_lengkap'] ? $a['nama_lengkap'] : '-'; ?></td>
                                <td class="align-middle"><?= $a['nama_prodi'] ? $a['nama_prodi'] : '-'; ?></td>
                                <td class="text-center align-middle"><?= $a['tahun_wisuda']; ?></td>
                                <td class="text-center align-middle"><?= $a['ipk']; ?></td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-success">Aktif / Terverifikasi</span>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/alumni_detail/' . $a['id_alumni']); ?>" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="<?= base_url('admin/alumni_ubah/' . $a['id_alumni']); ?>" class="btn btn-sm btn-primary" title="Ubah">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('admin/alumni_hapus/' . $a['id_alumni']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data alumni ini?');" title="Hapus">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab 3: Pending -->
        <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="datatable-pending" style="width:100%">
                    <thead class="table-warning">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Foto</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Program Studi</th>
                            <th>Tahun Wisuda</th>
                            <th>IPK</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($alumni_pending as $a): ?>
                            <tr>
                                <td class="text-center align-middle"><?= $i++; ?></td>
                                <td class="text-center align-middle">
                                    <img src="<?= base_url('assets/img/alumni/') . ($a['poto'] ? $a['poto'] : 'default.jpg'); ?>" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="align-middle">
                                    <a href="<?= base_url('admin/alumni_detail/' . $a['id_alumni']); ?>" class="font-weight-bold"><?= $a['nim_alumni']; ?></a>
                                </td>
                                <td class="align-middle"><?= $a['nama_lengkap'] ? $a['nama_lengkap'] : '-'; ?></td>
                                <td class="align-middle"><?= $a['nama_prodi'] ? $a['nama_prodi'] : '-'; ?></td>
                                <td class="text-center align-middle"><?= $a['tahun_wisuda']; ?></td>
                                <td class="text-center align-middle"><?= $a['ipk']; ?></td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-warning">Diajukan / Belum Aktif</span>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('admin/alumni_detail/' . $a['id_alumni']); ?>" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="<?= base_url('admin/alumni_ubah/' . $a['id_alumni']); ?>" class="btn btn-sm btn-primary" title="Ubah">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('admin/alumni_hapus/' . $a['id_alumni']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data alumni ini?');" title="Hapus">
                                        <i class="fas fa-trash"></i> Hapus
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
<!-- /.container-fluid -->
</div>

<!-- Extra JS to initialize DataTables inside tabs, fix header layout, and handle card filters -->
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<style>
    .prodi-filter-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .prodi-filter-card.active-filter {
        border-width: 3px !important;
        background-color: rgba(224, 235, 255, 0.5) !important;
    }
</style>
<script>
    $(document).ready(function() {
        // Initialize other DataTables (all is initialized automatically by footer_a.php if id="datatable")
        var tableAll = $('#datatable').DataTable();
        var tableAktif = $('#datatable-aktif').DataTable();
        var tablePending = $('#datatable-pending').DataTable();
        
        // Store initial tab counts
        var initialAll = <?= count($alumni); ?>;
        var initialAktif = <?= count($alumni_aktif); ?>;
        var initialPending = <?= count($alumni_pending); ?>;
        
        // Handle clicking on prodi cards to filter
        $('.prodi-filter-card').on('click', function() {
            var prodi = $(this).data('prodi');
            var isActive = $(this).hasClass('active-filter');
            
            // Remove active style from all cards
            $('.prodi-filter-card').removeClass('active-filter');
            
            if (isActive) {
                // Clear filter
                tableAll.column(4).search('').draw();
                tableAktif.column(4).search('').draw();
                tablePending.column(4).search('').draw();
                
                // Restore tab counts
                $('#all-tab .badge').text(initialAll);
                $('#aktif-tab .badge').text(initialAktif);
                $('#pending-tab .badge').text(initialPending);
            } else {
                // Add active style to this card
                $(this).addClass('active-filter');
                
                // Perform exact regex search on column index 4 (Program Studi)
                var regexSearch = '^' + $.fn.dataTable.util.escapeRegex(prodi) + '$';
                tableAll.column(4).search(regexSearch, true, false).draw();
                tableAktif.column(4).search(regexSearch, true, false).draw();
                tablePending.column(4).search(regexSearch, true, false).draw();
                
                // Update tab counts based on filtered rows
                $('#all-tab .badge').text(tableAll.rows({filter: 'applied'}).count());
                $('#aktif-tab .badge').text(tableAktif.rows({filter: 'applied'}).count());
                $('#pending-tab .badge').text(tablePending.rows({filter: 'applied'}).count());
            }
        });
        
        // Recalculate DataTable columns when changing tabs to prevent table compression inside hidden tabs
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });
    });
</script>
