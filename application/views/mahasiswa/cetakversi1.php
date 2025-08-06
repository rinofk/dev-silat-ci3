<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$html = '
<style type="text/css">
   
    p{
        font-family: "Times New Roman", Times, serif;
        font-size: 12pt;

    }
    img {
        max-width: 120px;
        height: auto;
      }

    i { 
      font-family: sans;
      color: orange;
    }
    body{
        font-family: "Times New Roman", Times, serif;
        font-size: 11pt;
    }
    .konten{
        padding-left: 30px;
        padding-right: 30px;
    }
    .separator {
        border-bottom: 3px solid #000;
        margin: 0rem 0 1rem;
    }
    .disp {
        text-align: center;
        
    }

    #nama {
        font-size: 17px!important;
        text-transform: uppercase;
        margin: 5px;
        
    }
    #namatebal {
        font-size: 17px!important;
        text-transform: uppercase;
        font-weight: bold;

    }
    .kop{
        padding-top:-25pt;
    }
    tr, td {
        text-align: justify;
        vertical-align: top!important;

    }

  </style>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style type="text/css">

</head>
<body>


<div class="kop">
<table border=0>
        <tr><td><img src="assets/img/logountan.png"></td><td width="550px"><center>
        <div class="disp">
            <span class="up" id="nama">KEMENTERIAN RISET TEKNOLOGI DAN PENDIDIKAN TINGGI</span><br/>
            <span class="up" id="nama">UNIVERSITAS TANJUNGPURA</span><br/>
            <span class="up" id="namatebal">FAKULTAS KEDOKTERAN</span><br/>
            <span id="alamat">Jalan Prof. Dr. H. Hadari Nawawi Pontianak 78124</span><br/>
            <span id="alamat">Telp. (0561) 8121432 Fax (0561) 8121432</span><br/>
            <span id="alamat">Email: kedokteran@untan.ac.id Website: www.kedokteran.untan.ac.id</span>
        </div></center>
        </td></tr>
</table>
</div>
<div class="separator"></div>
<div class="konten">
<table border=0>
<tr><td colspan="4" height=15></td></tr>


<tr ><td colspan="4"><center><u>SURAT KETERANGAN MASIH AKTIF KULIAH</u><br>Nomor : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /UN22.9/KM.00.00/2019</center></td></tr>
<tr><td colspan="4" height=55></td></tr>

<tr ><td colspan="4">Dekan Fakultas Kedokteran Universitas Tanjungpura menerangkan kepada dibawah ini :</td></tr>
<tr><td colspan="4" height=10></td></tr>
';

$html .= '<tr><td width=180>Nama Lengkap   </td><td width=3>:</td><td colspan="2">' . $mahasiswa["nama_lengkap"] . ' </td></tr>';
$html .= '<tr><td>Tempat/ Tanggal Lahir   </td><td width=3>:</td><td colspan="2">' . $mahasiswa["tempat_lahir"] . ', ' .  $mahasiswa["tgl_lahir"] . ' </td></tr>';
$html .= '<tr><td>Nim            </td><td width=3>:</td><td colspan="2">' . $mahasiswa["nim"] . '          </td></tr>';
$html .= '<tr><td>Semester / Prodi      </td><td width=3>:</td><td colspan="2">' . $mahasiswa["semester"] . ' / ' . $mahasiswa["nama_prodi"] . '   </td></tr>';
$html .= '<tr><td>Tahun Ajaran   </td><td width=3>:</td><td colspan="2">' . $mahasiswa["tahun_ajaran"] . '       </td></tr>';
$html .= '<tr><td>Alamat         </td><td width=3>:</td><td colspan="2">' . $mahasiswa["alamat"] . '       </td></tr>';

$html .= '<tr><td colspan="4" height=10></td></tr>
        <tr><td colspan="4">Bahwa yang bersangkutan adalah benar Mahasiswa Fakultas Kedokteran Universitas Tanjungpura yang masih aktif kuliah di Program Studi ';
$html .= '' . $mahasiswa["program_studi"] . ' hingga sekarang.</td></tr>
        <tr><td colspan="4" height=10></td></tr>
        <tr><td colspan="4">Demikian Surat Keterangan ini dibuat sebagai persyaratan untuk melengkapi pemberkasan ';
$html .= '' . $mahasiswa["keperluan"] . ' ' . $mahasiswa["keperluan_ket"] . ' sesuai dengan ketentuan yang berlaku.</td></tr>
        <tr><td colspan="4" height=60></td></tr>

        <tr><td colspan="3"></td><td width=250>';
$html .= '       Pontianak, ' . $tanggal . '<br>
        a.n. Dekan,<br>
        Kepala Bagian Tata Usaha,<br>
        <br>
        <br>
        <br>
        Astuti, SE., MM.<br>
        NIP 196910181991032001</td></tr>
';


$html .= '</table></div>


</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('Surat Aktif Kuliah.pdf', \Mpdf\Output\Destination::INLINE);
