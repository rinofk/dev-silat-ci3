<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Flash Message -->
  <?php if ($this->session->flashdata('flash')) : ?>
    <div class="row mt-3">
      <div class="col-md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Data mahasiswa <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- Filter -->
  <form method="get" action="<?= base_url('skl/yudisium'); ?>" class="mb-3">
    <div class="row">
      <div class="col-md-3">
        <select name="tahun" class="form-control">
          <option value="">-- Semua Tahun --</option>
          <?php foreach($filter_tahun as $t): ?>
            <option value="<?= $t['tahun']; ?>" <?= ($t['tahun'] == $this->input->get('tahun')) ? 'selected' : ''; ?>>
              <?= $t['tahun']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-3">
        <select name="status" class="form-control">
          <option value="">-- Semua Status --</option>
          <?php foreach($filter_status as $s): ?>
            <option value="<?= $s; ?>" <?= ($s == $this->input->get('status')) ? 'selected' : ''; ?>>
              <?= ($s == 'diajukan') ? 'Di Ajukan' : ucfirst($s); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-filter"></i> Filter
        </button>
      </div>
    </div>
  </form>

  <!-- Dashboard Cards -->
  <div class="row">
    <?php 
      $cards = [
        ['title' => 'Di Ajukan', 'count' => $count_diajukan, 'icon' => 'fa-paper-plane', 'color' => 'secondary', 'status' => 'diajukan'],
        ['title' => 'Proses',    'count' => $count_proses,   'icon' => 'fa-sync-alt',    'color' => 'warning',   'status' => 'proses'],
        ['title' => 'Selesai',   'count' => $count_selesai,  'icon' => 'fa-check-circle','color' => 'success',  'status' => 'selesai'],
        ['title' => 'Total',     'count' => $count_total,    'icon' => 'fa-list',        'color' => 'info',     'status' => '']
      ]; 
      $currentTahun = $this->input->get('tahun') ?? '';
    ?>

    <?php foreach ($cards as $card) : ?>
      <div class="col-xl-3 col-md-6 mb-4">
        <a href="<?= base_url('skl/yudisium?tahun=' . $currentTahun . '&status=' . $card['status']); ?>" class="text-decoration-none">
          <div class="card border-left-<?= $card['color'] ?> shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-<?= $card['color'] ?> text-uppercase mb-1">
                    <?= $card['title'] ?>
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $card['count'] ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas <?= $card['icon'] ?> fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?> 
  </div>

  <!-- Data Table -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table" id="datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">NIM</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Prodi</th>
              <th scope="col">Create At</th>
              <th scope="col">Status</th>
              <th scope="col">Finish</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($skly as $s) : ?>
              <tr>
                <th scope="row"><?= $i++; ?></th>
                <td>
                  <a href="<?= base_url('skl/detailyudisium/' . $s['id_skl']); ?>">
                    <?= $s['nim']; ?> [-<?= $s['id_skl']; ?>-]
                  </a>
                </td>
                <td><?= $s['nama_lengkap']; ?></td>
                <td><?= $s['nama_prodi']; ?></td>
                <td><?= tgl_ind(date($s['date_create'])); ?></td>
                <td>
                   <?php 
                    if ($s['status'] == 'selesai') {
                      $label = 'Selesai'; $badge = 'primary';
                    } elseif ($s['status'] == 'diajukan') {
                      $label = 'Di Ajukan'; $badge = 'secondary';
                    } elseif ($s['status'] == 'proses') {
                      $label = 'Proses'; $badge = 'warning';
                    } else {
                      $label = $s['status']; $badge = 'secondary';
                    }
                  ?>
                  <span class="badge badge-<?= $badge ?>"><?= $label ?></span><br>
                  <small class="text-muted"><?= $s['admin']; ?></small>
                </td>
                <td><?= tgl_ind(date($s['date_finish'])); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- End Page Content -->
