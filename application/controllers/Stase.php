<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stase extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        //        $this->load->model('Mahasiswa_model');
        $this->load->model('Stase_model');
        $this->load->model('Klinis_model');
        $this->load->library('form_validation');
        //$this->load->library('pdf');
    }
    public function index()
    {
        $data['title'] = 'Stase Mahasiswa FK UNTAN';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $id = $data['user']['nim'];
        $data['surat'] = $this->Stase_model->getSuratByNim($id);

        // echo 'Selamat Datang User ' . $data['user']['name'];
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['keperluan'] = $this->db->get('keperluan')->result_array();


        $data['status'] = $this->db->get_where('tb_alumni', ['nim_alumni' => $id])->row_array();


            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header_a', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('stase/index', $data);
                $this->load->view('templates/footer_a');
            } else {
                $this->Surat_model->tambahPengajuanSurat();
                $this->session->set_flashdata('flash', 'di UPDATE');
                redirect('biodata');
            }
       
    }

    public function kelompokdetail($id_praktekklinik)
    {
        $data['title'] = 'Kelompok Detail nomor '.$id_praktekklinik;
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['kd'] = $this->Klinis_model->get_IdKelompokDetail($id_praktekklinik);
        // $data['menu'] = $this->db->get('pk_id_kelompok')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");


        $this->form_validation->set_rules('nim_mahasiswa', 'nim_mahasiswa', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_a', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klinis/stasekelompokdetail', $data);
            $this->load->view('templates/footer_a');
        } else {
            $this->db->insert('pk_kelompok', ['id_praktekklinik' => $this->input->post('id_praktekklinik'),'nim_mahasiswa' => $this->input->post('nim_mahasiswa'), 'admin' => $this->session->userdata('name'), 'date_create' => $date]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New ID Kelompok Added</div>');
            redirect('klinis/kelompokdetail/'.$id_praktekklinik);
   
        }
    }


}
