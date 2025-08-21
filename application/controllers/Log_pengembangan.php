<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_pengembangan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Log_pengembangan_model');

       //cek_login();
    }

    public function index() {
        $data['title'] = 'Log Pengembangan';
        $data['logs'] = $this->Log_pengembangan_model->get_all_logs();
                $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();


        $this->load->view('templates/header_a', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        //$this->load->view('templates/header', $data);
        $this->load->view('log_pengembangan/index', $data);
        $this->load->view('templates/footer_a');
    }

    public function tambah() {
        if ($this->input->post()) {
            $data = [
                'judul'      => $this->input->post('judul'),
                'deskripsi'  => $this->input->post('deskripsi'),
                'kategori'   => $this->input->post('kategori'),
                'tanggal'    => date('Y-m-d'),
                'dibuat_oleh'=> 'Developer'
            ];
            $this->Log_pengembangan_model->insert_log($data);
            $this->session->set_flashdata('success', 'Log pengembangan berhasil ditambahkan.');
            redirect('log_pengembangan');
        }
    }
}
