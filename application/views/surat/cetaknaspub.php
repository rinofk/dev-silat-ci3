<?php

$pdf = new FPDF('P', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
$pdf->SetTitle($nomor['keterangan'] . ' ' . $naspub['nama_lengkap']);
$width_cell = 160;
$height_cell = 6;
$margin_kiri = 15;
$margin_kop = 28;



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

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 15, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->SetFont('times', 'u', 12);
$pdf->Cell(160, 5, $nomor['surat'], 0, 1, 'C');

$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Nomor :         ' . $nomor['nomor'], 0, 1, 'C');


//$naspub = $this->db->get('mahasiswa')->row_array();

$pdf->Cell($margin_kiri, 10, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Ketua Program Studi ' . $naspub['nama_prodi'] . ' Fakultas Kedokteran Universitas Tanjungpura menerangkan kepada dibawah ini :', 0,  'J');

$pdf->Cell(10, 4, '', 0, 1);
//   $pdf->SetFont('Times', 'B', 10);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Nama Lengkap', 0, 0);
$pdf->Cell(120, 5, ':  ' . $naspub['nama_lengkap'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'NIM', 0, 0);
$pdf->Cell(120, 5, ':  ' . $naspub['nim'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'e-Mail', 0, 0);
$pdf->Cell(3, 5, ':', 0, 0);
$pdf->Cell(117, 5, $user['email'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Judul Publikasi', 0, 0);
$pdf->Cell(3, 5, ':', 0, 0);
$pdf->MultiCell(117, 5, $naspub['judul_naspub'], 0, 'J');


$pdf->Cell(10, 4, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Telah memenuhi syarat untuk dipublikasikan secara online di Jurnal Online Fakultas Kedokteran Universitas Tanjungpura.', 0, 'J');
//   $pdf->SetXY($get_xxx, $get_yyy);

// $pdf->Ln();
// $get_xxx = $start_awal;
// $get_yyy += $height_cell;
$pdf->Cell($margin_kiri, 5, '', 0, 1);

//  $pdf->SetXY($get_xxx, $get_yyy);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Demikian surat pernyataan ini dibuat agar dapat dipergunakan sebagaimana mestinya.', 0, 'J');

// Memberikan space kebawah agar tidak terlalu rapat
// $pdf->Cell(10, 7, '', 0, 1);
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(20, 5, 'NIM', 0,0);
// $pdf->Cell(85, 5, 'NAMA MAHASISWA', 0,0);
// $pdf->Cell(27, 5, 'NO HP', 0,0);
// $pdf->Cell(25, 5, 'TANGGAL LHR', 0,1);

// $pdf->SetFont('Arial', '', 10);
// $naspub = $this->db->get('mahasiswa')->result();
// foreach ($naspub as $row) {
//     $pdf->Cell(20, 5, $row->nim, 0,0);
//     $pdf->Cell(85, 5, $row->nama_lengkap, 0,0);
//     $pdf->Cell(27, 5, $row->no_hp, 0,0);
//     $pdf->Cell(25, 5, $row->tgl_lahir, 0,1);
// }
$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 20, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(95, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Pontianak, ' . $tanggal, 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(95, 5, 'Mengetahui', 0, 0);
$pdf->Cell(60, 5, '', 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(95, 5, 'Ketua Program Studi', 0, 0);
$pdf->Cell(60, 5, 'Dosen Pembimbing Utama', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(95, 5, $naspub['nama_kaprodi'], 0, 0);
$pdf->Cell(70, 5, $naspub['pembimbing'], 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(95, 5, 'NIP. ' . $naspub['nip_kaprodi'], 0, 0);
$pdf->Cell(70, 5, 'NIP. ' . $naspub['nip'], 0, 1);
// Kasubbag Akademik
$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 7, '', 0, 1);
$pdf->Cell(70, 5, '', 0, 0);
$pdf->Cell(70, 5, 'Kasubbag.', 0, 1, 'L');
$pdf->Cell(70, 5, '', 0, 0);
$pdf->Cell(70, 5, 'Pendidikan dan Kemahasiswaan', 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell(70, 5, '', 0, 0);
$pdf->Cell(70, 5, 'Wahyudi, MM', 0, 1);
$pdf->Cell(70, 5, '', 0, 0);
$pdf->Cell(70, 5, 'NIP. 197509232006041001', 0, 1);

$pdf->Cell($margin_kiri, 15, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, 'Checklist Kelengkapan Berkas ID [ ' . $naspub['id_naspub'] . ' ]', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, '[  ] CD berisi softfile Naskah Publikasi', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, '[  ] Naskah Publikasi', 0, 1);

$pdf->Output($dest = 'I', $name = $nomor['keterangan'] . ' ' . $naspub['nama_lengkap'] . '.pdf', $isUTF8 = true);
