<div class="auth-wrapper">
    <div class="auth-container">
        
        <!-- Card Login Split Layout -->
        <div class="card auth-card-split border-0">
            <div class="row no-gutters">
                
                <!-- Kolom Kiri: Visual & Branding (Hanya tampil di Desktop/Tablet) -->
                <div class="col-md-6 auth-visual-col d-none d-md-flex">
                    <div style="width: 100%; max-width: 450px; height: 100%; display: flex; flex-direction: column; justify-content: space-between; margin: 0 auto;">
                        
                        <div class="auth-visual-brand text-left">
                            Silat <span>FK-UNTAN</span>
                        </div>
                        
                        <div class="auth-visual-text text-left">
                            <h3>Sistem Informasi <br>Layanan Persuratan</h3>
                            <p>
                                Kelola surat keterangan aktif kuliah, bebas laboratorium & perpustakaan, serta surat keterangan kelulusan secara mandiri, aman, dan instan dalam satu platform terintegrasi.
                            </p>
                        </div>
                        
                        <!-- Integrasi Bantuan Admin -->
                        <div class="auth-help-box text-left">
                            <h6>Butuh Bantuan?</h6>
                            <p>Jika mengalami kendala login atau verifikasi akun, silakan hubungi administrator kami:</p>
                            <a href="https://wa.me/6285391044299"
                                target="_blank"
                                class="btn btn-success btn-block">
                                <i class="fab fa-whatsapp mr-1"></i> Hubungi Admin Web
                            </a>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Kolom Kanan: Formulir Login -->
                <div class="col-md-6 col-12 auth-form-col">
                    <div style="width: 100%; max-width: 380px; margin: 0 auto;">
                        
                        <!-- Logo Fakultas & Kampus -->
                        <div class="text-center mb-4">
                            <img src="<?= base_url('assets/img/logo.png'); ?>"
                                alt="Logo Fakultas"
                                style="width: 80px; height: auto;">
                            <h5 class="mt-3 mb-0 font-weight-bold text-dark" style="font-size: 18px;">
                                Fakultas Kedokteran
                            </h5>
                            <h6 class="text-muted font-weight-bold" style="font-size: 13px;">
                                Universitas Tanjungpura
                            </h6>
                        </div>

                        <!-- Judul Welcome -->
                        <div class="text-center mb-4">
                            <h4 class="text-dark font-weight-bold mb-1" style="font-size: 22px;">Welcome Back</h4>
                            <p class="text-muted small mb-0">
                                Silakan masukkan kredensial Anda untuk melanjutkan
                            </p>
                        </div>

                        <!-- Flash Message Notifikasi -->
                        <?= $this->session->flashdata('message'); ?>

                        <!-- Formulir Input -->
                        <form method="post" action="<?= base_url('auth'); ?>">

                            <!-- Input NIM -->
                            <div class="form-group mb-3 text-left">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nim"
                                    placeholder="NIM / Username"
                                    value="<?= set_value('nim'); ?>"
                                    style="height: 46px;">
                                <?= form_error('nim', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>

                            <!-- Input Password + Toggle Mata -->
                            <div class="form-group mb-2 text-left" style="position: relative;">
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Password"
                                    style="height: 46px; padding-right: 45px;">
                                <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>

                                <span
                                    id="togglePassword"
                                    style="position: absolute; top: 23px; right: 15px; transform: translateY(-50%);
                                           cursor: pointer; color: #94a3b8;">
                                    <i class="fas fa-eye" id="iconPassword"></i>
                                </span>
                            </div>

                            <!-- Tautan Lupa Password -->
                            <div class="text-right mb-4">
                                <a href="<?= base_url('auth/reset_account'); ?>"
                                    class="small text-primary">
                                    Lupa Password?
                                </a>
                            </div>

                            <!-- Tombol Submit -->
                            <button
                                type="submit"
                                class="btn btn-primary btn-block"
                                style="height: 46px;">
                                MASUK
                            </button>

                        </form>

                        <!-- Navigasi Registrasi -->
                        <div class="text-center mt-4">
                            <a class="small text-primary" href="<?= base_url('auth/registration'); ?>">
                                Belum memiliki akun? Registrasi disini
                            </a>
                        </div>
                        
                        <!-- Link Bantuan (Hanya tampil di Mobile/Layar Kecil) -->
                        <div class="text-center mt-4 d-block d-md-none border-top pt-3">
                            <p class="text-muted small mb-2">Butuh Bantuan? Hubungi Admin</p>
                            <a href="https://wa.me/6285391044299"
                                target="_blank"
                                class="btn btn-success btn-sm px-3">
                                <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                            </a>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</div>

<!-- SCRIPT SHOW / HIDE PASSWORD -->
<script>
    const toggle = document.getElementById("togglePassword");
    const password = document.getElementById("password");
    const icon = document.getElementById("iconPassword");

    toggle.addEventListener("click", function() {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        icon.classList.toggle("fa-eye");
        icon.classList.toggle("fa-eye-slash");
    });
</script>