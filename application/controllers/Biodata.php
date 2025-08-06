<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biodata extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Mahasiswa_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Biodata';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['nim'];
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaByNim($id);
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['agama'] = $this->db->get('agama')->result_array();
        $data['keperluan'] = $this->db->get('keperluan')->result_array();
        $data['aktif'] = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('program_studi', 'Program Studi', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'NO HP', 'required');
        $this->form_validation->set_rules('agama', 'agama', 'required');
        $this->form_validation->set_rules('agamaa', 'Agama', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('biodata/index', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->Mahasiswa_model->ubahBioData();
            $this->session->set_flashdata('flash', 'di UPDATE');
            redirect('biodata');
        }
    }
}
