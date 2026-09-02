<?php

class Pustakawan_model extends CI_model
{

    public function get_All()
    {
        $status = array('accept', '');
        $this->db->select('*');
        $this->db->from('tb_bebasperpus');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebasperpus.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');
        $this->db->order_by('date_created', 'asc');
        $this->db->where_not_in('status', $status);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_Idbp($id_bp)
    {
        $this->db->select('tb_bebasperpus.*, tb_bebasperpus.nim_mahasiswa as nim, mahasiswa.nama_lengkap, mahasiswa.tempat_lahir, mahasiswa.tgl_lahir, mahasiswa.alamat, mahasiswa.no_hp, mahasiswa.prodi_id, prodi.nama_prodi, user.email');
        $this->db->from('tb_bebasperpus');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebasperpus.nim_mahasiswa', 'left');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id', 'left');
        $this->db->join('user', 'user.nim=tb_bebasperpus.nim_mahasiswa', 'left');

        $this->db->where('tb_bebasperpus.id_bp', $id_bp);
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

        $nomor = trim($this->input->post('nomor', true));
        // Jika nomor hanya berisi angka tanpa format, lengkapi dengan template tb_nomorsurat
        if (!empty($nomor) && strpos($nomor, '/') === false) {
            $nomor_surat = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '5'])->row_array();
            $base_nomor  = $nomor_surat ? $nomor_surat['nomor'] : '/UN22.9/TA.01.02/' . date('Y');
            $nomor       = $nomor . $base_nomor;
        }

        $data = [
            'nomor'        => $nomor,
            'status'       => $proses,
            'link'         => $this->input->post('link', true),
            'keterangan'   => 'Validasi Lengkap',
            'date_updated' => $date,
            'admin'        => $this->session->userdata('name')
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
            'date_updated' => $date,
            'admin' => $this->session->userdata('name')

        ];
        $this->db->where('id_bp', $id_bp);
        $this->db->update('tb_bebasperpus', $data);
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
        $this->db->select('*');
        $this->db->from('tb_bebasperpus');
        $this->db->join('mahasiswa', 'mahasiswa.nim=tb_bebasperpus.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi=mahasiswa.prodi_id');

        $this->db->where('nim_mahasiswa', $nim);
        $this->db->group_start()
                 ->where('tb_bebasperpus.status', 'di ajukan')
                 ->or_where('tb_bebasperpus.status', '')
                 ->or_where('tb_bebasperpus.status IS NULL')
                 ->group_end();
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

    //new
    public function count_by_filter($tahun = null, $status = null)
    {
        $this->db->from('tb_bebasperpus b');

        if (!empty($tahun)) {
            $this->db->where('YEAR(b.date_created)', $tahun);
        }

        if (!empty($status)) {
            if ($status === 'di ajukan') {
                $this->db->group_start()
                         ->where('b.status', 'di ajukan')
                         ->or_where('b.status', '')
                         ->or_where('b.status IS NULL')
                         ->group_end();
            } else {
                $this->db->where('b.status', $status);
            }
        }

        return $this->db->count_all_results();
    }

    public function get_filtered_data($tahun = null, $status = null)
    {
        $this->db->select('b.*, m.nama_lengkap, p.nama_prodi');
        $this->db->from('tb_bebasperpus b');
        $this->db->join('mahasiswa m', 'm.nim = b.nim_mahasiswa', 'left');
        $this->db->join('prodi p', 'p.id_prodi = m.prodi_id', 'left');

        if (!empty($tahun)) {
            $this->db->where('YEAR(b.date_created)', $tahun);
        }

        if (!empty($status)) {
            if ($status === 'di ajukan') {
                $this->db->group_start()
                         ->where('b.status', 'di ajukan')
                         ->or_where('b.status', '')
                         ->or_where('b.status IS NULL')
                         ->group_end();
            } else {
                $this->db->where('b.status', $status);
            }
        }
        // Urutkan berdasarkan tanggal dibuat, terbaru di atas
        $this->db->order_by('b.date_created', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_tahun_options()
    {
        $this->db->select('YEAR(date_created) as tahun');
        $this->db->from('tb_bebasperpus');
        $this->db->where('date_created IS NOT NULL');
        $this->db->where('date_created !=', '0000-00-00 00:00:00');
        $this->db->group_by('YEAR(date_created)');
        $this->db->order_by('tahun', 'DESC');

        return $this->db->get()->result_array();
    }

}
