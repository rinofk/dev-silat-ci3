<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Studi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        // $this->load->model('Mahasiswa_model');
        $this->load->model('Studi_model');
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }



    public function index()
    {
        $data['title'] = 'Surat Pengantar Studi Pendahuluan/ Penelitian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->Studi_model->getStudiP();
        $data['total_surat'] = $this->Studi_model->hitungJumlahSurat();
        $data['total_diajukan'] = $this->Studi_model->hitungJumlahdiAjukan();
        $data['total_proses'] = $this->Studi_model->hitungJumlahdiProses();
        $data['total_selesai'] = $this->Studi_model->hitungJumlahdiSelesai();

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('studi/index', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBiodataMahasiswa();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }

    public function detail($id_studip)
    {
        $data['title'] = 'Daftar Pengajuan Surat Aktif Kuliah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->Studi_model->getStudiById($id_studip);


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('studi/detail', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBiodataMahasiswa();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }

    public function cetak($id_studip)
    {
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['surat'] = $this->Studi_model->getStudiById($id_studip);

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {
          
                $this->load->view('studi/cetak', $data);
           
           
        } else {
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('transaksi');
        }
    }

    public function proses($id_studip)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->Studi_model->prosesStudip($id_studip);


        $this->Studi_model->prosesStudip($id_studip);
        $this->session->set_flashdata('flash', 'di PROSES');
        redirect('studi/detail/' . $id_studip);
    }
    public function selesai($id_studip)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['surat'] = $this->Studi_model->selesaiStudip($id_studip);


        $this->Studi_model->selesaiStudip($id_studip);
        $this->session->set_flashdata('flash', 'di SELESAIKAN');
        redirect('studi/detail/' . $id_studip);
    }
    

}
