<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <style>
    .status-card.active {
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.7);
        transform: scale(1.02);
        transition: 0.2s;
    }
    </style>

    <!-- datepicker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datepicker/dist/css/bootstrap-datepicker.min.css" type="text/css">

    <!-- FUNGSI Hide dan Show Form Input Jika List Menu Dipilih -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type='text/javascript'>
        $(window).load(function() {
            $("#keperluan").change(function() {
                console.log($("#keperluan option:selected").val());
                if ($("#keperluan option:selected").val() == '1') {
                    $('#id_keperluan').prop('hidden', false);
                } else {
                    if ($("#keperluan option:selected").val() == '2') {
                        $('#id_keperluan').prop('hidden', false);
                    } else {

                        $('#id_keperluan').prop('hidden', 'true');
                    }
                }
            });
        });
    </script>
    <!-- end FUNGSI Hide dan Show Form Input Jika List Menu Dipilih -->

    <!-- Keterangan FUNGSI Hide dan Show Form Input Jika List Menu Dipilih -->
    <script type='text/javascript'>
        $(window).load(function() {
            $("#keperluan").change(function() {
                console.log($("#keperluan option:selected").val());
                if ($("#keperluan option:selected").val() == '5') {
                    $('#keterangan').prop('hidden', false);
                } else {
                    if ($("#keperluan option:selected").val() == '6') {
                        $('#keterangan').prop('hidden', false);
                    } else {

                        $('#keterangan').prop('hidden', 'true');
                    }
                }
            });
        });
    </script>
    <!-- end Keterangan FUNGSI Hide dan Show Form Input Jika List Menu Dipilih -->

    <!-- Keterangan FUNGSI Hide dan Show Form Input Jika List Menu Dipilih -->
    <script type='text/javascript'>
        $(window).load(function() {
            $("#keperluan").change(function() {
                console.log($("#keperluan option:selected").val());
                if ($("#keperluan option:selected").val() == '0') {
                    $('#lainnya').prop('hidden', false);
                } else {
                    $('#lainnya').prop('hidden', 'true');
                }
            });
        });
    </script>
    <!-- end Keterangan FUNGSI Hide dan Show Form Input Jika List Menu Dipilih -->
<script data-ad-client="ca-pub-4023762833393579" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">