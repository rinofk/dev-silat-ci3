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
$pdf->Cell($margin_kiri, 8, '', 1, 1);
$pdf->Cell(120, 6, '', 1, 0);
$pdf->Cell(60, 6, 'Pontianak, 23 Februari 2019', 1, 1, 'R');
$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(85, 6, 'Yth. Dekan Fakultas Kedokteran', 1, 1);
$pdf->Cell($margin_kiri, 6, '', 1, 0);

$pdf->Cell(85, 6, 'Universitas Tanjungpura', 1, 1);
$pdf->Cell($margin_kiri, 6, '', 1, 0);

$pdf->Cell(85, 6, 'Pontianak', 1, 1);
$pdf->Cell($margin_kiri, 20, '', 1, 1);
$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(160, 6, 'Saya yang bertanda tangan dibawah ini :', 1, 1);


//$mahasiswa = $this->db->get('mahasiswa')->row_array();

$pdf->Cell(10, 7, '', 0, 1);
//   $pdf->SetFont('Times', 'B', 10);
$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(50, 6, 'Nama Lengkap', 1, 0);
$pdf->Cell(110, 6, ':  ' . $mahasiswa['nama_lengkap'], 1, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(50, 6, 'Tempat/ Tanggal Lahir', 1, 0);
$pdf->Cell(110, 6, ':  ' . $mahasiswa['nama_lengkap'], 1, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(50, 6, 'NIM', 1, 0);
$pdf->Cell(110, 6, ':  ' . $mahasiswa['tempat_lahir'], 1, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(50, 6, 'Semester/ Prodi', 1, 0);
$pdf->Cell(110, 6, ':  ' . $mahasiswa['tgl_lahir'], 1, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(50, 6, 'Tahun Ajaran', 1, 0);
$pdf->Cell(110, 6, ':  ' . $mahasiswa['tgl_lahir'], 1, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(50, 6, 'Nama Orang Tua', 1, 0);
$pdf->Cell(110, 6, ':  ' . $mahasiswa['tgl_lahir'], 1, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(50, 6, 'NIP/NRP/NPS', 1, 0);
$pdf->Cell(110, 6, ':  ' . $mahasiswa['tgl_lahir'], 1, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(50, 6, 'Pangkat/ Golongan', 1, 0);
$pdf->Cell(110, 6, ':  ' . $mahasiswa['tgl_lahir'], 1, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(50, 6, 'Instansi', 1, 0);
$pdf->Cell(110, 6, ':  ' . $mahasiswa['tgl_lahir'], 1, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(50, 6, 'Alamat', 1, 0);
$pdf->Cell(110, 6, ':  ' . $mahasiswa['tgl_lahir'], 1, 1);

$pdf->Cell(10, 7, '', 0, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->MultiCell($width_cell, 6, 'Sehubungan dengan hal tersebut di atas, maka saya mohon pihak Fakultas Kedokteran dapat memberikan Surat Keterangan Masih Aktif Kuliah di Fakultas Kedokteran Universitas Tanjungpura, yang dipergunakan untuk memenuhi persyaratan pemberkasan', 1, 1);
//   $pdf->SetXY($get_xxx, $get_yyy);

// $pdf->Ln();
// $get_xxx = $start_awal;
// $get_yyy += $height_cell;
$pdf->Cell($margin_kiri, 6, '', 1, 1);

//  $pdf->SetXY($get_xxx, $get_yyy);
$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->MultiCell($width_cell, 6, 'Demikian surat permohonan ini saya buat, atas perhatian dan bantuannya saya ucapkan terima kasih.', 1, 1);

// Memberikan space kebawah agar tidak terlalu rapat
// $pdf->Cell(10, 7, '', 0, 1);
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(20, 6, 'NIM', 1, 0);
// $pdf->Cell(85, 6, 'NAMA MAHASISWA', 1, 0);
// $pdf->Cell(27, 6, 'NO HP', 1, 0);
// $pdf->Cell(25, 6, 'TANGGAL LHR', 1, 1);

// $pdf->SetFont('Arial', '', 10);
// $mahasiswa = $this->db->get('mahasiswa')->result();
// foreach ($mahasiswa as $row) {
//     $pdf->Cell(20, 6, $row->nim, 1, 0);
//     $pdf->Cell(85, 6, $row->nama_lengkap, 1, 0);
//     $pdf->Cell(27, 6, $row->no_hp, 1, 0);
//     $pdf->Cell(25, 6, $row->tgl_lahir, 1, 1);
// }
$pdf->SetFont('Times', '', 12);
$pdf->Cell(10, 7, '', 0, 1);
$pdf->Cell(120, 6, '', 1, 0);
$pdf->Cell(60, 6, 'Hormat Saya,', 1, 1, 'L');
$pdf->Cell($margin_kiri, 6, '', 1, 1);
$pdf->Cell($margin_kiri, 6, '', 1, 1);
$pdf->Cell(120, 6, '', 1, 0);
$pdf->Cell(60, 6, $mahasiswa['nama_lengkap'], 1, 1);
$pdf->Cell(120, 6, '', 1, 0);
$pdf->Cell(60, 6, 'NIM ' . $mahasiswa['nim'], 1, 1);

$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(120, 6, 'Checklist Kelengkapan Berkas ID [   ]', 1, 1);
$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(120, 6, '[  ] fotocopy KTM', 1, 1);
$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(120, 6, '[  ] fotocopy KK', 1, 1);
$pdf->Cell($margin_kiri, 6, '', 1, 0);
$pdf->Cell(120, 6, '[  ] fotocopy SK Orang Tua Terakhir', 1, 1);

$pdf->Output();
