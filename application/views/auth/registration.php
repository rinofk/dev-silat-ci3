<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div style="width: 450px;">

        <!-- Card Registration -->
        <div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-body p-4">

                <!-- LOGO + FAKULTAS -->
                <div class="text-center mb-4">
                    <img src="<?= base_url('assets/img/logo.png'); ?>"
                        alt="Logo Fakultas"
                        style="width: 85px; height: auto;">

                    <h5 class="mt-3 mb-0 font-weight-bold text-dark">
                        Fakultas Kedokteran
                    </h5>
                    <h6 class="text-dark font-weight-bold">
                        Universitas Tanjungpura
                    </h6>
                </div>

                <!-- HEADER -->
                <div class="text-center mb-4">
                    <h4 class="text-dark font-weight-bold mb-1">Create Account</h4>
                    <p class="text-muted small mb-0">Silakan isi data dengan benar</p>
                </div>

                <!-- FORM -->
                <form method="post" action="<?= base_url('auth/registration'); ?>">

                    <!-- NIM -->
                    <div class="form-group mb-3">
                        <input type="text"
                            class="form-control"
                            id="nim"
                            name="nim"
                            placeholder="Masukkan NIM"
                            value="<?= set_value('nim'); ?>"
                            style="border-radius: 10px; height: 45px;">
                        <?= form_error('nim', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>

                    <!-- TANGGAL LAHIR -->
                    <div class="form-group mb-3">
                        <input type="text"
                            class="form-control datepicker"
                            id="tgl_lahir"
                            name="tgl_lahir"
                            placeholder="Masukkan Tanggal Lahir"
                            value="<?= set_value('tgl_lahir'); ?>"
                            style="border-radius: 10px; height: 45px;">
                        <?= form_error('tgl_lahir', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>

                    <!-- PASSWORD 1 -->
                    <div class="form-group mb-3" style="position: relative;">
                        <input type="password"
                            class="form-control"
                            id="password1"
                            name="password1"
                            placeholder="Password"
                            style="border-radius: 10px; height: 45px;">
                        <?= form_error('password1', '<small class="text-danger pl-2">', '</small>'); ?>

                        <span id="togglePassword1"
                            style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #6c757d;">
                            <i class="fas fa-eye" id="iconPassword1"></i>
                        </span>
                    </div>

                    <!-- PASSWORD 2 -->
                    <div class="form-group mb-4" style="position: relative;">
                        <input type="password"
                            class="form-control"
                            id="password2"
                            name="password2"
                            placeholder="Ulangi Password"
                            style="border-radius: 10px; height: 45px;">

                        <span id="togglePassword2"
                            style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #6c757d;">
                            <i class="fas fa-eye" id="iconPassword2"></i>
                        </span>
                    </div>

                    <!-- SUBMIT -->
                    <button type="submit"
                        class="btn btn-primary btn-block"
                        style="height: 45px; border-radius: 10px;">
                        Register Account
                    </button>

                </form>

                <div class="text-center mt-4">
                    <a class="small text-primary" href="<?= base_url('auth'); ?>">
                        Already have an account? Login here
                    </a>
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