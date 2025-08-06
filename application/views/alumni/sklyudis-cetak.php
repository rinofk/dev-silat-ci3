<?php

$pdf = new FPDF('P', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();

$width_cell = 160;
$height_cell = 6;
$margin_kiri = 15;
$margin_kop = 28;




$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 8, '', 0, 1);
$pdf->Cell(120, 6, '', 0, 0);
$pdf->Cell(60, 6, 'Pontianak, ' . $tanggal, 0, 1, 'R');

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(85, 5, 'Perihal : Permohonan Surat Kelulusan Yudisium', 0, 1);
$pdf->Cell($margin_kiri, 10, '', 0, 1);


$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(85, 5, 'Kepada Yth. ', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(85, 5, 'Dekan Fakultas Kedokteran', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);

$pdf->Cell(85, 5, 'Universitas Tanjungpura', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);

$pdf->Cell(85, 5, 'Pontianak', 0, 1);
$pdf->Cell($margin_kiri, 10, '', 0, 1);
$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(160, 6, 'Dengan hormat,', 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->MultiCell($width_cell, 6, 'Sehubungan dengan syarat pengambilan ijazah mahasiswa Program Studi ' . $skl['nama_prodi'] . ' Fakultas Kedokteran Universitas Tanjungpura, saya bertanda tangan dibawah ini :', 0,  'J');

$pdf->Cell(10, 4, '', 0, 1);
$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'Nama Lengkap', 0, 0);
$pdf->Cell(120, 6, ':  ' . $skl['nama_lengkap'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'NIM', 0, 0);
$pdf->Cell(120, 6, ':  ' . $skl['nim'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'Program Studi', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->MultiCell(117, 6, $skl['nama_prodi'], 0, 'J');

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'IPK', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->MultiCell(117, 6, $skl['ipk'], 0, 'J');

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'Tanggal Lulus', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->MultiCell(117, 6,  tgl_ind(date($skl['tgl_lulus_yudisium'])), 0, 'J');


$pdf->Cell(10, 4, '', 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->MultiCell($width_cell, 6, 'Demikian surat permohonan ini saya ajukan, atas perhatiannya saya ucapkan terima kasih yang sebanyak-banyaknya.', 0, 'J');


$pdf->Cell($margin_kiri, 6, '', 0, 1);

$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 20, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Hormat saya,', 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Alumni', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, '', 0, 0);
$pdf->Cell(60, 5, $skl['nama_lengkap'], 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, '', 0, 0);
$pdf->Cell(60, 5, 'NIM. ' . $skl['nim'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, 'Berkas ID [ -' . $skl['id_skl'] . '- ]', 0, 1);

$pdf->Output();
