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
$pdf->Image('assets/img/pejabat/hazwani.png', 127, 169, 33, 27);
$pdf->Image('assets/img/pejabat/cap2025.png', 15, 170, 33, 32);

if (!empty($qr_file) && file_exists($qr_file)) {
    $pdf->Image($qr_file, 85, 170, 22, 22);
}

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
$full_nomor = $bp['nomor'];
if (strpos($full_nomor, '/') === false && !empty($nomor['nomor'])) {
    $doc_date = !empty($bp['date_updated']) ? $bp['date_updated'] : (!empty($bp['date_finished']) ? $bp['date_finished'] : $bp['date_created']);
    $tahun = date('Y', strtotime($doc_date));
    $nomor_base = $nomor['nomor'];
    if (stripos($nomor_base, 'DST') === false) {
        if (substr($nomor_base, 0, 1) === '/') {
            $nomor_base = '/DST' . $nomor_base;
        } else {
            $nomor_base = '/DST/' . $nomor_base;
        }
    } else {
        if (substr($nomor_base, 0, 1) !== '/') {
            $nomor_base = '/' . $nomor_base;
        }
    }
    if (substr($nomor_base, -strlen($tahun)) !== $tahun) {
        if (substr($nomor_base, -1) !== '/') {
            $nomor_base = $nomor_base . '/' . $tahun;
        } else {
            $nomor_base = $nomor_base . $tahun;
        }
    }
    $full_nomor .= ' ' . $nomor_base;
}
$pdf->Cell(160, 5, 'Nomor : ' . $full_nomor, 0, 1, 'C');


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
$pdf->MultiCell($width_cell, 5, 'Bahwa yang bersangkutan dinyatakan Bebas dari segala Administrasi Peminjaman Lab kompetensi keperawatan dasar, Lab keperawatan medikal bedah, Lab keperawatan gawat darurat, Lab Keperawatan maternitas, Lab Keperawatan anak, Lab keperawatan jiwa dan Lab keperawatan komunitas Fakultas Kedokteran Universitas Tanjungpura Pontianak.', 0, 'J');

$pdf->Cell($margin_kiri, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->MultiCell($width_cell, 5, 'Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.', 0, 'J');

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
$pdf->Cell(60, 5, 'Prodi Keperawatan', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 1);

$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'Wahyudi, MM', 0, 0);
$pdf->Cell(60, 5, 'Hazwani, S.Kep., Ners.', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(105, 5, 'NIP. 197509232006041001', 0, 0);
$pdf->Cell(60, 5, 'NIP. 198901212025211047', 0, 1);


$pdf->Cell($margin_kiri, 15, '', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, 'Laboratorium FK UNTAN', 0, 1);
$pdf->Cell($margin_kiri, 5, '', 0, 0);
$pdf->Cell(120, 5, '[ ' . $bp['id_bebaslab'] . ' ] ID surat elektronik silat.fk.untan.ac.id', 0, 1);


$pdf->Output($dest = 'I', $name = $nomor['keterangan'] . ' ' . $bp['nama_lengkap'] . '.pdf', $isUTF8 = true);
