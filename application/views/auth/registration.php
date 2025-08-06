<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user input-upper" id="nim" name="nim" onkeyup="myFunction()" placeholder="Masukkan NIM" value="<?= set_value('nim'); ?>">
                                <?= form_error('nim', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user datepicker" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" value="<?= set_value('tgl_lahir'); ?>">
                                <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <!-- 
                            <div class="form-group row">
                                <label for="program_studi" class="col-sm-3 col-form-label">Program Studi</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="program_studi" name="program_studi">
                                        <?php foreach ($prodi as $p) : ?>
                                            <?php if ($p['id_prodi'] == $mahasiswa['prodi_id']) : ?>

                                                <option value="<?= $p['id_prodi']; ?>" selected><?= $p['nama_prodi']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $p['id_prodi']; ?>"><?= $p['nama_prodi']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>


                        </form>
                        <hr>
                        <!-- <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div> -->
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
                            <!--<p>16 Oktober 2020 - Mohon Maaf, Untuk Sementara Create Account Sedang dalam Perbaikan</p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>