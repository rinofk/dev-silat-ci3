<?php
require('./fpdf17/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('http://lh4.googleusercontent.com/-BKiW0q2EmPk/Ujsv0uq-KnI/AAAAAAAAAH4/y9LOxo2H-JU/h120/942399_662788143736596_1950874219_n.jpg',10,8,30);
    
    // Arial bold 12
    $this->SetFont('Arial','B',12);
    
    // Geser Ke Kanan 35mm
    $this->Cell(35);
    
    // Judul
    $this->Cell(30,7,'Laboratorium Pemrograman dan Basis Data',0,1,'L');
    $this->Cell(35);
    $this->Cell(30,7,'Program Studi Sistem Informasi',0,1,'L');
    $this->Cell(35);
    $this->Cell(30,7,'Fakultas Teknologi Informasi, Universitas Andalas',0,1,'L';
    
    // Garis Bawah Double
    $this->Cell(190,1,'','B',1,'L');
    $this->Cell(190,1,'','B',0,'L');
    
    // Line break 5mm
    $this->Ln(5);
}

// Page footer
function Footer()
{
    // Posisi 15 cm dari bawah
    $this->SetY(-15);
    
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Membuat file PDF
$pdf = new PDF();
//Alias total halaman dengan default {nb} (berhubungan dengan PageNo())
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
//Mencetak kalimat dengan perulangan
for($i=1;$i<=45;$i++)
    $pdf->Cell(0,10,'Baris '.$i,0,1);
//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>