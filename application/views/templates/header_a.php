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

        /* Mobile Sidebar Auto-Hidden & Offcanvas Drawer Enhancement */
        @media (max-width: 768px) {
            /* Default: Sembunyikan sidebar di mobile agar halaman utama mendapat lebar 100% penuh */
            .sidebar {
                width: 0 !important;
                min-height: 100vh;
                overflow: hidden;
                display: none;
                transition: all 0.3s ease;
            }

            .sidebar.toggled {
                width: 0 !important;
                display: none !important;
            }

            /* Saat sidebar dibuka oleh admin via tombol hamburger */
            body:not(.sidebar-toggled) .sidebar:not(.toggled),
            .sidebar.mobile-open {
                display: block !important;
                position: fixed !important;
                top: 0;
                left: 0;
                bottom: 0;
                z-index: 1050;
                width: 16rem !important;
                max-width: 82vw;
                box-shadow: 4px 0 25px rgba(0, 0, 0, 0.35);
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                animation: slideInMobileSidebar 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            }

            body:not(.sidebar-toggled) .sidebar:not(.toggled) .sidebar-brand-text,
            .sidebar.mobile-open .sidebar-brand-text {
                display: inline !important;
            }

            body:not(.sidebar-toggled) .sidebar:not(.toggled) .sidebar-heading,
            .sidebar.mobile-open .sidebar-heading {
                text-align: left !important;
                padding: 0 1.25rem;
            }

            body:not(.sidebar-toggled) .sidebar:not(.toggled) .nav-item .nav-link,
            .sidebar.mobile-open .nav-item .nav-link {
                text-align: left !important;
                padding: 0.75rem 1.25rem;
                width: 100% !important;
            }

            body:not(.sidebar-toggled) .sidebar:not(.toggled) .nav-item .nav-link span,
            .sidebar.mobile-open .nav-item .nav-link span {
                font-size: 0.85rem !important;
                display: inline !important;
                margin-left: 8px;
            }

            /* Mobile Backdrop Overlay saat sidebar aktif */
            .sidebar-mobile-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(15, 23, 42, 0.55);
                backdrop-filter: blur(2px);
                z-index: 1040;
                display: none;
                transition: opacity 0.3s ease;
            }
            body.mobile-sidebar-active .sidebar-mobile-backdrop {
                display: block;
            }

            /* Konten utama selalu 100% penuh */
            #content-wrapper {
                width: 100% !important;
                overflow-x: hidden;
            }
        }

        @keyframes slideInMobileSidebar {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
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