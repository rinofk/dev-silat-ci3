<!doctype html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/'); ?>css/homestyle.css?v=<?= filemtime(FCPATH . 'assets/css/homestyle.css'); ?>" rel="stylesheet">

    <title>Silat FK-UNTAN - Sistem Informasi Layanan Administrasi Persuratan Terpadu</title>
</head>

<body>
    <!-- Floating Navbar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="http://silatfk.untan.ac.id/">Silat <span>FK-UNTAN</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <?php if (!empty($navbar_menu)) : ?>
                        <?php foreach ($navbar_menu as $menu) : ?>
                            <?php if ($menu['is_button'] == 0) : ?>
                                <a class="nav-item nav-link" href="<?= $menu['url']; ?>" target="_blank"><?= htmlspecialchars($menu['label']); ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <a class="nav-item nav-link" href="https://www.untan.ac.id/" target="_blank">Untan</a>
                        <a class="nav-item nav-link" href="https://siremun.untan.ac.id/" target="_blank">Siremun</a>
                        <a class="nav-item nav-link" href="http://203.24.51.238:8015/" target="_blank">Reservasi Ruang Sidang</a>
                        <a class="nav-item nav-link" href="http://203.24.51.238:8020/" target="_blank">Agenda Fakultas</a>
                        <a class="nav-item nav-link" href="https://script.google.com/macros/s/AKfycbzLxqaPQQBLNFzYHFjXFwZjaUr1UKj7XCtt37zhr8umegRjdbioG15iRecWtmN_dDPMMA/exec" target="_blank">Pengumpulan Softfile Skripsi</a>
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
    <!-- Akhir Navbar -->

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="hero-glow-1"></div>
        <div class="hero-glow-2"></div>
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">
                        Sistem Informasi <br>
                        <span class="text-gradient">Layanan Administrasi</span> <br>
                        Persuratan Terpadu
                    </h1>
                    <p class="hero-subtitle">
                        Platform pelayanan administrasi persuratan digital terintegrasi Fakultas Kedokteran Universitas Tanjungpura. Kelola surat keterangan aktif kuliah, bebas lab & perpus, serta keterangan lulus secara cepat dan mudah.
                    </p>
                    <div class="hero-btn-container">
                        <a href="<?= base_url(); ?>auth" class="btn btn-hero-login">
                            LOGIN
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mock-dashboard-wrapper">
                        <div class="mock-card">
                            <div class="mock-header">
                                <div class="mock-dots">
                                    <span class="mock-dot red"></span>
                                    <span class="mock-dot yellow"></span>
                                    <span class="mock-dot green"></span>
                                </div>
                                <div class="mock-title">Statistik Layanan</div>
                            </div>
                            <div class="mock-stat-grid">
                                <div class="mock-stat-item">
                                    <div class="mock-stat-num blue">12,480+</div>
                                    <div class="mock-stat-label">Surat Selesai</div>
                                </div>
                                <div class="mock-stat-item">
                                    <div class="mock-stat-num teal">99.8%</div>
                                    <div class="mock-stat-label">Indeks Kepuasan</div>
                                </div>
                            </div>
                            <div class="mock-list">
                                <div class="mock-list-item">
                                    <div class="mock-list-item-content">
                                        <h5>Surat Aktif Kuliah</h5>
                                        <p>Baru saja disetujui & diterbitkan sistem</p>
                                    </div>
                                </div>
                                <div class="mock-list-item teal">
                                    <div class="mock-list-item-content">
                                        <h5>Bebas Lab & Perpustakaan</h5>
                                        <p>Telah ditandatangani secara digital</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Akhir Hero Section -->

    <!-- Info Panel / Services Section -->
    <section class="services-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <img src="<?= base_url('assets/img/home/'); ?>kuliah.png" alt="Aktif Kuliah">
                        </div>
                        <h4>Aktif Kuliah</h4>
                        <p>Pembuatan surat keterangan resmi yang menyatakan bahwa mahasiswa masih aktif dalam kegiatan perkuliahan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <img src="<?= base_url('assets/img/home/'); ?>scancode.png" alt="Bebas Lab & Perpustakaan">
                        </div>
                        <h4>Bebas Lab & Perpustakaan</h4>
                        <p>Pengurusan Surat Bebas Laboratorium dan Surat Bebas Perpustakaan Fakultas Kedokteran UNTAN secara praktis.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <img src="<?= base_url('assets/img/home/'); ?>lulus.png" alt="Keterangan Lulus">
                        </div>
                        <h4>Keterangan Lulus</h4>
                        <p>Pembuatan Surat Keterangan Lulus (SKL) resmi untuk mempermudah administrasi pengambilan ijazah wisuda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Services Section -->

    <!-- Working Space Section -->
    <section class="workingspace-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="video-card-container">
                        <div class="video-wrapper">
                            <iframe src="https://www.youtube.com/embed/videoseries?list=PL8_eTDhzC-uR4oyR6LX6X-OLWNHiK2bx8" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bdr-widget" style="background: var(--white); border: 1px solid var(--border); box-shadow: var(--shadow-md);">
                        <div>
                            <span class="section-tag">Panduan Layanan</span>
                            <h2 class="section-title">Tata Cara Pengajuan</h2>
                            <p class="bdr-instruction" style="margin-bottom: 24px;">
                                Ikuti langkah-langkah mudah berikut untuk mengajukan surat administrasi atau memproses berkas secara mandiri melalui sistem Silat FK-UNTAN:
                            </p>
                            
                            <div class="mock-list" style="gap: 16px;">
                                <div class="mock-list-item" style="border-left-color: var(--primary); background: var(--light); color: var(--dark); padding: 14px; margin: 0;">
                                    <div class="mock-list-item-content">
                                        <h5 style="color: var(--dark); font-weight: 700; font-size: 14px; margin-bottom: 4px;">1. LOGIN KE SISTEM</h5>
                                        <p style="color: var(--gray); font-size: 12px; margin: 0;">Masuk menggunakan akun mahasiswa atau pegawai Anda yang telah terdaftar resmi.</p>
                                    </div>
                                </div>
                                <div class="mock-list-item" style="border-left-color: var(--secondary); background: var(--light); color: var(--dark); padding: 14px; margin: 0;">
                                    <div class="mock-list-item-content">
                                        <h5 style="color: var(--dark); font-weight: 700; font-size: 14px; margin-bottom: 4px;">2. PILIH JENIS SURAT & ISI FORMULIR</h5>
                                        <p style="color: var(--gray); font-size: 12px; margin: 0;">Pilih layanan surat yang dibutuhkan, lengkapi formulir data diri, serta unggah berkas syarat.</p>
                                    </div>
                                </div>
                                <div class="mock-list-item" style="border-left-color: var(--accent); background: var(--light); color: var(--dark); padding: 14px; margin: 0;">
                                    <div class="mock-list-item-content">
                                        <h5 style="color: var(--dark); font-weight: 700; font-size: 14px; margin-bottom: 4px;">3. TUNGGU VERIFIKASI & UNDUH SURAT</h5>
                                        <p style="color: var(--gray); font-size: 12px; margin: 0;">Admin akan memverifikasi berkas Anda. Jika disetujui, surat resmi dapat langsung diunduh & dicetak.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Working Space Section -->

    <!-- Presensi Tendik Section -->
    <section class="tendik-container">
        <div class="container">
            <div class="tendik-banner">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="tendik-content">
                            <span class="section-tag">Aktivitas Tendik</span>
                            <h2 class="tendik-title">Presensi Tenaga Kependidikan</h2>
                            <blockquote class="tendik-quote">
                                "Jangan lupa kawan-kawan Tendik untuk mengisi Presensi WFH pada portal wfh.untan.ac.id ini setiap hari jum'at demi ketertiban administrasi."
                            </blockquote>
                            <a href="http://wfh.untan.ac.id/" target="_blank" class="btn-tendik-presensi">
                                BUKA PRESENSI WFH UNTAN
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="building-card">
                            <div class="building-img-wrapper">
                                <img src="<?= base_url('assets/img/home/'); ?>fk_homes.jpg" alt="Fakultas Kedokteran UNTAN">
                            </div>
                            <div class="building-caption">
                                <h5>Gedung FK UNTAN</h5>
                                <a href="http://kedokteran.untan.ac.id/" target="_blank">Profil Kampus &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Presensi Tendik Section -->

    <!-- Footer Section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="footer-brand">Silat <span>FK-UNTAN</span></div>
                    <p class="footer-desc">
                        Sistem Informasi Layanan Administrasi Persuratan Terpadu Fakultas Kedokteran Universitas Tanjungpura. Membantu kemudahan dan percepatan administrasi persuratan akademik.
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white mb-3 font-weight-bold">Layanan Utama</h5>
                    <ul class="footer-links">
                        <?php if (!empty($footer_layanan)) : ?>
                            <?php foreach ($footer_layanan as $fl) : ?>
                                <li><a href="<?= $fl['url']; ?>"><?= htmlspecialchars($fl['label']); ?></a></li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li><a href="#">Surat Keterangan Aktif Kuliah</a></li>
                            <li><a href="#">Bebas Laboratorium</a></li>
                            <li><a href="#">Bebas Perpustakaan Fakultas</a></li>
                            <li><a href="#">Surat Keterangan Lulus (SKL)</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-3 font-weight-bold">Tautan Terkait</h5>
                    <ul class="footer-links">
                        <?php if (!empty($footer_tautan)) : ?>
                            <?php foreach ($footer_tautan as $ft) : ?>
                                <li><a href="<?= $ft['url']; ?>" target="_blank"><?= htmlspecialchars($ft['label']); ?></a></li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li><a href="https://www.untan.ac.id/" target="_blank">Universitas Tanjungpura</a></li>
                            <li><a href="https://siremun.untan.ac.id/" target="_blank">Siremun UNTAN</a></li>
                            <li><a href="http://kedokteran.untan.ac.id/" target="_blank">Fakultas Kedokteran UNTAN</a></li>
                            <li><a href="http://wfh.untan.ac.id/" target="_blank">Presensi WFH Tendik</a></li>
                            <li><a href="http://203.24.51.238:8020/" target="_blank">Agenda Fakultas</a></li>
                            <li><a href="https://script.google.com/macros/s/AKfycbzLxqaPQQBLNFzYHFjXFwZjaUr1UKj7XCtt37zhr8umegRjdbioG15iRecWtmN_dDPMMA/exec" target="_blank">Pengumpulan Softfile Skripsi</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p class="footer-copyright">
                    &copy; <?= date('Y'); ?> All Rights Reserved. Fakultas Kedokteran UNTAN.
                </p>
                <p class="footer-attribution">
                    Developed by IT Programming FK UNTAN
                </p>
            </div>
        </div>
    </footer>
    <!-- Akhir Footer Section -->

    <!-- JavaScript & jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>