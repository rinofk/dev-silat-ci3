<?php

$pdf = new FPDF('P', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
$start_awal = $pdf->GetX();
$get_xxx = $pdf->GetX();
$get_yyy = $pdf->GetY();

$width_cell = 160;
$height_cell = 6;
$margin_kiri = 15;
$margin_kop = 28;


$pdf->Image('assets/img/pejabat/wahyudi.png', 140, 170, 10, 28);
$pdf->Image('assets/img/pejabat/cap.png', 115, 165, 33, 32);
$pdf->Image('assets/img/logo.png', 18, 10, 30, 30);
$pdf->SetFont('times', '', $kop['size_k']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['kementerian'], 0, 1, 'C');

$pdf->SetFont('times', '', $kop['size_u']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['universitas'], 0, 1, 'C');

$pdf->SetFont('times', 'B', $kop['size_f']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['fakultas'], 0, 1, 'C');

$pdf->SetFont('times', '', $kop['size_j']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['jalan'], 0, 1, 'C');

$pdf->SetFont('times', '', $kop['size_j']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['telpon'], 0, 1, 'C');

$pdf->SetFont('times', '', $kop['size_j']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['email'], 0, 1, 'C');
// $pdf->Cell(190, 6, '', 'B', 1, 'L'); membuat garis 

$pdf->SetLineWidth(0.9); // tebal garis
$pdf->Line(10, 43, 200, 43); // posisi garis
$pdf->Cell($margin_kiri, 10, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->SetFont('times', 'u', 12);
$pdf->Cell(160, 5, $nomor['surat'], 0, 1, 'C');

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Nomor :         ' . $nomor['nomor'], 0, 1, 'C');

$pdf->Cell($margin_kiri, 10, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell(160, 5, 'Yang bertanda tangan di bawah ini, Dekan Fakultas Kedokteran Universitas Tanjungpura menyatakan bahwa mahasiswa di bawah ini :', 0, 'J');
$pdf->Cell(10, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Nama', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->Cell(115, 5, $surat['nama_lengkap'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'NIM', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->Cell(115, 5,  $surat['nim'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Program Studi', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->Cell(115, 5,  $surat['nama_prodi'], 0, 1);

$pdf->Cell(10, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Telah menyelesaikan seluruh kegiatan pembelajaran dan telah lulus Yudisium pada Program Studi ' . $surat['nama_prodi'] . ' Fakultas Kedokteran Universitas Tanjungpura pada tanggal ' . tgl_ind(date($surat['tgl_lulus_yudisium'])) . '.', 0, 'J');
$pdf->Cell(10, 5, '', 0, 1);

//  $pdf->SetXY($get_xxx, $get_yyy);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Demikian Surat Keterangan ini diberikan untuk dapat dipergunakan sebagai syarat pengambilan ijazah dan transkrip.', 0, 'J');


$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 20, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Pontianak, ' . tgl_ind(date($surat['date_finish'])), 0, 1, 'L');
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'a.n. Dekan,', 0, 1, 'L');
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Kasubbag. Akademik', 0, 1, 'L');
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'dan Kemahasiswaan,', 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Wahyudi, MM', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'NIP. 197509232006041001', 0, 1);



$pdf->Output();
