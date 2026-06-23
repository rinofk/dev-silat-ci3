<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verify extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_set('Asia/Jakarta');
        // Load helpers/models
        $this->load->helper('url');
        $this->load->helper('tanggal');
    }

    public function bebaslab($id)
    {
        // Query bebaslab application detail by ID, joining necessary tables
        $this->db->select('
            tb_bebaslab.*,
            mahasiswa.nama_lengkap,
            mahasiswa.tempat_lahir,
            mahasiswa.tgl_lahir,
            mahasiswa.alamat,
            mahasiswa.no_hp,
            prodi.nama_prodi,
            prodi.slug,
            user.email
        ');
        $this->db->from('tb_bebaslab');
        $this->db->join('mahasiswa', 'mahasiswa.nim = tb_bebaslab.nim_mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.prodi_id');
        $this->db->join('user', 'user.nim = mahasiswa.nim', 'left');
        $this->db->where('tb_bebaslab.id_bebaslab', $id);
        
        $data['bl'] = $this->db->get()->row_array();

        // Verification page should only be shown if document exists and is accepted (accept)
        if (!$data['bl'] || strtolower($data['bl']['status']) !== 'accept') {
            show_404();
        }

        $data['title'] = 'Verifikasi Keaslian Surat Bebas Laboratorium';
        
        $this->load->view('verify/bebaslab', $data);
    }
}
