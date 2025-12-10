<?php

class Laboratorium_model extends CI_model
{

    public function get_All()
    {
        $status = ('' | 'accept');
        $this->db->select('*');
        $this->db->from('tb_bebasperpus');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebasperpus.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->order_by('date_created', 'asc');
        $this->db->where('status !=', $status);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_Prodi()
    {
        $nim = $this->session->userdata('nim');

        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->where('nim', $nim);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_Idbp($id_bebaslab)
    {

        $this->db->select('*');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->join('user', 'user.nim=mahasiswa.nim');

        $this->db->where('id_bebaslab', $id_bebaslab);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_statusaccept()
    {
        $accept = 'accept';
        $this->db->select('*');
        $this->db->from('tb_bebasperpus');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebasperpus.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('status', $accept);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function accept_Idbp($id_bp)
    {
        $proses = 'accept';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $data = [
            'status' => $proses,
            'semester' => $this->input->post('semester', true),
            'link' => $this->input->post('link', true),
            'keterangan' => 'Validasi Lengkap',
            'date_updated' => $date,
            'admin' => $this->session->userdata('name')

        ];
        $this->db->where('id_bp', $id_bp);
        $this->db->update('tb_bebasperpus', $data);
    }
    public function reject_Idbp($id_bp)
    {
        $proses = 'reject';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $data = [
            'status' => $proses,
            'keterangan' => $this->input->post('keterangan'),
            'date_updated' => $date

        ];
        $this->db->where('id_bp', $id_bp);
        $this->db->update('tb_bebasperpus', $data);
    }
    public function ajuan($nim)
    {
        $status = 'di ajukan';
        $this->db->select('*');
        $this->db->from('tb_bebasperpus');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebasperpus.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('nim_mahasiswa', $nim);
        $this->db->where('status', $status);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function ajukanBebasLab($id_bebaslab)
    {
        $proses = 'di ajukan';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $data = [
            'status' => $proses,
            'keterangan' => 'menunggu proses validasi',
            'date_updated' => $date

        ];
        $this->db->where('id_bebaslab', $id_bebaslab);
        $this->db->update('tb_bebaslab', $data);
    }

    public function hitungJumlahSurat()
    {
        // get_where('tb_skl', ['nim' => $id, 'jenis_skl' => '2'])
        $query = $this->db->get('tb_bebasperpus');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahdiAjukan()
    {
        $query = $this->db->get_where('tb_bebasperpus', ['status' => '']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahdiProses()
    {
        $query = $this->db->get_where('tb_bebasperpus', ['status' => 'reject']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahdiSelesai()
    {
        $query = $this->db->get_where('tb_bebasperpus', ['status' => 'accept']);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function getAllPengajuanByNim($nim)
    {
        return $this->db->order_by('id_bebaslab', 'DESC')
            ->get_where('tb_bebaslab', ['nim_mahasiswa' => $nim])
            ->result_array();
    }

    public function getById($id_bebaslab)
    {
        return $this->db->get_where('tb_bebaslab', ['id_bebaslab' => $id_bebaslab])->row_array();
    }

    public function delete($id_bebaslab)
    {
        return $this->db->delete('tb_bebaslab', ['id_bebaslab' => $id_bebaslab]);
    }

    public function cekPengajuan60Hari($nim)
    {
        $tanggal_batas = date('Y-m-d H:i:s', strtotime('-60 days'));

        $this->db->where('nim_mahasiswa', $nim);
        $this->db->where('date_created >=', $tanggal_batas);

        // hanya hitung pengajuan yang benar-benar dikirim
        $this->db->where_in('status', ['di ajukan', 'proses', 'accept', 'reject']);

        $query = $this->db->get('tb_bebaslab');

        return $query->num_rows();
    }
}
