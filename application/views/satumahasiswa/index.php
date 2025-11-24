<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?php
  // Hitung jumlah mahasiswa per prodi
  $count_by_prodi = [];
  foreach ($mahasiswa as $m) {
      $prodi = $m['nama_program_studi'];
      if (!isset($count_by_prodi[$prodi])) {
          $count_by_prodi[$prodi] = 0;
      }
      $count_by_prodi[$prodi]++;
  }

  $prodis = [
      'Pendidikan Profesi Apoteker',
      'Profesi Dokter',
      'Profesi Ners',
      'Kedokteran',
      'Farmasi',
      'Ilmu Keperawatan'
  ];
  ?>

  <!-- ===== CARD FILTER PRODI ===== -->
  <div class="row mb-4">
    <?php foreach ($prodis as $p): 
      $total = isset($count_by_prodi[$p]) ? $count_by_prodi[$p] : 0;
    ?>
      <div class="col-md-2 col-sm-4 mb-3">
        <div class="card prodi-card shadow-sm text-center h-100 py-3" data-prodi="<?= $p; ?>">
          <div class="card-body">
            <h6 class="font-weight-bold text-primary mb-1"><?= $p; ?></h6>
            <h5 class="text-dark font-weight-bold mb-0"><?= $total; ?></h5>
            <small class="text-muted">Mahasiswa</small>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- ===== CARD DATA MAHASISWA ===== -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa Satu Data Untan</h6>
      <button id="btnSync" class="btn btn-success btn-sm">
        <i class="fas fa-sync-alt"></i> Sinkronkan Data
      </button>
    </div>

    <div class="card-body">
      <div class="mb-3">
        <div class="progress" style="height: 25px;">
          <div id="syncProgress" class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width: 0%">0%</div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="datatable" width="100%" cellspacing="0">
          <thead class="thead-light">
            <tr>
              <th>NIM</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Program Studi</th>
              <th>Fakultas</th>
              <th>Sistem Kuliah</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($mahasiswa as $m): ?>
              <tr class="row-detail"
                  data-nim="<?= $m['nim']; ?>"
                  data-nama="<?= $m['nama']; ?>"
                  data-email="<?= $m['email']; ?>"
                  data-sistem="<?= $m['sistem_kuliah']; ?>"
                  data-id_periode="<?= $m['id_periode']; ?>"
                  data-id_periode_terakhir="<?= $m['id_periode_terakhir']; ?>"
                  data-alamat="<?= $m['alamat']; ?>"
                  data-tempat_lahir="<?= $m['tempat_lahir']; ?>"
                  data-tanggal_lahir="<?= $m['tanggal_lahir']; ?>"
                  data-hp="<?= $m['hp']; ?>"
                  data-agama="<?= $m['agama']; ?>"
                  data-jenis_kelamin="<?= $m['jenis_kelamin']; ?>"
                  data-nama_ayah="<?= $m['nama_ayah']; ?>"
                  data-nama_ibu="<?= $m['nama_ibu']; ?>"
                  data-id_prodi="<?= $m['id_program_studi']; ?>"
                  data-prodi="<?= $m['nama_program_studi']; ?>"
                  data-id_fakultas="<?= $m['id_fakultas']; ?>"
                  data-fakultas="<?= $m['nama_fakultas']; ?>"
                  data-id_jurusan="<?= $m['id_jurusan']; ?>"
                  data-jurusan="<?= $m['nama_jurusan']; ?>">
                <td><?= $m['nim']; ?></td>
                <td><?= $m['nama']; ?></td>
                <td><?= $m['email']; ?></td>
                <td><?= $m['nama_program_studi']; ?></td>
                <td><?= $m['nama_fakultas']; ?></td>
                <td><?= $m['sistem_kuliah']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- ===== MODAL DETAIL MAHASISWA ===== -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="fas fa-user-graduate"></i> Detail Mahasiswa</h5>
        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <p><strong>NIM:</strong> <span id="detailNim"></span></p>
            <p><strong>Nama:</strong> <span id="detailNama"></span></p>
            <p><strong>Email:</strong> <span id="detailEmail"></span></p>
            <p><strong>Sistem Kuliah:</strong> <span id="detailSistem"></span></p>
            <p><strong>Program Studi:</strong> <span id="detailProdi"></span></p>
            <p><strong>Fakultas:</strong> <span id="detailFakultas"></span></p>
            <p><strong>Jurusan:</strong> <span id="detailJurusan"></span></p>
            <p><strong>ID Program Studi:</strong> <span id="detailIdProdi"></span></p>
            <p><strong>ID Fakultas:</strong> <span id="detailIdFakultas"></span></p>
            <p><strong>ID Jurusan:</strong> <span id="detailIdJurusan"></span></p>
          </div>
          <div class="col-md-6">
            <p><strong>Alamat:</strong> <span id="detailAlamat"></span></p>
            <p><strong>Tempat Lahir:</strong> <span id="detailTempatLahir"></span></p>
            <p><strong>Tanggal Lahir:</strong> <span id="detailTanggalLahir"></span></p>
            <p><strong>No. HP:</strong> <span id="detailHp"></span></p>
            <p><strong>Agama:</strong> <span id="detailAgama"></span></p>
            <p><strong>Jenis Kelamin:</strong> <span id="detailGender"></span></p>
            <p><strong>Nama Ayah:</strong> <span id="detailAyah"></span></p>
            <p><strong>Nama Ibu:</strong> <span id="detailIbu"></span></p>
            <p><strong>ID Periode Awal:</strong> <span id="detailPeriode"></span></p>
            <p><strong>ID Periode Terakhir:</strong> <span id="detailPeriodeAkhir"></span></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- ===== STYLE TAMBAHAN ===== -->
