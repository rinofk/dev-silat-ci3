<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurnal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Jurnal_model');
        $this->load->library('form_validation');
        $this->load->library('pdf');
        $this->load->helper('download');
        $this->load->helper('url');
    }


    public function index()
    {
        $data['title'] = 'Jurnal Online / Naskah Publikasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['naspub'] = $this->Jurnal_model->getAllNaspub();
        $data['total_surat'] = $this->Jurnal_model->hitungJumlahSurat();
        $data['total_diajukan'] = $this->Jurnal_model->hitungJumlahdiAjukan();
        $data['total_proses'] = $this->Jurnal_model->hitungJumlahdiProses();
        $data['total_selesai'] = $this->Jurnal_model->hitungJumlahSelesai();

        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jurnal/index', $data);
        $this->load->view('templates/footer_a');
    }
    public function detail($id_naspub)
    {
        $data['title'] = 'Daftar Pengajuan Surat Aktif Kuliah';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['surat'] = $this->Jurnal_model->getNaspubById($id_naspub);


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jurnal/detail', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBiodataMahasiswa();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }

    public function proses($id_naspub)
    {
        $data['title'] = 'Daftar Pengajuan Surat Aktif Kuliah';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['surat'] = $this->Jurnal_model->getNaspubById($id_naspub);


        $this->form_validation->set_rules('link', 'Link Naspub', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jurnal/proses', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Jurnal_model->updateNaspub($id_naspub);
            $this->session->set_flashdata('flash', 'di SIMPAN');
            redirect('jurnal/proses/' . $id_naspub);
        }
    }
    public function download($naspub)
    {
        $data = file_get_contents(base_url().'assets/naspub/'.$naspub);
        $name = $naspub;
    force_download($name, $data);
    }
   public function reject($id_naspub)
    {

        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->Jurnal_model->reject($id_naspub);
        $this->session->set_flashdata('flash', 'di REJECT');
        redirect('jurnal/detail/' . $id_naspub);
    }
}
