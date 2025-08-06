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


                    <form action="" method="post">
                        <div class="form-group row">
                            <label for="nim" class="col-sm-3 col-form-label">NIM / Username</label>
                            <div class="col-sm-9"> <input type="text" name="nim" class="form-control" id="nim" value="<?= $tbuser['nim']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9"> <input type="text" name="name" class="form-control" id="name" value="<?= $tbuser['name']; ?>"></div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">email</label>
                            <div class="col-sm-9"> <input type="text" name="email" class="form-control" id="email" value="<?= $tbuser['email']; ?>"></div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9"> <input type="text" name="role" class="form-control" id="role" value="<?= $tbuser['role_id']; ?>">
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