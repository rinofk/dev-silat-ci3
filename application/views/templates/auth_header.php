<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Layanan Administrasi Persuratan Terpadu - FK UNTAN">
    <meta name="author" content="IT Programming FK UNTAN">

    <title>
        <?= $title; ?> - Silat FK-UNTAN
    </title>

    <!-- datepicker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datepicker/dist/css/bootstrap-datepicker.min.css" type="text/css">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Premium Custom Auth Styling -->
    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --secondary: #0d9488;
            --secondary-dark: #0f766e;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
            --border: #e2e8f0;
            --font-title: 'Plus Jakarta Sans', sans-serif;
            --font-body: 'Inter', sans-serif;
        }

        body {
            font-family: var(--font-body);
            background: radial-gradient(circle at 50% 50%, #0f172a 0%, #020617 100%) !important;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Background Drift Glows */
        .auth-glow-1 {
            position: fixed;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(2, 132, 199, 0.22) 0%, rgba(2, 132, 199, 0) 70%);
            top: -100px;
            right: -100px;
            filter: blur(50px);
            pointer-events: none;
            z-index: -1;
            animation: authDrift1 18s ease-in-out infinite alternate;
        }

        .auth-glow-2 {
            position: fixed;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(13, 148, 136, 0.16) 0%, rgba(13, 148, 136, 0) 70%);
            bottom: -150px;
            left: -150px;
            filter: blur(60px);
            pointer-events: none;
            z-index: -1;
            animation: authDrift2 22s ease-in-out infinite alternate;
        }

        @keyframes authDrift1 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-80px, 80px) scale(1.15); }
        }

        @keyframes authDrift2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(90px, -90px) scale(0.9); }
        }

        /* Glassmorphic Cards */
        .card {
            background: rgba(255, 255, 255, 0.88) !important;
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: 24px !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4) !important;
        }

        /* Typographies */
        h4, h5, h6, .font-weight-bold {
            font-family: var(--font-title) !important;
            color: var(--dark) !important;
        }

        .text-muted, p.small {
            font-family: var(--font-body);
            color: var(--gray) !important;
        }

        /* Modern Input Styling */
        .form-control {
            background: rgba(255, 255, 255, 0.8) !important;
            border: 1.5px solid #cbd5e1 !important;
            color: var(--dark) !important;
            font-family: var(--font-body);
            font-size: 14px !important;
            font-weight: 500 !important;
            padding-left: 18px !important;
            border-radius: 14px !important;
            transition: all 0.3s ease !important;
        }

        .form-control:focus {
            background: #ffffff !important;
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.18) !important;
            outline: none !important;
        }

        .form-control::placeholder {
            color: #94a3b8 !important;
            font-weight: 400;
        }

        /* Custom Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #0ea5e9) !important;
            border: none !important;
            font-family: var(--font-title);
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 14px !important;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.4) !important;
            background: linear-gradient(135deg, #0ea5e9, #38bdf8) !important;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--secondary), #14b8a6) !important;
            border: none !important;
            font-family: var(--font-title);
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 14px !important;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.25) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 148, 136, 0.4) !important;
            background: linear-gradient(135deg, #14b8a6, #2dd4bf) !important;
        }

        /* Alert Styling */
        .alert {
            border-radius: 14px !important;
            font-size: 13px !important;
            font-weight: 500;
            border: none !important;
        }
        
        .alert-danger {
            background-color: #fee2e2 !important;
            color: #ef4444 !important;
        }
        
        .alert-success {
            background-color: #d1fae5 !important;
            color: #10b981 !important;
        }
        
        .alert-info {
            background-color: #e0f2fe !important;
            color: #0284c7 !important;
        }

        /* Links */
        a.text-primary {
            color: var(--primary) !important;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        a.text-primary:hover {
            color: var(--primary-dark) !important;
            text-decoration: none;
        }

        a.text-muted {
            transition: all 0.2s ease;
        }

        a.text-muted:hover {
            color: var(--dark) !important;
            text-decoration: none;
        }

        /* Split Layout Auth Card (Full Viewport) */
        .auth-wrapper {
            min-height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: stretch;
            padding: 0;
            margin: 0;
        }

        .auth-container {
            width: 100%;
            max-width: 100%;
            padding: 0;
            margin: 0;
        }

        .auth-card-split {
            background: transparent !important;
            border-radius: 0 !important;
            border: none !important;
            box-shadow: none !important;
            width: 100%;
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
            transition: none;
        }

        .auth-card-split:hover {
            transform: none;
            box-shadow: none !important;
        }

        .auth-visual-col {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.94), rgba(2, 132, 199, 0.88)), url('<?= base_url("assets/img/home/header1.jpg"); ?>');
            background-size: cover;
            background-position: center;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
        }

        .auth-visual-col::before {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(45, 212, 191, 0.18) 0%, rgba(45, 212, 191, 0) 70%);
            bottom: -80px;
            right: -80px;
            filter: blur(35px);
        }

        .auth-visual-brand {
            font-family: var(--font-title);
            font-weight: 800;
            font-size: 28px;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .auth-visual-brand span {
            color: #2dd4bf;
        }

        .auth-visual-text {
            margin-top: auto;
            margin-bottom: auto;
            max-width: 480px;
        }

        .auth-visual-text h3 {
            font-family: var(--font-title);
            font-size: 38px;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 20px;
            color: #ffffff !important;
            letter-spacing: -1px;
        }

        .auth-visual-text p {
            font-family: var(--font-body);
            font-size: 15px;
            color: #cbd5e1 !important;
            line-height: 1.65;
        }

        .auth-form-col {
            padding: 60px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.93) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            min-height: 100vh;
        }

        .auth-help-box {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 18px;
            padding: 24px;
            margin-top: auto;
            max-width: 480px;
        }

        .auth-help-box h6 {
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 700;
        }

        .auth-help-box p {
            color: #94a3b8 !important;
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        @media (max-width: 767.98px) {
            .auth-form-col {
                padding: 40px 24px;
            }
        }
    </style>
</head>

<body>
    <!-- Background Glows -->
    <div class="auth-glow-1"></div>
    <div class="auth-glow-2"></div>