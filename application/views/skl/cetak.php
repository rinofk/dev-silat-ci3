
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


//KOP SAINTEK----------------------------------------------------------------------------

$pdf->Image('assets/img/logo.png', 18, 10, 30, 30);

$pdf->SetFont('times', '', $kop['size_k']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['kementerian1'], 0, 1, 'C');

$pdf->SetFont('times', '', $kop['size_u']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['universitas'], 0, 1, 'C');

$pdf->Cell(10, 3, '', 0, 1);

$pdf->SetFont('times', 'B', $kop['size_f']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['fakultas'], 0, 1, 'C');

$pdf->Cell(10, 3, '', 0, 1);

$pdf->SetFont('times', '', $kop['size_j']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['jalan'], 0, 1, 'C');

$pdf->SetFont('times', '', $kop['size_j']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['email'], 0, 1, 'C');

$pdf->SetLineWidth(0.9); // tebal garis
$pdf->Line(10, 44, 200, 44); // posisi garis
//AKHIR KOP SAINTEK-----------------------------------------------------------------------------------


//KOP RISTEKDIKTI----------------------------------------------------------------------------
// $pdf->Image('assets/img/logo.png', 18, 10, 30, 30);

// $pdf->SetFont('times', '', $kop['size_k']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['kementerian1'], 0, 1, 'C');

// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['kementerian2'], 0, 1, 'C');

// $pdf->SetFont('times', '', $kop['size_u']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['universitas'], 0, 1, 'C');

// $pdf->Cell(10, 1, '', 0, 1);

// $pdf->SetFont('times', 'B', $kop['size_f']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['fakultas'], 0, 1, 'C');

// $pdf->Cell(10, 1, '', 0, 1);

// $pdf->SetFont('times', '', $kop['size_j']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['jalan'], 0, 1, 'C');

// // $pdf->SetFont('times', '', $kop['size_j']);
// // $pdf->Cell($margin_kop, 5, '', 0, 0);
// // $pdf->Cell(160, 5, $kop['telpon'], 0, 1, 'C');

// $pdf->SetFont('times', '', $kop['size_j']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['email'], 0, 1, 'C');

// $pdf->SetLineWidth(0.9); // tebal garis
// $pdf->Line(10, 44, 200, 44); // posisi garis
//AKHIR KOP-----------------------------------------------------------------------------------


$pdf->Cell($margin_kiri, 10, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->SetFont('times', 'u', 12);
$pdf->Cell(160, 5, $nomor['surat'], 0, 1, 'C');

$pdf->SetFont('times', '', 12);
$pdf->Cell(65, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Nomor          ', 0, 1);

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 10, '', 0, 1);
$pdf->Cell($margin_kiri, 10, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell(160, 5, 'Dekan Fakultas Kedokteran Universitas Tanjungpura, menerangkan kepada :', 0, 'J');
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
$pdf->Cell(40, 5, 'Tempat/ Tanggal Lahir', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->MultiCell(115, 5,  $surat['tempat_lahir'] . ', ' . tgl_ind(date($surat['tgl_lahir'])), 0, 'J');

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Program Studi', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->Cell(115, 5,  $surat['nama_prodi'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Fakultas', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->Cell(115, 5,  'Fakultas Kedokteran Universitas Tanjungpura', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Alamat', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->MultiCell(115, 5,  $surat['alamat_sekarang'], 0, 'J');

$pdf->Cell(10, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Telah lulus sebagai ' . $surat['nama_prodi'] . ' dengan gelar (' . $surat['gelar'] . ') pada semester ' . $surat['ganjilgenap'] . ' Tahun Akademik ' . $surat['thn_akademik'] . ' dengan data sebagai berikut :', 0, 'J');
$pdf->Cell(10, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Tanggal Lulus', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->Cell(115, 5,  tgl_ind(date($surat['tgl_lulus_sidang'])), 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'IPK', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->Cell(115, 5,  $surat['ipk'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Predikat Kelulusan', 0, 0);
$pdf->Cell(5, 5, ':', 0, 0);
$pdf->Cell(115, 5,  $surat['predikat'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 1);

//  $pdf->SetXY($get_xxx, $get_yyy);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Demikian surat keterangan ini diberikan agar dapat dipergunakan sebagaimana mestinya.', 0, 'J');


$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 20, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Pontianak, ', 0, 1, 'L');
// $pdf->Cell(60, 5, 'Pontianak, ' .tgl_ind(date($surat['date_finish'])), 0, 1, 'L');

$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'a.n. Dekan,', 0, 1, 'L');
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Wakil Dekan Bidang Kemahasiswaan', 0, 1, 'L');
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'dan Alumni,', 0, 1, 'L');

$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Titan Ligita, S.Kp., MN., Ph.D	', 0, 1);
// $pdf->Cell(60, 5, 'Dr. Isnindar, S.Si., M.Sc.,Apt.	', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'NIP 197904042002122011', 0, 1);
// $pdf->Cell(60, 5, 'NIP 197809112008012011', 0, 1);

//$pdf->Cell(120, 5, '', 0, 0);
//$pdf->Cell(60, 5, 'Dekan,', 0, 1, 'L');
// $pdf->Cell(120, 5, '', 0, 0);
// $pdf->Cell(60, 5, 'Kepala Bagian Tata Usaha,', 0, 1, 'L');
//$pdf->Cell($margin_kiri, 5, '', 0, 1);
//$pdf->Cell($margin_kiri, 5, '', 0, 1);
//$pdf->Cell($margin_kiri, 5, '', 0, 1);
//$pdf->Cell(120, 5, '', 0, 0);
//$pdf->Cell(60, 5, 'dr. Muhammad Asroruddin, Sp.M.', 0, 1);
//$pdf->Cell(120, 5, '', 0, 0);
//$pdf->Cell(60, 5, 'NIP 198012312006041002', 0, 1);



$pdf->Output();
