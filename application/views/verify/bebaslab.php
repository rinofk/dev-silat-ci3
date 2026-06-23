<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Verifikasi Surat Bebas Laboratorium' ?></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f0f4f8;
            color: #2d3748;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 10px;
        }

        .verify-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            width: 100%;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .card-header-accent {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 30px 20px;
            text-align: center;
            color: #ffffff;
            border-bottom: 5px solid #38a169; /* Green Accent */
        }

        .institution-logo {
            width: 75px;
            height: auto;
            margin-bottom: 15px;
            filter: drop-shadow(0px 2px 4px rgba(0, 0, 0, 0.1));
        }

        .institution-title {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 300;
            margin: 0;
            opacity: 0.9;
        }

        .faculty-title {
            font-size: 18px;
            font-weight: 700;
            margin: 5px 0 0 0;
            letter-spacing: 0.5px;
        }

        .verify-status {
            text-align: center;
            padding: 25px 20px 15px 20px;
        }

        .status-badge {
            background-color: #e6fffa;
            color: #234e52;
            border: 1px solid #b2f5ea;
            padding: 10px 20px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 4px 6px rgba(56, 161, 105, 0.05);
        }

        .status-badge i {
            color: #38a169;
            font-size: 20px;
            margin-right: 10px;
        }

        .verify-title {
            font-size: 20px;
            font-weight: 700;
            color: #1a202c;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .verify-subtitle {
            font-size: 13px;
            color: #718096;
            margin-bottom: 0;
        }

        .verify-body {
            padding: 15px 30px 30px 30px;
        }

        .section-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #a0aec0;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 1px solid #edf2f7;
            padding-bottom: 5px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 25px;
        }

        .info-table td {
            padding: 8px 0;
            font-size: 15px;
        }

        .info-table td.label {
            color: #718096;
            width: 35%;
            font-weight: 400;
        }

        .info-table td.value {
            color: #2d3748;
            font-weight: 600;
        }

        .tte-footer {
            background-color: #f7fafc;
            padding: 20px 30px;
            border-top: 1px solid #edf2f7;
            text-align: center;
            font-size: 12px;
            color: #718096;
            line-height: 1.5;
        }

        .tte-footer i {
            color: #38a169;
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="verify-card">
        <!-- Card Header Accent -->
        <div class="card-header-accent">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Untan Logo" class="institution-logo">
            <p class="institution-title">Universitas Tanjungpura</p>
            <h1 class="faculty-title">Fakultas Kedokteran</h1>
        </div>

        <!-- Verification Badge Status -->
        <div class="verify-status">
            <div class="status-badge">
                <i class="fas fa-check-circle"></i> Dokumen Terverifikasi Asli
            </div>
            <h2 class="verify-title">Surat Bebas Laboratorium</h2>
            <p class="verify-subtitle">Nomor Surat: <?= htmlspecialchars($bl['nomor']) ?></p>
        </div>

        <!-- Verification Details Body -->
        <div class="verify-body">
            
            <h3 class="section-title">Informasi Mahasiswa</h3>
            <table class="info-table">
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td class="value">: &nbsp;<?= htmlspecialchars($bl['nama_lengkap']) ?></td>
                </tr>
                <tr>
                    <td class="label">NIM</td>
                    <td class="value">: &nbsp;<?= htmlspecialchars($bl['nim_mahasiswa']) ?></td>
                </tr>
                <tr>
                    <td class="label">Program Studi</td>
                    <td class="value">: &nbsp;<?= htmlspecialchars($bl['nama_prodi']) ?></td>
                </tr>
            </table>

            <h3 class="section-title">Detail Validasi Dokumen</h3>
            <table class="info-table">
                <tr>
                    <td class="label">Tanggal Terbit</td>
                    <td class="value">: &nbsp;<?= !empty($bl['date_finished']) ? date('d-m-Y', strtotime($bl['date_finished'])) : '-' ?></td>
                </tr>
                <tr>
                    <td class="label">Masa Berlaku</td>
                    <td class="value">: &nbsp;<?= !empty($bl['berlaku_sampai']) ? date('d-m-Y', strtotime($bl['berlaku_sampai'])) : '-' ?></td>
                </tr>
                <tr>
                    <td class="label">Divalidasi Oleh</td>
                    <td class="value">: &nbsp;<?= htmlspecialchars($bl['lab1_admin']) ?> (Koordinator Laboran)</td>
                </tr>
            </table>

        </div>

        <!-- Footer TTE Info -->
        <div class="tte-footer">
            <i class="fas fa-shield-alt text-success"></i> Surat Keterangan Bebas Laboratorium ini diterbitkan secara elektronik oleh Fakultas Kedokteran Universitas Tanjungpura Pontianak. Informasi yang tertera pada halaman ini bersumber langsung dari database resmi sistem SILAT FK UNTAN.
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
