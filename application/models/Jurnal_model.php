<?php

class Jurnal_model extends CI_model
{
    public function getAllNaspub()
    {
        $this->db->select('*');
        $this->db->from('tb_naspub');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_naspub.nim');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->order_by('status', 'asc');

        $query = $this->db->get();
        return $query->result_array();

        //return $this->db->get('mahasiswa')->result_array();
    }
    public function getNaspubById($id_naspub)
    {
        $this->db->select('*');
        $this->db->from('tb_naspub');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_naspub.nim');
        $this->db->join('user', 'user.nim=tb_naspub.nim');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('id_naspub', $id_naspub);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function updateNaspub($id_naspub)
    {
        $selesai = 'selesai';
        // $tanggal = date("Y-m-d");
        $data = [

            'nomorsurat' => $this->input->post('nomorsurat'),
            'link' => $this->input->post('link'),
            'date_finish' => time(),
            'status' => $selesai

        ];
        $this->db->where('id_naspub', $id_naspub);
        $this->db->update('tb_naspub', $data);
    }

    public function reject($id_naspub)
    {
        $proses = 'reject';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $data = [
            'status' => $proses,
            'ket' => $this->input->post('keterangan'),
            'date_updated' => $date

        ];
        $this->db->where('id_naspub', $id_naspub);
        $this->db->update('tb_naspub', $data);
    }
    
    public function hitungJumlahSurat()
    {
        $query = $this->db->get('tb_naspub');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahdiAjukan()
    {
        $query = $this->db->get_where('tb_naspub', ['status' => 'diajukan']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahdiProses()
    {
        $query = $this->db->get_where('tb_naspub', ['status' => 'proses']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahSelesai()
    {
        $query = $this->db->get_where('tb_naspub', ['status' => 'selesai']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}
