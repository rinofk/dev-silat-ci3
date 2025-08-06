<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css"> -->


    <!-- My Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Viga&display=swap" rel="stylesheet">

    <!-- My CSS -->
    <link href="<?= base_url('assets/'); ?>css/homestyle.css" rel="stylesheet">

    <title>Silat FK-UNTAN</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Silat FK-UNTAN</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#">Features</a>
                    <a class="nav-item nav-link" href="#">About</a>
                    <a class="nav-item btn btn-primary tombol" href="#" tabindex="-1" aria-disabled="true">Join Us</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- akhir Navbar -->

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid" style="background-image: url('<?= base_url("assets/img/home/"); ?>header1.jpg ');">
        <div class="container">
            <h1 class="display-4">Sistem Informasi <span>Layanan</span><br>Administrasi <span>Persuratan</span> Terpadu</h1>
            <a href="<?= base_url(); ?>auth" class="btn btn-primary"> LOGIN </a>


        </div>
    </div>
    <!-- Akhir Jumbotron -->

    <!-- Container -->
    <div class="container">
        <!-- info Panel -->
        <div class="row justify-content-center">
            <div class="col-10 info-panel">
                <div class="row">
                    <div class="col-lg">
                        <img src="<?= base_url('assets/img/home/'); ?>/kuliah.png" alt="" class="float-left">
                        <h4>Aktif Kuliah</h4>
                        <p>Surat keterangan masih aktif kuliah</p>
                    </div>
                    <div class="col-lg">
                        <img src="<?= base_url('assets/img/home/'); ?>/scancode.png" alt="" class="float-left">
                        <h4>Barcode Publikasi</h4>
                        <p>Proses publikasi ilmiah sampai diterbitkan nya barcode</p>
                    </div>
                    <div class="col-lg">
                        <img src="<?= base_url('assets/img/home/'); ?>/lulus.png" alt="" class="float-left">
                        <h4>Keterangan Lulus</h4>
                        <p>Surat keterangan lulus untuk pengambilan ijazah</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir info panel -->
        <!-- working space -->
        <div class="row workingspace">
            <div class="col-lg-6">
                <img src="<?= base_url('assets/img/home/'); ?>/fk_untan.jpg" alt="workingspace" class="img-fluid rounded">
            </div>
            <div class="col-lg-5">
                <h3>Cara <span>baru </span>layanan surat lebih <span>mudah</span></h3>
                <p>Login, click dan cetak surat yang dibutuhkan</p>
                <!-- <a href="" class="btn btn-primary tombol">Gallery</a> -->
            </div>
        </div>
        <!-- akhir working space -->

        <!-- Testimonial -->
        <section class="testimonial">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h5>"Administrasi jadi lebih mudah dengan aplikasi online"</h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6 justify-content-center d-flex">
                    <figure class="figure">
                        <img src="<?= base_url('assets/img/home/'); ?>icon.png" class="figure-img img-fluid rounded" alt="test1">
                        <figcaption class="figure-caption">
                            <h5>rino fs</h5>
                            <p>IT Programming</p>
                        </figcaption>
                    </figure>
                </div>
            </div>

        </section>
        <!-- Akhir Testimonial -->


    </div>
    <!-- akhir COntainer -->

    <!-- footer -->
    <div class="row footer">
        <div class="col text-center">
            <p>2019 All Rights Reserved Fakultas Kedokteran UNTAN</p>
        </div>
    </div>

    <!-- akhir footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>