<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satumahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Satumahasiswa_model');
    }

    public function index()
    {
            // tambahkan ini:
         $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();        
        $data['title'] = 'Sinkronisasi Data Mahasiswa (Satu Data)';
        $data['mahasiswa'] = $this->Satumahasiswa_model->getAll();

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('satumahasiswa/index', $data);
        $this->load->view('templates/footer_a');
    }

    // AJAX sinkronisasi
    public function sync()
    {
        $dataApi = $this->Satumahasiswa_model->fetchFromSatuData();
        $total = count($dataApi);
        $inserted = 0;

        foreach ($dataApi as $row) {
            $this->Satumahasiswa_model->insertOrUpdate([
                'nim' => $row['nim'],
                'nama' => $row['nama'],
                'email' => $row['email'],
                'sistem_kuliah' => $row['sistem_kuliah'],
                'id_periode' => $row['id_periode'],
                'id_periode_terakhir' => $row['id_periode_terakhir'],
                'alamat' => $row['alamat'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' => $row['tanggal_lahir'],
                'hp' => $row['hp'],
                'agama' => $row['agama'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'nama_ayah' => $row['nama_ayah'],
                'nama_ibu' => $row['nama_ibu'],
                'id_program_studi' => $row['id_program_studi'],
                'nama_program_studi' => $row['nama_program_studi'],
                'id_fakultas' => $row['id_fakultas'],
                'nama_fakultas' => $row['nama_fakultas'],
                'id_jurusan' => $row['id_jurusan'],
                'nama_jurusan' => $row['nama_jurusan'],
            ]);
            $inserted++;
            $progress = round(($inserted / $total) * 100);

            // Simulasi delay agar progress terlihat berjalan
            usleep(10000);
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Sinkronisasi selesai!',
            'total' => $total
        ]);
    }
}
