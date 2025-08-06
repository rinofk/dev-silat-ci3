<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    Form Tambah Operator Admin
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open_multipart('admin/tambah'); ?>

                    <!-- <form action="" method="post"> -->
                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label">NIM / Username</label>
                        <div class="col-sm-9"> <input type="text" name="nim" class="form-control" id="nim" value="<?= set_value('nim'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9"> <input type="text" name="name" class="form-control" id="name" value="<?= set_value('name'); ?>"></div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">email</label>
                        <div class="col-sm-9"> <input type="text" name="email" class="form-control" id="email" value="<?= set_value('email'); ?>"></div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9"> <input type="text" name="password" class="form-control" id="password" value="<?= set_value('password'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9"> <input type="text" name="role" class="form-control" id="role" value="<?= set_value('role'); ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
</div>