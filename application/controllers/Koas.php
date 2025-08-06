<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Mahasiswa_model');
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }


    public function index()
    {
        $data['title'] = 'Koas';
        
        $this->load->view('koas/resources/views/home.blade.php', $data);
       
    }

    public function tambah()
    {
        $data['title'] = 'Form Tambah Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['keperluan'] = $this->db->get('keperluan')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();


        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('mahasiswa/tambah');
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('mahasiswa');
        }
    }

    public function hapus($nim)
    {
        $this->Mahasiswa_model->hapusDataMahasiswa($nim);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('mahasiswa');
    }

    public function detail($nim)
    {

        $data['title'] = 'Detail data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaByJoin($nim);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/detail', $data);
        $this->load->view('templates/footer_a');
    }

    public function ubah($nim)
    {
        $data['title'] = 'Form Ubah Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($nim);
        // $data['program_studi'] = ['Kedokteran', 'Farmasi', 'Keperawatan', 'Pendidikan Profesi Dokter', 'Pendidikan Profesi Apoteker', 'Pendidikan Profesi Ners'];
        // $data['keperluan'] = ['masuk dalam tunjangan gaji orang tua', 'pensiun orang tua', 'asuransi kesehatan (ASKES)', 'BPJS', 'pengajuan beasiswa', 'mengikuti kegiatan'];
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['keperluan'] = $this->db->get('keperluan')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['agama'] = $this->db->get('agama')->result_array();
        $data['tanggal'] = tanggal();



        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('mahasiswa/ubah', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('mahasiswa/ubah/' . $nim);
        }
    }
    public function ubahotomatis($nim)
    {
        $data['title'] = 'Form Ubah Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($nim);
        // $data['program_studi'] = ['Kedokteran', 'Farmasi', 'Keperawatan', 'Pendidikan Profesi Dokter', 'Pendidikan Profesi Apoteker', 'Pendidikan Profesi Ners'];
        // $data['keperluan'] = ['masuk dalam tunjangan gaji orang tua', 'pensiun orang tua', 'asuransi kesehatan (ASKES)', 'BPJS', 'pengajuan beasiswa', 'mengikuti kegiatan'];
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['keperluan'] = $this->db->get('keperluan')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['agama'] = $this->db->get('agama')->result_array();
        $data['tanggal'] = tanggal();



        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('mahasiswa/ubah', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBioData();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('mahasiswa/ubah/' . $nim);
        }
    }

    public function laporanpdf($nim)
    {

        $data['judul'] = 'PDF Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($nim);
        $data['keperluan'] = $this->db->get('keperluan')->result_array();


        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            //  $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/laporanpdf', $data);
            //  $this->load->view('templates/footer');
        } else {
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('mahasiswa');
        }
    }

    public function cetak($nim)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaByJoin($nim);
        $mhs = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();


        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            if ($mhs['keperluan'] == 'masuk dalam tunjangan gaji orang tua') {
                //   $this->load->view('mahasiswa/kop', $data);
                $this->load->view('mahasiswa/cetak', $data);
                //  $this->load->view('templates/footer');
            } else {
                if ($mhs['keperluan'] == 'pensiun orang tua') {
                    //   $this->load->view('mahasiswa/kop', $data);
                    $this->load->view('mahasiswa/cetak', $data);
                    //  $this->load->view('templates/footer');
                } else {
                    $this->load->view('mahasiswa/cetakversi1', $data);
                }
            }
        } else {
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('mahasiswa');
        }
    }
    public function cetakversi1($nim)
    {
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($nim);

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
            //   $this->load->view('mahasiswa/kop', $data);
            $this->load->view('mahasiswa/cetakversi1', $data);
            //  $this->load->view('templates/footer');
        } else {
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('mahasiswa');
        }
    }
}
