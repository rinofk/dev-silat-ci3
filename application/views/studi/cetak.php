
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
$pdf->SetFont('times', '', 16);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN', 0, 1, 'C');

$pdf->SetFont('times', '', 14);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'UNIVERSITAS TANJUNGPURA', 0, 1, 'C');

$pdf->SetFont('times', 'B', 14);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'FAKULTAS KEDOKTERAN', 0, 1, 'C');

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Jalan Prof. Dr. H. Hadari Nawawi Pontianak 78124', 0, 1, 'C');

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Telp. (0561) 8121432 Fax (0561) 8121432
', 0, 1, 'C');

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kop, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Email: kedokteran@untan.ac.id Website: www.kedokteran.untan.ac.id', 0, 1, 'C');
// $pdf->Cell(190, 6, '', 'B', 1, 'L'); membuat garis 

$pdf->SetLineWidth(0.9); // tebal garis
$pdf->Line(10, 43, 200, 43); // posisi garis


$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 8, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 6, 'Nomor :          /UN22.9/TA.00.03/2019', 0, 0);
$pdf->Cell(60, 6,  $tanggal, 0, 1, 'R');
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(85, 5, 'Perihal : ' . $surat['perihal'], 0, 1);
$pdf->Cell(85, 10, '', 0, 1);


$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell(160, 5, 'Yth. ' . $surat['tujuan_surat'], 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);

$pdf->MultiCell(160, 5, $surat['alamat_tujuan'], 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);

$pdf->Cell(85, 5, 'Pontianak', 0, 1);
$pdf->Cell($margin_kiri, 10, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell(160, 5, 'Sehubungan dengan penyusunan Tugas Akhir (Skripsi) Mahasiswa Program Studi ' . $surat['nama_prodi'] . ' Fakultas Kedokteran Universitas Tanjungpura, yaitu saudara :', 0, 'J');


//$surat = $this->db->get('mahasiswa')->row_array();

$pdf->Cell(10, 5, '', 0, 1);
//   $pdf->SetFont('Times', 'B', 10);
$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'Nama Lengkap', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(115, 6, $surat['nama_lengkap'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'NIM', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(115, 6,  $surat['nim'], 0, 1);

$pdf->Cell($margin_kiri, 6, '', 0, 0);
$pdf->Cell(40, 6, 'Judul', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->MultiCell(115, 6,  $surat['judul_proposal'], 0, 'J');


$pdf->Cell(10, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Dengan hormat, kami mohon bantuan ' . $surat['tujuan_surat'] . ' agar dapat memberikan ijin kepada Mahasiswa kami untuk dapat melakukan Studi Pendahuluan di Rumah Sakit Universitas Tanjungpura guna penyusunan Tugas Akhir Mahasiswa yang bersangkuta.', 0, 'J');
//   $pdf->SetXY($get_xxx, $get_yyy);

// $pdf->Ln();
// $get_xxx = $start_awal;
// $get_yyy += $height_cell;
$pdf->Cell($margin_kiri, 5, '', 0, 1);

//  $pdf->SetXY($get_xxx, $get_yyy);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Demikian permohonan ini kami ajukan, atas perhatian dan kerjasama yang baik diucapkan terima kasih.', 0, 'J');


$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 20, '', 0, 1);

$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Dekan,', 0, 1, 'L');

$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'dr. Muhammad Asroruddin, Sp.M.', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'NIP 198012312006041002', 0, 1);



$pdf->Output();