<style>
  .prodi-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
    cursor: pointer;
  }

  .prodi-card.active {
    background-color: #ffeeba; /* kuning lembut */
    border-color: #ffc107;
    box-shadow: 0 0 10px rgba(255,193,7,0.4);
  }

  .prodi-card.active h6,
  .prodi-card.active h5,
  .prodi-card.active small {
    color: #856404 !important;
  }

  .prodi-card:hover {
    transform: translateY(-3px);
  }

  #datatable tbody tr {
    cursor: pointer;
  }
</style>

<!-- ===== JAVASCRIPT ===== -->
<script>
$(document).ready(function () {
  var table = $('#datatable').DataTable({ pageLength: 25 });

  // Filter berdasarkan prodi
  $('.prodi-card').click(function () {
    let prodi = $(this).data('prodi');
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      table.column(3).search('').draw();
    } else {
      $('.prodi-card').removeClass('active');
      $(this).addClass('active');
      table.column(3).search(prodi).draw();
    }
  });

  // Klik baris untuk tampilkan modal detail
  $('#datatable tbody').on('click', '.row-detail', function () {
    let d = $(this).data();
    $('#detailNim').text(d.nim);
    $('#detailNama').text(d.nama);
    $('#detailEmail').text(d.email);
    $('#detailSistem').text(d.sistem);
    $('#detailProdi').text(d.prodi);
    $('#detailFakultas').text(d.fakultas);
    $('#detailJurusan').text(d.jurusan);
    $('#detailIdProdi').text(d.id_prodi);
    $('#detailIdFakultas').text(d.id_fakultas);
    $('#detailIdJurusan').text(d.id_jurusan);
    $('#detailAlamat').text(d.alamat);
    $('#detailTempatLahir').text(d.tempat_lahir);
    $('#detailTanggalLahir').text(d.tanggal_lahir);
    $('#detailHp').text(d.hp);
    $('#detailAgama').text(d.agama);
    $('#detailGender').text(d.jenis_kelamin);
    $('#detailAyah').text(d.nama_ayah);
    $('#detailIbu').text(d.nama_ibu);
    $('#detailPeriode').text(d.id_periode);
    $('#detailPeriodeAkhir').text(d.id_periode_terakhir);
    $('#modalDetail').modal('show');
  });

  // Progres sinkronisasi
  $('#btnSync').click(function () {
    $('#btnSync').prop('disabled', true).text('Sinkronisasi sedang berjalan...');
    $('#syncProgress').css('width', '0%').text('0%');

    $.ajax({
      url: '<?= base_url("satumahasiswa/sync"); ?>',
      type: 'GET',
      dataType: 'json',
      xhr: function () {
        let xhr = new window.XMLHttpRequest();
        xhr.addEventListener("progress", function (evt) {
          if (evt.lengthComputable) {
            let percent = Math.round((evt.loaded / evt.total) * 100);
            $('#syncProgress').css('width', percent + '%').text(percent + '%');
          }
        }, false);
        return xhr;
      },
      success: function (res) {
        $('#syncProgress').css('width', '100%').text('100%');
        $('#btnSync').prop('disabled', false).text('Sinkronkan Data');
        Swal.fire('Berhasil!', res.message + ' Total: ' + res.total + ' mahasiswa.', 'success')
          .then(() => location.reload());
      },
      error: function () {
        $('#btnSync').prop('disabled', false).text('Sinkronkan Data');
        Swal.fire('Gagal!', 'Terjadi kesalahan saat sinkronisasi.', 'error');
      }
    });
  });
});
</script>
