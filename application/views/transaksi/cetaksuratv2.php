
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


$pdf->Image('assets/img/logo.png', 18, 10, 30, 30);

$pdf->SetFont('times', '', $kop['size_k']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['kementerian1'], 0, 1, 'C');

// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['kementerian2'], 0, 1, 'C');

$pdf->SetFont('times', '', $kop['size_u']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['universitas'], 0, 1, 'C');

$pdf->Cell(10, 1, '', 0, 1);

$pdf->SetFont('times', 'B', $kop['size_f']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['fakultas'], 0, 1, 'C');

$pdf->Cell(10, 1, '', 0, 1);


$pdf->SetFont('times', '', $kop['size_j']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['jalan'], 0, 1, 'C');

// $pdf->SetFont('times', '', $kop['size_j']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['telpon'], 0, 1, 'C');

$pdf->SetFont('times', '', $kop['size_j']);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, $kop['email'], 0, 1, 'C');

$pdf->SetLineWidth(0.9); // tebal garis
$pdf->Line(10, 42, 200, 42); // posisi garis

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 15, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->SetFont('times', 'u', 12);
$pdf->Cell(160, 5, $nomor['surat'], 0, 1, 'C');

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Nomor :         ', 0, 1);
// $pdf->Cell(160, 5, 'Nomor :         ' . $nomor['nomor'], 0, 1, 'C');

$pdf->Cell($margin_kiri, 10, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Dekan Fakultas Kedokteran Universitas Tanjungpura menerangkan kepada dibawah ini :', 0, 1);


//$surat = $this->db->get('mahasiswa')->row_array();

$pdf->Cell(10, 5, '', 0, 1);
//   $pdf->SetFont('Times', 'B', 10);
$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Nama Lengkap', 0, 0);
$pdf->Cell(110, 6, ':  ' . ucwords(strtolower(htmlspecialchars($surat['nama_lengkap']))), 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Tempat/ Tanggal Lahir', 0, 0);
$pdf->Cell(110, 6, ':  ' . ucwords(strtolower(htmlspecialchars($surat['tempat_lahir']))) . ', ' .  tgl_ind(date($surat['tgl_lahir'])), 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'NIM', 0, 0);
$pdf->Cell(110, 6, ':  ' . $surat['nim'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Semester/ Prodi', 0, 0);
$pdf->Cell(110, 6, ':  ' . $surat['semester'] . ' / ' . $surat['nama_prodi'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(50, 6, 'Tahun Ajaran', 0, 0);
$pdf->Cell(110, 6, ':  ' . $surat['tahun_ajaran'], 0, 1);

$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Bahwa yang bersangkutan adalah benar Mahasiswa Fakultas Kedokteran Universitas Tanjungpura yang masih aktif kuliah di Program Studi ' . $surat['nama_prodi'] . ' hingga sekarang.', 0, 'J');
//   $pdf->SetXY($get_xxx, $get_yyy);

// $pdf->Ln();
// $get_xxx = $start_awal;
// $get_yyy += $height_cell;
$pdf->Cell($margin_kiri, 5, '', 0, 1);

//  $pdf->SetXY($get_xxx, $get_yyy);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Demikian surat keterangan ini dibuat sebagai persyaratan untuk melengkapi pemberkasan ' . $surat['nama_keperluan'] . ' ' . $surat['keterangan'] . ' sesuai dengan ketentuan yang berlaku.', 0, 'J');

// Memberikan space kebawah agar tidak terlalu rapat
// $pdf->Cell(10, 7, '', 0, 1);
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(20, 5, 'NIM', 0,0);
// $pdf->Cell(85, 5, 'NAMA MAHASISWA', 0,0);
// $pdf->Cell(27, 5, 'NO HP', 0,0);
// $pdf->Cell(25, 5, 'TANGGAL LHR', 0,1);

// $pdf->SetFont('Arial', '', 10);
// $surat = $this->db->get('mahasiswa')->result();
// foreach ($surat as $row) {
//     $pdf->Cell(20, 5, $row->nim, 0,0);
//     $pdf->Cell(85, 5, $row->nama_lengkap, 0,0);
//     $pdf->Cell(27, 5, $row->no_hp, 0,0);
//     $pdf->Cell(25, 5, $row->tgl_lahir, 0,1);
// }
$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 20, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Pontianak, ', 0, 1, 'L');
// $pdf->Cell(60, 5, 'Pontianak, ' . tgl_ind(date($surat['tgl_surat'])), 0, 1, 'L');
// $pdf->Cell(120, 5, '', 0, 0);
// $pdf->Cell(60, 5, 'Dekan,', 0, 1, 'L');
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Wakil Dekan Bidang Kemahasiswaan', 0, 1, 'L');
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'dan Alumni,', 0, 1, 'L');

$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Titan Ligita, S.Kp., MN., Ph.D	', 0, 1);
// $pdf->Cell(60, 5, 'dr. Ita Armyanti, M.Pd., Ked.	', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'NIP 197904042002122011', 0, 1);
// $pdf->Cell(60, 5, 'NIP 198110042008012011', 0, 1);



$pdf->Output();
