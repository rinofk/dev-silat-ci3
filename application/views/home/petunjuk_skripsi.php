<!doctype html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- FontAwesome -->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/'); ?>css/homestyle.css?v=<?= filemtime(FCPATH . 'assets/css/homestyle.css'); ?>" rel="stylesheet">

    <title>Petunjuk Pengumpulan Softfile Skripsi - Silat FK-UNTAN</title>
</head>

<body>
    <!-- Floating Navbar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="<?= base_url(); ?>">Silat <span>FK-UNTAN</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <?php if (!empty($navbar_menu)) : ?>
                        <?php foreach ($navbar_menu as $menu) : ?>
                            <?php if ($menu['is_button'] == 0) : ?>
                                <?php
                                    $href = $menu['url'];
                                    $target = 'target="_blank"';
                                    if (strpos(strtolower($menu['label']), 'softfile skripsi') !== false) {
                                        $href = base_url('home/petunjuk_skripsi');
                                        $target = ''; // open in same window
                                    }
                                ?>
                                <a class="nav-item nav-link" href="<?= $href; ?>" <?= $target; ?>><?= htmlspecialchars($menu['label']); ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <a class="nav-item nav-link" href="https://www.untan.ac.id/" target="_blank">Untan</a>
                        <a class="nav-item nav-link" href="https://siremun.untan.ac.id/" target="_blank">Siremun</a>
                        <a class="nav-item nav-link" href="http://203.24.51.238:8015/" target="_blank">Reservasi Ruang Sidang</a>
                        <a class="nav-item nav-link" href="http://203.24.51.238:8020/" target="_blank">Agenda Fakultas</a>
                        <a class="nav-item nav-link" href="<?= base_url('home/petunjuk_skripsi'); ?>">Pengumpulan Softfile Skripsi</a>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('email')) : ?>
                        <?php 
                            $role_id = $this->session->userdata('role_id');
                            $dashboard_url = ($role_id == 1 || in_array($role_id, [3, 5, 7, 8, 9])) ? base_url('operator') : base_url('user');
                        ?>
                        <a class="nav-item nav-link" href="<?= $dashboard_url; ?>">Dashboard</a>
                    <?php else: ?>
                        <a class="nav-item nav-link" href="<?= base_url('auth'); ?>">Login</a>
                    <?php endif; ?>
                    <?php if (!empty($navbar_menu)) : ?>
                        <?php foreach ($navbar_menu as $menu) : ?>
                            <?php if ($menu['is_button'] == 1) : ?>
                                <a class="nav-item btn btn-primary btn-nav-action" href="<?= $menu['url']; ?>" target="_blank"><?= htmlspecialchars($menu['label']); ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <a class="nav-item btn btn-primary btn-nav-action" href="http://kedokteran.untan.ac.id/home" target="_blank">Website FK UNTAN</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>

    <!-- Content Section -->
    <header class="hero-section" style="min-height: 100vh; display: flex; align-items: center; padding: 140px 0 100px 0;">
        <div class="hero-glow-1"></div>
        <div class="hero-glow-2"></div>
        <div class="container hero-content">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Glassmorphic Card -->
                    <div class="card p-4 p-md-5 border-0 shadow-lg" style="background: rgba(30, 41, 59, 0.7) !important; backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.1) !important; border-radius: 24px; color: #f8fafc;">
                        
                        <div class="text-center mb-4">
                            <div class="icon-box mb-3 d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background: rgba(56, 189, 248, 0.15); border-radius: 50%; color: #38bdf8;">
                                <i class="fas fa-graduation-cap fa-2x"></i>
                            </div>
                            <h2 class="font-weight-bold text-gradient mb-2" style="font-size: 28px;">Petunjuk Pengumpulan Softfile Skripsi</h2>
                            <p class="text-muted small" style="color: #94a3b8 !important;">Fakultas Kedokteran Universitas Tanjungpura</p>
                        </div>

                        <hr style="border-top: 1px solid rgba(255, 255, 255, 0.1);">

                        <div class="guidelines-content mt-4" style="font-size: 15px; line-height: 1.6; color: #cbd5e1;">
                            <p class="mb-4">Sebelum melanjutkan ke aplikasi pengumpulan softfile skripsi, mohon perhatikan dan persiapkan beberapa poin petunjuk berikut ini:</p>
                            
                            <div class="d-flex mb-3">
                                <div class="mr-3" style="color: #2dd4bf;"><i class="fas fa-check-circle mt-1"></i></div>
                                <div>
                                    <strong class="text-white d-block mb-1">Kelengkapan Berkas</strong>
                                    Pastikan seluruh bagian skripsi (Cover, Lembar Pengesahan yang sudah ditandatangani, Bab I s.d. Bab Penutup, dan Lampiran) telah digabungkan atau disiapkan sesuai instruksi.
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="mr-3" style="color: #2dd4bf;"><i class="fas fa-check-circle mt-1"></i></div>
                                <div>
                                    <strong class="text-white d-block mb-1">Alamat Email Aktif</strong>
                                    Pastikan email yang di-input benar dan aktif. Bukti pengisian formulir akan dikirimkan melalui alamat email yang didaftarkan.
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="mr-3" style="color: #2dd4bf;"><i class="fas fa-check-circle mt-1"></i></div>
                                <div>
                                    <strong class="text-white d-block mb-1">Penerimaan Email Notifikasi (2x)</strong>
                                    Mahasiswa akan mendapatkan 2x email: email pertama berupa notifikasi/tanda terima pengiriman file, dan email kedua merupakan email bukti bahwa berkas sudah diverifikasi oleh admin.
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="mr-3" style="color: #2dd4bf;"><i class="fas fa-check-circle mt-1"></i></div>
                                <div>
                                    <strong class="text-white d-block mb-1">Penyerahan Jilid Skripsi Fisik</strong>
                                    Jika sudah mendapatkan email verifikasi, siapkan untuk menyerahkan jilid skripsi ke perpustakaan fakultas dengan menunjukkan email bukti verifikasi resmi dari pengirim <span class="text-gradient font-weight-bold">filefk@untan.ac.id</span>.
                                </div>
                            </div>
                        </div>

                        <!-- Tips Incognito Mode -->
                        <div class="alert alert-warning border-0 p-3 mt-4 text-left d-flex align-items-start" style="background: rgba(245, 158, 11, 0.15); border-left: 4px solid #f59e0b !important; border-radius: 12px; color: #ffedd5; font-size: 14px;">
                            <div class="mr-2 text-warning"><i class="fas fa-exclamation-triangle mt-1"></i></div>
                            <div>
                                <strong class="text-warning">Tips Akun Google (Incognito Mode):</strong><br>
                                Jika Anda mengalami error "butuh izin akses" saat membuka aplikasi, mohon gunakan **Mode Incognito/Samaran** di browser Anda. Klik tombol <strong>Salin Link</strong> di bawah, lalu buka Jendela Samaran baru (Incognito Window) dan tempel (paste) link tersebut di sana.
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center" style="gap: 15px;">
                                <a href="https://script.google.com/macros/s/AKfycbzLxqaPQQBLNFzYHFjXFwZjaUr1UKj7XCtt37zhr8umegRjdbioG15iRecWtmN_dDPMMA/exec" 
                                   target="_blank" 
                                   class="btn btn-primary px-4 py-3 font-weight-bold shadow text-white" 
                                   style="background: linear-gradient(135deg, #0284c7, #0d9488); border: none; border-radius: 12px; font-size: 15px; transition: all 0.3s; width: 280px;"
                                   onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(2, 132, 199, 0.4)';"
                                   onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
                                    Lanjutkan ke Aplikasi <i class="fas fa-external-link-alt ml-2" style="font-size: 13px;"></i>
                                </a>
                                
                                <button type="button"
                                        id="btnCopyLink"
                                        class="btn btn-secondary px-4 py-3 font-weight-bold shadow"
                                        style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; font-size: 15px; color: #fff; transition: all 0.3s; width: 180px;"
                                        onmouseover="this.style.background='rgba(255, 255, 255, 0.2)'; this.style.transform='translateY(-2px)';"
                                        onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.transform='none';">
                                    <i class="fas fa-copy mr-2"></i> Salin Link
                                </button>
                            </div>
                            
                            <div class="mt-4">
                                <a href="<?= base_url(); ?>" class="text-muted small" style="color: #94a3b8 !important; text-decoration: underline;">
                                    Kembali ke Halaman Utama
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <!-- JS Copy Link -->
    <script>
        $(document).ready(function() {
            $('#btnCopyLink').click(function() {
                var dummy = document.createElement('input'),
                text = 'https://script.google.com/macros/s/AKfycbzLxqaPQQBLNFzYHFjXFwZjaUr1UKj7XCtt37zhr8umegRjdbioG15iRecWtmN_dDPMMA/exec';
                document.body.appendChild(dummy);
                dummy.value = text;
                dummy.select();
                document.execCommand('copy');
                document.body.removeChild(dummy);
                
                var originalText = $(this).html();
                $(this).html('<i class="fas fa-check"></i> Disalin!').css({
                    'background-color': '#2dd4bf',
                    'border-color': '#2dd4bf',
                    'color': '#0f172a'
                });
                
                setTimeout(function() {
                    $('#btnCopyLink').html(originalText).css({
                        'background-color': 'rgba(255, 255, 255, 0.1)',
                        'border-color': 'rgba(255, 255, 255, 0.2)',
                        'color': '#fff'
                    });
                }, 2000);
            });
        });
    </script>
</body>

</html>
