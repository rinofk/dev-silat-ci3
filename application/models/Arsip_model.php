<?php

class Arsip_model extends CI_model
{

    
    public function get_All()
    {
        $status = array('di terima', '');
        $this->db->select('*');
        $this->db->from('a_yudisium');
        $this->db->join('mahasiswa', 'mahasiswa.nim=a_yudisium.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->join('a_periode', 'a_periode.id_periode=a_yudisium.id_periode');
        $this->db->order_by('date_created', 'asc');
        $this->db->where_not_in('status', $status);

        $query = $this->db->get();
        return $query->result_array();
    }
 
    public function get_nimmahasiswa($nim_mahasiswa)
    {

        $this->db->select('*');
        $this->db->from('a_yudisium');
        $this->db->join('mahasiswa', 'mahasiswa.nim=a_yudisium.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->join('user', 'user.nim=mahasiswa.nim');
        $this->db->join('a_periode', 'a_periode.id_periode=a_yudisium.id_periode');

        $this->db->where('nim_mahasiswa', $nim_mahasiswa);
        $query = $this->db->get();
        return $query->row_array();
    } 

    public function get_YudisiumPeriodeDetail($id_periode)
    {

        $status = 'di terima';

        $this->db->select('*');
        $this->db->from('a_yudisium');
        $this->db->join('mahasiswa', 'mahasiswa.nim=a_yudisium.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->join('user', 'user.nim=mahasiswa.nim');
        // $this->db->join('a_periode', 'a_periode.id_periode=a_yudisium.id_periode');

        $this->db->where('id_periode', $id_periode);
        // $this->db->where('status', $status);
        $query = $this->db->get();
        return $query->result_array();
    } 


    // public function get_statusaccept()
    // {
    //     $accept = 'accept';
    //     $this->db->select('*');
    //     $this->db->from('tb_bebasperpus');
    //     $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebasperpus.nim_mahasiswa');
    //     $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

    //     $this->db->where('status', $accept);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    public function get_YLengkap()
    {
        $status = 'di terima';
        $this->db->select('*');
        $this->db->from('a_yudisium');
        $this->db->join('mahasiswa', 'mahasiswa.nim=a_yudisium.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->join('a_periode', 'a_periode.id_periode=a_yudisium.id_periode');
        $this->db->where_in('status', $status);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_Periode()
    {
        $this->db->select('*');
        $this->db->from('a_periode');
        // $this->db->join('mahasiswa', 'mahasiswa.nim=a_yudisium.nim_mahasiswa');
        // $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        // $this->db->where_in('status', $status);
        $this->db->order_by('tgl_yudisium', 'DESC'); // urutkan berdasarkan tanggal yudisium terbaru
        $query = $this->db->get();
        return $query->result_array();

    }

    

    public function get_klinik_nonaktif()
    {
        $pkna = 'tidak aktif';
        $this->db->select('*');
        $this->db->from('pk_klinik');
        $this->db->join('prodi', 'prodi.id_prodi=pk_klinik.prodi_klinik');
        $this->db->where_in('status', $pkna);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function accept_Idbp($nim_mahasiswa)
    {
        $proses = 'di terima';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $data = [
            'status' => $proses,
            'keterangan' => 'Validasi Lengkap',
            'date_updated' => $date,
            'admin' => $this->session->userdata('name')

        ];
        $this->db->where('nim_mahasiswa', $nim_mahasiswa);
        $this->db->update('a_yudisium', $data);
    }
    public function reject_Idbp($nim_mahasiswa)
    {
        $proses = 'di tolak';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $data = [
            'status' => $proses,
            'keterangan' => $this->input->post('keterangan'),
            'date_updated' => $date

        ];
        $this->db->where('nim_mahasiswa', $nim_mahasiswa);
        $this->db->update('a_yudisium', $data);
    }
     public function tanggal_Idbp($id_bp)
    {
 
        $data = [
            'date_updated' => $this->input->post('tanggal')

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
    public function ajukanBebasPerpus($id_bp)
    {
        $proses = 'di ajukan';
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        $data = [
            'status' => $proses,
            'keterangan' => 'menunggu proses validasi',
            'date_updated' => $date

        ];
        $this->db->where('id_bp', $id_bp);
        $this->db->update('tb_bebasperpus', $data);
    }

    // public function hitungJumlahSurat()
    // {
    //     // get_where('tb_skl', ['nim' => $id, 'jenis_skl' => '2'])
    //     $query = $this->db->get('tb_bebasperpus');
    //     if ($query->num_rows() > 0) {
    //         return $query->num_rows();
    //     } else {
    //         return 0;
    //     }
    // }

    // public function hitungJumlahdiAjukan()
    // {
    //     $query = $this->db->get_where('tb_bebasperpus', ['status' => '']);
    //     if ($query->num_rows() > 0) {
    //         return $query->num_rows();
    //     } else {
    //         return 0;
    //     }
    // }

    // public function hitungJumlahdiProses()
    // {
    //     $query = $this->db->get_where('tb_bebasperpus', ['status' => 'reject']);
    //     if ($query->num_rows() > 0) {
    //         return $query->num_rows();
    //     } else {
    //         return 0;
    //     }
    // }

    // public function hitungJumlahdiSelesai()
    // {
    //     $query = $this->db->get_where('tb_bebasperpus', ['status' => 'accept']);
    //     if ($query->num_rows() > 0) {
    //         return $query->num_rows();
    //     } else {
    //         return 0;
    //     }
    // }
}
