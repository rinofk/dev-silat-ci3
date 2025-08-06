<?php
//include 'assets/fungsi_tanggal/fungsi_indotgl.php';
$pdf = new FPDF('P', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
$start_awal = $pdf->GetX();
$get_xxx = $pdf->GetX();
$get_yyy = $pdf->GetY();
$margin_kop = 15;

$width_cell = 160;
$height_cell = 6;
$margin_kiri = 15;



$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 10, '', 0, 1);


$pdf->SetFont('times', '', 14);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'BUKTI CETAK PENGISIAN ALUMNI APLIKASI SILAT', 0, 1);

$pdf->SetFont('times', 'B', 14);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'FAKULTAS KEDOKTERAN', 0, 1);
$pdf->SetFont('times', 'B', 14);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'UNIVERSITAS TANJUNGPURA', 0, 1);

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'email: kedokteran@untan.ac.id website: silat.fk.untan.ac.id', 0, 1);
// $pdf->Cell(190, 6, '', 'B', 1, 'L'); membuat garis 

$pdf->SetLineWidth(0.9); // tebal garis
$pdf->Line(10, 43, 200, 43); // posisi garis




$pdf->Cell($margin_kiri, 20, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Saya yang bertanda tangan dibawah ini :', 0, 1);


//$alumni = $this->db->get('mahasiswa')->row_array();

$pdf->Cell(10, 7, '', 0, 1);
//   $pdf->SetFont('Times', 'B', 10);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 6, 'Nama Lengkap', 0, 0);
$pdf->Cell(110, 6, ':  ' . ucwords(strtolower(htmlspecialchars($alumni['nama_lengkap']))), 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'NIM', 0, 0);
$pdf->Cell(110, 6, ':  ' . $alumni['nim'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Tempat/ Tanggal Lahir', 0, 0);
$pdf->Cell(110, 6, ':  ' . ucwords(strtolower(htmlspecialchars($alumni['tempat_lahir']))) . ', ' . tgl_ind(date($alumni['tgl_lahir'])), 0, 1);
//   $pdf->SetFont('Times', 'B', 10);
$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'No HP', 0, 0);
$pdf->Cell(110, 6, ':  ' . $alumni['no_hp'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'e-mail', 0, 0);
$pdf->Cell(110, 6, ':  ' . $alumni['email'], 0, 1);


//   $pdf->SetFont('Times', 'B', 10);
$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Tahun Wisuda', 0, 0);
$pdf->Cell(110, 6, ':  ' . $alumni['tahun_wisuda'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Jalur Masuk', 0, 0);
$pdf->Cell(110, 6, ':  ' . $alumni['jalur_masuk'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Program Studi', 0, 0);
$pdf->Cell(110, 6, ':  ' . $alumni['nama_prodi'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Agama', 0, 0);
$pdf->Cell(110, 6, ':  ' . $alumni['agamaa'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Alamat', 0, 0);
$pdf->MultiCell(110, 6, ':  ' . ucwords(strtolower(htmlspecialchars($alumni['alamat_sekarang']))), 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Judul Skripsi', 0, 0);
$pdf->Cell(3, 6, ':  ', 0, 0);
$pdf->MultiCell(107, 6, $alumni['judul_skripsi'], 0, 'J');

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Tanggal Daftar Alumni', 0, 0);
$pdf->Cell(110, 6, ':  ' . tgl_ind(date($alumni['tanggal_daftar'])), 0, 1);


$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->MultiCell($width_cell, 6, 'Dengan ini menyatakan bahwa data yang telah saya isi diatas adalah benar dan dapat dipergunakan sebagaimana mestinya. ', 0, 'J');
//   $pdf->SetXY($get_xxx, $get_yyy);

// $pdf->Ln();
// $get_xxx = $start_awal;
// $get_yyy += $height_cell;
$pdf->Cell($margin_kiri, 6, '', 0, 1);


$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 7, '', 0, 1);

$pdf->Image('assets/img/alumni/' . $alumni['poto'], 155, 68, 30, 45);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Pontianak, ' . $tanggal, 0, 1, 'L');
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Hormat Saya,', 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, ucwords(strtolower(htmlspecialchars($alumni['nama_lengkap']))), 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'NIM ' . $alumni['nim'], 0, 1);


$pdf->Output();
