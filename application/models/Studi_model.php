<?php

class Studi_model extends CI_model
{

  public function getStudiP()
  {

    $this->db->select('*');
    $this->db->from('tb_studip');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_studip.nim');
    $this->db->order_by('status', 'asc');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function getStudiById($id_studip)
  {

    $this->db->select('*');
    $this->db->from('tb_studip');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_studip.nim');
    $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

    $this->db->where('id_studip', $id_studip);
    $query = $this->db->get();
    return $query->row_array();
  }


  public function prosesStudip($id_studip)
  {
    $proses = 'proses';
    $data = [
      'status' => $proses,
      'admin' => $this->session->userdata('email'),
      'date_finish' => time()

    ];
    $this->db->where('id_studip', $id_studip);
    $this->db->update('tb_studip', $data);
  }

  public function selesaiStudip($id_studip)
  {
    $selesai = 'selesai';
    $tanggal = date("Y-m-d");
    $data = [

      'status' => $selesai,
      'admin' => $this->session->userdata('email'),
      'date_finish' => time()

    ];
    $this->db->where('id_studip', $id_studip);
    $this->db->update('tb_studip', $data);
  }

  public function hitungJumlahSurat()
  {
    $query = $this->db->get('tb_studip');
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiAjukan()
  {
    $query = $this->db->get_where('tb_studip', ['status' => 'diajukan']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiProses()
  {
    $query = $this->db->get_where('tb_studip', ['status' => 'proses']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiSelesai()
  {
    $query = $this->db->get_where('tb_studip', ['status' => 'selesai']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }
}
