<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div style="width: 400px;">

        <!-- Card Login -->
        <div class="card shadow-lg border-0 mb-3" style="border-radius: 15px;">
            <div class="card-body p-4">

                <!-- Logo Fakultas -->
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

                <!-- Welcome Text -->
                <div class="text-center mb-4">
                    <h4 class="text-dark font-weight-bold mb-1">Welcome</h4>
                    <p class="text-muted small mb-0">
                        Silakan login untuk melanjutkan
                    </p>
                </div>

                <!-- Flash Message -->
                <?= $this->session->flashdata('message'); ?>

                <!-- Form Login -->
                <form method="post" action="<?= base_url('auth'); ?>">

                    <!-- NIM -->
                    <div class="form-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="nim"
                            placeholder="NIM"
                            value="<?= set_value('nim'); ?>"
                            style="border-radius: 10px; height: 45px;">
                        <?= form_error('nim', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>

                    <!-- Password + Toggle -->
                    <div class="form-group mb-2" style="position: relative;">
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Password"
                            style="border-radius: 10px; height: 45px;">
                        <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>

                        <span
                            id="togglePassword"
                            style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%);
                                   cursor: pointer; color: #6c757d;">
                            <i class="fas fa-eye" id="iconPassword"></i>
                        </span>
                    </div>

                    <!-- Lupa Password -->
                    <div class="text-right mb-4">
                        <a href="<?= base_url('auth/reset_account'); ?>"
                            class="small text-muted">
                            Lupa Password?
                        </a>
                    </div>

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="btn btn-primary btn-block"
                        style="height: 45px; border-radius: 10px;">
                        Login
                    </button>

                </form>

                <!-- Register -->
                <div class="text-center mt-4">
                    <a class="small text-primary" href="<?= base_url('auth/registration'); ?>">
                        Create an account
                    </a>
                </div>

            </div>
        </div>

        <!-- Card Bantuan Admin -->
        <div class="card shadow-sm border-0" style="border-radius: 15px;">
            <div class="card-body p-3">
                <h6 class="font-weight-bold text-dark mb-2">Butuh Bantuan?</h6>

                <p class="text-muted small mb-3">
                    Jika Anda mengalami kendala login, silakan hubungi admin web melalui WhatsApp:
                </p>

                <a href="https://wa.me/6285391044299"
                    target="_blank"
                    class="btn btn-success btn-block"
                    style="border-radius: 10px;">
                    <i class="fab fa-whatsapp"></i> Hubungi Admin
                </a>
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