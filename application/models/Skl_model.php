<?php

class Skl_model extends CI_model
{

  public function getSkl()
  {

    $this->db->select('*');
    $this->db->from('tb_skl');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_skl.nim');
    $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
    $this->db->order_by('status', 'asc');
    $this->db->where('jenis_skl', 2);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function getSklId($id_skl)
  {

    $this->db->select('*');
    $this->db->from('tb_skl');
    $this->db->join('mahasiswa', 'mahasiswa.nim=tb_skl.nim');
    $this->db->join('prodi_skl', 'prodi_skl.id_prodi=mahasiswa.prodi_id');
    $this->db->join('tb_alumni', 'tb_alumni.nim_alumni=mahasiswa.nim');

    $this->db->where('id_skl', $id_skl);
    $query = $this->db->get();
    return $query->row_array();
  }


  public function prosesSkl($id_skl)
  {
    $proses = 'proses';
    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d H:i:s");
    $data = [
      'status' => $proses,
      'admin' => $this->session->userdata('name'),
      'date_finish' => $date

    ];
    $this->db->where('id_skl', $id_skl);
    $this->db->update('tb_skl', $data);
  }

  public function prosesupdateSkl($id_skl)
  {
    $data = [
      'ipk' => $this->input->post('ipk'),
      'tgl_lulus_sidang' => $this->input->post('tgl_lulus'),
      'thn_akademik' => $this->input->post('thn_akademik'),
      'ganjilgenap' => $this->input->post('ganjilgenap'),
      'predikat' => $this->input->post('predikat')

    ];
    $this->db->where('nim_alumni', $this->input->post('nim'));
    $this->db->update('tb_alumni', $data);
     }
  
    public function deleteSkl($id_skl)
    {
    $this->db->where('id_skl', $id_skl);
    $this->db->delete('tb_skl');
     }


  public function selesaiSkl($id_skl)
  {
    $selesai = 'selesai';
    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d H:i:s");
    $data = [

      'status' => $selesai,
      'admin' => $this->session->userdata('name'),
      'date_finish' => $date

    ];
    $this->db->where('id_skl', $id_skl);
    $this->db->update('tb_skl', $data);
  }

  public function hitungJumlahSurat()
  {
    // get_where('tb_skl', ['nim' => $id, 'jenis_skl' => '2'])
    $query = $this->db->get_where('tb_skl', ['jenis_skl' => '2']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiAjukan()
  {
    $query = $this->db->get_where('tb_skl', ['status' => 'diajukan', 'jenis_skl' => '2']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiProses()
  {
    $query = $this->db->get_where('tb_skl', ['status' => 'proses', 'jenis_skl' => '2']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function hitungJumlahdiSelesai()
  {
    $query = $this->db->get_where('tb_skl', ['status' => 'selesai', 'jenis_skl' => '2']);
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }
}
