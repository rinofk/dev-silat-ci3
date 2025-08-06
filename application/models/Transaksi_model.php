<?php

class Transaksi_model extends CI_model
{
  public function getAllMahasiswa()
  {
    $this->db->select('*');
    $this->db->from('mahasiswa');
    $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
    $query = $this->db->get();
    return $query->result_array();

    //return $this->db->get('mahasiswa')->result_array();
  }

  public function getSuratAktifKuliah()
  {

    $this->db->select('*');
    $this->db->from('tb_suratpengajuan');
    $this->db->join('keperluan', 'keperluan.id_keperluan=tb_suratpengajuan.keperluan');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_suratpengajuan.nim_mahasiswa');


     if ($this->input->get('status')) {
        $this->db->where('tb_suratpengajuan.status', $this->input->get('status'));
    }

    

    // Urutkan berdasarkan tahun terbaru dari date_create (UNIX timestamp)
    $this->db->order_by('YEAR(FROM_UNIXTIME(date_create))', 'DESC');

    $tahun = $this->input->get('tahun');

    if (!empty($tahun)) {
        $this->db->where('YEAR(FROM_UNIXTIME(date_create))', $tahun);
    }


    $this->db->order_by('date_create', 'desc');

    $query = $this->db->get();
    return $query->result_array();
  }


  public function getSuratAktifKuliahById($id_suratpengajuan)
  {

    $this->db->select('*');
    $this->db->from('tb_suratpengajuan');
    $this->db->join('keperluan', 'keperluan.id_keperluan=tb_suratpengajuan.keperluan');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_suratpengajuan.nim_mahasiswa');
    $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

    $this->db->where('id_suratpengajuan', $id_suratpengajuan);
    $query = $this->db->get();
    return $query->row_array();
  }

public function ubah($id_suratpengajuan)
  {

    $data = [
      'semester' => $this->input->post('semester', true),
      'tahun_ajaran' => $this->input->post('tahun_ajaran'),
      'keterangan' => $this->input->post('keterangan'),
      'ortu' => $this->input->post('ortu'),
      'nip' => $this->input->post('nip'),
      'pangkat' => $this->input->post('pangkat'),
      'instansi' => $this->input->post('instansi'),
      'alamat_instansi' => $this->input->post('alamat_instansi')

    ];
    $this->db->where('id_suratpengajuan', $id_suratpengajuan);
    $this->db->update('tb_suratpengajuan', $data);
  }
  public function prosesSuratAktifKuliah($id_suratpengajuan)
  {
    $proses = 'proses';
    date_default_timezone_set('Asia/Jakarta');
    $status_ket = '';
    $date = date("Y-m-d H:i:s");
    $data = [
      'status' => $proses,
            'status_keterangan' => $status_ket,

      'admin' => $this->session->userdata('name'),
      'tgl_surat'=> $date,
      'date_finish' => time()

    ];
    $this->db->where('id_suratpengajuan', $id_suratpengajuan);
    $this->db->update('tb_suratpengajuan', $data);
  }

  public function selesaiSuratAktifKuliah($id_suratpengajuan)
  {
    $selesai = 'selesai';
    $$status_ket = '';
    $tanggal = date("Y-m-d");
    $data = [

      'status' => $selesai,
      'status_keterangan' => $status_ket,
      'admin' => $this->session->userdata('name'),
      'date_finish' => time()

    ];
    $this->db->where('id_suratpengajuan', $id_suratpengajuan);
    $this->db->update('tb_suratpengajuan', $data);
  }

  public function hitungJumlahSurat()
  {
    $query = $this->db->get('tb_suratpengajuan');
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiAjukan()
  {
    $query = $this->db->get_where('tb_suratpengajuan', ['status' => 'diajukan']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiProses()
  {
    $query = $this->db->get_where('tb_suratpengajuan', ['status' => 'proses']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiSelesai()
  {
    $query = $this->db->get_where('tb_suratpengajuan', ['status' => 'selesai']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function getTahunSuratAktif()
{
    $this->db->select('YEAR(FROM_UNIXTIME(date_create)) AS tahun');
    $this->db->from('tb_suratpengajuan');
    $this->db->group_by('tahun');
    $this->db->order_by('tahun', 'DESC');
    $query = $this->db->get();
    return array_column($query->result_array(), 'tahun');
}

public function getStatistikSuratAktif($tahun)
{
    $this->db->select('status, COUNT(*) as jumlah');
    $this->db->from('tb_suratpengajuan');
    $this->db->where('YEAR(FROM_UNIXTIME(date_create))', $tahun);
    $this->db->group_by('status');
    $query = $this->db->get();

    $result = [
        'Diajukan' => 0,
        'Proses' => 0,
        'Ditolak' => 0,
        'Selesai' => 0,
        'Total' => 0
    ];

    foreach ($query->result() as $row) {
        if (stripos($row->status, 'Diajukan') !== false) $result['Diajukan'] += $row->jumlah;
        elseif (stripos($row->status, 'Proses') !== false) $result['Proses'] += $row->jumlah;
        elseif (stripos($row->status, 'Ditolak') !== false) $result['Ditolak'] += $row->jumlah;
        elseif (stripos($row->status, 'Selesai') !== false) $result['Selesai'] += $row->jumlah;

        $result['Total'] += $row->jumlah;
    }

    return $result;
}

}
