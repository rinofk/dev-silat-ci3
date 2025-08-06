<?php
include 'assets/phpqrcode/qrlib.php';

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();

$path = 'assets/qrcode/';
$file = $path . $barcode['nim'] . ".png";
// outputs image directly into browser, as PNG stream 
QRcode::png($barcode['link'], $file, QR_ECLEVEL_H, 5);


$width_cell = 160;
$height_cell = 6;
$margin_kiri = 15;
$margin_tab = 115;
$margin_kop = 42;



$pdf->setFont('courier', 'B', 11);
// $pdf->Cell(20, 28, '', 0, 1);

// $pdf->Cell(5, 7, '', 0, 0);
// $pdf->cell($margin_kiri, 7, ' Berkas.ID : ' . $barcode['id_naspub'], 0, 1);
$pdf->Image('assets/qrcode/' . $barcode['nim'] . '.png', 18, 13, 30, 30);

$pdf->Cell(20, 6, '', 0, 1);

$pdf->SetFont('times', '', 14);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'ADMIN PENGELOLA JURNAL PUBLIKASI', 0, 1);

$pdf->SetFont('times', 'B', 12);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'FAKULTAS KEDOKTERAN', 0, 1);

$pdf->SetFont('times', 'B', 12);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'UNIVERSITAS TANJUNGPURA', 0, 1);


$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'http://jurnal.untan.ac.id, email : kedokteran@untan.ac.id', 0, 1);

$pdf->SetFont('courier', '', 12);
$pdf->Cell(39, 5, '', 0, 0);
$pdf->Cell(160, 5,  ' Berkas.ID : ' . $barcode['id_naspub'], 0, 1);
// $pdf->Cell(190, 6, '', 'B', 1, 'L'); membuat garis 

$pdf->SetLineWidth(0.9); // tebal garis
$pdf->Line(10, 45, 200, 43); // posisi garis


$pdf->Cell(39, 15, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->SetFont('times', 'b', 12);
$pdf->Cell(160, 5, 'QR-CODE PUBLIKASI JURNAL', 0, 1, 'C');
$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->SetFont('times', '', 12);
$pdf->MultiCell($width_cell, 5, 'Berdasarkan surat nomor : ' . $barcode['nomorsurat'] . ', tentang publikasi jurnal ilmiah secara online dengan nama dibawah ini :', 0, 'J');

$pdf->Cell(10, 7, '', 0, 1);

$pdf->SetFont('times', '', 12);
//   $pdf->SetFont('Times', 'B', 10);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Nama Lengkap', 0, 0);
$pdf->Cell(120, 5, ':  ' . ucwords(strtolower(htmlspecialchars($barcode['nama_lengkap']))), 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'NIM', 0, 0);
$pdf->Cell(120, 5, ':  ' . $barcode['nim'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'e-Mail', 0, 0);
$pdf->Cell(3, 5, ':', 0, 0);
$pdf->Cell(117, 5, $user['email'], 0, 1);


$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Judul Publikasi', 0, 0);
$pdf->Cell(3, 5, ':', 0, 0);
$pdf->MultiCell(117, 5, $barcode['judul_naspub'], 0, 'J');

$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Surat ini merupakan bukti bahwa jurnal publikasi online dengan data di atas sudah terupload di Jurnal Untan dengan link sebagai berikut :', 0, 'J');

$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(200, 5, $barcode['link'], 0, 1);

$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Demikian surat ini dibuat agar dapat dipergunakan sebagaimana mestinya.', 0, 'J');

$pdf->Cell(10, 10, '', 0, 1);

$pdf->Cell($margin_tab, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Pontianak, ' . date('d F Y', $barcode['date_finish']), 0, 1);
$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(60, 5, 'ttd', 0, 1);
$pdf->Cell(10, 5, '', 0, 1);

$pdf->Cell($margin_tab, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Admin Pengelola Jurnal', 0, 1);

$pdf->Output();
