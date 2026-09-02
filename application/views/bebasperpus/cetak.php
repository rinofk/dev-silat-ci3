<?php
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$nama_lengkap = !empty($bp['nama_lengkap']) ? $bp['nama_lengkap'] : '-';
$nim          = !empty($bp['nim']) ? $bp['nim'] : (!empty($bp['nim_mahasiswa']) ? $bp['nim_mahasiswa'] : '-');
$tempat_lahir = !empty($bp['tempat_lahir']) ? $bp['tempat_lahir'] : '-';
$tgl_lahir    = (!empty($bp['tgl_lahir']) && $bp['tgl_lahir'] != '0000-00-00') ? tgl_ind(date('Y-m-d', strtotime($bp['tgl_lahir']))) : '-';
$nama_prodi   = !empty($bp['nama_prodi']) ? $bp['nama_prodi'] : '-';
$semester     = !empty($bp['semester']) ? $bp['semester'] : '-';
$no_hp        = !empty($bp['no_hp']) ? $bp['no_hp'] : '-';

$tgl_update   = (!empty($bp['date_updated']) && $bp['date_updated'] != '0000-00-00 00:00:00') 
                ? tgl_ind(date('Y-m-d', strtotime($bp['date_updated']))) 
                : tgl_ind(date('Y-m-d'));

$pdf->SetTitle(($nomor['keterangan'] ?? 'Bebas Perpustakaan') . ' ' . $nama_lengkap);
$width_cell = 160;
$height_cell = 6;
$margin_kiri = 15;
$margin_kop = 28;

$pdf->Image('assets/img/logo.png', 18, 10, 30, 30);
$pdf->Image('assets/img/pejabat/wahyudi.png', 40, 175, 10, 28);
$pdf->Image('assets/img/pejabat/suryani.png', 130, 172, 28, 20);
$pdf->Image('assets/img/pejabat/cap2025.png', 15, 169, 33, 32);

$pdf->SetFont('times', '', $kop['size_k'] ?? 10);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['kementerian1'] ?? '', 0, 1, 'C');

$pdf->SetFont('times', '', $kop['size_u'] ?? 12);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['universitas'] ?? '', 0, 1, 'C');

$pdf->Cell(10, 3, '', 0, 1);

$pdf->SetFont('times', 'B', $kop['size_f'] ?? 14);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['fakultas'] ?? '', 0, 1, 'C');

$pdf->Cell(10, 3, '', 0, 1);

$pdf->SetFont('times', '', $kop['size_j'] ?? 9);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['jalan'] ?? '', 0, 1, 'C');

$pdf->SetFont('times', '', $kop['size_j'] ?? 9);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['email'] ?? '', 0, 1, 'C');

$pdf->SetLineWidth(0.9);
$pdf->Line(10, 44, 200, 44);

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 15, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->SetFont('times', 'u', 12);
$pdf->Cell(160, 5, $nomor['surat'] ?? 'SURAT BEBAS PERPUSTAKAAN', 0, 1, 'C');

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 5, '', 0, 0);

$full_nomor = !empty($bp['nomor']) ? $bp['nomor'] : '';
if (strpos($full_nomor, '/') === false && !empty($nomor['nomor'])) {
    $full_nomor = $full_nomor . $nomor['nomor'];
}
$pdf->Cell(160, 5, 'Nomor : ' . $full_nomor, 0, 1, 'C');

$pdf->Cell($margin_kiri, 10, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Yang bertanda tangan dibawah ini menerangkan :', 0, 'J');

$pdf->Cell(10, 4, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Nama Lengkap', 0, 0);
$pdf->Cell(120, 5, ':  ' . $nama_lengkap, 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'NIM', 0, 0);
$pdf->Cell(120, 5, ':  ' . $nim, 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Tempat/ Tanggal Lahir', 0, 0);
$pdf->Cell(3, 5, ':', 0, 0);
$pdf->MultiCell(117, 5, $tempat_lahir . ', ' . $tgl_lahir, 0, 'J');

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Program Studi', 0, 0);
$pdf->Cell(3, 5, ':', 0, 0);
$pdf->MultiCell(117, 5, $nama_prodi, 0, 'J');

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Semester', 0, 0);
$pdf->Cell(3, 5, ':', 0, 0);
$pdf->Cell(117, 5, $semester, 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'No HP', 0, 0);
$pdf->Cell(3, 5, ':', 0, 0);
$pdf->MultiCell(117, 5, $no_hp, 0, 'J');

$pdf->Cell(10, 4, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Bahwa yang bersangkutan dinyatakan Bebas dari segala Administrasi Peminjaman Buku Perpustakaan Fakultas Kedokteran Universitas Tanjungpura Pontianak', 0, 'J');

$pdf->Cell($margin_kiri, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.', 0, 'J');

$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 20, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Pontianak, ' . $tgl_update, 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'Menyetujui', 0, 0);
$pdf->Cell(60, 5, '', 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'Kepala Bagian Umum', 0, 0);
$pdf->Cell(60, 5, 'Staff Perpustakaan', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, '', 0, 0);
$pdf->Cell(60, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'Wahyudi, SP., MM.', 0, 0);
$pdf->Cell(60, 5, 'Suryani, S.Sos', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'NIP. 197509232006041001', 0, 0);
$pdf->Cell(60, 5, 'NIP. -', 0, 1);

$pdf->Cell($margin_kiri, 15, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, 'Perpustakaan FK UNTAN', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, '[ ' . ($bp['id_bp'] ?? '-') . ' ] ID surat elektronik silat.fk.untan.ac.id', 0, 1);

$pdf->Output($dest = 'I', $name = ($nomor['keterangan'] ?? 'Bebas Perpustakaan') . ' ' . $nama_lengkap . '.pdf', $isUTF8 = true);
