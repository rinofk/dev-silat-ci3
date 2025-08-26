<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skl extends CI_Controller
{
    private $status_badge = [
        'diajukan' => 'secondary',
        'proses'   => 'warning',
        'selesai'  => 'success'
    ];

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Skl_model');
        $this->load->model('Sklyudis_model');
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }



    public function index() 
    {
        $data['title'] = 'Surat Kerangan Lulus';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        // $data['surat'] = $this->Skl_model->getSkl();

        // Ambil filter dari URL
        $tahun  = $this->input->get('tahun', true) ?? date('Y');
        $status = $this->input->get('status', true);

        // Hitungan untuk card dashboard 
        $data['count_diajukan'] = $this->Skl_model->count_by_filter($tahun, 'diajukan');
        $data['count_proses']   = $this->Skl_model->count_by_filter($tahun, 'proses');
        $data['count_selesai']   = $this->Skl_model->count_by_filter($tahun, 'selesai');
        $data['count_total']    = $this->Skl_model->count_by_filter($tahun, null);

        // Data untuk filter dropdown
        $data['filter_tahun']  = $this->Skl_model->get_tahun_options();
        $data['filter_status'] = array_keys($this->status_badge);

        // Data utama
        $data['skl'] = $this->Skl_model->get_filtered_data($tahun, $status);
        $data['status_badge'] = $this->status_badge;


        // $data['total_surat'] = $this->Skl_model->hitungJumlahSurat();
        // $data['total_diajukan'] = $this->Skl_model->hitungJumlahdiAjukan();
        // $data['total_proses'] = $this->Skl_model->hitungJumlahdiProses();
        // $data['total_selesai'] = $this->Skl_model->hitungJumlahdiSelesai();

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('skl/index', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBiodataMahasiswa();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }

    public function detail($id_skl)
    {
        $data['title'] = 'Daftar Pengajuan Surat Aktif Kuliah';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['surat'] = $this->Skl_model->getSklId($id_skl);


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('skl/detail', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBiodataMahasiswa();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }

    public function cetak($id_skl)
    {
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['surat'] = $this->Skl_model->getSklId($id_skl);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '2'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '1'])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('skl/cetak', $data);
        } else {
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('transaksi');
        }
    }

    public function proses($id_skl)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['surat'] = $this->Skl_model->prosesSkl($id_skl);


        $this->Skl_model->prosesSkl($id_skl);
        $this->session->set_flashdata('flash', 'di PROSES');
        redirect('skl/detail/' . $id_skl);
    }
    public function prosesupdateskl($id_skl)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['surat'] = $this->Skl_model->prosesupdateSkl($id_skl);


        $this->Skl_model->prosesupdateSkl($id_skl);
        $this->session->set_flashdata('flash', 'di UPDATE');
        redirect('skl/detail/' . $id_skl);
    }
    
     public function delete($id_skl)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
      //  $data['surat'] = $this->Skl_model->prosesupdateSkl($id_skl);


        $this->Skl_model->deleteSkl($id_skl);
        $this->session->set_flashdata('flash', 'di DELETE');
        redirect('skl/detail/' . $id_skl);
    }
    public function selesai($id_skl)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['surat'] = $this->Skl_model->selesaiSkl($id_skl);


        $this->Skl_model->selesaiSkl($id_skl);
        $this->session->set_flashdata('flash', 'di SELESAIKAN');
        redirect('skl/detail/' . $id_skl);
        
    }


    // SKL Yudisium Kontroller
    public function yudisium()
    {
        $data['title'] = 'Surat Kerangan Lulus Yudisium';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->Sklyudis_model->getSkl();
        $data['total_surat'] = $this->Sklyudis_model->hitungJumlahSurat();
        $data['total_diajukan'] = $this->Sklyudis_model->hitungJumlahdiAjukan();
        $data['total_proses'] = $this->Sklyudis_model->hitungJumlahdiProses();
        $data['total_selesai'] = $this->Sklyudis_model->hitungJumlahdiSelesai();

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sklyudisium/index', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBiodataMahasiswa();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }

    public function detailyudisium($id_skl)
    {
        $data['title'] = 'Daftar Pengajuan Surat Aktif Kuliah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->Sklyudis_model->getSklId($id_skl);


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sklyudisium/detail', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBiodataMahasiswa();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }

    public function cetakyudisium($id_skl)
    {
        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['surat'] = $this->Sklyudis_model->getSklId($id_skl);
        $data['kop'] = $this->db->get_where('tb_kop', ['id_kop' => '1'])->row_array();
        $data['nomor'] = $this->db->get_where('tb_nomorsurat', ['id_nomor' => '2'])->row_array();

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('sklyudisium/cetak', $data);
        } else {
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('transaksi');
        }
    }

    public function prosesyudisium($id_skl)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->Sklyudis_model->prosesSkl($id_skl);


        $this->Sklyudis_model->prosesSkl($id_skl);
        $this->session->set_flashdata('flash', 'di PROSES');
        redirect('skl/detailyudisium/' . $id_skl);
    }
    
    public function selesaiyudisium($id_skl)
    {

        $data['tanggal'] = tanggal();
        $data['judul'] = 'PDF Data Mahasiswa';
        $data['surat'] = $this->Sklyudis_model->selesaiSkl($id_skl);


        $this->Sklyudis_model->selesaiSkl($id_skl);
        $this->session->set_flashdata('flash', 'di SELESAIKAN');
        redirect('skl/detailyudisium/' . $id_skl);
    }
    
    public function updateyudisium($id_alumni)
    {

        $data['title'] = 'Update Pengajuan Surat Aktif Kuliah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['surat'] = $this->Sklyudis_model->getSklId($id_skl);
        $data['surat'] = $this->Sklyudis_model->getSklIdAlumni($id_alumni);


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('ipk', 'IPK', 'required');
        $this->form_validation->set_rules('tgl_lulus', 'Tanggal Lulus', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sklyudisium/update', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Sklyudis_model->updateSklYudisium($id_alumni);
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('skl/updateyudisium/' . $id_alumni); 
            }
    }
    public function tandai_selesai($id_skl)
    {
        $this->db->where('id_skl', $id_skl);
        $this->db->update('tb_skl', ['status' => 'selesai','admin' => $this->session->userdata('name')]);

        $this->session->set_flashdata('flash', 'Status berhasil diubah menjadi selesai');
        redirect('skl?tahun=2025&status=proses');
    }


}
