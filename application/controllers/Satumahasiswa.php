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

        $reg_source = $this->db->get_where('tb_setting', ['setting_key' => 'registration_source'])->row_array();
        $data['registration_source'] = $reg_source ? $reg_source['setting_value'] : 'service';

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('satumahasiswa/index', $data);
        $this->load->view('templates/footer_a');
    }

    // AJAX update setting registrasi
    public function update_setting()
    {
        $source = $this->input->post('registration_source');
        if (in_array($source, ['service', 'database'])) {
            // Check if key already exists
            $exists = $this->db->get_where('tb_setting', ['setting_key' => 'registration_source'])->row_array();
            if ($exists) {
                $this->db->where('setting_key', 'registration_source');
                $this->db->update('tb_setting', ['setting_value' => $source]);
            } else {
                $this->db->insert('tb_setting', [
                    'setting_key' => 'registration_source',
                    'setting_value' => $source
                ]);
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Sumber data registrasi berhasil diperbarui!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Pilihan sumber data tidak valid.'
            ]);
        }
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
