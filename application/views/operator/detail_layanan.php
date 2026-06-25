<div class="container-fluid">
    <!-- Judul Header -->
    <div class="dashboard-title-bar">
        <h1 class="h3 text-gray-800 font-weight-bold mb-1" style="font-family: var(--font-title); font-weight: 800;">Laporan Layanan <?= $tipe_label ?> Tahun <?= $tahun ?></h1>
        <p class="dashboard-subtitle">Fakultas Kedokteran Universitas Tanjungpura</p>
    </div>

    <!-- Card Aksi Ekspor -->
    <div class="card custom-table-card mb-4">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between py-3">
            <h6 class="chart-card-title m-0">Rincian Data Mahasiswa</h6>
            <div class="d-flex flex-wrap gap-2 mt-2 mt-sm-0">
                <a href="<?= base_url('operator/export_layanan_pdf?tahun=' . $tahun . '&tipe=' . $tipe); ?>" class="btn btn-danger btn-sm shadow-sm mr-2 mb-1">
                    <i class="fas fa-file-pdf mr-1"></i> Export ke PDF
                </a>
                <a href="<?= base_url('operator/export_layanan_xlsx?tahun=' . $tahun . '&tipe=' . $tipe); ?>" class="btn btn-success btn-sm shadow-sm mr-2 mb-1">
                    <i class="fas fa-file-excel mr-1"></i> Export ke XLSX
                </a>
                <a href="<?= base_url('operator'); ?>" class="btn btn-secondary btn-sm shadow-sm mb-1">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table custom-table table-bordered table-striped" id="detailLayananTable" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 8%">No</th>
                            <th style="width: 15%">NIM</th>
                            <th style="width: 27%">Nama Lengkap</th>
                            <th style="width: 20%">Tipe Layanan</th>
                            <th style="width: 15%">Nomor Surat</th>
                            <th style="width: 15%">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($detail_data)): ?>
                            <?php $no = 1; foreach ($detail_data as $row): 
                                $nomor_surat = (!empty($row['nomor_surat']) && $row['nomor_surat'] !== '-') ? $row['nomor_surat'] : '-';
                                $tanggal_formatted = !empty($row['tanggal']) ? date('d-m-Y', strtotime($row['tanggal'])) : '-';
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= $row['nim']; ?></td>
                                    <td><?= htmlspecialchars($row['nama']); ?></td>
                                    <td>
                                        <span class="badge badge-info px-2 py-1" style="font-size: 11px;">
                                            <?= htmlspecialchars($row['tipe_layanan']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center"><?= htmlspecialchars($nomor_surat); ?></td>
                                    <td class="text-center" data-order="<?= $row['tanggal']; ?>"><?= htmlspecialchars($tanggal_formatted); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Tidak ada data selesai diproses pada periode ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DataTables JS & CSS Initialization -->
<script>
    $(document).ready(function () {
        var t = $('#detailLayananTable').DataTable({
            pageLength: 25,
            order: [[5, 'asc']],
            columnDefs: [
                {
                    searchable: false,
                    orderable: false,
                    targets: 0
                }
            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
            }
        });

        t.on('order.dt search.dt', function () {
            let i = 1;
            t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    });
</script>
