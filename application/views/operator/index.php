<!-- DataTables CSS (bisa dipindah ke template header) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

<div class="container-fluid">
  <!-- Judul -->
  <h1 class="h3 mb-4 text-gray-800">Dashboard Operator</h1>
  <p>Selamat datang, <strong><?= $user['nim'] ?></strong></p>

  <!-- Kartu Layanan -->
  <div class="row">
    <!-- Surat Aktif Kuliah -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Surat Aktif Kuliah</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">Subiantoro Indra</div>
        </div>
      </div>
    </div>

    <!-- Bebas Perpustakaan -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Surat Bebas Perpus</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">Suryani</div>
        </div>
      </div>
    </div>

    <!-- Bebas Laboratorium -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Surat Bebas Lab</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">Sumo Lestari, Nurul Hamsiah, Hazwani</div>
        </div>
      </div>
    </div>

    <!-- Bebas Jurnal -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Barcode Publikasi</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">Andeff, Rino</div>
        </div>
      </div>
    </div>

    <!-- SKL -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Surat Keterangan Lulus</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">Yasinta Pagi</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Visitor Logs -->
  <h1 class="h3 mb-4 text-gray-800">Visitor Logs</h1>
  <div class="row">
    <!-- Total Visitors -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Visitors</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_visitors; ?></div>
        </div>
      </div>
    </div>

    <!-- Today Visitors -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Today Visitors</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $today_visitors; ?></div>
        </div>
      </div>
    </div>

    <!-- Unique Visitors -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Unique Visitors</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $unique_visitors; ?></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Chart & Statistik -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="row">
    <!-- Grafik Jumlah Visitor (scroll horizontal) -->
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Grafik Jumlah Visitor per Hari</h6>
        </div>
        <div class="card-body">
          <!-- Wadah scroll horizontal -->
          <div style="overflow-x: auto; white-space: nowrap;">
            <!-- Lebar besar supaya muncul scroll, bisa disesuaikan -->
            <div style="width: 2000px; height: 400px;">
              <canvas id="visitorChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie Visitor per Prodi -->
    <div class="col-lg-4">
      <div class="card shadow mb-4">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Visitor per Prodi</h6>
        </div>
        <div class="card-body">
          <canvas id="chartVisitorProdi" height="250"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabel Statistik Visitor -->
  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-primary">Tabel Statistik Visitor</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="visitorTable">
          <thead class="thead-dark">
            <tr>
              <th>Tanggal</th>
              <th>Jumlah Visitor</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($visitors as $row): ?>
              <tr>
                <td>
                  <a href="javascript:void(0);" class="show-visitors" data-date="<?= $row->visit_date; ?>">
                    <?= $row->visit_date; ?>
                  </a>
                </td>
                <td><?= $row->total; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Card Visitor Per Prodi (Chart + Table) -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Visitor Per Prodi</h6>
    </div>
    <div class="card-body">
      <div class="row">
        <!-- Chart -->
        <div class="col-lg-6 mb-3">
          <canvas id="visitorPerProdiChart"></canvas>
        </div>
        <!-- Table -->
        <div class="col-lg-6">
          <div class="table-responsive">
            <table class="table table-bordered table-sm" id="visitorProdiTable">
              <thead class="thead-light">
                <tr>
                  <th>Program Studi</th>
                  <th>Total Visitor</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($statistik_prodi as $row): ?>
                  <tr>
                    <td><?= $row->nama_prodi ?></td>
                    <td><?= $row->total ?></td>
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

<!-- Modal -->
<div class="modal fade" id="visitorModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" id="modalContent">
      <!-- konten dari AJAX -->
    </div>
  </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- DataTables JS (setelah jQuery & Bootstrap JS) -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function () {

      // Inisialisasi DataTables untuk Tabel Statistik Visitor
      $('#visitorTable').DataTable({
          pageLength: 10,
          order: [[0, 'desc']],
          language: {
              url: "https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
          }
      });

      // Inisialisasi DataTables untuk Tabel Visitor Per Prodi
      $('#visitorProdiTable').DataTable({
          paging: false,
          searching: false,
          info: false,
          language: {
              url: "https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json"
          }
      });

      // Chart Bar Visitor Harian (scroll horizontal)
      var ctx1 = document.getElementById("visitorChart").getContext('2d');
      new Chart(ctx1, {
          type: 'bar',
          data: {
              labels: <?= $labels; ?>,
              datasets: [{
                  label: 'Jumlah Visitor',
                  data: <?= $totals; ?>,
                  backgroundColor: 'rgba(54, 162, 235, 0.7)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
              }]
          },
          options: { 
              responsive: true,
              maintainAspectRatio: false, // penting agar tinggi mengikuti div (400px)
              scales: { 
                  y: { 
                      beginAtZero:true 
                  }
              }
          }
      });

      // Chart Pie Visitor per Prodi
      var ctx2 = document.getElementById("chartVisitorProdi").getContext('2d');
      new Chart(ctx2, {
          type: 'pie',
          data: {
              labels: [<?php foreach ($statistik_prodi as $row) { echo "'" . $row->nama_prodi . "',"; } ?>],
              datasets: [{
                  data: [<?php foreach ($statistik_prodi as $row) { echo $row->total . ","; } ?>],
                  backgroundColor: ['#4e73df','#1cc88a','#36b9cc','#f6c23e','#e74a3b','#858796','#20c9a6'],
                  hoverOffset: 4
              }]
          },
          options: { 
              responsive: true, 
              plugins: { 
                  legend: { position: 'bottom' } 
              } 
          }
      });

      // Chart Bar Visitor per Prodi (dalam card + tabel)
      var ctx3 = document.getElementById("visitorPerProdiChart").getContext('2d');
      new Chart(ctx3, {
          type: 'bar',
          data: {
              labels: <?= json_encode(array_column($statistik_prodi, 'nama_prodi')) ?>,
              datasets: [{
                  label: 'Total Visitor',
                  data: <?= json_encode(array_column($statistik_prodi, 'total')) ?>,
                  backgroundColor: 'rgba(54, 162, 235, 0.7)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
              }]
          },
          options: { 
              responsive: true, 
              scales: { 
                  y: { 
                      beginAtZero:true, 
                      ticks: { precision:0 } 
                  } 
              } 
          }
      });

      // Modal AJAX Visitor Detail
      $(document).on('click', '.show-visitors', function(){
          var date = $(this).data('date');
          $.ajax({
              url: "<?= base_url('operator/get_visitors_by_date/'); ?>" + date,
              type: "GET",
              success: function(res){
                  $('#modalContent').html(res);
                  $('#visitorModal').modal('show');
              }
          });
      });

  });
</script>
