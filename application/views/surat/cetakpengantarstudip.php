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
$pdf->MultiCell($width_cell, 6, 'Dalam rangka proposal penelitian skripsi sebagai salah satu syarat mendapatkan gelar Sarjana ' . $studip['nama_prodi'] . ', maka saya selaku peneliti mengajukan permohonan pembuatan surat pengambilan data kepada Dekan  Fakultas Kedokteran Universitas Tanjungpura dengan rincian sebagai berikut :', 0,  'J');

$pdf->Cell(10, 4, '', 0, 1);
//   $pdf->SetFont('Times', 'B', 10);
$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'Nama Lengkap', 0, 0);
$pdf->Cell(120, 6, ':  ' . $studip['nama_lengkap'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'NIM', 0, 0);
$pdf->Cell(120, 6, ':  ' . $studip['nim'], 0, 1);



$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'Judul Penelitian', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->MultiCell(117, 6, $studip['judul_proposal'], 0, 'J');


$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'Tujuan Surat', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->MultiCell(117, 6, $studip['tujuan_surat'], 0, 'J');

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'Alamat Tujuan', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->MultiCell(117, 6, $studip['alamat_tujuan'], 0, 'J');

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'Perihal', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->MultiCell(117, 6, $studip['perihal'], 0, 'J');


$pdf->Cell(10, 4, '', 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->MultiCell($width_cell, 6, 'Demikianlah surat permohonan ini saya sampaikan, saya mengharapkan agar Dekan Fakultas Kedokteran berkenan memberikan surat permohonan izin ini sehingga penelitian saya dapat dilaksanakan. Atas perhatian yang diberikan, saya ucapkan terima kasih.', 0, 'J');


$pdf->Cell($margin_kiri, 6, '', 0, 1);

$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 20, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'Mengetahui,', 0, 0);
$pdf->Cell(60, 5, '', 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'Sekretaris Program Studi', 0, 0);
$pdf->Cell(60, 5, 'Peneliti', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, $studip['nama_sekprodi'], 0, 0);
$pdf->Cell(60, 5, $studip['nama_lengkap'], 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'NIP. ' . $studip['nip_sekprodi'], 0, 0);
$pdf->Cell(60, 5, 'NIM. ' . $studip['nim'], 0, 1);


$pdf->Output();
