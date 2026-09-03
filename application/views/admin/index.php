<style>
    .app-service-grid-admin {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    .app-service-link {
        text-decoration: none !important;
        display: block;
        height: 100%;
        color: inherit;
    }
    .app-service-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 20px 12px 16px 12px;
        text-align: center;
        border: 1px solid #eef2f6;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02);
        transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        height: 100%;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    .app-service-link:hover .app-service-card {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px -4px rgba(15, 23, 42, 0.12), 0 6px 10px -2px rgba(15, 23, 42, 0.04);
        border-color: #cbd5e1;
    }
    .app-service-link:active .app-service-card {
        transform: scale(0.96);
    }
    .app-icon-squircle {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #ffffff;
        margin-bottom: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .app-service-link:hover .app-icon-squircle {
        transform: scale(1.1) rotate(4deg);
        box-shadow: 0 12px 22px rgba(0, 0, 0, 0.2);
    }
    .bg-gradient-blue { background: linear-gradient(135deg, #0284c7, #38bdf8) !important; }
    .bg-gradient-green { background: linear-gradient(135deg, #059669, #34d399) !important; }
    .bg-gradient-amber { background: linear-gradient(135deg, #d97706, #fbbf24) !important; }
    .bg-gradient-purple { background: linear-gradient(135deg, #7c3aed, #c084fc) !important; }
    .bg-gradient-indigo { background: linear-gradient(135deg, #4f46e5, #06b6d4) !important; }
    .app-service-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 4px;
        line-height: 1.3;
    }
    .app-service-link:hover .app-service-title {
        color: #0284c7;
    }
    .app-service-admin {
        font-family: 'Inter', sans-serif;
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        background-color: #f1f5f9;
        padding: 3px 8px;
        border-radius: 6px;
        margin-top: 4px;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        border: 1px solid #e2e8f0;
    }
    .app-service-hint {
        font-size: 10px;
        font-weight: 700;
        color: #0284c7;
        margin-top: 6px;
        opacity: 0;
        transform: translateY(4px);
        transition: all 0.2s ease;
    }
    .app-service-link:hover .app-service-hint {
        opacity: 1;
        transform: translateY(0);
    }
    @media (max-width: 991px) {
        .app-service-grid-admin {
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
    }
    @media (max-width: 768px) {
        .app-service-grid-admin {
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .app-service-card {
            padding: 14px 6px 12px 6px !important;
            border-radius: 16px !important;
        }
        .app-icon-squircle {
            width: 48px !important;
            height: 48px !important;
            border-radius: 14px !important;
            font-size: 20px !important;
            margin-bottom: 8px !important;
        }
        .app-service-title {
            font-size: 11.5px !important;
            margin-bottom: 2px !important;
        }
        .app-service-admin {
            font-size: 9.5px !important;
            padding: 2px 4px !important;
            border-radius: 5px !important;
            max-width: 98% !important;
        }
    }
    @media (max-width: 360px) {
        .app-service-grid-admin {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid px-3 px-md-4">

  <!-- Page Heading -->
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 mb-0 text-gray-800 font-weight-bold"><?= $title; ?></h1>
  </div>

  <div class="app-service-grid-admin">
    <!-- 1. Surat Aktif Kuliah -->
    <a href="<?= base_url('transaksi/aktifkuliah'); ?>" 
       class="app-service-link service-app-item" 
       data-service="Surat Aktif Kuliah" 
       data-admins="Subiantoro Indra" 
       data-allowed-keys="subiantoro,indra"
       title="Buka Menu Surat Aktif Kuliah">
      <div class="app-service-card">
        <div class="app-icon-squircle bg-gradient-blue">
          <i class="fas fa-file-alt"></i>
        </div>
        <div class="app-service-title">Aktif Kuliah</div>
        <div class="app-service-admin">
          <i class="fas fa-user-circle mr-1 text-primary"></i>Subiantoro
        </div>
        <div class="app-service-hint d-none d-md-block">Buka Layanan &rarr;</div>
      </div>
    </a>

    <!-- 2. Bebas Perpustakaan -->
    <a href="<?= base_url('pustakawan'); ?>" 
       class="app-service-link service-app-item" 
       data-service="Bebas Perpustakaan" 
       data-admins="Suryani" 
       data-allowed-keys="suryani"
       title="Buka Menu Bebas Perpustakaan">
      <div class="app-service-card">
        <div class="app-icon-squircle bg-gradient-green">
          <i class="fas fa-book"></i>
        </div>
        <div class="app-service-title">Bebas Perpus</div>
        <div class="app-service-admin">
          <i class="fas fa-user-circle mr-1 text-success"></i>Suryani
        </div>
        <div class="app-service-hint d-none d-md-block">Buka Layanan &rarr;</div>
      </div>
    </a>

    <!-- 3. Bebas Lab -->
    <a href="<?= base_url('bebaslab'); ?>" 
       class="app-service-link service-app-item" 
       data-service="Bebas Laboratorium" 
       data-admins="Sumo Lestari, Nurul Hamsiah, Hazwani" 
       data-allowed-keys="sumo,lestari,nurul,hamsiah,hazwani,hazwan"
       title="Buka Menu Bebas Laboratorium">
      <div class="app-service-card">
        <div class="app-icon-squircle bg-gradient-amber">
          <i class="fas fa-flask"></i>
        </div>
        <div class="app-service-title">Bebas Lab</div>
        <div class="app-service-admin">
          <i class="fas fa-user-circle mr-1 text-warning"></i>Laboran
        </div>
        <div class="app-service-hint d-none d-md-block">Buka Layanan &rarr;</div>
      </div>
    </a>

    <!-- 4. Barcode Publikasi -->
    <a href="<?= base_url('jurnal'); ?>" 
       class="app-service-link service-app-item" 
       data-service="Barcode Publikasi" 
       data-admins="Andeff, Rino" 
       data-allowed-keys="andeff,rino,andef"
       title="Buka Menu Barcode Publikasi">
      <div class="app-service-card">
        <div class="app-icon-squircle bg-gradient-purple">
          <i class="fas fa-qrcode"></i>
        </div>
        <div class="app-service-title">Barcode Publikasi</div>
        <div class="app-service-admin">
          <i class="fas fa-user-circle mr-1" style="color:#7c3aed;"></i>Andeff, Rino
        </div>
        <div class="app-service-hint d-none d-md-block">Buka Layanan &rarr;</div>
      </div>
    </a>

    <!-- 5. SKL -->
    <a href="<?= base_url('skl'); ?>" 
       class="app-service-link service-app-item" 
       data-service="Surat Keterangan Lulus (SKL)" 
       data-admins="Yasinta Pagi, Yuti Maisyarah" 
       data-allowed-keys="yasinta,pagi,yuti,maisyarah"
       title="Buka Menu Surat Keterangan Lulus (SKL)">
      <div class="app-service-card">
        <div class="app-icon-squircle bg-gradient-indigo">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="app-service-title">Ket. Lulus</div>
        <div class="app-service-admin">
          <i class="fas fa-user-circle mr-1 text-info"></i>Yasinta
        </div>
        <div class="app-service-hint d-none d-md-block">Buka Layanan &rarr;</div>
      </div>
    </a>
  </div>

</div>
<!-- End of Page Content -->

<script>
    $(document).ready(function() {
        $(document).on('click', '.service-app-item', function(e) {
            const isSuperAdmin = <?= ($this->session->userdata('role_id') == 1) ? 'true' : 'false'; ?>;
            const currentName = "<?= strtolower(addslashes($user['name'])); ?>";
            const currentNim = "<?= strtolower(addslashes($user['nim'])); ?>";
            
            const rawAllowedKeys = $(this).data('allowed-keys') || '';
            const allowedKeys = rawAllowedKeys.toString().split(',');
            const serviceName = $(this).data('service') || 'Layanan';
            const adminNames = $(this).data('admins') || '-';

            let hasAccess = isSuperAdmin;
            if (!hasAccess) {
                for (let i = 0; i < allowedKeys.length; i++) {
                    const key = allowedKeys[i].trim().toLowerCase();
                    if (key && (currentName.indexOf(key) !== -1 || currentNim.indexOf(key) !== -1)) {
                        hasAccess = true;
                        break;
                    }
                }
            }

            if (!hasAccess) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: '<span style="font-family: \'Plus Jakarta Sans\', sans-serif; font-weight: 800; color: #1e293b;">Akses Tidak Diizinkan!</span>',
                    html: '<div style="font-family: \'Inter\', sans-serif; font-size: 13.5px; color: #475569; line-height: 1.5;">' +
                          'Maaf, Anda tidak memiliki hak akses untuk mengelola modul <b>' + serviceName + '</b>.<br>' +
                          '<div class="mt-3 p-3 text-left" style="background-color: #fef2f2; border: 1px solid #fee2e2; border-radius: 10px; font-size: 12px; color: #991b1b;">' +
                          '<i class="fas fa-user-shield mr-1"></i> <strong>Admin Pengelola:</strong> ' + adminNames +
                          '</div></div>',
                    confirmButtonColor: '#0284c7',
                    confirmButtonText: '<i class="fas fa-check mr-1"></i> Saya Mengerti'
                });
                return false;
            }
        });
    });
</script>
