<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    Ubah Password
                </div>
                <div class="card-body">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>


                    <form action="" method="post">


                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9"> <input type="text" name="password" class="form-control" id="password">
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