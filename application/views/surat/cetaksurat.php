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



$pdf->SetFont('times', '', 12);
$pdf->Cell($margin_kiri, 8, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Pontianak, ' . $tanggal, 0, 1, 'R');
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(85, 5, 'Yth. Dekan Fakultas Kedokteran', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);

$pdf->Cell(85, 5, 'Universitas Tanjungpura', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);

$pdf->Cell(85, 5, 'Pontianak', 0, 1);
$pdf->Cell($margin_kiri, 20, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(160, 5, 'Saya yang bertanda tangan dibawah ini :', 0, 1);


//$surat = $this->db->get('mahasiswa')->row_array();

$pdf->Cell(10, 7, '', 0, 1);
//   $pdf->SetFont('Times', 'B', 10);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Nama Lengkap', 0, 0);
$pdf->Cell(110, 5, ':  ' . ucwords(strtolower(htmlspecialchars($surat['nama_lengkap']))), 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Tempat/ Tanggal Lahir', 0, 0);
$pdf->Cell(110, 5, ':  ' . ucwords(strtolower(htmlspecialchars($surat['tempat_lahir']))) . ', ' . tgl_ind(date($surat['tgl_lahir'])), 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 5, 'NIM', 0, 0);
$pdf->Cell(110, 5, ':  ' . $surat['nim'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Semester/ Prodi', 0, 0);
$pdf->Cell(110, 5, ':  ' . $surat['semester'] . ' / ' . $surat['nama_prodi'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Tahun Ajaran', 0, 0);
$pdf->Cell(110, 5, ':  ' . $surat['tahun_ajaran'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Nama Orang Tua', 0, 0);
$pdf->Cell(110, 5, ':  ' . $surat['ortu'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 5, 'NIP/NRP/NPS', 0, 0);
$pdf->Cell(110, 5, ':  ' . $surat['nip'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Pangkat/ Golongan', 0, 0);
$pdf->Cell(110, 5, ':  ' . $surat['pangkat'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Instansi', 0, 0);
$pdf->Cell(110, 5, ':  ' . $surat['instansi'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Alamat Instansi', 0, 0);
$pdf->Cell(110, 5, ':  ' . $surat['alamat_instansi'], 0, 1);

$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Sehubungan dengan hal tersebut di atas, maka saya mohon pihak Fakultas Kedokteran dapat memberikan Surat Keterangan Masih Aktif Kuliah di Fakultas Kedokteran Universitas Tanjungpura, yang dipergunakan untuk memenuhi persyaratan pemberkasan ' . $surat['nama_keperluan'] . ' ' . $surat['keterangan'], 0, 'J');
//   $pdf->SetXY($get_xxx, $get_yyy);

// $pdf->Ln();
// $get_xxx = $start_awal;
// $get_yyy += $height_cell;
$pdf->Cell($margin_kiri, 5, '', 0, 1);

//  $pdf->SetXY($get_xxx, $get_yyy);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Demikian surat permohonan ini saya buat, atas perhatian dan bantuannya saya ucapkan terima kasih.', 0, 'J');

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
$pdf->Cell(10, 7, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'Hormat Saya,', 0, 1, 'L');
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, ucwords(strtolower(htmlspecialchars($surat['nama_lengkap']))), 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(60, 5, 'NIM ' . $surat['nim'], 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, 'Checklist Kelengkapan Berkas ID [ ' . $surat['id_suratpengajuan'] . ' ]', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, '[  ] fotocopy KTM', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, '[  ] fotocopy KK', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, '[  ] fotocopy SK Orang Tua Terakhir', 0, 1);

$pdf->Output();
