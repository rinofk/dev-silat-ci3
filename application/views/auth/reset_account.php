<div class="container d-flex justify-content-center align-items-center"
    style="min-height: 100vh;">

    <div style="width: 450px;">

        <div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-body p-4">

                <!-- LOGO -->
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
                <div class="text-center mb-3">
                    <h4 class="text-dark font-weight-bold mb-1">
                        Reset Account
                    </h4>
                    <p class="text-muted small mb-0">
                        Reset password akun mahasiswa
                    </p>
                </div>

                <!-- FLASH MESSAGE -->
                <?= $this->session->flashdata('message'); ?>

                <!-- INFO LIMIT -->
                <div class="alert alert-info small text-center mb-4">
                    Sisa reset hari ini: <?= 3 - $reset_today ?>/3

                </div>

                <!-- FORM -->
                <form method="post"
                    action="<?= base_url('auth/reset_account'); ?>">

                    <!-- NIM -->
                    <div class="form-group mb-3">
                        <input type="text"
                            class="form-control"
                            name="nim"
                            placeholder="Masukkan NIM"
                            value="<?= set_value('nim'); ?>"
                            style="border-radius: 10px; height: 45px;"
                            required>
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
                            style="border-radius: 10px; height: 45px;"
                            required>
                        <?= form_error('tgl_lahir', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>

                    <!-- PASSWORD BARU -->
                    <div class="form-group mb-3" style="position: relative;">
                        <input type="password"
                            class="form-control"
                            id="password1"
                            name="password1"
                            placeholder="Password Baru"
                            style="border-radius: 10px; height: 45px;"
                            required>

                        <span id="togglePassword1"
                            style="position: absolute; top: 50%; right: 15px;
                                     transform: translateY(-50%);
                                     cursor: pointer; color: #6c757d;">
                            <i class="fas fa-eye" id="iconPassword1"></i>
                        </span>

                        <?= form_error('password1', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>

                    <!-- ULANGI PASSWORD -->
                    <div class="form-group mb-4" style="position: relative;">
                        <input type="password"
                            class="form-control"
                            id="password2"
                            name="password2"
                            placeholder="Ulangi Password Baru"
                            style="border-radius: 10px; height: 45px;"
                            required>

                        <span id="togglePassword2"
                            style="position: absolute; top: 50%; right: 15px;
                                     transform: translateY(-50%);
                                     cursor: pointer; color: #6c757d;">
                            <i class="fas fa-eye" id="iconPassword2"></i>
                        </span>
                    </div>

                    <!-- SUBMIT -->
                    <button type="submit"
                        class="btn btn-primary btn-block"
                        style="height: 45px; border-radius: 10px;">
                        Reset Password
                    </button>

                </form>

                <div class="text-center mt-4">
                    <a class="small text-primary"
                        href="<?= base_url('auth'); ?>">
                        Kembali ke halaman Login
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>