<?php

class Wisuda_model extends CI_model
{

  public function get_All()
  {
    $status = '';
    $this->db->select('*');
    $this->db->from('tb_berkaswisuda');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_berkaswisuda.nim_bw');
    $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
    $this->db->order_by('date_created', 'asc');
    $this->db->where('status !=', $status);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_Idbw($id_bw)
  {

    $this->db->select('*');
    $this->db->from('tb_berkaswisuda');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_berkaswisuda.nim_bw');
    $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

    $this->db->where('id_bw', $id_bw);
    $query = $this->db->get();
    return $query->row_array();
  }
  public function get_statusaccept()
  {
    $accept = 'accept';
    $this->db->select('*');
    $this->db->from('tb_berkaswisuda');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_berkaswisuda.nim_bw');
    $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

    $this->db->where('status', $accept);
    $query = $this->db->get();
    return $query->result_array();
  }


  public function accept_Idbw($id_bw)
  {
    $proses = 'accept';
    $data = [
      'status' => $proses,
      'keterangan' => 'Validasi Lengkap',
      'date_updated' => time()

    ];
    $this->db->where('id_bw', $id_bw);
    $this->db->update('tb_berkaswisuda', $data);
  }
  public function reject_Idbw($id_bw)
  {
    $proses = 'reject';

    $data = [
      'status' => $proses,
      'keterangan' => $this->input->post('keterangan'),
      'date_updated' => time()

    ];
    $this->db->where('id_bw', $id_bw);
    $this->db->update('tb_berkaswisuda', $data);
  }



  public function hitungJumlahSurat()
  {
    // get_where('tb_skl', ['nim' => $id, 'jenis_skl' => '2'])
    $query = $this->db->get('tb_berkaswisuda');
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiAjukan()
  {
    $query = $this->db->get_where('tb_berkaswisuda', ['status' => '']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiProses()
  {
    $query = $this->db->get_where('tb_berkaswisuda', ['status' => 'reject']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiSelesai()
  {
    $query = $this->db->get_where('tb_berkaswisuda', ['status' => 'accept']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }
}
