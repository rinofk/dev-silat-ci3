<div class="auth-wrapper">
    <div class="auth-container">
        
        <!-- Card Registration Split Layout -->
        <div class="card auth-card-split border-0">
            <div class="row no-gutters">
                
                <!-- Kolom Kiri: Visual & Branding (Hanya tampil di Desktop/Tablet) -->
                <div class="col-md-6 auth-visual-col d-none d-md-flex">
                    <div style="width: 100%; max-width: 450px; height: 100%; display: flex; flex-direction: column; justify-content: space-between; margin: 0 auto;">
                        
                        <div class="auth-visual-brand text-left">
                            Silat <span>FK-UNTAN</span>
                        </div>
                        
                        <div class="auth-visual-text text-left">
                            <h3>Registrasi <br>Akun Baru</h3>
                            <p>
                                Daftarkan akun akademik Anda untuk dapat mengajukan pembuatan surat aktif kuliah, bebas laboratorium & perpustakaan secara digital dengan aman dan mudah.
                            </p>
                        </div>
                        
                        <!-- Integrasi Bantuan Admin -->
                        <div class="auth-help-box text-left">
                            <h6>Butuh Bantuan?</h6>
                            <p>Jika mengalami kendala registrasi atau pencocokan data mahasiswa, silakan hubungi administrator kami:</p>
                            <a href="https://wa.me/6285391044299"
                                target="_blank"
                                class="btn btn-success btn-block">
                                <i class="fab fa-whatsapp mr-1"></i> Hubungi Admin Web
                            </a>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Kolom Kanan: Formulir Registrasi -->
                <div class="col-md-6 col-12 auth-form-col">
                    <div style="width: 100%; max-width: 380px; margin: 0 auto;">
                        
                        <!-- Logo Fakultas & Kampus -->
                        <div class="text-center mb-3">
                            <img src="<?= base_url('assets/img/logo.png'); ?>"
                                alt="Logo Fakultas"
                                style="width: 75px; height: auto;">
                            <h5 class="mt-2 mb-0 font-weight-bold text-dark" style="font-size: 16px;">
                                Fakultas Kedokteran
                            </h5>
                            <h6 class="text-muted font-weight-bold" style="font-size: 12px;">
                                Universitas Tanjungpura
                            </h6>
                        </div>

                        <!-- Judul Form -->
                        <div class="text-center mb-3">
                            <h4 class="text-dark font-weight-bold mb-1" style="font-size: 20px;">Create Account</h4>
                            <p class="text-muted small mb-0">
                                Silakan isi data dengan benar sesuai dengan Siakad
                            </p>
                        </div>

                        <!-- Flash Message Notifikasi -->
                        <?= $this->session->flashdata('message'); ?>

                        <!-- Formulir Input -->
                        <form method="post" action="<?= base_url('auth/registration'); ?>">

                            <!-- Input NIM -->
                            <div class="form-group mb-3 text-left">
                                <input type="text"
                                    class="form-control"
                                    id="nim"
                                    name="nim"
                                    placeholder="Masukkan NIM"
                                    value="<?= set_value('nim'); ?>"
                                    style="height: 45px;">
                                <?= form_error('nim', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>

                            <!-- Input Tanggal Lahir -->
                            <div class="form-group mb-3 text-left">
                                <input type="text"
                                    class="form-control datepicker"
                                    id="tgl_lahir"
                                    name="tgl_lahir"
                                    placeholder="Tanggal Lahir (DD-MM-YYYY)"
                                    value="<?= set_value('tgl_lahir'); ?>"
                                    style="height: 45px;"
                                    autocomplete="off">
                                <?= form_error('tgl_lahir', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>

                            <!-- Input Password 1 + Toggle Mata -->
                            <div class="form-group mb-3 text-left" style="position: relative;">
                                <input type="password"
                                    class="form-control"
                                    id="password1"
                                    name="password1"
                                    placeholder="Kata Sandi Baru"
                                    style="height: 45px; padding-right: 45px;">
                                <?= form_error('password1', '<small class="text-danger pl-2">', '</small>'); ?>

                                <span id="togglePassword1"
                                    style="position: absolute; top: 22px; right: 15px; transform: translateY(-50%); cursor: pointer; color: #94a3b8;">
                                    <i class="fas fa-eye" id="iconPassword1"></i>
                                </span>
                            </div>

                            <!-- Input Password 2 + Toggle Mata -->
                            <div class="form-group mb-4 text-left" style="position: relative;">
                                <input type="password"
                                    class="form-control"
                                    id="password2"
                                    name="password2"
                                    placeholder="Konfirmasi Kata Sandi"
                                    style="height: 45px; padding-right: 45px;">
                                <?= form_error('password2', '<small class="text-danger pl-2">', '</small>'); ?>

                                <span id="togglePassword2"
                                    style="position: absolute; top: 22px; right: 15px; transform: translateY(-50%); cursor: pointer; color: #94a3b8;">
                                    <i class="fas fa-eye" id="iconPassword2"></i>
                                </span>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit"
                                class="btn btn-primary btn-block"
                                style="height: 45px;">
                                DAFTAR AKUN
                            </button>

                        </form>

                        <!-- Tautan Login -->
                        <div class="text-center mt-3">
                            <a class="small text-primary" href="<?= base_url('auth'); ?>">
                                Sudah memiliki akun? Login disini
                            </a>
                        </div>
                        
                        <!-- Link Bantuan Mobile -->
                        <div class="text-center mt-3 d-block d-md-none border-top pt-3">
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

<!-- SCRIPT SHOW/HIDE PASSWORD -->
<script>
    function addToggle(inputId, toggleId, iconId) {
        const input = document.getElementById(inputId);
        const toggle = document.getElementById(toggleId);
        const icon = document.getElementById(iconId);

        if (!input || !toggle || !icon) return;

        toggle.addEventListener("click", function() {
            const type = input.getAttribute("type") === "password" ? "text" : "password";
            input.setAttribute("type", type);

            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        });
    }

    addToggle("password1", "togglePassword1", "iconPassword1");
    addToggle("password2", "togglePassword2", "iconPassword2");
</script>