<?php
// include 'assets/phpqrcode/qrlib.php';
$pdf = new FPDF('P', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();

// $path = 'assets/qrcode/bebasperpus/';
// $file = $path . $bp['nim'] . ".png";
// // outputs image directly into browser, as PNG stream 
// QRcode::png($bp['link'], $file, QR_ECLEVEL_H, 5);

$pdf->SetTitle($nomor['keterangan'] . ' ' . $bp['nama_lengkap']);
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

//KOP DIKBUD ---------------------------------------------------------------------------------------
// $pdf->Image('assets/img/logo.png', 18, 10, 30, 30);
// // $pdf->Image('assets/qrcode/bebasperpus/' . $bp['nim'] . '.png', 87, 165, 30, 30);
$pdf->Image('assets/img/pejabat/wahyudi.png', 40, 175, 10, 28);
$pdf->Image('assets/img/pejabat/nurulhamsiah.png', 127, 169, 33, 27);
$pdf->Image('assets/img/pejabat/cap2025.png', 15, 170, 33, 32);

// $pdf->SetFont('times', '', $kop['size_k']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['kementerian1'], 0, 1, 'C');

// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['kementerian2'], 0, 1, 'C');

// $pdf->Cell(10, 2, '', 0, 1);

// $pdf->SetFont('times', '', $kop['size_u']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['universitas'], 0, 1, 'C');

// $pdf->SetFont('times', 'B', $kop['size_f']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['fakultas'], 0, 1, 'C');

// $pdf->Cell(10, 1, '', 0, 1);


// $pdf->SetFont('times', '', $kop['size_j']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['jalan'], 0, 1, 'C');

// $pdf->SetFont('times', '', $kop['size_j']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['telpon'], 0, 1, 'C');

// $pdf->SetFont('times', '', $kop['size_j']);
// $pdf->Cell($margin_kop, 5, '', 0, 0);
// $pdf->Cell(160, 5, $kop['email'], 0, 1, 'C');

// $pdf->SetLineWidth(0.9); // tebal garis
// $pdf->Line(10, 49, 200, 49); // posisi garis

//AKHIR KOP DIKBUD ------------------------------------------------------------------------

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 15, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->SetFont('times', 'u', 12);
$pdf->Cell(160, 5, $nomor['surat'], 0, 1, 'C');

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Nomor : ' . $bp['nomor'] . ' ' . $nomor['nomor'], 0, 1, 'C');


//$bp = $this->db->get('mahasiswa')->row_array();

$pdf->Cell($margin_kiri, 10, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Yang bertanda tangan dibawah ini menerangkan :', 0,  'J');

$pdf->Cell(10, 4, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Nama Lengkap', 0, 0);
$pdf->Cell(120, 5, ':  ' . $bp['nama_lengkap'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'NIM', 0, 0);
$pdf->Cell(120, 5, ':  ' . $bp['nim'], 0, 1);

// $pdf->Cell($margin_kiri, 5, '', 0, 0);
// $pdf->Cell(40, 5, 'Tempat/ Tanggal Lahir', 0, 0);
// $pdf->Cell(3, 5, ':', 0, 0);
// $pdf->MultiCell(117, 5, $bp['tempat_lahir'] . ', ' . tgl_ind(date($bp['tgl_lahir'])), 0, 'J');

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Program Studi', 0, 0);
$pdf->Cell(3, 5, ':', 0, 0);
$pdf->MultiCell(117, 5, $bp['nama_prodi'], 0, 'J');

// $pdf->Cell($margin_kiri, 5, '', 0, 0);
// $pdf->Cell(40, 5, 'Semester', 0, 0);
// $pdf->Cell(3, 5, ':', 0, 0);
// $pdf->Cell(117, 5, $bp['semester'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'No HP', 0, 0);
$pdf->Cell(3, 5, ':', 0, 0);
$pdf->MultiCell(117, 5, $bp['no_hp'], 0, 'J');


$pdf->Cell(10, 4, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Bahwa yang bersangkutan dinyatakan Bebas dari segala Administrasi Peminjaman Lab teknologi farmasi, Lab kimia farmasi, Lab biologi farmasi dan Lab farmakologi klinis Fakultas Kedokteran Universitas Tanjungpura Pontianak', 0, 'J');

$pdf->Cell($margin_kiri, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.', 0, 'J');

$pdf->Cell($margin_kiri, 5, '', 0, 1);

$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 20, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Pontianak, ' . tgl_ind(date($bp['date_updated'])), 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'Menyetujui', 0, 0);
$pdf->Cell(60, 5, '', 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'Kepala Bagian Umum', 0, 0);
$pdf->Cell(60, 5, 'Koordinator Laboran', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Prodi Farmasi', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'Wahyudi, MM', 0, 0);
$pdf->Cell(60, 5, 'Nurul Hamsiah, S.Si', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'NIP. 197509232006041001', 0, 0);
$pdf->Cell(60, 5, 'NIH. 19940701201801012', 0, 1);


$pdf->Cell($margin_kiri, 15, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, 'Laboratorium FK UNTAN', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, '[ ' . $bp['id_bebaslab'] . ' ] ID surat elektronik silat.fk.untan.ac.id', 0, 1);


$pdf->Output($dest = 'I', $name = $nomor['keterangan'] . ' ' . $bp['nama_lengkap'] . '.pdf', $isUTF8 = true);
